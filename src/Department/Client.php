<?php

declare(strict_types=1);

namespace Dingtalk\Department;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 获取子部门 ID 列表
     *
     * @param int $dept_id
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getSubDepartmentIds(int $dept_id): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/department/listsubid', [
            'json' => [
                'dept_id' => $dept_id,
            ],
        ]);
    }

    /**
     * 获取部门列表
     *
     * @param int|null $dept_id
     * @param null     $language
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function list(int $dept_id = null, $language = null): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/department/listsub', [
            'json' => [
                'dept_id' => $dept_id,
                'language' => $language,
            ],
        ]);
    }

    /**
     * 获取部门详情
     *
     * @param int  $dept_id
     * @param null $language
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(int $dept_id, $language = null): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/department/get', [
            'form_params' => [
                'dept_id' => $dept_id,
                'language' => $language,
            ],
        ]);
    }

    /**
     * 获取指定部门的所有父部门列表
     *
     * @param int $dept_id
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getParentsById(int $dept_id): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/department/listparentbydept', [
            'json' => [
                'dept_id' => $dept_id,
            ]
        ]);
    }

    /**
     * 获取指定用户的所有父部门列表
     *
     * @param string $userId
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getParentsByUserId(string $userId): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/department/listparentbyuser', [
            'json' => [
                'userid' => $userId,
            ],
        ]);
    }

    /**
     * 创建部门
     *
     * @param array $params
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function create(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/department/create', [
            'json' => $params,
        ]);
    }

    /**
     * 更新部门
     *
     * @param int   $dept_id
     * @param array $params
     *
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function update(int $dept_id, array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/department/update', [
            'json' => array_merge([
                'dept_id' => $dept_id,
            ], $params)
        ]);
    }

    /**
     * 删除部门
     *
     * @param int $dept_id
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function delete(int $dept_id): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/department/delete', [
            'json' => [
                'dept_id' => $dept_id,
            ]
        ]);
    }
}