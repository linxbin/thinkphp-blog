<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/20
 * Time: 13:41
 */
namespace Common\Logic;

use Common\Model\ChannelModel;
use Common\Util\ErrCode;

class ChannelLogic {

    /**
     * 操作导航
     * @param $params
     * @param $response
     * @return bool
     */
    public function channelOper($params,$response,$type='add')
    {
        $ChannelModel = new ChannelModel();
        $data = array(
            'title' => $params['title'],
            'display' => $params['display'],
            'sort' => $params['sort'],
            'status' => $params['status'],
            'mould' => $params['mould'],
            'keyword' => $params['keyword'],
            'description' => $params['description'],
            'ename' => $params['ename']
        );
        if($type == 'edit') {
            $data['id'] = $params['id'];
            $res = $ChannelModel->save($data);
        } else {
            $unique = $ChannelModel->getChannel($params['title']);
            if($unique){
                $response(ErrCode::CHANNEL_NAME_ERROR);
            }
            $res = $ChannelModel->add($data);
        }
        if($res === false){
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }


    /**
     * 删除导航栏目信息
     * @param $params
     * @param $response
     * @return bool
     */
    public function dropById($params,$response)
    {
        $ChannelModel = new ChannelModel();
        $data = array(
            'id' => array('in',$params['id']),
            'status' => ChannelModel::STATUS_DELETE
        );
        $res = $ChannelModel->save($data);
        if($res === false){
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    /**
     * 获取栏目
     * @param array $params
     * @param $response
     * @return mixed
     */
    public function getChannel($params = array(),$response)
    {
        $ChannelModel = new ChannelModel();
        foreach ($params as $key => $value) {
            if ($value != null) {
                $condition[$key] = array('like', '%' . $value . '%');
            }
        }
        $navs = $ChannelModel->getChannelByCondition($condition);
        return $navs;
    }

    public static function getChannelById($id,$response)
    {
        $ChannelModel = new ChannelModel();
        $res = $ChannelModel->getChannelById($id);
        if($res === false){
            $response(ErrCode::SQL_ERROR);
        }
        return $res;
    }

    public static function getChannelByEname($ename,$response)
    {
        $ChannelModel = new ChannelModel();
        $condition = array(
            'ename' => $ename
        );
        $res = $ChannelModel->getChannelByCondition($condition);
        return $res[0];
    }
}