<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/6 0006
 * Time: 下午 5:06
 */
namespace Common\Lib;

class Weixin {

    private $appId;
    private $appSecret;
    private $token;
    private $encodingAsekey;

    const RIGHT = 10000;
    const TOKEN_ERROR = 10001;

    public function __construct($appId,$appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    public static $errMsg = array(
        self::TOKEN_ERROR =>'获取微信token错误！',
        self::RIGHT => 'success',

    );

    /**
     * 返回参数设置
     * @param $respCode
     * @param array $resp
     * @param string $respMsg
     * @return mixed
     */
    private function response($code, $resp = array())
    {
        $resp['respCode'] = $code;
        $resp['respMsg'] = self::$errMsg[$code];

        return $resp;
    }

    /**
     * 获取微信公众号token
     * @return mixed
     */
    public function getWxAccessToken() {
        if( session('access_token') || session('expires_in') > time()){
            $res['access_token'] = session('access_token');
            return $this->response(self::RIGHT,$res);

        } else {
            $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$this->appId."&secret=".$this->appSecret;
            $res = $this->httpReqCurl($url);
            $res = json_decode($res,true);
            if(!$res['access_token']) {
                return $this->response(self::TOKEN_ERROR);
            }
            $res['expires_in'] += time();
            setSession($res);
            return $this->response(self::RIGHT,$res);
        }
    }

    public function definedItems() {


    }

    public function httpReqCurl($url, $content = null, $type='get')
    {
        if (function_exists("curl_init")) {
            $curl = curl_init();

            if (is_array($content)) {
                $data = http_build_query($content);
            }
            if($type == 'post'){
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_TIMEOUT, 60); //seconds

            // https verify
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

            $ret_data = curl_exec($curl);

            if (curl_errno($curl)) {
                curl_close($curl);
                return false;
            } else {
                curl_close($curl);
                return trim($ret_data);
            }
        } else {
            throw new \Exception("[PHP] curl module is required");
        }
    }
}