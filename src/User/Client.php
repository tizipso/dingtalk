<?php

declare(strict_types=1);

namespace Dingtalk\User;

use Dingtalk\Kernel\BaseClient;
use Psr\Http\Message\ResponseInterface;

class Client extends BaseClient
{
    /**
     * 获取用户详情
     *
     * @param string      $userid
     * @param string|null $language
     * @return ResponseInterface
     */
    public function get(string $userid, string $language = null): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/user/get', [
            'json' => [
                'userid' => $userid,
                'language' => $language,
            ],
        ]);
    }

    /**
     * 获取部门用户 Userid 列表
     *
     * @param int $dept_id
     * @return ResponseInterface
     */
    public function getUserIds(int $dept_id): ResponseInterface
    {
        return $this->http->client->post('topapi/user/listid', [
            'json' => [
                'dept_id' => $dept_id,
            ],
        ]);
    }

    /**
     * 获取部门用户
     *
     * @param int         $dept_id
     * @param int         $cursor
     * @param int         $size
     * @param string|null $order
     * @param bool|null   $limit
     * @param string|null $language
     * @return ResponseInterface
     */
    public function getUsers(int $dept_id, int $cursor, int $size, string $order = null, bool $limit = false, string $language = null): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/user/listsimple', [
            'json' => [
                'dept_id' => $dept_id,
                'cursor' => $cursor,
                'size' => $size,
                'order_field' => $order,
                'contain_access_limit' => $limit,
                'language' => $language,
            ]
        ]);
    }

    /**
     * 获取部门用户详情
     *
     * @param int         $dept_id
     * @param int         $cursor
     * @param int         $size
     * @param string|null $order
     * @param bool        $limit
     * @param string|null $language
     * @return ResponseInterface
     */
    public function getDetailedUsers(int $dept_id, int $cursor, int $size, string $order = null, bool $limit = false, string $language = null): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/user/list', [
            'json' => [
                'dept_id' => $dept_id,
                'cursor' => $cursor,
                'size' => $size,
                'order_field' => $order,
                'contain_access_limit' => $limit,
                'language' => $language,
            ]
        ]);
    }

    /**
     * 获取管理员列表
     * @return ResponseInterface
     */
    public function administrators(): ResponseInterface
    {
        return $this->http->client->post('topapi/user/listadmin');
    }

    /**
     * 获取管理员通讯录权限范围
     *
     * @param string $userid
     * @return ResponseInterface
     */
    public function administratorScope(string $userid): ResponseInterface
    {
        return $this->http->client->post('topapi/user/get_admin_scope', [
            'json' => [
                'userid' => $userid,
            ],
        ]);
    }

    /**
     * 根据 Unionid 获取 Userid
     *
     * @param string $unionid
     * @return ResponseInterface
     */
    public function getUseridByUnionid(string $unionid): ResponseInterface
    {
        return $this->http->client->post('topapi/user/getbyunionid', [
            'json' => [
                'unionid' => $unionid,
            ],
        ]);
    }

    /**
     * 创建用户
     *
     * @param array $params
     * @return ResponseInterface
     */
    public function create(array $params): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/user/create', [
            'json' => $params,
        ]);
    }

    /**
     * 更新用户
     *
     * @param string $userid
     * @param array  $params
     *
     * @return mixed
     */
    public function update(string $userid, array $params)
    {
        return $this->http->client->post('topapi/v2/user/update', [
            'json' => array_merge([
                'userid' => $userid,
            ], $params),
        ]);
    }

    /**
     * 删除用户
     *
     * @param string $userid
     * @return ResponseInterface
     */
    public function delete(string $userid): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/user/delete', [
            'json' => [
                'userid' => $userid,
            ],
        ]);
    }

    /**
     * 企业内部应用免登获取用户 Userid
     *
     * @param string $code
     * @return ResponseInterface
     */
    public function getUserByCode(string $code): ResponseInterface
    {
        return $this->http->client->get('user/getuserinfo', [
            'query' => [
                'code' => $code,
            ]
        ]);
    }

    /**
     * 批量增加员工角色
     *
     * @param array|string $userIds
     * @param array|string $roleIds
     * @return ResponseInterface
     */
    public function addRoles($userIds, $roleIds): ResponseInterface
    {
        $userIds = is_array($userIds) ? implode(',', $userIds) : $userIds;
        $roleIds = is_array($roleIds) ? implode(',', $roleIds) : $roleIds;

        return $this->http->client->post('topapi/role/addrolesforemps', [
            'json' => [
                'userIds' => $userIds,
                'roleIds' => $roleIds,
            ],
        ]);
    }

    /**
     * 批量删除员工角色
     *
     * @param array|string $userIds
     * @param array|string $roleIds
     * @return ResponseInterface
     */
    public function removeRoles($userIds, $roleIds): ResponseInterface
    {
        $userIds = is_array($userIds) ? implode(',', $userIds) : $userIds;
        $roleIds = is_array($roleIds) ? implode(',', $roleIds) : $roleIds;

        return $this->http->client->post('topapi/role/removerolesforemps', [
            'json' => [
                'userIds' => $userIds,
                'roleIds' => $roleIds,
            ],
        ]);
    }

    /**
     * 获取企业员工人数
     *
     * @param bool $only_active
     * @return ResponseInterface
     */
    public function getCount(bool $only_active = false): ResponseInterface
    {
        return $this->http->client->post('topapi/user/count', [
            'json' => [
                'only_active' => $only_active,
            ],
        ]);
    }

    /**
     * 获取企业已激活的员工人数
     *
     * @return ResponseInterface
     */
    public function getActivatedCount(): ResponseInterface
    {
        return $this->getCount(true);
    }

    /**
     * 根据员工手机号获取 Userid
     *
     * @param string $mobile
     * @return ResponseInterface
     */
    public function getUserIdByPhone(string $mobile = ''): ResponseInterface
    {
        return $this->http->client->post('topapi/v2/user/getbymobile', [
            'json' => [
                'mobile' => $mobile,
            ],
        ]);
    }

    /**
     * 未登录钉钉的员工列表
     *
     * @param bool   $is_active
     * @param array  $dept_ids
     * @param int    $offset
     * @param int    $size
     * @param string $query_date
     * @return ResponseInterface
     */
    public function getInactiveUsers(bool $is_active, array $dept_ids, int $offset, int $size, string $query_date): ResponseInterface
    {
        return $this->http->client->post('topapi/inactive/user/v2/get', [
            'json' => [
                'is_active' => $is_active,
                'dept_ids' => $dept_ids,
                'offset' => $offset,
                'size' => $size,
                'query_date' => $query_date,
            ],
        ]);
    }
}