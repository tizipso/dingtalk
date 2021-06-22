<?php

declare(strict_types=1);

namespace Dingtalk\Constant;

class SubscribeConstant
{
    /**
     * 通讯录用户增加
     */
    const USER_ADD_ORG = 'user_add_org';

    /**
     * 通讯录用户更改
     */
    const USER_MODIFY_ORG = 'user_modify_org';

    /**
     * 通讯录用户离职
     */
    const USER_LEAVE_ORG = 'user_leave_org';

    /**
     * 加入企业后用户激活
     */
    const USER_ACTIVE_ORG = 'user_active_org';

    /**
     * 通讯录用户被设为管理员
     */
    const ORG_ADMIN_ADD = 'org_admin_add';

    /**
     * 通讯录用户被取消设置管理员
     */
    const ORG_ADMIN_REMOVE = 'org_admin_remove';

    /**
     * 通讯录企业部门创建
     */
    const ORG_DEPT_CREATE = 'org_dept_create';

    /**
     * 通讯录企业部门修改
     */
    const ORG_DEPT_MODIFY = 'org_dept_modify';

    /**
     * 通讯录企业部门删除
     */
    const ORG_DEPT_REMOVE = 'org_dept_remove';

    /**
     * 企业被解散
     */
    const ORG_REMOVE = 'org_remove';

    /**
     * 企业信息发生变更
     */
    const ORG_CHANGE = 'org_change';

    /**
     * 员工角色信息发生变更
     */
    const LABEL_USER_CHANGE = 'label_user_change';

    /**
     * 增加角色或者角色组
     */
    const LABEL_CONF_ADD = 'label_conf_add';

    /**
     * 删除角色或者角色组
     */
    const LABEL_CONF_DEL = 'label_conf_del';

    /**
     * 修改角色或者角色组
     */
    const LABEL_CONF_MODIFY = 'label_conf_modify';

    /**
     * 人员身份新增
     */
    const EDU_USER_INSERT = 'edu_user_insert';

    /**
     * 人员身份更新
     */
    const EDU_USER_UPDATE = 'edu_user_update';

    /**
     * 人员身份删除
     */
    const EDU_USER_DELETE = 'edu_user_delete';

    /**
     * 人员关系新增
     */
    const EDU_USER_RELATION_INSERT = 'edu_user_relation_insert';

    /**
     * 人员关系更新
     */
    const EDU_USER_RELATION_UPDATE = 'edu_user_relation_update';

    /**
     * 人员关系删除
     */
    const EDU_USER_RELATION_DELETE = 'edu_user_relation_delete';

    /**
     * 部门节点新增
     */
    const EDU_DEPT_INSERT = 'edu_dept_insert';

    /**
     * 部门节点更新
     */
    const EDU_DEPT_UPDATE = 'edu_dept_update';

    /**
     * 部门节点删除
     */
    const EDU_DEPT_DELETE = 'edu_dept_delete';

    /**
     * 审批任务开始，结束，转交
     */
    const BPMS_TASK_CHANGE = 'bpms_task_change';

    /**
     * 审批实例开始，结束
     */
    const BPMS_INSTANCE_CHANGE = 'bpms_instance_change';

    /**
     * 群会话添加人员
     */
    const CHAT_ADD_MEMBER = 'chat_add_member';

    /**
     * 群会话删除人员
     */
    const CHAT_REMOVE_MEMBER = 'chat_remove_member';

    /**
     * 群会话用户主动退群
     */
    const CHAT_QUIT = 'chat_quit';

    /**
     * 群会话更换群主
     */
    const CHAT_UPDATE_OWNER = 'chat_update_owner';

    /**
     * 群会话更换群名称
     */
    const CHAT_UPDATE_TITLE = 'chat_update_title';

    /**
     * 群会话解散群
     */
    const CHAT_DISBAND = 'chat_disband';

    /**
     * 用户签到事件
     */
    const CHECK_IN = 'check_in';

    /**
     * 员工打卡事件
     */
    const ATTENDANCE_CHECK_RECORD = 'attendance_check_record';

    /**
     * 员工排班变更事件
     */
    const ATTENDANCE_CHECK_CHANGE = 'attendance_schedule_change';

    /**
     * 员工加班事件
     */
    const ATTENDANCE_CHECK_DURATION = 'attendance_overtime_duration';

    /**
     * 会议室预定等事件，预定成功、取消等
     */
    const MEETINGROOM_BOOK = 'meetingroom_book';

    /**
     * 会议室创建、更新、删除等
     */
    const MEETINGROOM_ROOM_INFO = 'meetingroom_room_info';

    /**
     * 人事档案变动
     */
    const HRM_USER_RECORD_CHANGE = 'hrm_user_record_change';
}