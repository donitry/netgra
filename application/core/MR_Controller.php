<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 扩展Control
 * 计划仅接受post数据来源
 * @author don
 */

class MR_Controller extends CI_Controller {
    protected $rParam = array(),
              $views_data = array();
    function __construct($method) {
        parent::__construct ();
        $this->load->helper(array('oauth','array','date','url'));
        if (empty($method)) {
            $this->rParam = empty($this->input->post())?$this->input->get():$this->input->post();
        } else $this->rParam = $this->input->{$method}();
        $this->views_data['title'] = 'welcome to netgra!';
        $this->views_data['css'] = array(site_url('public_html/css/base.css'));
        $this->views_data['templete'] = array();
        $this->views_data['user_data'] = array();
        //if (!$this->checkInput($this->input->post())) 
        //    show_error('sign!',401);
        
    }
    public function __destruct(){}
    
    protected function pushTemplete($user_data = array(), $templete = ''){
        if (!empty($templete)){
            array_push($this->views_data['templete'], $templete);
        }
        
        if (!empty($user_data) && is_array($user_data)){
            foreach ($user_data As $k => $v){
                $this->views_data['user_data'][$k] = $v;
            }
        }
    }
    
    protected function public_html(){
        //var_dump($this->views_data);die();
        $this->load->view('templete/header', $this->views_data);
        if (!empty($this->views_data) && isset($this->views_data['templete']) 
            && is_array($this->views_data['templete']) && !empty($this->views_data['templete'])){
            foreach ($this->views_data['templete'] As $k => $v){
                $this->load->view($v, $this->views_data['user_data']);
            }
        }
        $this->load->view('templete/footer', $this->views_data);       
    }
    
    protected function response($response){     
        $this->output
             ->set_status_header(200)
             ->set_content_type('application/json', 'utf-8')
             ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
             ->_display();
        exit;
    }
    
    protected function getLastError(){
        return array('errMsg'=>$this->lastErr); 
    }
    
    protected function getResponse($result){       
        $this->respMsg['code'] = empty($result) ? 0:1;
        $this->respMsg['data'] = empty($result) ? $this->getLastError():$result;
        return $this->respMsg;
    }
    
}