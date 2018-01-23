<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/5
 * Time: 9:29
 */

namespace Manage\Controller;

use Common\Logic\MouldLogic;

class MouldController extends InitController {

    public function index(){
        $MouldLogic = new MouldLogic();
        $data = $MouldLogic->getAllMoudls($this->errorFunc());
        $this->assign('mouldList',$data);
        $this->display();
    }

    public function add() {
        $MouldLogic = new MouldLogic();
        $MouldLogic->mouldOper('add',$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function edit() {
        $MouldLogic = new MouldLogic();
        $MouldLogic->mouldOper('edit',$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function drop() {
        $needParams = array('id');
        $params = $this->checkParams($needParams);
        $MouldLogic = new MouldLogic();
        $MouldLogic->drop($params['id'],$this->ajaxResponse());
        $this->ajaxReturn();
    }
}