<?php

declare(strict_types=1);

namespace Dingtalk\Kernel\Providers;

use Dingtalk\Kernel\Encryption\Encryptor;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class EncryptionServiceProvider implements ServiceProviderInterface
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
        $pimple['encryptor'] = function ($app) {
            return new Encryptor(
                $app['config']->get('app_key'),
                $app['config']->get('token'),
                $app['config']->get('aes_key')
            );
        };
    }
}