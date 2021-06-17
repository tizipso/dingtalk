<?php

declare(strict_types=1);

namespace Dingtalk\Kernel;

use Dingtalk\Application;
use Dingtalk\Kernel\Http\Client;

class BaseClient
{
    /**
     * @var Application
     */
    protected $app;

    /**
     * @var Client
     */
    protected $http;

    /**
     * Client constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->http = $this->app['client'];
    }
}