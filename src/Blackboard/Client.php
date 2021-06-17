<?php

declare(strict_types=1);

namespace Dingtalk\Blackboard;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 获取用户公告数据
     *
     * @param string $userid
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function list(string $userid): ResponseInterface
    {
        return $this->http->client->post('topapi/blackboard/listtopten', [
            'json' => [
                'userid' => $userid,
            ],
        ]);
    }
}