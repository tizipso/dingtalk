<?php

declare(strict_types=1);

namespace Dingtalk\Role;

use GuzzleHttp\Exception\GuzzleException;
use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 获取角色列表
     *
     * @param null $offset
     * @param null $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function list($offset = null, $size = null): ResponseInterface
    {
        return $this->http->client->post('topapi/role/list', [
            'json' => [
                'offset' => $offset,
                'size' => $size,
            ]
        ]);
    }

    /**
     * 获取角色下的员工列表
     *
     * @param int      $roleId
     * @param int|null $offset
     * @param int|null $size
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getUsers(int $roleId, int $offset = null, int $size = null): ResponseInterface
    {
        return $this->http->client->post('topapi/role/simplelist', [
            'json' => [
                'offset' => $offset,
                'size' => $size,
                'role_id' => $roleId
            ],
        ]);
    }

    /**
     * 获取角色组
     *
     * @param int $groupId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function getGroups(int $groupId): ResponseInterface
    {
        return $this->http->client->post('topapi/role/getrolegroup', [
            'json' => ['group_id' => $groupId]
        ]);
    }

    /**
     * 获取角色详情
     *
     * @param int $roleId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function get(int $roleId): ResponseInterface
    {
        return $this->http->client->post('topapi/role/getrole', [
            'json' => [
                'roleId' => $roleId,
            ]
        ]);
    }

    /**
     * 创建角色
     *
     * @param int    $groupId
     * @param string $roleName
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function create(int $groupId, string $roleName): ResponseInterface
    {
        return $this->http->client->post('role/add_role', [
            'json' => [
                'groupId' => $groupId,
                'roleName' => $roleName,
            ]
        ]);
    }

    /**
     * 更新角色
     *
     * @param int    $roleId
     * @param string $roleName
     *
     * @return mixed
     * @throws GuzzleException
     */
    public function update(int $roleId, string $roleName)
    {
        return $this->http->client->post('role/update_role', [
            'json' => [
                'roleId' => $roleId,
                'roleName' => $roleName,
            ]
        ]);
    }

    /**
     * 删除角色
     *
     * @param int $roleId
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function delete(int $roleId): ResponseInterface
    {
        return $this->http->client->post('topapi/role/deleterole', [
            'json' => ['role_id' => $roleId]
        ]);
    }

    /**
     * 创建角色组
     *
     * @param string $name
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function createGroup(string $name): ResponseInterface
    {
        return $this->http->client->post('role/add_role_group', [
            'json' => [
                'name' => $name,
            ]
        ]);
    }
}
