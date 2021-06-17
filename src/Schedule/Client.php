<?php

declare(strict_types=1);

namespace Dingtalk\Schedule;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 发起待办
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function add(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/workrecord/add', [
            'json' => $params,
        ]);
    }

    /**
     * 更新待办
     *
     * @param string $userId
     * @param string $recordId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function update(string $userId, string $recordId): ResponseInterface
    {
        return $this->http->client->post('topapi/workrecord/update', [
            'json' => ['userid' => $userId, 'record_id' => $recordId],
        ]);
    }

    /**
     * 获取用户待办事项
     *
     * @param string $userId
     * @param bool   $completed
     * @param int    $offset
     * @param int    $limit
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function list(string $userId, bool $completed, int $offset, int $limit): ResponseInterface
    {
        return $this->http->client->post('topapi/workrecord/getbyuserid', [
            'json' => [
                'userid' => $userId,
                'status' => (int) $completed,
                'offset' => $offset,
                'limit' => $limit,
            ]
        ]);
    }
}