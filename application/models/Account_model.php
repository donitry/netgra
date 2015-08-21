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
        return $this->select('account',array('user_email'=>$user), FALSE, TRUE);
    }
    
    /**
     * 产生一个新的用户
     * @param unknown $userInfo
     * @return boolean
     */
    public function createAccount($userInfo) {
        if (is_array($userInfo) 
            && array_key_exists('user_email', $userInfo) && !empty($userInfo['user_email'])
            && array_key_exists('user_password', $userInfo) && !empty($userInfo['user_password'])) {
            $userInfo['create_time'] = now(); $userInfo['last_time'] = now();
            return $this->insert('account', $userInfo);
        } return FALSE;
    }
    
    /**
     * 更新用户基本信息
     * @param unknown $user
     * @param unknown $update
     */
    public function updateAccount($user, $update) {
        return $this->update('account', array('user_email'=>$user), $update);
    }
    
}