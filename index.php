<?php
//  ------------------------------------------------------------------------ //
// 本模組由 Derek 製作
// 製作日期：2012-04-06
// $Id:$
// ------------------------------------------------------------------------- //
/*-----------引入檔案區--------------*/
include_once "header.php";
$xoopsOption['template_main'] = "osa_scholarship_index_tpl.html";
/*-----------function區--------------*/

//osa_scholarship編輯表單
function osa_scholarship_form($sn=""){
	global $xoopsDB,$xoopsUser;
	if(empty($xoopsUser))redirect_header("index.php",3, _MA_OSASCHOLA_NO_POST_POWER);
	//include_once(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
	//include_once(XOOPS_ROOT_PATH."/class/xoopseditor/xoopseditor.php");

	//抓取預設值
	if(!empty($sn)){
		$DBV=get_osa_scholarship($sn);
	}else{
		$DBV=array();
	}

	//預設值設定
	
	
	//設定「sn」欄位預設值
	$sn=(!isset($DBV['sn']))?"":$DBV['sn'];
	
	//設定「sch_name」欄位預設值
	$sch_name=(!isset($DBV['sch_name']))?"":$DBV['sch_name'];
	
	//設定「sch_link」欄位預設值
	$sch_link=(!isset($DBV['sch_link']))?"":$DBV['sch_link'];
	
	//設定「sch_depart」欄位預設值
	$sch_depart=(!isset($DBV['sch_depart']))?"":$DBV['sch_depart'];
	
	//設定「sch_require」欄位預設值
	$sch_require=(!isset($DBV['sch_require']))?"":$DBV['sch_require'];
	
	//設定「apply_date」欄位預設值
	$apply_date=(!isset($DBV['apply_date']))?"":$DBV['apply_date'];
	
	//設定「apply_form1」欄位預設值
	$apply_form1=(!isset($DBV['apply_form1']))?"":$DBV['apply_form1'];
	
	//設定「apply_link1」欄位預設值
	$apply_link1=(!isset($DBV['apply_link1']))?"":$DBV['apply_link1'];
	
	//設定「apply_form2」欄位預設值
	$apply_form2=(!isset($DBV['apply_form2']))?"":$DBV['apply_form2'];
	
	//設定「apply_link2」欄位預設值
	$apply_link2=(!isset($DBV['apply_link2']))?"":$DBV['apply_link2'];
	
	//設定「apply_form3」欄位預設值
	$apply_form3=(!isset($DBV['apply_form3']))?"":$DBV['apply_form3'];
	
	//設定「apply_link3」欄位預設值
	$apply_link3=(!isset($DBV['apply_link3']))?"":$DBV['apply_link3'];
	
	//設定「apply_way」欄位預設值
	$apply_way=(!isset($DBV['apply_way']))?"":$DBV['apply_way'];
	
	//設定「post_date」欄位預設值
	$post_date=(!isset($DBV['post_date']))?date("Y-m-d"):$DBV['post_date'];
	
	//設定「enable」欄位預設值
	$enable=(!isset($DBV['enable']))?"1":$DBV['enable'];

	$op=(empty($sn))?"insert_osa_scholarship":"update_osa_scholarship";
	//$op="replace_osa_scholarship";
	
	if(!file_exists(TADTOOLS_PATH."/formValidator.php")){
   redirect_header("index.php",3, _MA_NEED_TADTOOLS);
  }
  include_once TADTOOLS_PATH."/formValidator.php";
  $formValidator= new formValidator("#myForm",true);
  $formValidator_code=$formValidator->render();
	
	$main="
	$formValidator_code
	
	<script type='text/javascript' src='".TADTOOLS_URL."/My97DatePicker/WdatePicker.js'></script>
	<form action='{$_SERVER['PHP_SELF']}' method='post' id='myForm' enctype='multipart/form-data'>
	<table class='form_tbl'>
  

	<!--序號-->
	<input type='hidden' name='sn' value='{$sn}'>

	<!--獎學金名稱-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_SCH_NAME."</td>
	<td class='col'><input type='text' name='sch_name' size='40' value='{$sch_name}' id='sch_name'  class='validate[required]'></td></tr>

	<!--辦法連結-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_SCH_LINK."</td>
	<td class='col'><input type='text' name='sch_link' size='60' value='{$sch_link}' id='sch_link' ></td></tr>

	<!--獎助學門-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_SCH_DEPART."</td>
	<td class='col'>
	<input type='radio' name='sch_depart' id='sch_depart' value='undergraduate'  ".chk($sch_depart,'undergraduate').">"._MA_OSASCHOLA_SCH_DEPART1."
	<input type='radio' name='sch_depart' id='sch_depart' value='graduate'  ".chk($sch_depart,'graduate').">"._MA_OSASCHOLA_SCH_DEPART2."
	<input type='radio' name='sch_depart' id='sch_depart' value='both'  ".chk($sch_depart,'both').">"._MA_OSASCHOLA_SCH_DEPART3."</td></tr>";
	if(!file_exists(XOOPS_ROOT_PATH."/modules/tadtools/fck.php")){
		redirect_header("index.php",3, _MA_NEED_TADTOOLS);
	}
	include_once XOOPS_ROOT_PATH."/modules/tadtools/fck.php";
	$fck=new FCKEditor264("osa_scholarship","sch_require",$sch_require);
	$fck->setWidth(620);
	$fck->setHeight(300);
	$sch_require_editor=$fck->render();

	$main.="
	<!--獎助對象與條件-->
	<tr>
	<td class='col' colspan='2'><div>"._MA_OSASCHOLA_SCH_REQUIRE."</div>$sch_require_editor</td></tr>

	<!--申請日期-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_APPLY_DATE."</td>
	<td class='col'><input type='text' name='apply_date' size='20' value='{$apply_date}' id='apply_date' class='validate[required]'  onClick=\"WdatePicker({dateFmt:'yyyy-MM-dd' , startDate:'%y-%M-%d}'})\"></td></tr>

	<!--申請表1-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_APPLY_FORM1."</td>
	<td class='col'><input type='text' name='apply_form1' size='20' value='{$apply_form1}' id='apply_form1' ></td></tr>

	<!--申請表1連結-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_APPLY_LINK1."</td>
	<td class='col'><input type='text' name='apply_link1' size='60' value='{$apply_link1}' id='apply_link1' ></td></tr>

	<!--申請表2-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_APPLY_FORM2."</td>
	<td class='col'><input type='text' name='apply_form2' size='20' value='{$apply_form2}' id='apply_form2' ></td></tr>

	<!--申請表2連結-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_APPLY_LINK2."</td>
	<td class='col'><input type='text' name='apply_link2' size='60' value='{$apply_link2}' id='apply_link2' ></td></tr>

	<!--申請表3-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_APPLY_FORM3."</td>
	<td class='col'><input type='text' name='apply_form3' size='20' value='{$apply_form3}' id='apply_form3' ></td></tr>

	<!--申請表3連結-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_APPLY_LINK3."</td>
	<td class='col'><input type='text' name='apply_link3' size='60' value='{$apply_link3}' id='apply_link3' ></td></tr>

	<!--申請方式-->
	<tr><td class='title' nowrap>"._MA_OSASCHOLA_APPLY_WAY."</td>
	<td class='col'>
	<input type='radio' name='apply_way' id='apply_way' value='school'  ".chk($apply_way,'school')." class='validate[required]' ".chk($apply_way,'school').">"._MA_OSASCHOLA_APPLY_WAY1."
	<input type='radio' name='apply_way' id='apply_way' value='self'  ".chk($apply_way,'self')." class='validate[required]' ".chk($apply_way,'self').">"._MA_OSASCHOLA_APPLY_WAY2."</td></tr>

	<!--使否啟用-->
	<input type='hidden' name='enable' value='{$enable}'>
	<tr><td class='bar' colspan='2'>
	<input type='hidden' name='op' value='{$op}'>
	<input type='submit' value='"._MA_SAVE."'></td></tr>
	</table>
	</form>";

	//raised,corners,inset
	$main=div_3d(_MA_OSA_SCHOLARSHIP_FORM,$main,"raised");
  
	return $main;
}



