<?php

declare(strict_types=1);

namespace Dingtalk\Kernel\Providers;

use Dingtalk\Kernel\AccessToken;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class AccessTokenServiceProvider implements ServiceProviderInterface
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
        isset($pimple['access_token']) || $pimple['access_token'] = function ($app) {
            return new AccessToken($app);
        };
    }
}