<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/14
 * Time: 9:56
 */
namespace Common\Logic;

use Common\Model\AdminModel;
use Common\Model\AuthGroupAccessModel;
use Common\Model\BaseModel;
use Common\Util\ErrCode;
use Org\Util\String;

class UserLogic {

    /**
     * 后台管理员登录
     * @param $params
     * @param $response
     */
    public function adminSign($params, $response) {
        if ($params['account'] == '' || $params['password'] == '' || $params['code'] == '') {
            $response(ErrCode::ACCOUNT_ERROR);
        }
        if (!check_verify($params['code'])) {
            $response(ErrCode::VERIFY_ERROR);
        }
        $AdminsModel = new AdminModel();
        $account = $AdminsModel->getAdmin($params['account']);
        if (!$account) {
            $response(ErrCode::ACCOUNT_ERROR);
        }
        $password = md5($params['password'] . $account['salt']);
        if ($account['password'] != $password) {
            $response(ErrCode::PASSWORD_ERROR);
        }
        if($account['status'] != BaseModel::STATUS_DEFAULT){
            $response(ErrCode::ACCOUNT_FORBID);
        }
        $account['login_time'] = time();
        $account['login_ip'] = get_client_ip();
        $account['login_num'] = $account['login_num']+1;
        $AdminsModel->save($account);
        $data = array(
            'adminId' => $account['id'],
            'account' => $account['account'],
            'name' => $account['name']
        );
        setSession($data);
        return true;
    }


    public function getAllAdmins($response) {
        $AdminModel = new AdminModel();
        $data = $AdminModel->getAllAdmins();
        if($data === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return $data;
    }

    /**
     * 添加后台用户
     * @param $params
     * @param $response
     * @return bool
     */
    public function addAdminUser($params,$response) {
        $AdminModel = new AdminModel();
        $account = $AdminModel->adminUnique($params['account']);
        if ($account) {
            $response(ErrCode::ACCOUNT_NOT_UNIQUE);
        }
        $String = new String();
        $salt = $String->randString(6, '', 'LlOo01');
        $data = array(
            'account' => $params['account'],
            'name' => $params['name'],
            'password' => md5(md5($params['password']) . $salt),
            'salt' => $salt,
            'create_time' => time(),
            'login_time' => time(),
            'login_ip' => get_client_ip(),
            'status' => $params['status']
        );

        $AdminModel->startTrans();
        $id = $AdminModel->add($data);
        if($id === false ) {
            $AdminModel->rollback();
            $response(ErrCode::SQL_ERROR);
        }
        $AuthGroupAccess = new AuthGroupAccessModel();
        $access = array(
            'uid' => $id,
            'group_id' => $params['group_id']
        );
        $res = $AuthGroupAccess->add($access);
        if($res === false) {
            $AdminModel->rollback();
            $response(ErrCode::SQL_ERROR);
        }
        $AdminModel->commit();
        return true;
    }

    /**
     * 编辑后台管理员
     * @param $params
     * @param $response
     * @return bool
     */
    public function editAdminUser($params,$response){
        $AdminModel = new AdminModel();
        $account = $AdminModel->adminUnique($params['account'],$params['id']);
        if ($account) {
            $response(ErrCode::ACCOUNT_NOT_UNIQUE);
        }
        $data = array(
            'account' => $params['account'],
            'name' => $params['name'],
            'status' => $params['status']
        );
        if($params['password']){
            $String = new String();
            $salt = $String->randString(6, '', 'LlOo01');
            $data['password'] = md5(md5($params['password']) . $salt);
            $data['salt'] = $salt;
        }
        $AdminModel->startTrans();
        $res = $AdminModel->saveAdminByid($params['id'],$data);
        if($res === false ) {
            $AdminModel->rollback();
            $response(ErrCode::SQL_ERROR);
        }
        $AuthGroupAccess = new AuthGroupAccessModel();
        $access = array(
            'group_id' => $params['group_id']
        );
        $res = $AuthGroupAccess->where(array('uid'=>$params['id']))->setField($access);
        if($res === false) {
            $AdminModel->rollback();
            $response(ErrCode::SQL_ERROR);
        }
        $AdminModel->commit();
        return true;
    }


    public function dropAdminById($id,$response) {
        $data = array(
            'id'=> $id,
            'status' => BaseModel::STATUS_DROP
        );
        $AdminModel = new AdminModel();
        $res = $AdminModel->save($data);
        if($res=== false){
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }
}