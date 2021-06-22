<?php

declare(strict_types=1);

namespace Dingtalk\Personnel;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 获取在职员工列表
     *
     * @param string $status_list
     * @param int    $offset
     * @param int    $size 分页大小，最大50。
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function onJob(string $status_list, int $offset = 0, int $size = 50): ResponseInterface
    {
        return $this->http->client->post('topapi/smartwork/hrm/employee/queryonjob', [
            'json' => [
                'status_list' => $status_list,
                'offset' => $offset,
                'size' => $size,
            ],
        ]);
    }

    /**
     * 获取待入职员工列表
     *
     * @param int $offset
     * @param int $size 分页大小，最大50。
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function beHired(int $offset = 0, int $size = 50): ResponseInterface
    {
        return $this->http->client->post('topapi/smartwork/hrm/employee/querypreentry', [
            'json' => [
                'offset' => $offset,
                'size' => $size,
            ],
        ]);
    }

    /**
     * 获取员工离职信息
     *
     * @param array $userid_lists
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function leave(array $userid_lists): ResponseInterface
    {
        $userid_list = implode(',', $userid_lists);

        return $this->http->client->post('topapi/smartwork/hrm/employee/listdimission', [
            'json' => [
                'userid_list' => $userid_list,
            ],
        ]);
    }

    /**
     * 获取离职员工列表
     *
     * @param int $offset
     * @param int $size 分页大小，最大50。
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function leaves(int $offset = 0, int $size = 50): ResponseInterface
    {
        return $this->http->client->post('topapi/smartwork/hrm/employee/querydimission', [
            'json' => [
                'offset' => $offset,
                'size' => $size,
            ],
        ]);
    }

    /**
     * 添加企业待入职员工
     *
     * @param string      $name           名称
     * @param string      $mobile         手机号
     * @param string|null $pre_entry_time 预期入职时间
     * @param array       $extend_info    扩展信息
     * @param string|null $op_userid      操作人
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function add(string $name, string $mobile, string $pre_entry_time = null, array $extend_info = [], string $op_userid = null): ResponseInterface
    {
        return $this->http->client->post('topapi/smartwork/hrm/employee/addpreentry', [
            'json' => [
                'param' => [
                    'pre_entry_time' => $pre_entry_time,
                    'name' => $name,
                    'extend_info' => json_encode($extend_info, JSON_UNESCAPED_UNICODE),
                    'op_userid' => $op_userid,
                    'mobile' => $mobile,
                ],
            ],
        ]);
    }
}