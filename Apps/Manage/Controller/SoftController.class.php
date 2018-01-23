<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/3/26 0026
 * Time: 下午 9:31
 */
namespace Manage\Controller;

use Common\Logic\ChannelLogic;
use Common\Logic\SoftLogic;

class SoftController extends InitController {

    public function index() {
        $SoftLogic = new SoftLogic();
        $data = $SoftLogic -> getSfotList($this->ajaxResponse());
        $this->assign('softlist',$data['list']);
        $this->assign('page',$data['page']);
        $this->display();
    }

    public function add() {

        if(!IS_AJAX) {
            $ChannelLogic = new ChannelLogic();
            $params = array(
                'mould' => 'soft'
            );
            $channels = $ChannelLogic->getChannel($params,$this->ajaxResponse());
            $this->assign('title','添加软件');
            $this->assign("channels",$channels);
            $this->display();
        } else {
            $needParams = array('title','thumb','channel_id','language','version','size','download','platform','author');
            $optParams = array('keyword','num','description','content');
            $params = $this->checkParams($needParams,$optParams);
            $SoftLogic = new SoftLogic();
            $SoftLogic->addSoft($params,$this->ajaxResponse());
            $this->ajaxReturn();
        }
    }

    public function edit()
    {
        if (!IS_AJAX) {
            $params = array(
                'id' => getParams('id')
            );
            $ChannelLogic = new ChannelLogic();
            $channels = $ChannelLogic->getChannel(array('mould' => 'soft'), $this->ajaxResponse());
            $SoftLogic = new SoftLogic();
            $data = $SoftLogic->getSoftById($params['id'], $this->ajaxResponse());
            $this->assign('title', '编辑软件');
            $this->assign("channels", $channels);
            $this->assign('data', $data);
            $this->display();
        } else {
            $needParams = array('id','title','thumb','channel_id','language','version','size','download','platform','author');
            $optParams = array('keyword','num','description','content');
            $params = $this->checkParams($needParams, $optParams);
            $ArticleLogic = new SoftLogic();
            $ArticleLogic->editSoft($params, $this->ajaxResponse());
            $this->ajaxReturn();
        }
    }

    public function drop() {
        $needParams = array('id');
        $params = $this->checkParams($needParams);
        $ArticleLogic = new SoftLogic();
        $ArticleLogic->dropSoft($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }
}