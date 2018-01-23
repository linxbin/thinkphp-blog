<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/13
 * Time: 11:24
 */
namespace Common\Model;

class AuthRuleModel extends BaseModel {

    const DEFAULT_TYPE = 1;
    const RULE_URL = 1;
    const RULE_MAIN = 2;

    public function getRules() {

        $res = $this->where(array())->select();
        return $res;
    }

    public function getRulesByIds($ids) {

        $condition = array(
            'id' => array('in',$ids)
        );
        $res = $this->where($condition)->getField('name',true);
        return $res;
    }
}