<?php

declare(strict_types=1);

namespace Dingtalk\Kernel;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Application;
use Dingtalk\Kernel\Concerns\InteractsWithCache;
use Dingtalk\Kernel\Exceptions\InvalidCredentialsException;
use Dingtalk\Kernel\Http\Client;
use Psr\SimpleCache\InvalidArgumentException;

class AccessToken
{
    use InteractsWithCache;

    /**
     * @var Application
     */
    protected $app;

    private $authorization = false;

    /**
     * AccessToken constructor.
     *
     * @param Application
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * 获取钉钉 AccessToken
     *
     * @return array
     * @throws GuzzleException|InvalidCredentialsException|InvalidArgumentException
     */
    public function get(): array
    {
        if ($value = $this->getCache()->get($this->cacheFor())) {
            return $value;
        }

        return $this->refresh();
    }

    /**
     * 获取 AccessToken
     *
     * @return string
     * @throws GuzzleException|InvalidCredentialsException|InvalidArgumentException
     */
    public function getToken(): string
    {
        return $this->get()['access_token'];
    }

    /**
     * 刷新钉钉 AccessToken
     *
     * @return array
     * @throws GuzzleException|InvalidCredentialsException|InvalidArgumentException
     */
    public function refresh(): array
    {
        $response = (new Client($this->app))->client->get('gettoken', [
            'query' => [
                'appkey' => $this->app['config']->get('app_key'),
                'appsecret' => $this->app['config']->get('app_secret'),
            ]
        ]);

        $content = $response->getBody()->getContents();

        $response = json_decode($content, true);

        if ($response['errcode'] !== 0) {
            throw new InvalidCredentialsException(json_encode($response));
        }

         $this->getCache()->set($this->cacheFor(), $response, $response['expires_in']);

        return $response;
    }

    /**
     * 缓存 Key
     *
     * @return string
     */
    protected function cacheFor(): string
    {
        return sprintf('access_token:dingtalk:%s', $this->app['config']->get('app_key'));
    }
}
