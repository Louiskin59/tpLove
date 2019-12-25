<?php
/**
 * Created by PhpStorm.
 * User: jinjinying
 * Date: 2019/12/25
 * Time: 15:56
 */
// 阿里云网站主机，经过负载均衡转发的https请求会有HTTP_X_FORWARDED_PROTO头，且值为https
if(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){
    $_SERVER['SERVER_PORT'] = '443';
}

// 判断当前请求是不是https请求
// https
if(isset($_SERVER['SERVER_PORT']) && strpos($_SERVER['SERVER_PORT'], '443') !== false){
    define('IS_HTTPS', true);
    define('PROTOCOL', 'https');
}
// http
else {
    define('IS_HTTPS', false);
    define('PROTOCOL', 'http');
}

// 判断当前端口，只要不是可以省略的443和80端口，主要是用于在本地服务器上访问8080端口
if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != '443' && $_SERVER['SERVER_PORT'] != '80'){
    define('PORT', ':'.$_SERVER['SERVER_PORT']);
}else{
    define('PORT', '');
}

// 网页中显示的版本号
$version = '版本文件不存在';
if(file_exists(dirname(dirname(__FILE__)).'\VERSION')){
    $version = file_get_contents(dirname(dirname(__FILE__)).'\VERSION');
    if(empty($version)){
        $version = '未指定版本';
    }
}
define('__VER__', $version);

// web入口设置了$second_domain变量，CLI入口未设置，此时$second_domain应该等同SUB_DOMAIN
if(!isset($second_domain))
{
    $second_domain = SUB_DOMAIN;
    $domain_fun = function ($sub_domain)
    {
        return $sub_domain.'.'.TOP_DOMAIN;
    };
}
// 网址常量
define('TOP_DOMAIN',		DOMAIN.PORT);							// 子域名后的所有域名内容
define('FULL_DOMAIN',		$second_domain.'.'.TOP_DOMAIN);				// 完整域名
define('__HOST__',			PROTOCOL.'://'.FULL_DOMAIN);						// 当前站点地址
define('__PUBLIC__',		PROTOCOL.'://'.$domain_fun('public'));		// 静态资源
define('__STATIC__',		PROTOCOL.'://static.waiyutong.org');				// 外网静态资源
define('__WWW__',			'http://'.$domain_fun('www'));				// 主站
define('__STUDENT__',		PROTOCOL.'://'.$domain_fun('student'));		// 学生
define('__TEACHER__',		'http://'.$domain_fun('teacher'));			// 教师
define('__SYSTEACHER__',	'http://'.$domain_fun('systeacher'));			// 系统老师
define('__FAMILY__',		'http://'.$domain_fun('jiazhang'));			// 家长
define('__GROUP_LEADER__',	'http://'.$domain_fun('zuzhang'));			// 组长
define('__PRESIDENT__',		'http://'.$domain_fun('xiaozhang'));		// 校长
define('__STORE__',			'http://'.$domain_fun('shangcheng'));		// 商城
define('__RESEARCHER__',	'http://'.$domain_fun('jygl'));				// 教研管理
define('__AGENT__',			'http://'.$domain_fun('dls'));				// 代理商
define('__SALES__',			'http://'.$domain_fun('sales'));			// 销售
define('__ADMIN__',			'http://'.$domain_fun('admin'));			// 管理后台
define('__API__',			'http://'.$domain_fun('api'));				// API接口
define('__DB__',			'http://'.$domain_fun('db'));				// 数据库导入
define('__DEVELOP__',		'http://'.$domain_fun('develop'));			// 开发测试用
define('__DATA__',			PROTOCOL.'://data.waiyutong.org');				// 外网静态资源
define('__FEEDBACK__',	    'http://'.$domain_fun('feedback'));			// 反馈流程
define('__ASR__',			PROTOCOL.'://asr.waiyutong.org');	// 语音识别服务
define('__SCB__',			'http://'.$domain_fun('scb'));				// 生产部

// 跨域处理
if(isset($_SERVER['HTTP_ORIGIN'])){
    $origin = $_SERVER['HTTP_ORIGIN'];
    if(empty($origin)){
        header('HTTP/1.1 403');
        exit();
    }
    $domainPos= stripos($origin , '.waiyutong.org');
    if(empty($domainPos)){
        header('HTTP/1.1 403');
        exit();
    }
    header('Access-Control-Allow-Origin: '.$origin);
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization, Accept,X-Requested-With, Content-Encoding, Request-Origin, Pcm-Data');
    if('OPTIONS' == $_SERVER['REQUEST_METHOD']){
        header('HTTP/1.1 204 No Content');
        exit();
    }
}