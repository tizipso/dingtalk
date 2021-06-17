<?php

declare(strict_types=1);

namespace Dingtalk\Kernel\Http;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Dingtalk\Application;
use Hyperf\Guzzle\PoolHandler;
use Hyperf\Utils\Coroutine;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Client
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var HttpClient
     */
    public $client;

    /**
     * @var HandlerStack
     */
    private $stack;

    /**
     * @var array
     */
    protected static $httpConfig = [
        'base_uri' => 'https://oapi.dingtalk.com',
    ];

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        $config = array_merge(static::$httpConfig, $this->app['config']->get('http', []));

        $this->toHandler($config);
    }

    /**
     * @param array $config
     */
    public function setHttpConfig(array $config)
    {
        static::$httpConfig = array_merge(static::$httpConfig, $config);
    }

    public function toHandler(array $config)
    {
        $handler = null;

        if (Coroutine::inCoroutine() && ! $handler) {
            $handler = make(PoolHandler::class, [
                'option' => [
                    'max_connections' => 50,
                ],
            ]);
        }

        if (! $this->stack) {

            $this->stack = HandlerStack::create($handler);

            $this->withRetryMiddleware();
            $this->withAccessTokenMiddleware();
        }

        $client = make(HttpClient::class, [
            'config' => array_merge($config, [
                'handler' => $this->stack,
            ]),
        ]);

        $this->client = $client;
    }

    private function withAccessTokenMiddleware()
    {
        $middleware = function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                if ($this->app['access_token'] && $request->getUri()->getPath() !== '/gettoken') {

                    parse_str($request->getUri()->getQuery(), $query);

                    $request = $request->withUri(
                        $request->getUri()->withQuery(http_build_query(['access_token' => $this->app['access_token']->getToken()] + $query))
                    );
                }

                return $handler($request, $options);
            };
        };

        $this->stack->push($middleware, 'access_token');
    }

    private function withRetryMiddleware()
    {
        $middleware = Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null) {
            if (is_null($response) || $retries < 1) {
                return false;
            }

            if (in_array(json_decode($response->getBody(), true)['errcode'] ?? null, [40001])) {
                $this->app['access_token']->refresh();

                return true;
            }

            return false;
        });

        $this->stack->push($middleware, 'retry');
    }
}