<?php

declare(strict_types=1);

namespace Dingtalk\Attendance;

use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 企业考勤排班详情
     *
     * @param string   $date
     * @param int|null $offset
     * @param int|null $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function schedules(string $date, int $offset = null, int $size = null): ResponseInterface
    {
        return $this->http->client->post('topapi/attendance/listschedule', [
            'json' => [
                'workDate' => $date, 'offset' => $offset, 'size' => $size,
            ]
        ]);
    }

    /**
     * 企业考勤组详情
     *
     * @param int|null $offset
     * @param int|null $size
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function groups(int $offset = null, int $size = null): ResponseInterface
    {
        return $this->http->client->post('topapi/attendance/getsimplegroups', [
            'json' => [
                'offset' => $offset,
                'size' => $size,
            ],
        ]);
    }

    /**
     * 获取用户考勤组
     *
     * @param string $userId
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function userGroup(string $userId): ResponseInterface
    {
        return $this->http->client->post('topapi/attendance/getusergroup', [
            'json' => ['userid' => $userId],
        ]);
    }

    /**
     * 获取打卡详情
     *
     * @param array $params
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function records(array $params): ResponseInterface
    {
        return $this->http->client->post('attendance/listRecord', [
            'json' => $params
        ]);
    }

    /**
     * 获取打卡结果
     *
     * @param array $params
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function results(array $params): ResponseInterface
    {
        return $this->http->client->post('attendance/list', [
            'json' => $params,
        ]);
    }

    /**
     * 获取请假时长
     *
     * @param string $userId
     * @param Carbon $from
     * @param Carbon $to
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function duration(string $userId, Carbon $from, Carbon $to): ResponseInterface
    {
        return $this->http->client->post('topapi/attendance/getleaveapproveduration', [
            'json' => [
                'userid' => $userId, 'from_date' => $from, 'to_date' => $to,
            ],
        ]);
    }

    /**
     * 查询请假状态
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function status(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/attendance/getleavestatus', [
            'json' => $params,
        ]);
    }
}