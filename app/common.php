<?php
// 应用公共文件

use app\common\service\AuthService;
use think\facade\Cache;

if (!function_exists('__url')) {

    /**
     * 构建URL地址
     * @param string $url
     * @param array $vars
     * @param bool $suffix
     * @param bool $domain
     * @return string
     */
    function __url(string $url = '', array $vars = [], $suffix = true, $domain = false)
    {
        return url($url, $vars, $suffix, $domain)->build();
    }
}

if (!function_exists('password')) {

    /**
     * 密码加密算法
     * @param $value 需要加密的值
     * @param $type  加密类型，默认为md5 （md5, hash）
     * @return mixed
     */
    function password($value)
    {
        $value = sha1('blog_') . md5($value) . md5('_encrypt') . sha1($value);
        return sha1($value);
    }

}

if (!function_exists('xdebug')) {

    /**
     * debug调试
     * @deprecated 不建议使用，建议直接使用框架自带的log组件
     * @param string|array $data 打印信息
     * @param string $type 类型
     * @param string $suffix 文件后缀名
     * @param bool $force
     * @param null $file
     */
    function xdebug($data, $type = 'xdebug', $suffix = null, $force = false, $file = null)
    {
        !is_dir(runtime_path() . 'xdebug/') && mkdir(runtime_path() . 'xdebug/');
        if (is_null($file)) {
            $file = is_null($suffix) ? runtime_path() . 'xdebug/' . date('Ymd') . '.txt' : runtime_path() . 'xdebug/' . date('Ymd') . "_{$suffix}" . '.txt';
        }
        file_put_contents($file, "[" . date('Y-m-d H:i:s') . "] " . "========================= {$type} ===========================" . PHP_EOL, FILE_APPEND);
        $str = (is_string($data) ? $data : (is_array($data) || is_object($data)) ? print_r($data, true) : var_export($data, true)) . PHP_EOL;
        $force ? file_put_contents($file, $str) : file_put_contents($file, $str, FILE_APPEND);
    }
}

if (!function_exists('sysconfig')) {

    /**
     * 获取系统配置信息
     * @param $group
     * @param null $name
     * @return array|mixed
     */
    function sysconfig($group, $name = null)
    {
        $where = ['group' => $group];
        $value = empty($name) ? Cache::get("sysconfig_{$group}") : Cache::get("sysconfig_{$group}_{$name}");
        if (empty($value)) {
            if (!empty($name)) {
                $where['name'] = $name;
                $value = \app\admin\model\SystemConfig::where($where)->value('value');
                Cache::tag('sysconfig')->set("sysconfig_{$group}_{$name}", $value, 3600);
            } else {
                $value = \app\admin\model\SystemConfig::where($where)->column('value', 'name');
                Cache::tag('sysconfig')->set("sysconfig_{$group}", $value, 3600);
            }
        }
        return $value;
    }
}

if (!function_exists('array_format_key')) {

    /**
     * 二位数组重新组合数据
     * @param $array
     * @param $key
     * @return array
     */
    function array_format_key($array, $key)
    {
        $newArray = [];
        foreach ($array as $vo) {
            $newArray[$vo[$key]] = $vo;
        }
        return $newArray;
    }

}

if (!function_exists('auth')) {

    /**
     * auth权限验证
     * @param $node
     * @return bool
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    function auth($node = null)
    {
        $authService = new AuthService(session('admin.id'));
        $check = $authService->checkNode($node);
        return $check;
    }

}

if (!function_exists('unitArr')) {
    /**
     * 产品单位
     * 
     * @return array
     */
    function unitArr()
    {
        $unitStr = '个,块,只,把,枚,瓶,盒,台,吨,千克,米,箱';
        $unitArr = explode(',',$unitStr);
        return $unitArr;
    }
}

if (!function_exists('checkPhone')) {
    /**
     * 验证手机号
     * 
     * @return bool
     */
    function checkPhone($value)
    {
        $value = trim(str_replace('，',',',$value),',');
        $phoneArr = explode(',',$value);
        $pattern = "/^1[3456789]\d{9}$/";
        $newPhoneArr = array();
        foreach ($phoneArr as $key => $val) {
            if(preg_match($pattern,$val) == 1){
                array_push($newPhoneArr,$val);
            }
        }
        if(count($newPhoneArr) > 0){
            $phone = implode(',',$newPhoneArr);
            return $phone;
        }else{
            return false;
        }
    }
}

if (!function_exists('checkMobile')) {
    function checkMobile($value){
        $value = trim(str_replace('，',',',$value),',');
        $mobileArr = explode(',',$value);
        $pattern = "/^0[0-9]{2,4}[-][3-9]{1}[0-9]{6,7}$/";
        $newMobileArr = array();
        foreach ($mobileArr as $key => $val) {
            if(preg_match($pattern,$val) == 1){
                array_push($newMobileArr,$val);
            }
        }
        if(count($newMobileArr) > 0){
            $mobile = implode(',',$newMobileArr);
            return $mobile;
        }else{
            return false;
        }
    }
}
