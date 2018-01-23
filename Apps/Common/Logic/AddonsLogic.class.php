<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 17:56
 */
namespace Common\Logic;

use Common\Model\BaseModel;
use Common\Model\FriendslinkModel;
use Common\Util\ErrCode;

class AddonsLogic {

    public function friendslinkAdd($params,$response) {
        $data = array(
            'name'=>$params['name'],
            'url' => $params['url'],
            'time' => time()
        );
        $FriendslinkModel = new FriendslinkModel();
        $res = $FriendslinkModel->add($data);
        if($res === false){
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    public function getFriendslink() {
        $FriendslinkModel = new FriendslinkModel();
        $res = $FriendslinkModel->getFriendslink(C('PAGE_SIZE'));
        return $res;
    }

    public function friendslinkEdit($params,$response) {
        $data = array(
            'id' => $params['id'],
            'name'=>$params['name'],
            'url' => $params['url'],
            'time' => time()
        );
        $FriendslinkModel = new FriendslinkModel();
        $res = $FriendslinkModel->save($data);
        if($res === false){
            $response(ErrCode::SQL_ERROR);
        }
        return true;

    }

    public function friendslinkDrop($params,$response) {
        $data = array(
            'id' => array('in',$params['id']),
            'status' => BaseModel::STATUS_DROP
        );
        $FriendslinkModel = new FriendslinkModel();
        $res = $FriendslinkModel->save($data);
        if($res === false){
            $response(ErrCode::SQL_ERROR);
        }
        return true;

    }
}