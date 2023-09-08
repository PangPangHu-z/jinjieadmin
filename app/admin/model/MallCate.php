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

class MallCate extends TimeModel
{

    protected $deleteTime = 'delete_time';

    public function getPidCateList($modelType = '')
    {
        $list = $this->field('id,pid,title')
            ->where([
                ['status', '=', 1]
            ])
            ->order('sort desc')
            ->select()
            ->toArray();
        $pidCateList = $this->buildPidCate(0, $list);
        if($modelType == 'cate'){
            $pidCateList = array_merge([[
                'id'    => 0,
                'pid'   => 0,
                'title' => '顶级分类',
            ]], $pidCateList);
        }
        return $pidCateList;
    }

    protected function buildPidCate($pid, $list, $level = 0)
    {
        $newList = [];
        foreach ($list as $vo) {
            if ($vo['pid'] == $pid) {
                $level++;
                foreach ($newList as $v) {
                    if ($vo['pid'] == $v['pid'] && isset($v['level'])) {
                        $level = $v['level'];
                        break;
                    }
                }
                $vo['level'] = $level;
                if ($level > 1) {
                    $repeatString = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    $markString   = str_repeat("{$repeatString}├{$repeatString}", $level - 1);
                    $vo['title']  = $markString . $vo['title'];
                }
                $newList[] = $vo;
                $childList = $this->buildPidCate($vo['id'], $list, $level);
                !empty($childList) && $newList = array_merge($newList, $childList);
            }

        }
        return $newList;
    }
}