<?php

/**
 * RSA处理类
 */

namespace Common\Util;

class Rsa {

    /**
     * 生成密钥，存在私钥参数则生成公钥
     * @param string $privKey RSA私钥
     * @retrun array pubKey公钥 privKey私钥 
     */
	public function createKey($privKey = null) {
    	//配置参数
    	$config = array(
    		'private_key_bits' => 2048,
    	);
    	if ($privKey != null) {
    		$res = openssl_pkey_get_private($privKey);
    	} else {
    		$res = openssl_pkey_new($config);
	    	openssl_pkey_export($res, $privKey, null, $config);
    	}
    	$array = openssl_pkey_get_details($res);
    	$pubKey = $array['key'];
    	openssl_pkey_free($res);
    	return array('pubKey' => $pubKey, 'privKey' => $privKey);
    }

    /**
     * 加密字符串（公钥加密）
     * @param string $str 需要加密的字符串
     * @param string $privKey RSA私钥
     * @retrun string
     */
    public function encrypt($str, $pubKey) {
    	openssl_public_encrypt($str, $crypted, $pubKey);
        $crypted = base64_encode($crypted);
    	return $crypted;
    }

    public function getPubKeyLength($pubKey) {

        $keyResource = openssl_pkey_get_public($pubKey);
        $keyDetail = openssl_pkey_get_details($keyResource);
        $keyByteLength = $keyDetail['bits'] / 8;
        openssl_free_key($keyResource);
        return $keyByteLength;
    }


    public function pubDecrypt($data, $pubKey) {
        $keyByteLength = $this->getPubKeyLength($pubKey);
        $dataArr = str_split($data, $keyByteLength);
        $plain = '';
        foreach($dataArr as $key => $val) {
            openssl_public_decrypt($val, $decrypted, $pubKey);
            $plain .= $decrypted;
        }
        return $plain;
    }

    /**
     * 解密字符串（私钥解密）
     * @param string $str 需要解密的字符串
     * @param string $privKey RSA私钥
     * @retrun string
     */
    public function decrypt($str, $privKey) {
    	$str = base64_decode($str);
    	$rs = openssl_private_decrypt($str, $decrypted, $privKey);
        if(!$rs) {
    	    openssl_private_decrypt($str, $decrypted, $privKey, OPENSSL_NO_PADDING);
            $decrypted = rtrim(strrev($decrypted), "\0");
        }
    	return urldecode($decrypted);
    }

    /**
     * RSA签名（私钥）
     * @param array $params 需要签名的数组
     * @param string $privKey RSA私钥
     * @retrun string
     */
    public function sign(&$params, $privKey) {
        $params_str = arrToQuery($params);
        $status = openssl_sign($params_str, $signature, $privKey);
        if ($status) {
            $signature_base64 = base64_encode($signature);
            $params['signature'] = $signature_base64;
        }
    }

    /**
     * 验证签名（公钥）
     * @param array $params 需要验签的参数数组
     * @param string $pubKey RSA公钥
     * @retrun boolean
     */
    public function verify($params, $pubKey) {
        $signature_str = $params['signature'];
        unset($params['signature']);
        $params_str = arrToQuery($params);
        $signature = base64_decode($signature_str);
        $status = openssl_verify($params_str, $signature, $pubKey);
        return $status;
    }

    /**
     * 根据私钥获取公钥
     * @param string $privKey RSA私钥
     * @retrun string
     */
    public function getPubKey($privKey) {
        $res = openssl_pkey_get_private($privKey);
        $array = openssl_pkey_get_details($res);
        $pubKey = $array['key'];
        openssl_pkey_free($res);
        return $pubKey;
    }

    /**
     * 发送短信数据签名
     */
    public function smsSign($str, $cert) {
        $privKey = file_get_contents(COMMON_PATH . $cert);
        $keyId = openssl_pkey_get_private($privKey);
        openssl_sign($str, $signature, $keyId);        
        $signature = base64_encode($signature);
        openssl_pkey_free($keyId);
        return $signature;
    }

    public function saveKeyPair($keyPair, $publicKeyPath, $privateKeyPath) {
        $keyFileName = uniqid() . '.pem';
        file_put_contents($publicKeyPath . $keyFileName, $keyPair['pubKey']);
        file_put_contents($privateKeyPath . $keyFileName, $keyPair['privKey']);
        return $keyFileName;
    }

    public function getPriKeyFromPath($publicKeyPath, $privateKeyPath, $keyFileName) {
        $keyPair['pubKey'] = file_get_contents($publicKeyPath . $keyFileName);
        $keyPair['privKey'] = file_get_contents($privateKeyPath . $keyFileName);
        return $keyPair;
    }

    public function savePassportKeys($keyPair, $keyFileName, $publicKeyPath, $privateKeyPath) {
        $keyFileName = $keyFileName . '.pem';
        file_put_contents($publicKeyPath . $keyFileName, $keyPair['pubKey']);
        file_put_contents($privateKeyPath . $keyFileName, $keyPair['privKey']);
        return $keyFileName;
    }
}