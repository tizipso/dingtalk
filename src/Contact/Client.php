<?php

declare(strict_types=1);

namespace Dingtalk\Contact;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 获取外部联系人标签列表
     *
     * @param int $offset
     * @param int $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function labels(int $offset = 0, int $size = 100): ResponseInterface
    {
        return $this->http->client->post('topapi/extcontact/listlabelgroups', [
            'json' => [
                'offset' => $offset,
                'size' => $size,
            ]
        ]);
    }

    /**
     * 获取外部联系人列表
     *
     * @param int $offset
     * @param int $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function list(int $offset = 0, int $size = 100): ResponseInterface
    {
        return $this->http->client->post('topapi/extcontact/list', [
            'json' => [
                'offset' => $offset,
                'size' => $size,
            ]
        ]);
    }

    /**
     * 获取外部联系人详情
     *
     * @param string $userId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(string $userId): ResponseInterface
    {
        return $this->http->client->post('topapi/extcontact/get', [
            'json' => [
                'user_id' => $userId,
            ],
        ]);
    }

    /**
     * 添加外部联系人
     *
     * @param array $contact
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function create(array $contact): ResponseInterface
    {
        return $this->http->client->post('topapi/extcontact/create', [
            'json' => [
                'contact' => $contact,
            ]
        ]);
    }

    /**
     * 更新外部联系人
     *
     * @param string $userId
     * @param array  $contact
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function update(string $userId, array $contact): ResponseInterface
    {
        return $this->http->client->post('topapi/extcontact/update', [
            'json' => [
                'contact' => array_merge([
                    'user_id' => $userId,
                ], $contact),
            ]
        ]);
    }

    /**
     * 删除外部联系人
     *
     * @param string $userId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function delete(string $userId): ResponseInterface
    {
        return $this->http->client->post('topapi/extcontact/delete', [
            'json' => [
                'user_id' => $userId
            ],
        ]);
    }

    /**
     * 获取通讯录权限范围
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function scopes(): ResponseInterface
    {
        return $this->http->client->get('auth/scopes');
    }
}