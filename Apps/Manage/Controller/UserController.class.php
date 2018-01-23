<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 14:51
 */
namespace Manage\Controller;

use Common\Logic\AuthLogic;
use Common\Logic\UserLogic;

class UserController extends InitController {

    public function index() {

        $UserLogic = new UserLogic();
        $data = $UserLogic->getAllAdmins($this->ajaxResponse());
        $AuthGroupLogic = new AuthLogic();
        $groups = $AuthGroupLogic -> groupList('',$this->ajaxResponse());
        $this->assign('groups',$groups);
        $this->assign('users',$data);
        $this->display();
    }

    public function add() {

        $needParams = array('group_id','name','account','password','status');
        $params = $this->checkParams($needParams);
        $UserLogic = new UserLogic();
        $UserLogic ->addAdminUser($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function edit() {

        $needParams = array('id','group_id','name','account','status');
        $optParams = array('password');
        $params = $this->checkParams($needParams,$optParams);
        $UserLogic = new UserLogic();
        $UserLogic->editAdminUser($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function drop()  {
        $needParams = array('id');
        $params = $this->checkParams($needParams);
        $UserLogic = new UserLogic();
        $UserLogic->dropAdminById($params['id'],$this->ajaxResponse());
        $this->ajaxReturn();
    }
}