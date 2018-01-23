<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 17:15
 */
namespace Manage\Controller;

use Common\Logic\AddonsLogic;

class AddonsController extends InitController {

    public function friendslink() {
        $AddonsLogic = new AddonsLogic();
        $data = $AddonsLogic->getFriendslink();
        $this->assign('list',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
    }

    public function friendslinkAdd() {

        $needParams = array('name','url');
        $params = $this->checkParams($needParams);
        $AddonsLogic = new AddonsLogic();
        $AddonsLogic->friendslinkAdd($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function friendslinkEdit() {

        $needParams = array('id','name','url');
        $params = $this->checkParams($needParams);
        $AddonsLogic = new AddonsLogic();
        $AddonsLogic->friendslinkEdit($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function friendslinkDrop() {

        $needParams = array('id');
        $params = $this->checkParams($needParams);
        $AddonsLogic = new AddonsLogic();
        $AddonsLogic->friendslinkDrop($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }
}