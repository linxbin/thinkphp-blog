<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/14
 * Time: 10:29
 */
namespace Common\Model;

class AdminModel extends BaseModel  {
    /**
     * 获取管理员信息
     * @param $account
     * @return mixed
     */
    public function getAdmin($account) {
        $condition = array(
            'account' => $account,
        );
        return $this->where($condition)->find();
    }

    public function getAllAdmins() {
        $table = '__ADMIN__ ad';
        $joinAuthGroupAccess = '__AUTH_GROUP_ACCESS__ aga on aga.uid = ad.id';
        $joinAuthGroup = '__AUTH_GROUP__ ag on ag.id = aga.group_id';
        $field = 'ad.*, ag.title title';
        $res = $this->table($table)->join($joinAuthGroupAccess)->join($joinAuthGroup)->where(array())->field($field)->select();
        return $res;
    }


    public function saveAdminByid($id,$data){
        $condition = array(
            'id' => array('eq',$id)
        );
        $res = $this->where($condition)->save($data);
        return $res;
    }

    /**
     * 判断用户账号是否唯一
     * @param $account
     * @param string $id
     */
    public function adminUnique($account,$id = '') {

        $condition = array(
            'account'=> $account
        );
        if($id) {
            $condition['id'] = array('neq',$id);
        }
        $res = $this->where($condition)->find();
        return $res;
    }
}