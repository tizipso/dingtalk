<?php

declare(strict_types=1);

namespace Dingtalk\Microapp;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 获取应用列表
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function list(): ResponseInterface
    {
        return $this->http->client->post('microapp/list');
    }

    /**
     * 获取员工可见的应用列表
     *
     * @param string $userId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function listByUserId(string $userId): ResponseInterface
    {
        return $this->http->client->get('microapp/list_by_userid', [
            'query' => [
                'userid' => $userId,
            ]
        ]);
    }

    /**
     * 获取应用的可见范围
     *
     * @param int $agentId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getVisibility(int $agentId): ResponseInterface
    {
        return $this->http->client->post('microapp/visible_scopes', [
            'json' => [
                'agentId' => $agentId,
            ]
        ]);
    }

    /**
     * 设置应用的可见范围
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function setVisibility(array $params): ResponseInterface
    {
        return $this->http->client->post('microapp/set_visible_scopes', [
            'json' => $params
        ]);
    }
}