//新增資料到osa_scholarship中
function insert_osa_scholarship(){
	global $xoopsDB,$xoopsUser;
	

	$myts =& MyTextSanitizer::getInstance();
	$_POST['sch_name']=$myts->addSlashes($_POST['sch_name']);
	$_POST['sch_link']=$myts->addSlashes($_POST['sch_link']);
	$_POST['sch_require']=$myts->addSlashes($_POST['sch_require']);
	$_POST['apply_form1']=$myts->addSlashes($_POST['apply_form1']);
	$_POST['apply_link1']=$myts->addSlashes($_POST['apply_link1']);
	$_POST['apply_form2']=$myts->addSlashes($_POST['apply_form2']);
	$_POST['apply_link2']=$myts->addSlashes($_POST['apply_link2']);
	$_POST['apply_form3']=$myts->addSlashes($_POST['apply_form3']);
	$_POST['apply_link3']=$myts->addSlashes($_POST['apply_link3']);

  
	$sql = "insert into ".$xoopsDB->prefix("osa_scholarship")."
	(`sch_name` , `sch_link` , `sch_depart` , `sch_require` , `apply_date` , `apply_form1` , `apply_link1` , `apply_form2` , `apply_link2` , `apply_form3` , `apply_link3` , `apply_way` , `post_date` , `enable`)
	values('{$_POST['sch_name']}' , '{$_POST['sch_link']}' , '{$_POST['sch_depart']}' , '{$_POST['sch_require']}' , '{$_POST['apply_date']}' , '{$_POST['apply_form1']}' , '{$_POST['apply_link1']}' , '{$_POST['apply_form2']}' , '{$_POST['apply_link2']}' , '{$_POST['apply_form3']}' , '{$_POST['apply_link3']}' , '{$_POST['apply_way']}' , now() , '{$_POST['enable']}')";
	$xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	
	//取得最後新增資料的流水編號
	$sn=$xoopsDB->getInsertId();
	return $sn;
}

