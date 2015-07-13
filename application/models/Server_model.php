<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 服务器数据模块
 * 用于服务器数据的调整和查询更新
 * @author don
 *
 */
class Server_model extends MR_Model {
    public function __construct(){
        parent::__construct();
        $this->__get('load')->helper('date');
    }
    public function __destruct(){}
    
    /**
     * 获得服务器列表，应该只用于后台控制
     * 不应在前端直接调用，因为对数据库会有直接查询
     * @param unknown $game_key
     * @param unknown $group
     * @return NULL|Ambigous <multitype:, boolean, number, mixed, unknown>
     */
    public function getServerList($game_key, $group){
        $serverInfo = $this->select('gc_server', array('game_key'=>$game_key,'group'=>$group));
        if (!empty($serverInfo)){           
            $idArr = array();
            foreach ($serverInfo As $k => $v){
                array_push($idArr, $v['t_server_status_id']);
            }             
            $serverInfo_ = $this->db->where_in('id', $idArr)->get('gc_server_status')->result_array();
            if (!empty($serverInfo_)){
                foreach ($serverInfo As $k => $v){
                    foreach ($serverInfo_ As $k_ => $v_){
                        if ($v['t_server_status_id'] == $v_['id']){
                            unset($serverInfo_[$k_]['id']);
                            $serverInfo[$k] = array_merge_recursive($serverInfo[$k],$serverInfo_[$k_]);
                            break;
                        }
                    }
                }             
            }else return NULL;
        }return $serverInfo;
    }
    
    /**
     * 更改服务器状态，用于服务器的开关新建操作
     * @param unknown $game_key
     * @param unknown $group
     * @param unknown $server_id
     * @param unknown $status
     * @return boolean
     */
    public function updateServerStatus($game_key, $group, $server_id, $status){        
        $serverInfo = $this->select('gc_server', array('game_key'=>$game_key,'group'=>$group, 'id_server'=>$server_id),FALSE ,TRUE);
        return empty($serverInfo) ? FALSE:$this->update('gc_server_status', array('id'=>$serverInfo['t_server_status_id']), array('status'=>$status));
    }
    
    /**
     * 更改服务器状态表数据
     * 是上一个方法的扩展，大多数情况下不会使用
     * @param unknown $game_key
     * @param unknown $group
     * @param unknown $server_id
     * @param unknown $update
     * @return boolean
     */
    public function updateServerStatusEx($game_key, $group, $server_id, $update){
        $serverInfo = $this->select('gc_server', array('game_key'=>$game_key,'group'=>$group, 'id_server'=>$server_id),FALSE ,TRUE);
        return empty($serverInfo) ? FALSE:$this->update('gc_server_status', array('id'=>$serverInfo['t_server_status_id']), $update);
    }
    
}
