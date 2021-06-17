<?php

declare(strict_types=1);

namespace Dingtalk\Kernel\Providers;

use Dingtalk\Kernel\Server;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServerServiceProvider implements ServiceProviderInterface
{
    /**
     * Registers services on the given container.
     * This method should only be used to configure services and parameters.
     * It should not get services.
     *
     * @param Container $pimple A container instance
     */
    public function register(Container $pimple)
    {
        $pimple['server'] = function ($app) {
            return new Server($app);
        };
    }
}