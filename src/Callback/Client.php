<?php

declare(strict_types=1);

namespace Dingtalk\Callback;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 注册回调事件
     *
     * @param array $params
     * @return mixed
     * @throws GuzzleException
     */
    public function register(array $params)
    {
        $params['token'] = $this->app['config']->get('token');
        $params['aes_key'] = $this->app['config']->get('aes_key');

        return $this->http->client->post('call_back/register_call_back', [
            'json' => $params,
        ]);
    }

    /**
     * 查询订阅事件
     *
     * @throws GuzzleException
     */
    public function list(): ResponseInterface
    {
        return $this->http->client->get('call_back/get_call_back');
    }

    /**
     * 更新事件回调接口
     * @param $params
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function update($params): ResponseInterface
    {
        $params['token'] = $this->app['config']->get('token');
        $params['aes_key'] = $this->app['config']->get('aes_key');

        return $this->http->client->post('call_back/update_call_back', [
            'json' => $params,
        ]);
    }

    /**
     * 删除事件回调接口
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function delete(): ResponseInterface
    {
        return $this->http->client->get('call_back/delete_call_back');
    }

    /**
     * 获取回调失败结果
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function failed(): ResponseInterface
    {
        return $this->http->client->get('call_back/get_call_back_failed_result');
    }
}