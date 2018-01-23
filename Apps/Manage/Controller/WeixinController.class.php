<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/4
 * Time: 14:06
 */
namespace Manage\Controller;

use Common\Logic\ConfigLogic;

class WeixinController extends InitController {

    public function index() {

        $ConfigLogic = new ConfigLogic();
        $config = $ConfigLogic->getWxConfig($this->ajaxResponse());
        $this->assign($config);
        $this->display();
    }

    public function basic() {

        $needParams = array('wx_url', 'wx_appid','wx_appsecret','wx_token');
        $optParams = array('wx_encoding_aeskey');
        $params = $this->checkParams($needParams,$optParams);

        $ConfigLogic = new ConfigLogic();
        $ConfigLogic->saveWxConfig($params,$this->errorFunc());
        $this->success('修改配置成功！',U('index'));
    }
}