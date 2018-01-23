<?php
return array(
    'DEFAULT_MODULE' => 'Home',        //默认模块
    'MODULE_ALLOW_LIST' => array('Home'),  // 允许访问的模块列表
    'MODULE_DENY_LIST'     => array('Common', 'Manage'),//禁止访问的模块列表
    'SESSION_AUTO_START' => true,       //自动开启session
    'LOAD_EXT_CONFIG' => 'db',          //加载配置文件
    'URL_CASE_INSENSITIVE' => True,     //设置URL不区分大小写
    'MULTI_MODULE' =>  true,
    'URL_MODEL' => 2,                   //URL模式

    /*自定义配置*/
    'JS_BASE_PATH' => "/Public/js/",    //公共js默认路径

    'AUTH_CONFIG'=>array(
        'AUTH_ON' => true,              //认证开关
        'AUTH_TYPE' => 1,               // 认证方式，1为时时认证；2为登录认证。
        'AUTH_GROUP' => 'auth_group',   //用户组数据表名
        'AUTH_GROUP_ACCESS' => 'auth_group_access', //用户组明细表
        'AUTH_RULE' => 'auth_rule',     //权限规则表
        'AUTH_USER' => 'admin'          //用户信息表
    )

);