//更新osa_scholarship某一筆資料
function update_osa_scholarship($sn=""){
	global $xoopsDB,$xoopsUser;
	

	$myts =& MyTextSanitizer::getInstance();
	$_POST['sch_name']=$myts->addSlashes($_POST['sch_name']);
	$_POST['sch_link']=$myts->addSlashes($_POST['sch_link']);
	$_POST['sch_require']=$myts->addSlashes($_POST['sch_require']);
	$_POST['apply_form1']=$myts->addSlashes($_POST['apply_form1']);
	$_POST['apply_link1']=$myts->addSlashes($_POST['apply_link1']);
	$_POST['apply_form2']=$myts->addSlashes($_POST['apply_form2']);
	$_POST['apply_link2']=$myts->addSlashes($_POST['apply_link2']);
	$_POST['apply_form3']=$myts->addSlashes($_POST['apply_form3']);
	$_POST['apply_link3']=$myts->addSlashes($_POST['apply_link3']);

  
	$sql = "update ".$xoopsDB->prefix("osa_scholarship")." set 
	 `sch_name` = '{$_POST['sch_name']}' , 
	 `sch_link` = '{$_POST['sch_link']}' , 
	 `sch_depart` = '{$_POST['sch_depart']}' , 
	 `sch_require` = '{$_POST['sch_require']}' , 
	 `apply_date` = '{$_POST['apply_date']}' , 
	 `apply_form1` = '{$_POST['apply_form1']}' , 
	 `apply_link1` = '{$_POST['apply_link1']}' , 
	 `apply_form2` = '{$_POST['apply_form2']}' , 
	 `apply_link2` = '{$_POST['apply_link2']}' , 
	 `apply_form3` = '{$_POST['apply_form3']}' , 
	 `apply_link3` = '{$_POST['apply_link3']}' , 
	 `apply_way` = '{$_POST['apply_way']}' , 
	 `post_date` = now() , 
	 `enable` = '{$_POST['enable']}'
	where sn='$sn'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	return $sn;
}

