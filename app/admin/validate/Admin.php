<?php

namespace app\admin\validate;

use think\Validate;

class Admin extends Validate
{
	//验证规则
	protected $rule =   [
        'username'  =>	'require|alphaNum|length:5,11|unique:system_admin',
        'password'	=>	'require|alphaNum|length:5,20',
        'phone'		=>	'require|mobile|unique:system_admin',
    ];

    //验证提示信息
    protected $message  =   [
		'username.require'		=>	'用户名不能为空',
		'username.alphaNum'		=>	'用户名必须是字母数字',
		'username.length'			=>	'用户名长度范围5-11个字符',
		'username.unique'		=>	'用户名已存在',
		'password.require'		=>	'密码不能为空',
		'password.alphaNum'		=>	'密码只能是字母数字',
		'password.length'			=>	'密码长度范围5-20个字符',
		'phone.require'			=>	'手机号不能为空',
		'phone.mobile'			=>	'手机号格式错误',
		'phone.unique'			=>	'手机号重复'
    ];

    //验证场景
    protected $scene = [
    	'add'	=>	['username','phone'],
        'edit'  =>  ['username','phone'],
    ];  
}