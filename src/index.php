<?php
/**
 * Created by PhpStorm.
 * User: jinjinying
 * Date: 2019/11/22
 * Time: 14:07
 */

header("Content-type:text/html;charset=utf-8");

// 引入server.php，与index_cli.php执行相同的代码
require dirname(__FILE__).'/server.php';

// 引入domain.php，与index_cli.php执行相同的代码
require dirname(__FILE__).'/domain.php';
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH', dirname(__FILE__).'/Application/');

// 引入ThinkPHP入口文件
require dirname(__FILE__).'/ThinkPHP/ThinkPHP.php';