//列出所有osa_scholarship資料
function list_osa_scholarship1($show_function=1){
	global $xoopsDB,$xoopsModule,$chinese,$isAdmin;
	$today=date("Y-m-d",xoops_getUserTimestamp(time()));
	$sql = "select * from ".$xoopsDB->prefix("osa_scholarship")." where apply_way='school' and apply_date >= '{$today}'";

/*	//getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
  $PageBar=getPageBar($sql,20,10);
  $bar=$PageBar['bar'];
  $sql=$PageBar['sql'];
  $total=$PageBar['total'];
*/
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	
	$show_function=$isAdmin;
	$function_title=($show_function)?"<th width='10%'>"._BP_FUNCTION."</th>":"";
	$add_data=($show_function)?"<a href='{$_SERVER['PHP_SELF']}?op=osa_scholarship_form'  class='link_button_r'>"._BP_ADD."</a>":"";
	
	$all_content="";
	
	while($all=$xoopsDB->fetchArray($result)){
	  //以下會產生這些變數： $sn , $sch_name , $sch_link , $sch_depart , $sch_require , $apply_date , $apply_form1 , $apply_link1 , $apply_form2 , $apply_link2 , $apply_form3 , $apply_link3 , $apply_way , $post_date , $enable
    foreach($all as $k=>$v){
      $$k=$v;
    }
    
		$fun=($show_function)?"
		<td>
		<a href='{$_SERVER['PHP_SELF']}?op=osa_scholarship_form&sn=$sn' class='link_button'>"._BP_EDIT."</a>
		<a href=\"javascript:delete_osa_scholarship_func($sn);\" class='link_button'>"._BP_DEL."</a>
		</td>":"";
		$where_form1=(!empty($apply_form1))?"<a href='{$apply_link1}' class=''>{$apply_form1}</a>":"";
		$where_form2=(!empty($apply_form2))?"</br><a href='{$apply_link2}' class=''>{$apply_form2}</a>":"";
		$where_form3=(!empty($apply_form3))?"</br><a href='{$apply_link3}' class=''>{$apply_form3}</a>":"";
		//$date = explode("-", $apply_date);//切割日期
		
		$all_content.="<tr>
		<td><a href='{$sch_link}' class=''>{$sch_name}</a></td>
		<td>{$chinese[$sch_depart]}</td>
		<td>{$sch_require}</td>
		<td>{$apply_date}</td>
		<td align='center'>
		$where_form1
		$where_form2
		$where_form3
		</td>
		$fun
		</tr>";
	}

  //if(empty($all_content))return "";
	
	//刪除確認的JS
	$data="
	<script>
	function delete_osa_scholarship_func(sn){
		var sure = window.confirm('"._BP_DEL_CHK."');
		if (!sure)	return;
		location.href=\"{$_SERVER['PHP_SELF']}?op=delete_osa_scholarship&sn=\" + sn;
	}
	</script>

	<table summary='list_table' id='tb1' style='width:100%;' class='display'>
	<thead>
	<tr>
	<th>"._MA_OSASCHOLA_SCH_NAME."</th>
	<th>"._MA_OSASCHOLA_SCH_DEPART."</th>
	<th>"._MA_OSASCHOLA_SCH_REQUIRE."</th>
	<th>"._MA_OSASCHOLA_APPLY_DATE."</th>
	<th>"._MA_OSASCHOLA_APPLY_FORM1."</th>
	$function_title</tr>
	</thead>
	<tbody>
	$all_content
	</tbody>
    <tfoot>
    <tr>
	<th width='20%'>"._MA_OSASCHOLA_SCH_NAME."</th>
	<th width='16%'>"._MA_OSASCHOLA_SCH_DEPART."</th>
	<th width='25%'>"._MA_OSASCHOLA_SCH_REQUIRE."</th>
	<th width='15%'>"._MA_OSASCHOLA_APPLY_DATE."</th>
	<th width='14%'>"._MA_OSASCHOLA_APPLY_FORM1."</th>
    $function_title</tr>
    </tfoot>
	</table>";
	
	//raised,corners,inset
	//$main=div_3d("",$data,"corners");
	
	return $data;
}

