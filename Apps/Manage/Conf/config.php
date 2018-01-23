<?php
return array(

    'USER_AUTH_GATEWAY' => 'Login/index', //认证网关
    'NOT_AUTH_MODULE' => 'Login,Test,File', //无需认证控制器
    'USER_AUTH_ON' => True, //是否需要认证
    'USER_AUTH_KEY' => 'adminId', //认证识别号l
    'DEFAULT_URL' => 'Index/index', //默认首页
    'URL_MODEL' => 3,                   //URL模式

    'PAGE_SIZE' => 10,                  //设置每页显示数量

    //权限管理配置
    'ALLOW_VISIT' => array(
        'login/index',
        'index/index',
        'index/home',
        'files/uploads',
        'files/MdUploads'
    ),

    'DENY_VISIT' => array(

    ),

    //设置后台表单提交跳转界面
    'TMPL_ACTION_ERROR'    => './Template/Manage/Common/jump.html', // error tpl
    'TMPL_ACTION_SUCCESS'  => './Template/Manage/Common/jump.html', //  success tpl
//    'TMPL_EXCEPTION_FILE'  => './Template/Manage/Common/exception.html', //exception tpl

    //设置sql备份文件大小
    'CFG_SQL_FILESIZE' => '5242880',

);