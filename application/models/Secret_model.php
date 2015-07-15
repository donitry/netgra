<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 针对通讯验证加密
 * 验证数据控制等操作s
 * @author don
 *
 */
class Secret_model extends MR_Model {
    public function __construct(){
        parent::__construct();
        $this->__get('load')->helper('date');
    }
    public function __destruct(){}
    
    /**
     * 获得secretKey和ip鉴权数据
     * @param unknown $client
     * @return Ambigous <boolean, number, mixed, unknown>
     */
    public function getSecretKey($client){
        $sec = $this->select('gc_secret', array('client'=>$client), FALSE, TRUE, 'ip_verify,secret_key');
        return empty($sec) ? FALSE:$sec;
    }
}