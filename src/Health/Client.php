<?php

declare(strict_types=1);

namespace Dingtalk\Health;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 查询用户是否开启了钉钉运动
     *
     * @param string $userId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function status(string $userId): ResponseInterface
    {
        return $this->http->client->post('topapi/health/stepinfo/getuserstatus', [
            'json' => [
                'userid' => $userId
            ],
        ]);
    }

    /**
     * 获取个人钉钉运动数据
     *
     * @param string $id
     * @param string $dates
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function byUser(string $id, string $dates): ResponseInterface
    {
        return $this->http->client->post('topapi/health/stepinfo/list', [
            'json' => [
                'type' => 0,
                'object_id' => $id,
                'stat_dates' => $dates
            ]
        ]);
    }

    /**
     * 获取部门钉钉运动数据
     *
     * @param string $id
     * @param string $dates
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function byDepartment(string $id, string $dates): ResponseInterface
    {
        return $this->http->client->post('topapi/health/stepinfo/list', [
            'json' => [
                'type' => 1,
                'object_id' => $id,
                'stat_dates' => $dates
            ]
        ]);
    }

    /**
     * 批量获取钉钉运动数据
     *
     * @param array  $userIds
     * @param string $date
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function byUsers(array $userIds, string $date): ResponseInterface
    {
        return $this->http->client->post('topapi/health/stepinfo/listbyuserid', [
            'json' => [
                'userids' => implode(',', $userIds),
                'stat_date' => $date
            ],
        ]);
    }
}