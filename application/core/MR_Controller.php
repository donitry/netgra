<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 扩展Control
 * @author don
 */

class MR_Controller extends CI_Controller {
    
    function __construct() {
        parent::__construct ();
        $this->load->helper('oauth');
        
    }
    public function __destruct(){}
    
    /**
     * 数字签名安全验证
     * @param unknown $data
     */
    protected function securityVerify($data){
        if (!array_key_exists('client', $data))
            return FALSE;
        $secret = $this->secret_model->getSecretKey($data['client']);
        if (empty($secret))
            return FALSE;
        else{
            $sign = $data['sign']; unset($data['sign']);
            return checkOAuth($data, $secret['secret_key'], $sign);
        }
    }
    
    /**
     * 对请求的数据进行验证
     * @param unknown $data
     */
    private function checkInput($data){
        if (empty($data) || !is_array($data) || !array_key_exists('sign', $data) 
            || !$this->securityVerify($data)) 
            return FALSE;
        
    }
}