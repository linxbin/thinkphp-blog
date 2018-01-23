<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/5
 * Time: 15:11
 */
namespace Common\Logic;

use Common\Model\BaseModel;
use Common\Model\MouldModel;
use Common\Util\ErrCode;

class MouldLogic {

    /**
     * 获取全部的模型
     * @param $response
     * @return mixed
     */
    public function getAllMoudls($response) {

        $MouldModel = new MouldModel();
        $opt = array(
            'status' => array('gt',BaseModel::STATUS_DROP)
        );
        $res = $MouldModel->where($opt)->select();
        if($res === false ) {
            $response('数据库服务繁忙！');
        }
        return $res;
    }

    /**
     * 获取有效的模型
     * @param $response
     * @return mixed
     */
    public function getVaildMoulds($response) {

        $MouldModel = new MouldModel();
        $opt = array(
            'status' => array('eq',BaseModel::STATUS_DEFAULT)
        );
        $res = $MouldModel->where($opt)->select();
        if($res === false ) {
            $response('数据库服务繁忙！');
        }
        return $res;
    }


    /**
     * 模型操作
     */
    public function mouldOper($type,$response) {

        $params = trimRequest();
        $data = array(
            'name' => $params['name'],
            'tablename' => $params['tablename'],
            'status' => $params['status'],
            'sort' => $params['sort'],
            'description' => $params['description'] ? $params['description'] : ''
        );
        $MouldModel = new MouldModel();
        if($type == 'add') {
            $res = $MouldModel->add($data);
            if($res === false) {
                $response(ErrCode::SQL_ERROR);
            }
        }
        if($type == 'edit'){
            $data['id'] = $params['id'];
            $res = $MouldModel->save($data);
            if($res === false) {
                $response(ErrCode::SQL_ERROR);
            }
        }
        return true;
    }

    public function drop($id,$response) {
        $MoudlModel = new MouldModel();
        $data = array(
            'id' => array('in',$id),
            'status' => BaseModel::STATUS_DROP
        );
        $res = $MoudlModel->save($data);
        if($res === false){
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }
}