<?php

declare(strict_types=1);

namespace Dingtalk\Checkin;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 获取部门用户签到记录
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function records(array $params): ResponseInterface
    {
        return $this->http->client->get('checkin/record', [
            'query' => $params,
        ]);
    }

    /**
     * 获取用户签到记录
     *
     * @param array $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/checkin/record/get', [
            'json'=>$params
        ]);
    }
}