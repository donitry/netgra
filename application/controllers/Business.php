<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 商业交易控制器
 * @author don
 * 1，处理订单相关业务
 * 2，向用户指定账户所在服务器发送货物
 * 3，对于订单提供可支持的查询类业务
 */
class Business extends MR_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url', 'email', 'date'));
        $this->load->library('form_validation');
        $this->load->model('Account_model');
    }
    public function __destruct(){}
    
    public function index(){
        echo 'hello';
    }
    
    /**
     * 发货流程
     */
    public function completeOrder(){
        
    }
    
    
    /**
     * 订单申请开启
     */
    public function applyOrder(){
        
    }
    
    /**
     * 订单支付
     * 支付成功，启动发货流程
     * 若失败则不发起发货流程
     */
    public function payOrder(){
        
    }
    
}