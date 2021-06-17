<?php

declare(strict_types=1);

namespace Dingtalk\Kernel;

use Closure;
use Dingtalk\Application;
use Dingtalk\Kernel\Exceptions\InvalidArgumentException;
use Hyperf\HttpServer\Request;
use Hyperf\Utils\ApplicationContext;

class Server
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var array
     */
    protected $handlers = [];

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle the request.
     */
    public function serve()
    {
        foreach ($this->handlers as $handler) {
            $handler->__invoke($this->getPayload());
        }

        $this->app['logger']->debug('Request received: ', [
            'method' => $this->app['request']->getMethod(),
            'uri' => $this->app['request']->getUri(),
            'content' => $this->app['request']->getContent(),
        ]);

        return $this->app['encryptor']->encrypt('success');
    }

    /**
     * Push handler.
     *
     * @param Closure|string|object $handler
     *
     * @return void
     *
     * @throws InvalidArgumentException
     */
    public function push($handler)
    {
        if (is_string($handler)) {
            $handler = function ($payload) use ($handler) {
                return (new $handler($this->app))->__invoke($payload);
            };
        }

        if (! is_callable($handler)) {
            throw new InvalidArgumentException('Invalid handler');
        }

        array_push($this->handlers, $handler);
    }

    /**
     * Get request payload.
     *
     * @return array
     */
    public function getPayload(): array
    {

        $request = ApplicationContext::getContainer()->get(Request::class);
//        $payload = json_decode($this->app['request']->getContent(), true);

//        if (JSON_ERROR_NONE !== json_last_error()) {
//            throw new RuntimeException('No payload received');
//        }

        $payload = $request->all();
        var_dump($payload);

        $result = $this->app['encryptor']->decrypt(
            $payload['encrypt'], $payload['signature'], $payload['nonce'], (int) $payload['timestamp']
        );

        return json_decode($result, true);
    }
}
