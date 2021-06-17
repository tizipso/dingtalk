<?php

declare(strict_types=1);

namespace Dingtalk\Process;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 发起审批实例
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function create(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/processinstance/create', [
            'json' => $params,
        ]);
    }

    /**
     * 获取审批实例ID列表
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getIds(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/processinstance/listids', [
            'json' => $params,
        ]);
    }

    /**
     * 获取审批实例详情
     *
     * @param string $id
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(string $id): ResponseInterface
    {
        return $this->http->client->post('topapi/processinstance/get', [
            'json' => [
                'process_instance_id' => $id
            ],
        ]);
    }

    /**
     * 获取用户待审批数量
     *
     * @param string $userId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function count(string $userId): ResponseInterface
    {
        return $this->http->client->post('topapi/process/gettodonum', [
            'json' => [
                'userid' => $userId
            ],
        ]);
    }

    /**
     * 获取指定用户可见的审批表单列表
     *
     * @param string|null $userId
     * @param int         $offset
     * @param int         $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function listByUserId(string $userId = null, int $offset = 0, int $size = 100): ResponseInterface
    {
        return $this->http->client->post('topapi/process/listbyuserid', [
            'json' => [
                'userid' => $userId,
                'offset' => $offset,
                'size' => $size
            ],
        ]);
    }
}