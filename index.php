<?php
//echo 333;exit;
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
//echo 124;exit;
define('ALIPAY_DIR','D:/phpStudy/www/alipay2/');
define('APP_DEBUG',True); // 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_PATH','./App/'); // 定义应用目录
require 'Core/Think.php'; //加载框架

