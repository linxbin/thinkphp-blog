<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/14
 * Time: 16:54
 */
namespace Common\Model;

class AuthGroupModel extends BaseModel {

    public function getGroupList (){

        $res = $this->where(array())->select();
        return $res;
    }


    public function getGroup($id) {
        $condition = array(
            'id' => array('in',$id)
        );
        $res = $this->where($condition)->find();
        return $res;
    }
}