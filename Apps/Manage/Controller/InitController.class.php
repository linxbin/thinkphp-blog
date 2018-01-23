<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/4
 * Time: 15:29
 */
namespace Manage\Controller;

use Common\Controller\BaseController;
use Common\Util\ErrCode;
use Think\Auth;

class InitController extends BaseController {

    public function _initialize() {
        parent::_initialize();
        if (C('USER_AUTH_ON')
            && !in_array(CONTROLLER_NAME, explode(',', C('NOT_AUTH_MODULE')))
            && !in_array(CONTROLLER_NAME . '/' . ACTION_NAME, explode(',', C('NOT_AUTH_ACTION')))
        ) {
            if (!session(C('USER_AUTH_KEY'))) {
                $this->redirect(C('USER_AUTH_GATEWAY'));
            }

            // 检测访问权限
            $access =   $this->accessControl();
            if ( $access === false ) {
                $this->error('403:禁止访问');
            }elseif( $access === null ){
                $rule  = strtolower('/'.CONTROLLER_NAME.'/'.ACTION_NAME);
                $Auth  =  new Auth();
                if( !$Auth->check($rule,session('adminId'))){
                    if(IS_AJAX){
                        $this->response(ErrCode::NOT_ACCESS);
                    } else {
                        $this->error("您无权使用该操作，请联系管理员授权！", U(CONTROLLER_NAME.'/index'));
                    }
                }
            }

        }
        return true;
    }

    /**
     * action访问控制,在 **登陆成功** 后执行的第一项权限检测任务
     *
     * @return boolean|null  返回值必须使用 `===` 进行判断
     *
     *   返回 **false**, 不允许任何人访问(超管除外)
     *   返回 **true**, 允许任何管理员访问,无需执行节点权限检测
     *   返回 **null**, 需要继续执行节点权限检测决定是否允许访问
     *
     */
    final protected function accessControl(){
        $allow = C('ALLOW_VISIT');
        $deny  = C('DENY_VISIT');
        $check = strtolower(CONTROLLER_NAME.'/'.ACTION_NAME);
        if ( !empty($deny)  && in_array_case($check,$deny) ) {
            return false;//非超管禁止访问deny中的方法
        }
        if ( !empty($allow) && in_array_case($check,$allow) ) {
            return true;
        }
        return null;//需要检测节点权限
    }
}