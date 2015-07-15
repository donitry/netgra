<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 密钥算法helper
 * @author don
 */

if ( ! function_exists('getSign')) {
    
    /**
     * 获得MD5后的加密串
     * @param unknown $param
     * @param unknown $secretKey
     */
    function getSign($param, $secretKey){
        $str = '';
        ksort($param);
        foreach ($param as $key => $value) {
            $str .= $key .'='. $value;
        } return md5($str . $secretKey);
    }
}


if ( ! function_exists('checkOAuth')) {

    /**
     * 验证验证码是否匹配
     * @param unknown $param
     * @param unknown $secretKey
     * @param unknown $sign
     * @return boolean
     */
    function checkOAuth($param, $secretKey, $sign){
        $correctSign = getSign($param, $secretKey);
        return  ($correctSign == strtolower($sign));
    }
    
}