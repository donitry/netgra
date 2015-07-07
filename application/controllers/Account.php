<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 通行证控制器
 * @author don
 *
 */
class Account extends MR_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url', 'email', 'date'));
        $this->load->library('form_validation');       
        $this->load->model('Account_model');
    }
    public function __destruct(){}
    
    public function index(){
  
    }

    /**
     * 检测用户名，不带密码的时候不做验证
     * @param unknown $user
     * @param string $pass
     * @return boolean
     */
    private function checkUserName($user, $pass = NULL){
        $userInfo = $this->Account_model->getAccountInfo($user);
        if (!empty($userInfo)){
            if (!empty($pass) && $userInfo['password'] != $pass)            
                return FALSE;
            elseif (!empty($pass) && $userInfo['password'] == $pass)
                $this->session->set_userdata('user',$userInfo);
             return TRUE;
        } return FALSE;
    }
    
    /**
     * 效验是否是表单来的
     * @param unknown $verif
     * @return boolean
     */
    private function checkVerification($verif) {
        if ($this->session->has_userdata('step')
            && !empty($verif) && ($this->session->userdata('step') == $verif)){
            return TRUE;
        }return FALSE;
    }
    
    /**
     * 显示此时需要的表单(register/login)
     * @param unknown $form
     */
    private function setDisplayForm($form){
        $data['title'] = $form;
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
        $postParams = $this->input->post();
        if ($this->form_validation->run() && isset($postParams['verification'])
            && $this->checkVerification($postParams['verification'])) {
            if ($this->checkUserName($postParams['username'], $postParams['password']))
                $this->Account_model->updateAccount($postParams['username'], array('last_time'=>now()));
            var_dump($this->session->userdata('user'));
        }else {           
            $this->setDisplayForm('login');
        }return FALSE;      
    }
    
    /**
     * 注册处理
     */
    public function register(){      
        $postParams = $this->input->post();
        if ($this->form_validation->run() && isset($postParams['verification'])
            && $this->checkVerification($postParams['verification'])) {
            $data = array(
                'user_email' => $postParams['username'],
                'password'   => $postParams['password'],
                'phone'      => @$postParams['phone'],
            ); return $this->checkUserName($postParams['username'])?FALSE:$this->Account_model->createAccount($data);
        }else { 
            $this->setDisplayForm('register');
        }return FALSE;  
        
    }
    
    
    
    
}