<?php

declare(strict_types=1);

namespace Dingtalk\Chat;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 发送群消息
     *
     * @param string $chatId
     * @param string $message
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function send(string $chatId, string $message): ResponseInterface
    {
        return $this->http->client->post('chat/send', [
            'json' => [
                'chatid' => $chatId,
                'msg' => $message,
            ]
        ]);
    }

    /**
     * 查询群消息已读人员列表
     *
     * @param string $messageId
     * @param int    $cursor
     * @param int    $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function result(string $messageId, int $cursor, int $size): ResponseInterface
    {
        return $this->http->client->get('chat/getReadList', [
            'query' => [
                'messageId' => $messageId, 'cursor' => $cursor, 'size' => $size,
            ]
        ]);
    }

    /**
     * 创建群会话
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function create(array $params): ResponseInterface
    {
        return $this->http->client->post('chat/create', [
            'json' => $params,
        ]);
    }

    /**
     * 修改群会话
     *
     * @param string $chatId
     * @param array  $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function update(string $chatId, array $params): ResponseInterface
    {
        return $this->http->client->post('chat/update', [
            'json' => array_merge([
                'chatid' => $chatId
            ], $params),
        ]);
    }

    /**
     * 获取群会话信息
     *
     * @param string $chatId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(string $chatId): ResponseInterface
    {
        return $this->http->client->get('chat/get', [
            'query' => [
                'chatid' => $chatId,
            ],
        ]);
    }
}