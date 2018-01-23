<?php

namespace Manage\Controller;

use Common\Controller\BaseController;
use Common\Logic\UserLogic;

class LoginController extends BaseController  {

    public function index(){

        $this->display();
    }

    /**
     * 管理员登录
     */
    public function signin()
    {
        if(!IS_POST && !IS_AJAX)
        {
            $this->redirect(C('USER_AUTH_GATEWAY'));
        }
        $params = array(
            'account' => getParams('account'),
            'password' => getParams('password'),
            'code' => getParams('code')
        );

        $UserLogic = new UserLogic();
        $UserLogic -> adminSign($params,$this->ajaxResponse());
        $this->ajaxReturn();

    }

    public function signout() {
        session(null);
        $this->redirect('login/index');
    }
}
