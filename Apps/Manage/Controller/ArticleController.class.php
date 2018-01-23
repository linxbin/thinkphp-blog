<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/21 0021
 * Time: 下午 9:41
 */
namespace Manage\Controller;

use Common\Logic\ArticleLogic;
use Common\Logic\ChannelLogic;
use Common\Model\ArticleModel;

class ArticleController extends InitController {

    /**
     * 文章列表页
     */
    public function index()
    {
        $params = array(
            'title' => getParams('title')
        );
        $ArticleLogic = new ArticleLogic();
        $data = $ArticleLogic -> getArticList($params, $page = C('PAGE_SIZE'), $this->ajaxResponse());
        $draftNum = $ArticleLogic -> getDraftNum();
        $this->assign('draftNum',$draftNum);
        $this->assign('data',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
    }

    /**
     * 文章添加
     */
    public function add()
    {
        if(!IS_POST){
            $ChannelLogic = new ChannelLogic();
            $params = array(
                'mould' => 'article'
            );
            $channels = $ChannelLogic->getChannel($params,$this->ajaxResponse());
            $this->assign('title','添加文章');
            $this->assign("channels",$channels);
            $this->display();
        } else {
            $needParams = array('title','content','channel_id','author');
            $optParams = array('id','description','keyword','hot','top');
            $params = $this->checkParams($needParams,$optParams);
            $ArticleLogic = new ArticleLogic();
            $ArticleLogic->addArticle($params,$this->ajaxResponse());
            $this->ajaxReturn();
        }
    }

    /**
     * 文章编辑
     */
    public function edit()
    {
        if(!IS_AJAX) {
            $params = array(
                'id' => getParams('id')
            );
            $ChannelLogic = new ChannelLogic();
            $channels = $ChannelLogic->getChannel(array('mould'=>'article'),$this->ajaxResponse());
            $ArticleLogic = new ArticleLogic();
            $data = $ArticleLogic->getArticleById($params['id'],$this->ajaxResponse());
            $this->assign('title','编辑文章');
            $this->assign("channels",$channels);
            $this->assign('data',$data);
            $this->display();
        } else {
            $needParams = array('id','title','content','channel_id','author');
            $optParams = array('description','keyword','hot','top');
            $params = $this->checkParams($needParams,$optParams);
            $ArticleLogic = new ArticleLogic();
            $ArticleLogic->editArticle($params,$this->ajaxResponse());
            $this->ajaxReturn();
        }

    }

    /**
     * 保存到草稿箱
     */
    public function draft ()
    {
        if(!IS_AJAX) {
            $ArticleLogic = new ArticleLogic();
            $params = array(
                'status' => ArticleModel::STATUS_DRAF
            );
            $data = $ArticleLogic->getArticList($params, $page = C('PAGE_SIZE'), $this->ajaxResponse());
            $this->assign('data',$data['list']);
            $this->assign('page',$data['page']);
            $this->display();
        } else {
            $needParams = array('title','content','channel_id','author');
            $optParams = array('id','description','keyword','hot','top');
            $params = $this->checkParams($needParams,$optParams);
            $ArticleLogic = new ArticleLogic();
            $resp = $ArticleLogic->draftArticle($params,$this->ajaxResponse());
            $this->ajaxReturn($resp);
        }
    }

    /**
     * 删除
     */
    public function drop() {
        $needParams = array('id');
        $params = $this->checkParams($needParams);
        $ArticleLogic = new ArticleLogic();
        $ArticleLogic->dropArticle($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }
}