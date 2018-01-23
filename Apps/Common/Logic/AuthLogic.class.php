<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/13
 * Time: 11:18
 */
namespace Common\Logic;

use Common\Model\AuthGroupModel;
use Common\Model\AuthRuleModel;
use Common\Model\BaseModel;
use Common\Util\ErrCode;

class AuthLogic{

    public function getRules () {
        $AuthRuleModel = new AuthRuleModel();
        $res = $AuthRuleModel->getRules();
        $rules = rankList($res);
        return formRankLists($rules);
    }

    public function ruleAdd($params,$response) {
        $data = array(
            'pid' => $params['pid'],
            'name' => $params['name'],
            'title' => $params['title'],
            'type' => AuthRuleModel::DEFAULT_TYPE,
            'status' => AuthRuleModel::STATUS_DEFAULT,
            'create_time' => time()
        );
        $AuthRuleModel = new AuthRuleModel();
        $res = $AuthRuleModel->add($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return $res;
    }

    public function ruleEdit($params,$response) {
        $data = array(
            'id' => $params['id'],
            'name' => $params['name'],
            'title' => $params['title'],
            'create_time' => time()
        );
        $AuthRuleModel = new AuthRuleModel();
        $res = $AuthRuleModel->save($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return $res;
    }

    public function ruleDrop($id,$response) {
        if(empty($id) || !isset($id)){
            $response(ErrCode::PARAM_ERROR);
        }
        $opt = array(
            'pid' => $id,
            'id' => $id,
            '_logic' => 'OR'
        );
        $condition = array($opt);
        $AuthRule = new AuthRuleModel();
        $res = $AuthRule->where($condition)->delete();
        if($res===false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    /**
     * @param $id
     * @param $response
     * @return mixed
     */
    public function groupList($response) {
        $AuthGroupModel = new AuthGroupModel();
        $res = $AuthGroupModel->getGroupList();
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return $res;
    }

    public function groupAdd($params,$response) {
        $data = array(
            'title' => $params['title'],
            'status' => $params['status'],
            'create_time' => time()
        );
        $AuthGroupModel = new AuthGroupModel();
        $res = $AuthGroupModel->add($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    public function groupEdit($params,$response){
        $data = array(
            'id' => $params['id'],
            'title' => $params['title'],
            'status' => $params['status'],
            'create_time' => time()
        );
        $AuthGroupModel = new AuthGroupModel();
        $res = $AuthGroupModel->save($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    public function groupDrop($id,$response){
        $data = array(
            'id' => $id,
            'status' => BaseModel::STATUS_DROP
        );
        $AuthGroupModel = new AuthGroupModel();
        $res = $AuthGroupModel->save($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    public function accessAuth($params,$response){
        $data = array(
            'id' => $params['id'],
            'rules' => implode(',',$params['rules'])
        );
        $AuthGroupModel = new AuthGroupModel();
        $res = $AuthGroupModel->save($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    public function getGroupById($id,$ruleType,$response) {

        $AuthGroupModel = new AuthGroupModel();
        $group = $AuthGroupModel->getGroup($id);
        if($group === false){
            $response(ErrCode::SQL_ERROR);
        }
        if($ruleType === 'array') {
            $group['rules'] = explode(',',$group['rules']);
        }
        return $group;

    }

}