//列出所有osa_scholarship資料
function list_osa_scholarship2($show_function=1){
	global $xoopsDB,$xoopsModule,$chinese,$isAdmin;
	$today=date("Y-m-d",xoops_getUserTimestamp(time()));
	$sql = "select * from ".$xoopsDB->prefix("osa_scholarship")." where apply_way='self' and apply_date >= '{$today}'";

/*	//getPageBar($原sql語法, 每頁顯示幾筆資料, 最多顯示幾個頁數選項);
  $PageBar=getPageBar($sql,20,10);
  $bar=$PageBar['bar'];
  $sql=$PageBar['sql'];
  $total=$PageBar['total'];
*/
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	
	$show_function=$isAdmin;
	$function_title=($show_function)?"<th width='10%'>"._BP_FUNCTION."</th>":"";
	//$add_data=($show_function)?"<a href='{$_SERVER['PHP_SELF']}?op=osa_scholarship_form'  class='link_button_r'>"._BP_ADD."</a>":"";
	
	$all_content="";
	
	while($all=$xoopsDB->fetchArray($result)){
	  //以下會產生這些變數： $sn , $sch_name , $sch_link , $sch_depart , $sch_require , $apply_date , $apply_form1 , $apply_link1 , $apply_form2 , $apply_link2 , $apply_form3 , $apply_link3 , $apply_way , $post_date , $enable
    foreach($all as $k=>$v){
      $$k=$v;
    }
    
		$fun=($show_function)?"
		<td>
		<a href='{$_SERVER['PHP_SELF']}?op=osa_scholarship_form&sn=$sn' class='link_button'>"._BP_EDIT."</a>
		<a href=\"javascript:delete_osa_scholarship_func($sn);\" class='link_button'>"._BP_DEL."</a>
		</td>":"";
		$where_form1=(!empty($apply_form1))?"<a href='{$apply_link1}' class=''>{$apply_form1}</a>":"";
		$where_form2=(!empty($apply_form2))?"</br><a href='{$apply_link2}' class=''>{$apply_form2}</a>":"";
		$where_form3=(!empty($apply_form3))?"</br><a href='{$apply_link3}' class=''>{$apply_form3}</a>":"";
		//$date = explode("-", $apply_date);//切割日期
		
		$all_content.="<tr>
		<td><a href='{$sch_link}' class=''>{$sch_name}</a></td>
		<td>{$chinese[$sch_depart]}</td>
		<td>{$sch_require}</td>
		<td>{$apply_date}</td>
		<td align='center'>
		$where_form1
		$where_form2
		$where_form3
		</td>
		$fun
		</tr>";
	}

  //if(empty($all_content))return "";
	
	//刪除確認的JS
	$data="
	<script>
	function delete_osa_scholarship_func(sn){
		var sure = window.confirm('"._BP_DEL_CHK."');
		if (!sure)	return;
		location.href=\"{$_SERVER['PHP_SELF']}?op=delete_osa_scholarship&sn=\" + sn;
	}
	</script>

	<table summary='list_table' id='tb2' style='width:100%;' class='display'>
	<thead>
	<tr>
	<th>"._MA_OSASCHOLA_SCH_NAME."</th>
	<th>"._MA_OSASCHOLA_SCH_DEPART."</th>
	<th>"._MA_OSASCHOLA_SCH_REQUIRE."</th>
	<th>"._MA_OSASCHOLA_APPLY_DATE."</th>
	<th>"._MA_OSASCHOLA_APPLY_FORM1."</th>
	$function_title</tr>
	</thead>
	<tbody>
	$all_content
	</tbody>
    <tfoot>
    <tr>
	<th width='20%'>"._MA_OSASCHOLA_SCH_NAME."</th>
	<th width='16%'>"._MA_OSASCHOLA_SCH_DEPART."</th>
	<th width='25%'>"._MA_OSASCHOLA_SCH_REQUIRE."</th>
	<th width='15%'>"._MA_OSASCHOLA_APPLY_DATE."</th>
	<th width='14%'>"._MA_OSASCHOLA_APPLY_FORM1."</th>
    $function_title</tr>
    </tfoot>
	</table>";
	
	//raised,corners,inset
	//$main=div_3d("",$data,"corners");
	
	return $data;
}

