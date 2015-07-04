<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 自定义的model
 * @author don
 * 按目前的设计来，Redis+Mysql 所以直接扩展redis库
 */

class MY_Model extends CI_Model{
    private $is_supported = FALSE,$cache;
    function __construct($adapter = 'redis'){
        parent::__construct();
        $this->load->driver('cache');
        $this->cache = $this->cache->{$adapter};
    }
    public function __destruct(){}
    
    /**
     * 检测缓存是否开启成功
     */
    public function is_supported(){
        $this->is_supported = $this->cache->is_supported();
        return $this->is_supported;
    }
    
    public function get($table, $where, $select = 'id', $only_db = FALSE){
        if ($only_db){
            return $this->db->select($select)->where($where)->get($table);
        }else {
            $key = serialize(array($table,$where,$select));
            $mem_data = $this->m_get($key);
            if (empty($mem_data)){
                $mem_data = $this->db->select($select)->where($where)->get($table);
                
            }
        }
    }
    
    public function test(){
        
    }
    
    /**
     * 缓存写入
     * @param unknown $key
     * @param unknown $value
     * @param number $time
     */
    private function m_set($key, $value, $time = 0){
        return $this->cache->save($key, $value, $time ? $time : $this->time);
    }
    
    /**
     * 缓存获得
     * @param unknown $key
     * @return boolean
     */
    private function m_get($key){
        return empty($key)?FALSE:$this->cache->get($key);
    }
    
    /**
     * 删除缓存
     * @param unknown $key
     * @return boolean
     */
    private function m_delete($key){
        return empty($key)?FALSE:$this->cache->delete($key);
    }
    
}