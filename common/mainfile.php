<?php
define('ADMIN_ID', 'admin');
define('ADMIN_PASSWD', '12345');
define('WEB_THEME', 'emptyspace');
define("XOOPS_DB_PREFIX","x5c5");
define('XOOPS_DB_HOST', 'localhost');
define('XOOPS_DB_USER', 'root');
define('XOOPS_DB_PASS', 'vxusgu');
define('XOOPS_DB_NAME', 'xoops2.3');
define('XOOPS_DB_CHARSET', 'utf8');

$xoopsConfig['language']="tchinese_utf8";
$module_footer="版權所有，侵權必究";
$get_google_api_key="";

/*************** 必要時再修改即可**************/
define("XOOPS_ROOT_PATH",substr(dirname( __FILE__ ),0,-7));
define('XOOPS_URL', "http://{$_SERVER['SERVER_NAME']}/".basename(XOOPS_ROOT_PATH));
define("TADTOOLS_PATH",str_replace(basename(XOOPS_ROOT_PATH),"tadtools",XOOPS_ROOT_PATH));
define("TADTOOLS_URL","http://{$_SERVER['SERVER_NAME']}/tadtools");
?>