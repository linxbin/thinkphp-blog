<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/23
 * Time: 14:14
 */

namespace Manage\Controller;


use Common\Logic\MenuLogic;
use Think\Model;

class IndexController extends InitController
{
    /**
     * 后台首页显示
     */
    public function index(){
        $MenuLogic = new MenuLogic();
        $menuList = $MenuLogic->createMenus();
        $this->assign('name',session('name'));
        $this->assign('menuList',$menuList);
        $this->display();
    }

    public function home() {
        $data = $this->getSystemInfo();
        $this->assign('data',$data);
        $this->display();
    }

    /**
     * 获取网站信息
     * @return array
     */
    public function getSystemInfo() {
        $info = array(
            '网站域名'=>  $_SERVER['HTTP_HOST'],
            '网站根目录' => $_SERVER['DOCUMENT_ROOT'],
            '服务器操作系统' => php_uname('s'),
            '服务器端口' => $_SERVER['SERVER_PORT'],
            'PHP版本' => PHP_VERSION,
            '服务器环境' =>  $_SERVER['SERVER_SOFTWARE'],
            '数据库信息' => $this->getMysqlVersion(),
            '文件上传限制' => ini_get('post_max_size'),
        );
        return $info;
    }

    public function getMysqlVersion(){
        $Model = new Model();
        $v = $Model->query("select VERSION() as version");
        return $v[0]["version"];
    }
}