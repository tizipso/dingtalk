<?php

declare(strict_types=1);

namespace Dingtalk\Microapp;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
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
        $pimple['microapp'] = function ($app) {
            return new Client($app);
        };
    }
}
