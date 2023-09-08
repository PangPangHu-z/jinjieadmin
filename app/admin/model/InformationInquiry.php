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

class InformationInquiry extends TimeModel
{

    protected $table = "";

    protected $deleteTime = 'delete_time';

    protected $autoWriteTimestamp = true;


    /**
    *
    *与询价单产品详情表一对多关联
    *
    */
    public function inquiryProduct()
    {
    	return $this->hasMany('InformationInquiryProduct','inquiry_id','id');
    }

    /**
    *
    *与项目关联
    *
    */
    public function project()
    {
    	return $this->belongsTo('InformationProject','project_id','id');
    }
    /**
    *
    *与联系人关联
    *
    */
    public function contacts()
    {
    	return $this->belongsTo('InformationContacts','contacts_id','id');
    }
    
}


