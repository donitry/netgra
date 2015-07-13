<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 服务中心控制器
 * @author don
 * 1，获得用户服务器数据
 * 2，服务器管理（开关服）
 * 3，新游戏服发布，删档等控制发起中心
 */
class Server extends MR_Controller {
    public function __construct(){
        parent::__construct();
        
    }
    public function __destruct(){}
    
    public function index(){
        echo 'hello';
    }
    
    /**
     * 获得服务器基本资料
     */
    public function getServerInfo(){
        
    }
    
    /**
     * 服务器基本状态修改
     * 修改状态会发向游戏服，并让游戏服同步状态
     */
    public function modifyServer(){
        
    }
    
    
    
}