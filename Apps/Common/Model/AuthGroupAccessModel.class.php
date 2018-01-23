<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/15
 * Time: 15:55
 */
namespace Common\Model;

use Think\Model;

class AuthGroupAccessModel extends Model  {


    public  function getRulesIdByUid($uid) {

        $table = '__AUTH_GROUP_ACCESS__ aga';
        $joinAuthGroup = '__AUTH_GROUP__ ag on ag.id = aga.group_id';
        $condition = array(
            'uid' => $uid
        );
        $res = $this->table($table)->join($joinAuthGroup)->where(array($condition))->find();
        return $res;
    }
}