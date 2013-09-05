<?php
//  ------------------------------------------------------------------------ //
// 本模組由 Derek 製作
// 製作日期：2012-04-06
// $Id:$
// ------------------------------------------------------------------------- //

//---基本設定---//
//模組名稱
$modversion['name'] = _MI_OSASCHOLA_NAME;
//模組版次
$modversion['version']	= '1.0';
//模組作者
$modversion['author'] = _MI_OSASCHOLA_AUTHOR;
//模組說明
$modversion['description'] = _MI_OSASCHOLA_DESC;
//模組授權者
$modversion['credits']	= _MI_OSASCHOLA_CREDITS;
//模組版權
$modversion['license']		= "GPL see LICENSE";
//模組是否為官方發佈1，非官方0
$modversion['official']		= 0;
//模組圖示
$modversion['image']		= "images/logo.png";
//模組目錄名稱
$modversion['dirname']		= "osa_scholarship";

//---啟動後台管理界面選單---//
$modversion['system_menu'] = 1;//---資料表架構---//
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
$modversion['tables'][1] = "osa_scholarship";

//---管理介面設定---//
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/index.php";
$modversion['adminmenu'] = "admin/menu.php";

//---使用者主選單設定---//
$modversion['hasMain'] = 1;


//---樣板設定---//

$modversion['templates'][1]['file'] = 'osa_scholarship_index_tpl.html';
$modversion['templates'][1]['description'] = _MI_OSASCHOLA_TEMPLATE_DESC1;
//---區塊設定---//

?>