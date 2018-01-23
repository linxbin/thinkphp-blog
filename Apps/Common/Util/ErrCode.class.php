<?php

/**
 * 错误信息对照码
 */

namespace Common\Util;

class ErrCode
{
    const RIGHT = 10000;
    const PARAM_ERROR = 10001;
    const ACCOUNT_ERROR = 10002;
    const PASSWORD_ERROR = 10003;
    const VERIFY_ERROR = 10004;
    const NO_STUDENT = 10005;
    const AUTH_ERROR = 10006;
    const OLD_PASSWORD_ERROR = 10007;
    const NEW_PASSWORD_ERROR = 10008;
    const AGAIN_PASSWORD_ERROR = 10009;
    const CHANNEL_NAME_ERROR = 10010;
    const SQL_ERROR = 10011;
    const ACCOUNT_NOT_UNIQUE = 10012;
    const NOT_ACCESS  = 10013;
    const UPLOAD_IMG_ERROR = 10014;
    const ACCOUNT_FORBID = 10015;

    public static $errMsg = array(
        self::RIGHT => '获取成功',
        self::PARAM_ERROR => '参数错误！',
        self::ACCOUNT_ERROR => '用户名错误，请重新输入！',
        self::PASSWORD_ERROR => '密码错误，请重新输入！',
        self::VERIFY_ERROR => '验证码错误，请重新输入！',
        self::NO_STUDENT => '所选分级下没有用户！',
        self::AUTH_ERROR => '不具备权限！',
        self::OLD_PASSWORD_ERROR => '旧密码输入不正确！',
        self::NEW_PASSWORD_ERROR => '新密码格式不正确！',
        self::AGAIN_PASSWORD_ERROR => '两次密码输入不一致',
        self::CHANNEL_NAME_ERROR => '导航名称已存在，请重新输入！',
        self::SQL_ERROR => '数据库请求错误！',
        self::ACCOUNT_NOT_UNIQUE => '账号已存在，请重新输入!',
        self::NOT_ACCESS => '您没有操作的权限，请联系管理员授权！',
        self::UPLOAD_IMG_ERROR => '图片上传失败!',
        self::ACCOUNT_FORBID => '您的账号已被管理员禁止使用，请联系管理员！',

    );

}