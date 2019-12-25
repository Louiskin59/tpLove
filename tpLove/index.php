<?php

$domain = 'ymm324.club';

//$module_arr =  [
//    'www' => 'Home'//主站
//];
// 域名
define('DOMAIN', $domain);

// ICP备案号
define('ICP_NO', '<a href="http://beian.miit.gov.cn" target="_blank">皖ICP备19017850号-1</a>');

// 电信增值许可证
//define('ICP_LICENSE', '电信增值业务许可证:苏B2-20160570');

// 引入公共入口文件
require dirname(dirname(__FILE__)).'/src/index.php';