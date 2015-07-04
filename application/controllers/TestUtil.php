<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TestUtil extends CI_Controller {
    private $lastErrMsg = '', $response = array();
    function __construct(){
        parent::__construct(); 
        header("Content-Type:text/html;charset=utf-8");
        $this->load->library('unit_test'); 
        $this->unit->active(TRUE);
    }
    
    public function __destruct() {}
    
    public function index(){
    }
    
    private function check(){
        return TRUE;
    }
    
    function run(){
        print_r('this all right!'); 
        $this->load->model('Account_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        var_dump(form_open('account/register'));
        $a = '';
        var_dump(empty($a));die(); 
        $this->unit->run($this->check());
        echo $this->unit->report();
        echo $this->lastErrMsg;
    }
    
    
}