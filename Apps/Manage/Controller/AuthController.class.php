<?php
/**
 * 权限管理模块
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/10
 * Time: 14:33
 */
namespace Manage\Controller;

use Common\Logic\AuthLogic;
use Common\Logic\MenuLogic;
use Common\Model\AuthRuleModel;

class AuthController extends InitController {

    public function index() {
        $this->display();
    }

    /**
     * 节点管理
     */
    public function rules() {
        $AuthLogic = new AuthLogic();
        $data = $AuthLogic->getRules();
        $this->assign('ruleList',$data);
        $this->display();
    }

    public function ruleAdd() {
        $needParams = array('name','title','pid');
        $params = $this->checkParams($needParams);
        $AuthLogic = new AuthLogic();
        $AuthLogic->ruleAdd($params,$this->ajaxResponse());
        $this->ajaxReturn();

    }

    public function ruleEdit() {
        $needParams = array('id','name','title','pid');
        $params = $this->checkParams($needParams);
        $AuthLogic = new AuthLogic();
        $AuthLogic->ruleEdit($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function ruleDrop() {
        $needParams = array('id');
        $params = $this->checkParams($needParams);
        $AuthLogic = new AuthLogic();
        $AuthLogic->ruleDrop($params['id'],$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function group() {
        $AuthLogic = new AuthLogic();
        $res = $AuthLogic->groupList($this->ajaxResponse());
        $this->assign('groups',$res);
        $this->display();
    }

    public function groupAdd() {
        $needParams = array('title','status');
        $params = $this->checkParams($needParams);
        $AuthLogic = new AuthLogic();
        $AuthLogic->groupAdd($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function groupEdit() {
        $needParams = array('id','title','status');
        $params = $this->checkParams($needParams);
        $AuthLogic = new AuthLogic();
        $AuthLogic->groupEdit($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function groupDrop(){
        $needParams = array('id');
        $params = $this->checkParams($needParams);
        $AuthLogic = new AuthLogic();
        $AuthLogic->groupDrop($params['id'],$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function apply() {
        if(!IS_POST){
            $id = getParams('id');
            $AuthRuleModel = new AuthRuleModel();
            $AuthLogic = new AuthLogic();
            $data = $AuthRuleModel->getRules();
            $ruleList = rankList($data);
            $groups = $AuthLogic->getGroupById($id,$ruleType='array',$this->ajaxResponse());
            $this->assign('groups',$groups);
            $this->assign('ruleList',$ruleList);
            $this->display();
        }   else  {
            $needParams = array('id');
            $optParams = array('rules');
            $params = $this->checkParams($needParams,$optParams);
            $AuthLogic = new AuthLogic();
            $AuthLogic->accessAuth($params,$this->ajaxResponse());
            $this->ajaxReturn();
        }
    }
}