<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/24
 * Time: 16:58
 */

namespace Manage\Controller;

use Common\Logic\ConfigLogic;

class ConfigController extends InitController
{
    public function index()
    {
        $ConfigLogic = new ConfigLogic();
        $config = $ConfigLogic->getConfig($this->ajaxResponse());
        $this->assign($config);
        $this->display();
    }

    /**
     * 配置参数设置
     */
    public function set() {
        $params = I('param.',array(),'trim');
        $ConfigLogic = new ConfigLogic();
        $ConfigLogic->setConfig($params,$this->ajaxResponse());
        $this->ajaxReturn();
    }
}