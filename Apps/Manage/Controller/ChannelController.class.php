<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/17
 * Time: 10:16
 */
namespace Manage\Controller;


use Common\Logic\ChannelLogic;
use Common\Logic\MouldLogic;

class ChannelController extends InitController {

    public  function index() {
        $params = array(
            'title' =>getParams('title')
        );
        $ChannelLogic = new ChannelLogic();
        $channel = $ChannelLogic->getChannel($params,$this->ajaxResponse());
        $MouldLogic = new MouldLogic();
        $mouldlist = $MouldLogic->getVaildMoulds($this->ajaxResponse());
        $this->assign('mouldlist',$mouldlist);
        $this->assign('channelList',$channel);
        $this->display();
    }

    public function add() {
        $needParams = array('title','ename','sort','display','status','mould','keyword','description');
        $params = $this->checkParams($needParams);
        $ChannelLogic = new ChannelLogic();
        $ChannelLogic->channelOper($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }

    public function edit() {
        $needParams = array('id','title','ename','sort','display','status','mould','keyword','description');
        $params = $this->checkParams($needParams);
        $ChannelLogic = new ChannelLogic();
        $ChannelLogic->channelOper($params,$this->ajaxResponse(),'edit');
        $this->ajaxReturn();
    }

    public function drop() {
        $needParams = array('id');
        $params = $this->checkParams($needParams);
        $ChannelLogic = new ChannelLogic();
        $ChannelLogic->dropById($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }
}