//列出所有osa_scholarship資料
function list_osa_scholarship($show_function=1){
	global $xoopsDB,$xoopsModule,$chinese,$isAdmin;
	$MDIR=$xoopsModule->getVar('dirname');
	$form1=list_osa_scholarship1();
	$form2=list_osa_scholarship2();
	$data="";
	$data.="
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'></script>
	<script type='text/javascript' src='".XOOPS_URL."/modules/$MDIR/class/tabs.js'></script>
	<link href='".XOOPS_URL."/modules/$MDIR/class/tabs.css' rel='stylesheet' type='text/css' />
	<link href='".XOOPS_URL."/modules/$MDIR/class/demo_table_jui.css' rel='stylesheet' type='text/css' />
	<link href='".XOOPS_URL."/modules/$MDIR/class/jquery-ui-1.8.4.custom.css' rel='stylesheet' type='text/css' />
	<script type='text/javascript' src='".XOOPS_URL."/modules/$MDIR/class/jquery.dataTables.js'></script>
	<script type=\"text/javascript\">
			$(document).ready(function() {
				oTable = $('#tb1,#tb2').dataTable({
					\"bJQueryUI\": true,
					\"sPaginationType\": \"full_numbers\",
					\"aaSorting\": [[ 3, \"asc\" ]]
				});
			} );
	</script>
	";
	$data.="
	<div class='abgne_tab scholarship'>
	<ul class='tabs3'>
      <li><a href='#tab1'><strong>"._MA_OSASCHOLA_TAB_WAY1."</strong></a></li>
      <li><a href='#tab2'><strong>"._MA_OSASCHOLA_TAB_WAY2."</strong></a></li>
    </ul>
    <div class='tab_container3'>
	";
	$data.="<div id='tab1' class='tab_content3'>$form1</div>";
	$data.="<div id='tab2' class='tab_content3'>$form2</div>";
	$data.="</div></div>";
	
	//raised,corners,inset
	//$main=div_3d("",$data,"corners");
	
	return $data;
}

//以流水號取得某筆osa_scholarship資料
function get_osa_scholarship($sn=""){
	global $xoopsDB;
	if(empty($sn))return;
	$sql = "select * from ".$xoopsDB->prefix("osa_scholarship")." where sn='$sn'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	$data=$xoopsDB->fetchArray($result);
	return $data;
}

