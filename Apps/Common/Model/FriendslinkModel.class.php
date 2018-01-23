<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/29
 * Time: 17:58
 */
namespace Common\Model;

use Think\Page;

class FriendslinkModel extends BaseModel {

    public function getFriendslink($pageSize) {

        if($pageSize){
            $count = $this->where(array())->count();
            $page = new Page($count, $pageSize);
            $data = $this->where(array())->order('time desc')->limit($page->firstRow,$page->listRows)->select();
            return array('list' => $data, 'page' => $page->show());
        }
        return  array('list'=>$this->where(array())->order('time desc')->select());
    }
}