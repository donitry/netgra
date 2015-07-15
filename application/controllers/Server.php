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
    private $method_name, $lastErr, $response = array();
    public function __construct(){
        parent::__construct('get');
        //$method_name = @$this->postParam['action'];
        //if (!method_exists($this, $method_name))
        //    show_error('action!',401);
        $this->load->model('Server_model');
        $this->load->helper(array('oauth','array'));
        header("Content-Type:text/html;charset=utf-8");
        $this->load->library('unit_test');
        $this->unit->active(TRUE);
    }
    public function __destruct(){}
    
    public function index(){
        $result = $this->{$this->method_name}($this->$rParam['data']);
        if ($result){
            $this->response($this->getResponse());
        }else $this->response($this->getLastError());
    }
    
    /**
     * 获得服务器基本资料
     */
    private function getServerInfo($params){
        $this->response['code'] = 0;
        $tmpArr = elements(array('game_key', 'group', 'id_server'), $params);
        if (!empty($tmpArr['game_key']) && !empty($tmpArr['group'])){
            $serInfo = $this->Server_model->getServerList($tmpArr['game_key'], $tmpArr['group']);
            if (!empty($serInfo)){                  
                if (!empty($tmpArr['id_server'])){
                    foreach ($serInfo As $k => $v){
                        if ($v['id_server'] == $tmpArr['id_server']){  
                            $this->response['code'] = 1;
                            $this->response['data'] = $v;
                            return TRUE;
                        }
                    } $this->lastErr = 'no this server!';
                }else {  
                    $this->response['code'] = 1;
                    $this->response['data'] = $serInfo;
                    return TRUE;
                } 
            }else $this->lastErr = 'no server info!';
        }return FALSE;
    }
    
    /**
     * 服务器基本状态修改
     * 修改状态会发向游戏服，并让游戏服同步状态
     */
    private function modifyServer($params){
        $this->response['code'] = 0;
        $tmpArr = elements(array('game_key', 'group', 'id_server', 'status'), $params);
        if (!empty($tmpArr['game_key']) && !empty($tmpArr['group']) 
            && !empty($tmpArr['id_server']) && !empty($tmpArr['status'])){
            if ($this->Server_model->updateServerStatus($tmpArr['game_key'], $tmpArr['group'], $tmpArr['id_server'], $tmpArr['status'])){
                
            }else $this->lastErr = 'fail!';
        }return FALSE;
    }
    
    private function getLastError(){
        return $this->lastErr;
    }
    
    private function getResponse(){
        return $this->response;
    }
    
    function Test(){
        $params = array(
            'game_key' => 'xdcvf',
            'group' => 'own',
            //'id_server' => '302011001',
            'status' => 4
        );
        $a = $this->getServerInfo($params);
        var_dump($this->response);die();
        $this->unit->run($this->getServerInfo($params));
        echo $this->unit->report();
        echo $this->lastErr;
    }
    
}