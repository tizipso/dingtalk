<?php

declare(strict_types=1);

namespace Dingtalk\Kernel\Concerns;

use Hyperf\Utils\ApplicationContext;
use Psr\SimpleCache\CacheInterface;

trait InteractsWithCache
{
    protected $cache;

    public function getCache()
    {
        if ($this->cache) {
            return $this->cache;
        }

        $cache = ApplicationContext::getContainer()->get(CacheInterface::class);

        return $this->cache = $cache;
    }
}