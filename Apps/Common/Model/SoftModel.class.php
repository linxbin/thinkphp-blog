<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/27 0027
 * Time: 下午 10:19
 */
namespace Common\Model;

use Think\Page;

class SoftModel extends BaseModel {


    public function getSoftList($pageSize) {

        $table = '__SOFT__ soft';
        $joinChannel = '__CHANNEL__ cha on soft.channel_id = cha.id';
        $field = 'cha.title channel , soft.id , soft.author , soft.channel_id , soft.time , soft.num , soft.title , soft.thumb , soft.version , soft.language';

        if($pageSize){
            $count = $this->table($table)->join($joinChannel)->where(array())->count();
            $page = new Page($count, $pageSize);
            $data = $this->table($table)->join($joinChannel)->field($field)->where(array())->order('time desc')->limit($page->firstRow,$page->listRows)->select();
            return array('list' => $data, 'page' => $page->show());
        }
        return  array('list'=>$this -> table($table)->where(array())->join($joinChannel)->field($field)->order('time desc')->select());
    }


    public function getSoftById($id) {
        $condition = array(
            'id' => array('in',$id)
        );
        return $this->where($condition)->find();
    }

    public function getSoftByChannelId($channelId,$pageSize)
    {
        $condition = array(
            'channel_id' =>$channelId,
        );
        if($pageSize){
            $count = $this->where($condition)->count();
            $page = new Page($count, $pageSize);
            $data = $this->where($condition)->order('time desc')->limit($page->firstRow,$page->listRows)->select();
            return array('list' => $data, 'page' => $page->show());
        }
        return  array('list'=>$this ->where($condition)->order('time desc')->select());

    }
}