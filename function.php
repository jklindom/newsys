<?php
//  ------------------------------------------------------------------------ //
// 本模組由 Derek 製作
// 製作日期：2012-04-06
// $Id:$
// ------------------------------------------------------------------------- //
//引入TadTools的函式庫
if(!file_exists(TADTOOLS_PATH."/tad_function.php")){
 redirect_header("index.php",3, _TAD_NEED_TADTOOLS);
}
include_once TADTOOLS_PATH."/tad_function.php";

/********************* 自訂函數 *********************/
$chinese=array("undergraduate"=>_MA_OSASCHOLA_SCH_DEPART1,"graduate"=>_MA_OSASCHOLA_SCH_DEPART2,"both"=>_MA_OSASCHOLA_SCH_DEPART3,"school"=>_MA_OSASCHOLA_APPLY_WAY1,"self"=>_MA_OSASCHOLA_APPLY_WAY2);


/********************* 預設函數 *********************/
//圓角文字框
function div_3d($title="",$main="",$kind="raised",$style="",$other=""){
	$main="<table style='width:auto;{$style}'><tr><td>
	<div class='{$kind}'>
	<h1>$title</h1>
	$other
	<b class='b1'></b><b class='b2'></b><b class='b3'></b><b class='b4'></b>
	<div class='boxcontent'>
 	$main
	</div>
	<b class='b4b'></b><b class='b3b'></b><b class='b2b'></b><b class='b1b'></b>
	</div>
	</td></tr></table>";
	return $main;
}
?>