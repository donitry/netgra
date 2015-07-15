<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 扩展Control
 * 计划仅接受post数据来源
 * @author don
 */

class MR_Controller extends CI_Controller {
    protected $rParam = array();
    function __construct($method) {
        parent::__construct ();
        $this->load->helper('oauth','array');
        //if (!$this->checkInput($this->input->post())) 
        //    show_error('sign!',401);
        
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
        else {
            if (array_key_exists('data', $data)){
                $this->rParam = $data['data'];
                return TRUE;
            }
        } return FALSE;
    }
    
    protected function response($response){       
        $this->output
             ->set_status_header(200)
             ->set_content_type('application/json', 'utf-8')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
             ->_display();
        exit;
    }
    
}