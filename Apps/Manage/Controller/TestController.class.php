<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/14
 * Time: 14:19
 */
namespace Manage\Controller;

use Common\Logic\ConfigLogic;
use Common\Logic\MenuLogic;
use Common\Model\AdminModel;
use Common\Model\AuthGroupAccessModel;
use Common\Model\AuthRuleModel;
use Common\Model\ChannelModel;
use Common\Model\MenuModel;
use Common\Lib\Weixin;
use Org\Util\String;
use Think\Model;

class TestController extends InitController  {

    public function createAdmin() {
        $String = new String();
        $salt = $String->randString(6, '', 'LlOo01');
        $data = array(
            'account' => 'admin2',
            'name' => '超级管理员',
            'password' => md5(md5('111111') . $salt),
            'salt' => $salt,
            'create_time' => time()
        );
        $AdminModel = new AdminModel();
        $id = $AdminModel->add($data);
        var_dump($id);
    }


    public function getRankMenu() {

        $MenuModel = new MenuModel();
        $menus = $MenuModel->getMenus();
        $MenuLogic = new MenuLogic();
        $data = $MenuLogic->rankMenus($menus);
        printn($data);
    }

    public function treeTable(){
        $MenuLogic = new MenuLogic();
        $res = $MenuLogic->createMenus();
        printn($res);
    }

    public function getRuleIdByUid() {
        $AuthGroupAccess = new AuthGroupAccessModel();
        $res = $AuthGroupAccess->getRulesIdByUid(session('adminId'));
        $AuthRuleModel = new AuthRuleModel();
        $res['rules'] = $AuthRuleModel->getRulesByIds($res['rules']);
        printn($res);
    }

    public function wxTest() {
        $ConfigLogic = new ConfigLogic();
        $res = $ConfigLogic->getWxConfig($this->ajaxResponse());
        $Weixin = new Weixin($res['WX_APPID'],$res['WX_APPSECRET']);
        $res = $Weixin->getWxAccessToken();
        printn($res);
    }

    public function wx() {

        $ConfigLogic = new ConfigLogic();
        $config = $ConfigLogic->getWxConfig($this->ajaxResponse());
        $Weixin = new Weixin($config['WX_APPID'],$config['WX_APPSECRET']);
        $res = $Weixin->checkSignature();
        if($res === true){

        }
    }

    public function test()
    {
        $path     = realpath(dirname(__FILE__).'/../../../../../');
        printn($path);

        $url      = dirname($_SERVER['PHP_SELF']) . '/';
        printn($url);
        $savePath = realpath($path . '../uploads/') . DIRECTORY_SEPARATOR;
        printn($savePath);
        $saveURL  = $url . '../uploads/';
        printn($saveURL);
    }
}