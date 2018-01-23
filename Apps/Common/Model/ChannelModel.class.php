<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 13:37
 */
namespace Common\Model;

class ChannelModel extends BaseModel {

    const STATUS_DELETE = -1;
    const ONLY_DISPLAY = 1;
    /**
     * 获取单个栏目
     * @param $title
     * @return mixed
     */
    public function getChannel($title){
        $condition = array(
            'title' => $title
        );
        $res = $this->where($condition)->limit(1)->find();
        return $res;
    }

    /**
     * 按条件获取栏目
     * @return mixed
     */
    public function getChannelByCondition($condition = array()) {

        $res = $this->where($condition)->order('sort asc','time desc')->select();
        return $res;
    }

    public function getChannelById($id)
    {
        $condition = array(
            'id' =>$id
        );
        return $this->where($condition)->find();
    }
}