<?php

declare(strict_types=1);

namespace Dingtalk\Report;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 获取用户发出的日志列表
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function list(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/report/list', [
            'json' => $params,
        ]);
    }

    /**
     * 获取用户可见的日志模板
     *
     * @param string|null $userId
     * @param int         $offset
     * @param int         $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function templates(string $userId = null, int $offset = 0, int $size = 100): ResponseInterface
    {
        return $this->http->client->post('topapi/report/template/listbyuserid', [
            'json' => [
                'userid' => $userId,
                'offset' => $offset,
                'size' => $size,
            ],
        ]);
    }

    /**
     * 获取用户日志未读数
     *
     * @param string $userid
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function unreadCount(string $userid): ResponseInterface
    {
        return $this->http->client->post('topapi/report/getunreadcount', [
            'json' => [
                'userid' => $userid,
            ],
        ]);
    }

    /**
     * 获取日志统计数据
     *
     * @param $report_id
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function statistics($report_id): ResponseInterface
    {
        return $this->http->client->post('topapi/report/statistics', [
            'json' => [
                'report_id' => $report_id,
            ],
        ]);
    }

    /**
     * 获取日志相关人员列表
     *
     * @param string $report_id
     * @param int    $type
     * @param int    $offset
     * @param int    $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function statisticsByType(string $report_id, int $type, int $offset = 0, int $size = 100): ResponseInterface
    {
        return $this->http->client->post('topapi/report/statistics/listbytype', [
            'json' => [
                'report_id' => $report_id,
                'type' => $type,
                'offset' => $offset,
                'size' => $size,
            ],
        ]);
    }

    /**
     * 获取日志接收人员列表
     *
     * @param string $report_id
     * @param int    $offset
     * @param int    $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getReceivers(string $report_id, int $offset = 0, int $size = 100): ResponseInterface
    {
        return $this->http->client->post('topapi/report/receiver/list', [
            'json' => [
                'report_id' => $report_id,
                'offset' => $offset,
                'size' => $size,
            ],
        ]);
    }

    /**
     * 获取日志评论详情
     *
     * @param string $report_id
     * @param int    $offset
     * @param int    $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getComments(string $report_id, int $offset = 0, int $size = 100): ResponseInterface
    {
        return $this->http->client->post('topapi/report/comment/list', [
            'json' => [
                'report_id' => $report_id,
                'offset' => $offset,
                'size' => $size,
            ],
        ]);
    }

}