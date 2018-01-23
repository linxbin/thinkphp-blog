<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/15 0015
 * Time: 下午 2:25
 */
namespace Home\Controller;

use Common\Logic\ChannelLogic;
use Common\Logic\SoftLogic;

class SoftController extends InitController {


    public function index()
    {
        $id = getParams('id');
        $SoftLogic = new SoftLogic();
        $soft = $SoftLogic->getSoftById($id,$this->ajaxResponse());
        $channel = ChannelLogic::getChannelById($soft['channel_id'],$this->ajaxResponse());
        $this->assign('class',$channel);
        $this->assign('soft',$soft);
        $this->display();
    }
}