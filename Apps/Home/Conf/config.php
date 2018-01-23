<?php
return array(
    /*正则路由*/
    'URL_ROUTER_ON' => TRUE,
    'URL_ROUTE_RULES' => array(
        'special/:id\d' => 'special/shows',
        'search' => 'search/index',
        'rss' => 'Rss/index',
        'p/:p\d' => 'Index/index?p=:1',
        ':e/p/:p\d' => 'Channel/index?ename=:1&p=:2',
        ':e/:id\d' => 'Article/index',
        '/^(\w+)$/' => 'Channel/index?ename=:1',
    ),

    //加载自定义标签
    'TAGLIB_PRE_LOAD' => 'Common\\LibTag\\Linxb',//预加载的tag
    'TAGLIB_BUILD_IN' => 'cx', //内置标签
);