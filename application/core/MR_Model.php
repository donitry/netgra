<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 这是Mysql+Redis组合的Model父类
 * 用于继承使用，这里的方法会对Redis做扩展
 * @author Don 2015/7/3
 */

class MR_Model extends CI_Model{
    private $cache, $db;
    function __construct(){
        parent::__construct();
        $this->__get('load')->driver('cache');
        $this->cache = $this->__get('cache')->redis->is_supported()?
                    $this->__get('cache')->redis->_redis:NULL; 
        $this->__get('load')->database('pdo_driver');
        $this->db = $this->__get('db');
    }
    public function __destruct(){
        !empty($this->cache)?
            $this->__get('cache')->redis->__destruct():'';
        !empty($this->db)?$this->db->close():'';
    }

    private function r_hGet($table, $where)
    {
        if (is_array($where) OR is_object($where))
            $where = serialize($where);
        $value = $this->cache->hGet($table, $where);
        if (!empty($value) && $this->cache->sIsMember('_ci_redis_serialized', $where))
            return unserialize($value);
        return $value;
    }
    
    private function r_hSet($table, $where, $data){
        if (is_array($where) OR is_object($where))
            $where = serialize($where);
        if (is_array($data) OR is_object($data)){           
            if ( ! $this->cache->sIsMember('_ci_redis_serialized', $where) 
                && ! $this->cache->sAdd('_ci_redis_serialized', $where)) {
                return FALSE;
            } $data = serialize($data);           
        } elseif ($this->cache->sIsMember('_ci_redis_serialized', $where)) {
            $this->cache->sRemove('_ci_redis_serialized', $where);
        } return $this->cache->hSet($table, $where, $data);
    }
    
    private function r_hDel($table, $where){
        if (is_array($where) OR is_object($where))
            $where = serialize($where);
        if ($this->cache->sIsMember('_ci_redis_serialized', $where))
            $this->cache->sRemove('_ci_redis_serialized', $where);
        return $this->cache->hDel($table, $where);
            
    }
    
    /**
     * 获得数据原方法,缓存默认为Redis的hash
     * @param unknown $table 表名
     * @param unknown $where 条件
     * @param string $select 字段
     * @param string $only_db 是否直接取数据库数据
     * @return boolean|number 判断方式empty
     */
    public function select($table, $where, $only_db = FALSE, $is_row = FALSE, $select = '*') {
        if (empty($table) || empty($where)) return FALSE;
        $tmpData = $only_db ? 0:$this->r_hGet($table, $where);       
        if (empty($tmpData)) {
            $tmpData = $this->db->select($select)->where($where)->get($table);
            $tmpData = $is_row?$tmpData->row_array():$tmpData->result_array();           
            if (!empty($tmpData))
                $this->r_hSet($table, $where, $tmpData);
        }return $tmpData;
    }    
    
    /**
     * 数据表数据插入处理
     * @param unknown $table 表名
     * @param unknown $insert 插入的数据 array('feild'=>'data')
     * @return boolean
     */
    public function insert($table, $insert) {
        return empty($table) ? FALSE:$this->db->insert($table, $insert);
    }
    
    /**
     * 数据更新，更新成功后删除缓存数据
     * @param unknown $table
     * @param unknown $where
     * @param unknown $update
     * @return boolean
     */
    public function update($table, $where, $update) {
        if (empty($table) || empty($where) || empty($update)) return FALSE;
        if ($this->db->where($where)->update($table, $update)) {
            $this->r_hDel($table, $where);
            return TRUE;
        }else {
            $where = json_encode($where);
            log_message('error',"数据更新失败update!:{$where}-{$table}");
        } return FALSE;
    }
    
    /**
     * 数据删除，删除成功后删除缓存数据
     * @param unknown $table
     * @param unknown $where
     * @return boolean
     */
    public function delete($table, $where) {
        if (empty($table) || empty($where)) return FALSE;
        if ($this->db->where($where)->delete($table)) {
            $this->r_hDel($table, $where);
            return TRUE;
        }else {
            $where = json_encode($where);
            log_message('error',"数据删除失败update!:{$where}-{$table}");
        } return FALSE;
    }
    
    
    
    
    
    
    
    
    
    
    
}