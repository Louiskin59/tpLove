<?php
/**
 * Created by PhpStorm.
 * User: jinjinying
 * Date: 2019/12/25
 * Time: 15:56
 */
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 定义环境常量，用于判断是否为相应环境
// 开发环境常量
define('ENV_DEV', 'd');
// 测试环境常量
define('ENV_ALPHA', 'a');
// 预生产环境常量
define('ENV_BETA', 'b');
// 生产环境常量
define('ENV_RC', 'rc');
// SVN环境常量
define('ENV_SVN', 'svn');
// 如果存在env.php文件，则引入该文件，一般会在该文件中定义ENV_VAR、APP_DEBUG、ALIYUN_ECS、SERVER_NO
if(file_exists(dirname(__FILE__).'/env.php'))
{
    require dirname(__FILE__).'/env.php';
}
// 如果env.php文件不存在，或该文件并未定义ENV_VAR，则定义为ENV_DEV
if(!defined('ENV_VAR'))
{
    define('ENV_VAR', ENV_DEV);
}

// 定义判断环境的常量
define('IS_DEV', ENV_VAR == ENV_DEV);
define('IS_ALPHA', ENV_VAR == ENV_ALPHA);
define('IS_BETA', ENV_VAR == ENV_BETA);
define('IS_RC', ENV_VAR == ENV_RC);
define('IS_SVN', ENV_VAR == ENV_SVN);

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
if(!defined('APP_DEBUG'))
{
    define('APP_DEBUG', true);
}

// 开启阿里云ECS模式
if(!defined('ALIYUN_ECS'))
{
    define('ALIYUN_ECS', false);
}

// 是否为测试服务器，该变量已无实际意义，后续可以移除
define('DEBUG_ECS', false);

//要生成Lite文件
// define('BUILD_LITE_FILE',true);

// 版权所有
define('COPY_RIGHT', 'Copyright © 2008-'.date('Y').' 南京听说科技有限公司 All Rights Reserved');

// 服务器标识
// 如果未定义SERVER_NO，则定义为1
if(!defined('SERVER_NO'))
{
    define('SERVER_NO', 1);
}