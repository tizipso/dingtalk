<?php

declare(strict_types=1);

namespace Dingtalk\Kernel\Providers;

use Dingtalk\Kernel\Http\Client;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ClientServiceProvider implements ServiceProviderInterface
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
        isset($pimple['client']) || $pimple['client'] = function ($app) {
            return new Client($app);
        };
    }
}