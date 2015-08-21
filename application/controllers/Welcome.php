<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MR_Controller {
    function __construct(){
        parent::__construct(null);
    }
    
	public function index() {
	    if (empty($this->rParam) || !isset($this->rParam['action'])){
	        $this->default_page();
	    } $this->public_html();
	}
	
	private function default_page(){
	    $out = array(
	        'user_sess' => $this->session->userdata('user'),
	    ); $this->pushTemplete($out, 'body/account_nav');
        return TRUE;
	}
	
	
	public function test(){
	    print_r("a"); 
	}
}
