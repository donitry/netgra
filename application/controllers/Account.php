<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 通行证控制器
 * @author don
 * 功能：
 * 1，checkLoginToken 验证用户登陆的真实性
 * 2，updateUserInfo  登陆成功后，GS需要向GC发送用户的一些基本资料 只发送一次
 * 3，bannedRole      对指定账号或条件玩家实现封禁功能
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
        echo 'hello';
    }
    
    /**
     * 效验用户loginToken
     * 这步是和UC通讯的部分，获得正确的LoginToken
     * 因为是内部通讯，外部无从得知
     */
    public function checkLoginToken(){
        
    }
    
    /**
     * 完成效验后，玩家将进入游戏载入流程
     * GS将玩家最近的一些信息发过来，此处完成入库
     * 基本数据保存，可用于基本的一些接口查询
     */
    public function updateUserInfo(){
        
    }
    
    /**
     * 对于正常玩家实现一个封禁的功能
     * 会将封禁的信息发送到对应的GS，保证封禁情况同步发生
     * 这里叫封禁角色是留个口，以后同账号对应多个角色时修改此函数解决
     */
    public function bannedRole(){
        
    }
    

    
    
    
    
}