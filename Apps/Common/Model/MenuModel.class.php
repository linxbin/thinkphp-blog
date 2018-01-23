<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/24
 * Time: 17:36
 */
namespace Common\Model;

class MenuModel extends BaseModel {


    public function getMenus($condition = array()) {

        return $this->where($condition)->select();
    }

    public function getFistMenus() {
        $condition = array(
            'pid' => 0
        );
        return $this->where($condition)->select();
    }

}