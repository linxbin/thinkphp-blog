<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/23
 * Time: 14:43
 */
namespace Common\Model;

use Think\Page;

class ArticleModel extends BaseModel {

    const STATUS_DRAF = 2;

    public function getArticle($opt, $orderBy, $pageSize) {

        $table = '__ARTICLE__ art';
        $joinChannel = '__CHANNEL__ cha on art.channel_id = cha.id';

        $field = 'cha.title channel ,  cha.ename ename,  art.*';

        if($pageSize){
            $count = $this->table($table)->join($joinChannel)->where($opt)->count();
            $page = new Page($count, $pageSize);
            $data = $this->table($table)->join($joinChannel)->field($field)->where($opt)->order($orderBy)->limit($page->firstRow,$page->listRows)->select();
            return array('list' => $data, 'page' => $page->show());
        }

        return array('list'=>$this->table($table)->join($joinChannel)->field($field)->where($opt)->order($orderBy)->select());
    }

    public function getArticleById($id) {
        $condition = array(
            'id' => array('in',$id)
        );
        return $this->where($condition)->find();
    }

    public function getArticleByChannelId($channelId,$pageSize) {
        $condition = array(
            'channel_id' => array('in',$channelId),
        );
        $notfield = 'content';
        if($pageSize) {
            $count = $this->where($condition)->count();
            $page = new Page($count, $pageSize);
            $data = $this->where($condition)->field($notfield,true)->order('time desc')->limit($page->firstRow,$page->listRows)->select();
            return array('list' => $data, 'page' => $page->show());
        }
        return array('list'=>$this->where($condition)->field($notfield,true)->order('time desc')->select());
    }

}