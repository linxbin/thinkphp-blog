<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/4/5
 * Time: 11:39
 */
namespace Home\Controller;

use Common\Logic\ArticleLogic;
use Common\Logic\ChannelLogic;
use Common\Logic\SoftLogic;

class ChannelController extends InitController
{

    public function index()
    {
        $ename = getParams('ename');
        $channel = ChannelLogic::getChannelByEname($ename,$this->ajaxResponse());
        if(!$channel) {
            $this->display('Common:404');
            return ;
        }
        $this->assign($channel);
        $this->display($channel['mould']);
    }

}