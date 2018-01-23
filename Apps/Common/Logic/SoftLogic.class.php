<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/27 0027
 * Time: 下午 10:20
 */

namespace Common\Logic;

use Common\Model\BaseModel;
use Common\Model\SoftModel;
use Common\Util\ErrCode;

class SoftLogic {


    public function addSoft($params, $response)
    {
        $data = array(
            'title' => $params['title'],
            'digest' => $params['digest'],
            'thumb' => $params['thumb'],
            'channel_id' => $params['channel_id'],
            'language' => $params['language'],
            'version' => $params['version'],
            'size' => $params['size'],
            'download' => json_encode($params['download']),
            'num' => $params['num'] ? $params['num']:'0',
            'tags' => $params['tags'] ? $params['tags'] : '',
            'description' => $params['description'] ? $params['description'] : '',
            'platform' => $params['platform'],
            'author' => $params['author'],
            'time' => time()
        );
        $SoftModel = new SoftModel();
        $res = $SoftModel->add($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;

    }

    /**
     * @param $response
     * @return array
     */
    public function getSfotList($response){

        $SoftModel = new SoftModel();
        $data = $SoftModel->getSoftList(C('PAGE_SIZE'));
        if($data === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return $data;

    }

    public function getSoftById($id,$response) {
        $ArticleModel = new SoftModel();
        $data = $ArticleModel->getSoftById($id);
        if($data === false) {
            $response(ErrCode::SQL_ERROR);
        }
        $data['download'] = json_decode($data['download'],true);
        return $data;
    }

    public function getSoftByChannelId($channelId,$pageSize,$response){
        $softModel = new SoftModel();
        $data = $softModel->getSoftByChannelId($channelId,$pageSize);
        if($data === false) {
            $response(ErrCode::SQL_ERROR);
        }
        $data['download'] = json_decode($data['download'],true);
        return $data;

    }

    public function editSoft($params,$response)
    {
        $data = array(
            'id' => $params['id'],
            'title' => $params['title'],
            'thumb' => $params['thumb'],
            'digest' => $params['digest'],
            'channel_id' => $params['channel_id'],
            'language' => $params['language'],
            'version' => $params['version'],
            'size' => $params['size'],
            'download' => json_encode($params['download']),
            'num' => $params['num'] ? $params['num']:'0',
            'tags' => $params['tags'] ? $params['tags'] : '',
            'description' => $params['description'] ? $params['description'] : '',
            'platform' => $params['platform'],
            'author' => $params['author'],
            'time' => time()
        );
        $SoftModel = new SoftModel();
        $res = $SoftModel->save($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    public function dropSoft($params,$response){

        $data = array(
            'id' => array('in',$params['id']) ,
            'status' => BaseModel::STATUS_DROP
        );
        $SoftModel = new SoftModel();
        $res = $SoftModel->save($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }
}