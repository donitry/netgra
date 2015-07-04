<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MR_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
    }
    public function __destruct(){}
    
    public function index(){
  
    }
    
    /**
     * 显示此时需要的表单(register/login)
     * @param unknown $form
     */
    private function setDisplayForm($form){                   
        $data['verification'] = mt_rand(1000, 10000) . $form;
        $this->session->set_flashdata('step', $data['verification']);
        $this->load->view('templete/header', $data);
        $this->load->view('account/'.$form);
        $this->load->view('templete/footer');
    }
    
    /**
     * 登陆处理
     * 通过step这个session来避免重复性的提交
     */
    public function login(){
        if ($this->session->has_userdata('step')
            && !empty($this->input->post('verification'))
            && ($this->session->userdata('step') == $this->input->post('verification'))){                             
            print_r( $this->input->post());
        }else {
            
            $this->setDisplayForm('login');
        }return FALSE;      
    }
    
    /**
     * 注册处理
     */
    public function register(){
        if ($this->session->has_userdata('step')
            && !empty($this->input->post('verification'))
            && ($this->session->userdata('step') == $this->input->post('verification'))){                             
            print_r($this->input->post());
        }else {
            print_r($this->input->post());
            $this->setDisplayForm('register');
        }return FALSE;  
        
    }
    
    
    
    
}