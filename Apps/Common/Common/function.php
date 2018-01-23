<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/11/23
 * Time: 13:59
 */

use Think\Log;

function check_verify($code , $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code,$id);
}

/**
 * 打印信息函数
 * @param $val
 */
function printn($val)
{
    echon("<pre>");
    print_r($val);
    echon("</pre>");
    echo "<br>";
}

function echon($val)
{
    echo $val;
    echo "<br>";

}

/**
 * @param $arrayQuery
 * @param bool $urlEncode
 * @return string
 */
function arrToQuery($arrayQuery, $urlEncode = true)
{
    ksort($arrayQuery);
    $tmp = array();
    foreach ($arrayQuery as $k => $param) {
        $tmp[] = $k . '=' . ($urlEncode ? urlencode($param) : $param);
    }
    $params = implode('&', $tmp);
    return $params;
}

function laRequest($data)
{
    Log::write(var_export($data, true), 'INFO', '', C('LOG_PATH') . 'request_' . date('y_m_d') . '.log');
}

/**
 * 获取参数
 * @param $key
 * @return string
 */
function getParams($key)
{
    $result = I('post.'.$key);
    if (isEmpty($result)) {
        $result = I('get.'.$key);
    }
    return $result;
}

/**
 * 是否为空（只能用于判断）
 * @param $key
 * @return bool （true 空， false 非空）
 */
function isEmpty($value)
{
    return !isset($value) || (isset($value) && trim($value) == '');
}

/**
 * 设置session
 */
function setSession($data)
{
    foreach ($data as $key => $value) {
        session($key, $value);
    }
}

/**
 * 计算每个页面数量
 * @param $currentPage
 * @return int
 */
function calculatePage($currentPage)
{
    if (isEmpty($currentPage)) {
        return 0;
    } else {
        return ($currentPage - 1) * C('PAGE_SIZE');
    }
}

/**
 * 列表数据排序
 * @param $menus
 * @return array
 */
function rankList($datas) {
    foreach($datas as $i => $data){
        $items[$data['id']] = $data;
    }
    foreach($items as $item){
        if($item['pid'] > 0){
            $items[$item['pid']]['children'][] = &$items[$item['id']];
        }else{
            $newdatas[] = &$items[$item['id']];
        }
    }
    return  $newdatas;
}

/**
 * 格式化列表
 * @param $parent
 * @param string $spl
 * @return array
 */
function formRankLists($parent,$speed='1') {
    foreach($parent as $i => $row) {
        $newRow = $row;
        isset($newRow['children']) ? $newRow['children']=1 : $newRow['children']=0;
        $newRow['speed'] = $speed;
        $data[] = $newRow;
        if ($row['children']) {
            $data = array_merge($data, formRankLists($row['children'], $speed+1));
        }
    }
    return $data;
}

/**
 * 功能：计算文件大小
 * @param int $bytes
 * @return string 转换后的字符串
 */
function get_byte($bytes)
{
    if (empty($bytes)) {
        return '--';
    }
    $sizetext = array(" B", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    return round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), 2) . $sizetext[$i];
}

/**
 * 生成随机字符串
 * @param string $lenth 长度
 * @return string 字符串
 */
function get_randomstr($lenth = 6)
{
    return get_random($lenth, '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ');
}

/**
 * 产生随机字符串
 *
 * @param    int        $length  输出长度
 * @param    string     $chars   可选的 ，默认为 0123456789
 * @return   string     字符串
 */
function get_random($length, $chars = '0123456789')
{
    $hash = '';
    $max  = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    return $hash;
}

/**
 * 把request参数全部trim一遍
 */
function trimRequest()
{
    $return = trimArr(array_merge($_GET, $_POST));
    unset($return["_URL_"]);
    return $return;
}

function trimArr($arr)
{
    $returnArr = array();
    foreach ($arr as $key => $value) {
        $returnArr[$key] = trim($arr[$key]);
    }
    return $returnArr;
}


/**
 * 获取文档内容页网址--[Home|Mobile]
 * @param integer $id 文档id
 * @param integer $cid 栏目id
 * @param string $ename 栏目英文名称
 * @param boolean $jumpflag 是否跳转
 * @param string $jumpurl 跳转网址
 * @return string
 */
function get_content_url($id, $cid, $ename, $jumpflag = false, $jumpurl = '')
{
    $url = '';
    //如果是跳转，直接就返回跳转网址
    if ($jumpflag && !empty($jumpurl)) {
        return $jumpurl;
    }
    if (empty($id) || empty($cid) || empty($ename)) {
        return $url;
    }

    //修正不能跨模块，判断当前MODULE_NAME
    if (in_array(MODULE_NAME, array('Home', 'Mobile'))) {
        $module = '';
    } else {
        $module = '/'; //'Home/';
    }

    //开启路由
    if (C('URL_ROUTER_ON') == true) {
        $url = $id > 0 ? U($module . '' . $ename . '/' . $id, '') : U('/' . $ename, '', '');
    } else {
        $url = U($module . 'Show/index', array('cid' => $cid, 'id' => $id));
    }

    return $url;
}
