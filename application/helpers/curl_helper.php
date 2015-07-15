<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * curl通用函数helper
 * 可用于不同网站间的post和get通信
 * @author don
 */

if ( ! function_exists('curlTransfer')) {
    
    /**
     * 传递数据函数(使用curl)
     * @param unknown $uri
     * @param unknown $data
     * @param unknown $method
     */
    function curlTransfer($uri, $data, $is_post = TRUE){
        $option = array();
        $ch = curl_init();      
        if ($is_post){
            $option['CURLOPT_POST'] = 1;
            $option['CURLOPT_POSTFIELDS'] = $data;
        }if (empty($ch)) return FALSE;
        curl_setopt_array($ch, array(
            'CURLOPT_URL' => $uri,
            'CURLOPT_HEADER' => 0,
            'CURLOPT_RETURNTRANSFER' => 1,
            'CURLOPT_FOLLOWLOCATION' => 1,
        )); $rtn = curl_exec($ch);
        curl_close($ch);
        return $rtn;
    }
}