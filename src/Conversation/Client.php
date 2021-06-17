<?php

declare(strict_types=1);

namespace Dingtalk\Conversation;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 发送普通消息
     *
     * @param string $sender
     * @param string $cid
     * @param array  $message
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendNormalMessage(string $sender, string $cid, array $message): ResponseInterface
    {
        return $this->http->client->post('message/send_to_conversation', [
            'json' => [
                'sender' => $sender,
                'cid' => $cid,
                'msg' => $message,
            ],
        ]);
    }

    /**
     * 发送工作通知消息
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function sendCorporationMessage(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/message/corpconversation/asyncsend_v2', [
            'json' => $params,
        ]);
    }

    /**
     * 查询工作通知消息的发送进度
     * @param int $taskId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function progress(int $taskId): ResponseInterface
    {
        return $this->http->client->post('topapi/message/corpconversation/getsendprogress', [
            'json' => [
                'agent_id' => $this->app['config']['agent_id'],
                'task_id' => $taskId,
            ],
        ]);
    }

    /**
     * 查询工作通知消息的发送结果
     *
     * @param int $taskId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function result(int $taskId): ResponseInterface
    {
        return $this->http->client->post('topapi/message/corpconversation/getsendresult', [
            'json' => [
                'agent_id' => $this->app['config']['agent_id'],
                'task_id' => $taskId,
            ],
        ]);
    }
}