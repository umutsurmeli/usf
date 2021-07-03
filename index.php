<?php
header('Content-Type: text/html; charset=utf-8');
header('X-Powered-By: USurmeli 1.0');//Google snifferdan php versiyonunu gizleyelim. 
header('X-XSS-Protection:1'); // 1: Chrome ve opera javascript otomatik postlarda sıkıntı çıkarıyor.
define('APPPATH','app/');
define('SYSTEMPATH','system/');
define('VIEWPATH',APPPATH.'view/');
define('DOMAIN',$_SERVER['HTTP_HOST']);

define('PROTOCOL',$_SERVER['REQUEST_SCHEME'].'://');

define('DEFAULT_CONTROLLER','yapimasamasinda');
define('US_VERSION','20210703');

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);//E_ALL);

if(DOMAIN=='localhost'||DOMAIN==''||$_SERVER['REQUEST_SCHEME']=='http') {
    session_set_cookie_params(86400, '/','.'.DOMAIN, false,false); //httponly = false javascript için önemli
}
else {
    session_set_cookie_params(86400, '/','.'.DOMAIN, true,true); //httponly = false javascript için önemli
}

session_start();
include(SYSTEMPATH.'starter.php');



