<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/4
 * Time: 15:51
 */
namespace Common\Controller;

use Common\Util\ErrCode;
use Think\Controller;
use Think\Upload;
use Think\Verify;

class BaseController extends Controller {

    public function _initialize(){
        header("Content-type:text/html;charset=utf-8");
    }

    public function  _empty() {
        header ( " HTTP/1.0  404  Not Found" );
        $this->display("Common:404");
    }

    public function index() {

    }

    /**
     * 根据设置参数判断传递参数是否正确以及验证数据签名是否正确
     * @access public
     * @param array $need_param : 必须传递参数
     * @param array $option_param : 可选传递参数
     * @param array $method : 请求方法
     * @return array
     */
    public function checkParams($need_param, $option_param = array(), $method = "post", $filter=false)
    {
        $params = I($method . '.', '', $filter);
        if ($params['backUrl']) {
            $params['backUrl'] = htmlspecialchars_decode($params['backUrl']);
        }
        if ($params['frontUrl']) {
            $params['frontUrl'] = htmlspecialchars_decode($params['frontUrl']);
        }

        $resp = array();

        foreach ($need_param as $field) {
            if (!isset($params[$field]) || $params[$field] === "") {
                $this->response(ErrCode::PARAM_ERROR, '缺少参数 ' . $field);
            }
            $resp[$field] = $params[$field];
        }

        foreach ($option_param as $val) {
            if (!isset($params[$val])) {
                $params[$val] = '';
            }
            $resp[$val] = $params[$val];
        }

        return $resp;
    }

    public function response($code, $msg = '')
    {
        $res = array(
            'respCode' => $code,
            'respMsg' => ErrCode::$errMsg[$code] . $msg,
        );
        $this->ajaxReturn($res, FALSE);
    }

    /**
     * 客户端响应处理
     */
    public function ajaxResponse()
    {
        $thisObj = $this;
        $response = function ($code, $msg = '') use ($thisObj) {
            $res = array(
                'respCode' => $code,
                'respMsg' => ErrCode::$errMsg[$code] . $msg,
            );
            $thisObj->ajaxReturn($res, FALSE);
        };
        return $response;
    }

    /**
     * ajax返回函数公有化
     */
    public function ajaxReturn($data = array(), $success = true, $type = '', $json_option = 0)
    {
        if ($success) {
            $code = ErrCode::RIGHT;
            $data['respCode'] = $code;
            $data['respMsg'] = ErrCode::$errMsg[$code];
        }
        parent::ajaxReturn($data, $type = '', $json_option = 0);
        exit;
    }

    /**
     * 生成验证码
     */
    public function verify()
    {
        $Verify = new Verify();
        $Verify->length = 4;
        $Verify->codeSet = '123456789';
        $Verify->useNoise = false;
        $Verify->useImgBg = true;
        $Verify->entry();
    }

    public function uploadImg($filename,$response)
    {
        $config = array(
            'maxSize' => 3145728,
            'rootPath' => './Uploads/',
            'savePath' => $filename.'/',
            'saveName' => array('uniqid', ''),
            'exts' => array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub' => true,
            'subName' => array('date', 'Ymd'),
        );
        $upload = new Upload($config);
        $info = $upload->upload();
        if (!$info) {
            $response(ErrCode::UPLOAD_IMG_ERROR, $upload->getError());
        }
        $rootPath = '/Uploads/' . $info['file']['savepath'];
        $data['imageUrl'] = $rootPath . $info['file']['savename'];
        return $data;
    }

    public function errorFunc()
    {
        $action = $this;
        return function ($errorMsg) use ($action) {
            $action->error($errorMsg);
        };
    }

    function error($msg, $jumpUrl = false, $waitSecond = 3, $ajax = false)
    {
        if ($jumpUrl) {
            $this->assign('jumpUrl', $jumpUrl);
        }
        $this->assign('waitSecond', $waitSecond);
        parent::error($msg, $ajax);
    }

}
