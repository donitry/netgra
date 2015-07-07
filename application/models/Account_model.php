<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends MR_Model {
    public function __construct(){
        parent::__construct();
        $this->__get('load')->helper('date');
    }
    public function __destruct(){}
    
    /**
     * 返回账号数据
     * @param unknown $user
     */
    public function getAccountInfo($user) {
        $userInfo = $this->select('api_account',array('user_email'=>$user));
        return empty($userInfo) ? NULL:(is_array($userInfo)?$userInfo[0]:$userInfo);
    }
    
    /**
     * 产生一个新的用户
     * @param unknown $userInfo
     * @return boolean
     */
    public function createAccount($userInfo) {
        if (is_array($userInfo) 
            && array_key_exists('user_email', $userInfo) && !empty($userInfo['user_email'])
            && array_key_exists('password', $userInfo) && !empty($userInfo['password'])) {
            $userInfo['create_time'] = now();
            $userInfo['last_time'] = now();
            return $this->insert('api_account', $userInfo);
        } return FALSE;
    }
    
    /**
     * 更新用户基本信息
     * @param unknown $user
     * @param unknown $update
     */
    public function updateAccount($user, $update) {
        return $this->update('api_account', array('user_email'=>$user), $update);
    }
    
}