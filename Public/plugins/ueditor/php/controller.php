<?php
//header('Access-Control-Allow-Origin: http://*.baidu.com'); //设置http://*.baidu.com允许跨域访问
date_default_timezone_set("Asia/Shanghai");
error_reporting(E_ERROR);
header("Content-Type: text/html; charset=utf-8");
$CONFIG = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents("config.json")), true);
$action = $_GET['action'];
foreach($CONFIG as $key => $val) {
    if(strpos($key, 'UrlPrefix')) {
        $CONFIG[$key] = str_replace($_SERVER['SCRIPT_URL'], "", $_SERVER['SCRIPT_URI']);
		if(!$CONFIG[$key]) {
			$CONFIG[$key] = "//" . $_SERVER['HTTP_HOST'];
		}
    }
}
switch ($action) {
    case 'config':
        $result =  json_encode($CONFIG);
        break;

    /* 上传图片 */
    case 'uploadimage':
    /* 上传涂鸦 */
    case 'uploadscrawl':
    /* 上传视频 */
    case 'uploadvideo':
    /* 上传文件 */
    case 'uploadfile':
        $result = include("action_upload.php");
        break;

    /* 列出图片 */
    case 'listimage':
        $result = include("action_list.php");
        break;
    /* 列出文件 */
    case 'listfile':
        $result = include("action_list.php");
        break;

    /* 抓取远程文件 */
    case 'catchimage':
        $result = include("action_crawler.php");
        break;

    default:
        $result = json_encode(array(
            'state'=> '请求地址出错'
        ));
        break;
}

/* 输出结果 */
if (isset($_GET["callback"])) {
    echo $_GET["callback"] . '(' . $result . ')';
} else {
    echo $result;
}