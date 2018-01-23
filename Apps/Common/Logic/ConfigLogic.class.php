<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/23
 * Time: 15:49
 */
namespace Common\Logic;

use Common\Model\ConfigModel;
use Common\Util\ErrCode;

class ConfigLogic {

    public function setConfig($params,$response){
        if(!is_array($params)){
            $response(ErrCode::PARAM_ERROR);
        }
        $ConfigModel = new ConfigModel();
        $res = $ConfigModel -> setData($params);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    public function getConfig($response) {
        $ConfigModel = new ConfigModel();
        $config = $ConfigModel->getConfig();
        if($config === false) {
            $response(ErrCode::SQL_ERROR);
        }
        setSession($config);
        return $config;
    }

    public function getWxConfig($response) {

        $wx_config = M('wx_config') -> getField('name,value');

        if($wx_config === false) {
            $response(ErrCode::SQL_ERROR);
        }
        setSession($wx_config);
        return $wx_config;
    }

    public function saveWxConfig($params,$error) {
        if(!is_array($params)){
            $error('非法数据请求！');
        }
        foreach($params as $name => $val){
            $condition = array(
                'name'=> strtoupper($name)
            );
            $res =& M('wx_config')->where($condition)->setField('value',$val);
        }
        if($res === false) {
            $error('数据库操作失败！');
        }
        return true;
    }
}