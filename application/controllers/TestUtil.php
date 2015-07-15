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
        $this->load->model('Server_model');
        $this->load->helper('oauth');
        //$a = $this->Server_model->getServerList('xdcvf', 'own');
        //$a = $this->Server_model->updateServerStatus('xdcvf', 'own', 302011001, 4);
        $a = getSign(array('a'=>1), '1111');
        $data = $this->input->raw_input_stream;
        var_dump($data);show_error('a',301);
        $this->unit->run($this->check());
        echo $this->unit->report();
        echo $this->lastErrMsg;
    }
    
    
}