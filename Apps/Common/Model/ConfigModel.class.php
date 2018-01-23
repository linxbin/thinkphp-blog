<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23
 * Time: 16:09
 */

namespace Common\Model;

class ConfigModel extends BaseModel {

    public function setData($data) {
        foreach($data as $name => $val){
            $condition = array(
                'name'=> strtoupper($name)
            );
            $res =& $this->where($condition)->setField('value',$val);
        }
        return $res;
    }

    /**
     * 获取系统配置
     * @return mixed
     */
    public function getConfig() {

        $res = $this->getField('name,value');
        return $res;
    }
}