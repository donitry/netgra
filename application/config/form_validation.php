<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config = array(
    'account/register' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|valid_email|min_length[5]|max_length[24]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[5]|max_length[24]'
        ),
        array(
            'field' => 'passconf',
            'label' => 'Password Confirmation',
            'rules' => 'trim|required|min_length[5]|max_length[24]'
        ),
        array(
            'field' => 'phone',
            'label' => 'Modile Phone',
            'rules' => 'trim|required|min_length[5]|max_length[24]'
        )
    ),
    'account/login' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|valid_email|min_length[5]|max_length[24]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[5]|max_length[24]'
        )
    ),
    'account/email' => array(
        array(
            'field' => 'emailaddress',
            'label' => 'EmailAddress',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|alpha'
        ),
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'message',
            'label' => 'MessageBody',
            'rules' => 'required'
        )
    )
);