//刪除osa_scholarship某筆資料資料
function delete_osa_scholarship($sn=""){
	global $xoopsDB;
	$sql = "delete from ".$xoopsDB->prefix("osa_scholarship")." where sn='$sn'";
	$xoopsDB->queryF($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
}

//以流水號秀出某筆osa_scholarship資料內容
function show_one_osa_scholarship($sn=""){
	global $xoopsDB,$xoopsModule,$chinese;
	if(empty($sn)){
		return;
	}else{
		$sn=intval($sn);
	}
	$sql = "select * from ".$xoopsDB->prefix("osa_scholarship")." where sn='{$sn}'";
	$result = $xoopsDB->query($sql) or redirect_header($_SERVER['PHP_SELF'],3, mysql_error());
	$all=$xoopsDB->fetchArray($result);
	
	//以下會產生這些變數： $sn , $sch_name , $sch_link , $sch_depart , $sch_require , $apply_date , $apply_form1 , $apply_link1 , $apply_form2 , $apply_link2 , $apply_form3 , $apply_link3 , $apply_way , $post_date , $enable
	foreach($all as $k=>$v){
		$$k=$v;
	}
  
	$data="
	<table summary='list_table' id='tbl'>
	<tr><th>"._MA_OSASCHOLA_SN."</th><td>{$sn}</td></tr>
	<tr><th>"._MA_OSASCHOLA_SCH_NAME."</th><td>{$sch_name}</td></tr>
	<tr><th>"._MA_OSASCHOLA_SCH_LINK."</th><td>{$sch_link}</td></tr>
	<tr><th>"._MA_OSASCHOLA_SCH_DEPART."</th><td>{$chinese[$sch_depart]}</td></tr>
	<tr><th>"._MA_OSASCHOLA_SCH_REQUIRE."</th><td>{$sch_require}</td></tr>
	<tr><th>"._MA_OSASCHOLA_APPLY_DATE."</th><td>{$apply_date}</td></tr>
	<tr><th>"._MA_OSASCHOLA_APPLY_FORM1."</th><td>{$apply_form1}</td></tr>
	<tr><th>"._MA_OSASCHOLA_APPLY_LINK1."</th><td>{$apply_link1}</td></tr>
	<tr><th>"._MA_OSASCHOLA_APPLY_FORM2."</th><td>{$apply_form2}</td></tr>
	<tr><th>"._MA_OSASCHOLA_APPLY_LINK2."</th><td>{$apply_link2}</td></tr>
	<tr><th>"._MA_OSASCHOLA_APPLY_FORM3."</th><td>{$apply_form3}</td></tr>
	<tr><th>"._MA_OSASCHOLA_APPLY_LINK3."</th><td>{$apply_link3}</td></tr>
	<tr><th>"._MA_OSASCHOLA_APPLY_WAY."</th><td>{$chinese[$apply_way]}</td></tr>
	<tr><th>"._MA_OSASCHOLA_POST_DATE."</th><td>{$post_date}</td></tr>
	<tr><th>"._MA_OSASCHOLA_ENABLE."</th><td>{$enable}</td></tr>
	</table>";
	
	//raised,corners,inset
	$main=div_3d("",$data,"corners");
	
	return $main;
}

/*-----------執行動作判斷區----------*/
$op=(empty($_REQUEST['op']))?"":$_REQUEST['op'];
$sn=(empty($_REQUEST['sn']))?"":intval($_REQUEST['sn']);


switch($op){
	
		//替換資料
		case "replace_osa_scholarship":
		replace_osa_scholarship();
		header("location: {$_SERVER['PHP_SELF']}");
		break;
		
		//新增資料
		case "insert_osa_scholarship":
		$sn=insert_osa_scholarship();
		header("location: {$_SERVER['PHP_SELF']}?sn=$sn");
		break;
		
		//更新資料
		case "update_osa_scholarship":
		update_osa_scholarship($sn);
		header("location: {$_SERVER['PHP_SELF']}");
		break;
		//輸入表格
		case "osa_scholarship_form":
		$main=osa_scholarship_form($sn);
		break;
		
		//刪除資料
		case "delete_osa_scholarship":
		delete_osa_scholarship($sn);
		header("location: {$_SERVER['PHP_SELF']}");
		break;
		
		//預設動作
		default:
		if(empty($sn)){
			$main=list_osa_scholarship();
			//$main.=osa_scholarship_form($sn);
		}else{
			$main=show_one_osa_scholarship($sn);
		}
		break;

}

/*-----------秀出結果區--------------*/
module_footer($main);
?>