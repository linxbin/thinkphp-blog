<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/23
 * Time: 11:20
 */
namespace Common\Logic;

use Common\Model\ArticleModel;
use Common\Model\BaseModel;
use Common\Util\ErrCode;
class ArticleLogic {

    public function addArticle($params,$response)
    {
        $data = $this->createData($params);
        $data['time'] = time();
        $ArticleModel = new ArticleModel();
        if( $data['id'] ) {
            $res = $ArticleModel->save($data);
        } else {
            $res = $ArticleModel->add($data);
        }
        if( $res === false ) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    /**
     * 获取文章列表
     * @param $params
     * @param $page
     * @param $response
     * @return array|bool
     */
    public function getArticList($params, $page, $response){

        $opt = $this->getCondition($params);
        $ArticleModel = new ArticleModel();
        $orderBy = 'art.time desc';
        $data = $ArticleModel ->getArticle($opt, $orderBy,$page);
        if($data === false){
            $response(ErrCode::SQL_ERROR);
        }
        foreach($data['list']  as $i => $item){
            $data['list'][$i]['url'] = get_content_url($item['id'], $item['channel_id'], $item['ename']);
        }
        return $data;
    }

    public function getArticleById($id,$response) {
        $ArticleModel = new ArticleModel();
        $data = $ArticleModel->getArticleById($id);
        if($data) {
            $data['tags'] = explode(',',$data['keyword']);
            $data['content'] = stripslashes($data['content']);
            $data['description'] = stripslashes($data['description']);
        }

        if($data === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return $data;
    }

    /**
     * 编辑文章
     * @param $params
     * @param $response
     * @return bool
     */
    public function editArticle($params,$response)
    {
        $ArticleModel = new ArticleModel();
        $data = $this->createData($params);
        $res = $ArticleModel->save($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    /**
     * 保存草稿箱
     * @param $params
     * @param $response
     * @return bool
     */
    public function draftArticle($params,$response)
    {
        $data = $this->createData($params);
        $data['time'] = time();
        $data['status'] = ArticleModel::STATUS_DRAF;
        $ArticleModel = new ArticleModel();
        if($params['id']) {
            $data['id'] = $params['id'];
            $res = $ArticleModel ->save($data);
            $resp['draftId'] = $data['id'];
        } else {
            $res = $ArticleModel -> add($data);
            $resp['draftId'] = $res;
        }
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return $resp;
    }


    /**
     * 构造处理的数据
     * @param $params
     * @return array
     */
    protected function createData($params)
    {
        $data = array(
            'id' => $params['id'] ? $params['id'] : '',
            'title' => $params['title'],
            'description' => $params['description'],
            'keyword' => $params['keyword'],
            'content' => $params['content'],
            'channel_id' => $params['channel_id'],
            'digest' => $params['digest'] ? $params['digest'] : '',
            'hot' => $params['hot'] ? $params['hot'] : '',
            'top' => $params['top'] ? $params['top'] : '',
            'tags' => $params['tags'] ? $params['tags'] : '',
            'author' => $params['author'],
            'thumb' => self::thumb($params['content']),
            'status' => ArticleModel::STATUS_DEFAULT,
        );
        return $data;
    }


    /**
     * 删除文章
     * @param $params
     * @param $response
     * @return bool
     */
    public function dropArticle($params,$response){

        $data = array(
            'id' => array('in',$params['id']) ,
            'status' => BaseModel::STATUS_DROP
        );
        $ArticleModel = new ArticleModel();
        $res = $ArticleModel->save($data);
        if($res === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return true;
    }

    /**
     * 根据栏目id获取文章列表
     * @param $ChannelId
     * @param $pageSize
     * @param $response
     * @return array
     */
    public function getArticleByChannelId($ChannelId,$pageSize,$response) {
        $ArticleModel = new ArticleModel();
        $data = $ArticleModel->getArticleByChannelId($ChannelId,$pageSize);
        if($data === false) {
            $response(ErrCode::SQL_ERROR);
        }
        return $data;
    }

    /**
     * 获取文章第一张图片做为缩略图
     * @param $content
     * @return bool|string
     */
    private static function thumb($content){
        $content = stripslashes($content);
        $rule = "/<img([^>]*)\ssrc=([^\s>]+)/";
        if(preg_match_all($rule, $content, $matches)) {
            $str = $matches[2][0];
            if (preg_match('/Uploads/', $str)) {
                $str = explode('Uploads',$str);
                $thumb = '/Uploads'.$str[1];
                return $thumb;
            }
        }
        return '';
    }

    /**
     * 构造查询条件
     * @param $params
     * @return array
     */
    public function getCondition($params)
    {

        $opt = array();
        if($params['status']) {
            $opt['art.status'] = array('eq',$params['status']);
        } else {
            $opt['art.status'] = array('eq',ArticleModel::STATUS_DEFAULT);
        }

        if($params['aid']) {
            $opt['art.id'] = array('eq', $params['aid']);
        }
        if($params['cid']) {
            $opt['art.channel_id'] = array('eq', $params['cid']);
        }
        if($params['hot']) {
            $opt['art.hot'] = array('eq', '1');
        }
        if($params['top']) {
            $opt['art.top'] = array('eq' , '1');
        }

        if($params['keyword']) {
            $opt['art.title | art.keyword'] = array('like', '%'.$params['keyword']. '%');
        }

        if($params['title']) {
            $opt['art.title'] = array('like', '%'. $params['title'] . '%');
        }

        return $opt;
    }

    /**
     * 添加浏览数，每浏览一次页面+1
     * @param $aid
     */
    public static function  addAtriclePv($aid)
    {
        $ArticleModel = new ArticleModel();
        $ArticleModel -> where(array('id'=> $aid)) -> setInc('pv',1);
    }

    public function getDraftNum()
    {
        $ArticleModel = new ArticleModel();
        $num = $ArticleModel -> where(array('status'=> ArticleModel::STATUS_DRAF))->count();
        return $num ? $num : 0;
    }
}