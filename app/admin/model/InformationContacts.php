<?php

// +----------------------------------------------------------------------
// | EasyAdmin
// +----------------------------------------------------------------------
// | PHP交流群: 763822524
// +----------------------------------------------------------------------
// | 开源协议  https://mit-license.org 
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zhongshaofa/EasyAdmin
// +----------------------------------------------------------------------

namespace app\admin\model;


use app\common\model\TimeModel;

class InformationContacts extends TimeModel
{

    protected $table = "";

    protected $deleteTime = 'delete_time';


    /**
    *
    *性别获取器
    *
    */
    public function getSexAttr($value)
    {
    	$arr = array(1=>'男',2=>'女');
    	return $arr[$value];
    }

    /**
    *
    *联系人类型获取器
    *
    */
    public function getTypeAttr($value)
    {
    	$arr = array(1=>'供应商',2=>'客户');
    	return $arr[$value];
    }

    /**
    *
    *首要联系人获取器
    *
    */
    public function getIsLeaderAttr($value)
    {
        $arr = array(0=>'否',1=>'是');
        return $arr[$value];
    }
}