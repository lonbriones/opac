<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: Saved.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $
require_once('config.php');
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<title>Webopac Print Page</title>
<style type="text/css">
<!--
@import url("themes/advisen/style.css");
-->
</style>
<script type="text/JavaScript">
<!--
function printarea(){	
	//opener_area = opener.document.getElementById('printarea');
	//this_area = document.getElementById('printarea');
	//this_area.innerHTML = opener_area.innerHTML;
	print();	
}
onblur = function () {
	window.close();
}


//-->
</script>
</head>

<body onload="printarea();">
<?php
require_once(INCDIR.'MarcTags.class.php');
require_once(INCDIR.'marc_parser.php');
require_once(INCDIR.'marc_parser.php');
require_once(LANGDIR.'/'.LANG.'.php');
$arr_selecthost = Language::getHosts();
$hostname = $arr_selecthost[0][1];
$curhost = $arr_selecthost[0][0];
if (isset($_REQUEST['hostname']) && $_REQUEST['hostname'] != '')
	$hostname = $_REQUEST['hostname'];
if (isset($_REQUEST['curhost']) && $_REQUEST['curhost'] != '')
	$curhost = $_REQUEST['curhost'];
if (isset($_REQUEST['curhost']) && $_REQUEST['curhost'] != '')
	$ids = explode(',',$_REQUEST['ids']);
if (isset($_REQUEST['checkall']) && count($_REQUEST['checkall'])){
	$items = $_REQUEST['checkall'];
	for ($i=0;$i <count($items);$i++) {
		$id = $items[$i];
		unset($_SESSION[$hostname][$id]);
	}
}

$marc = $_SESSION[$hostname];

if ($curhost == 0) {
	$fields = array ('callno','title','author','publisher','year');
} elseif ($curhost == 1){
	$fields = array ('journal_title','title','author','journal_issue');
}
$lang = array('callno'=>'Call No.','title'=>'Title','author'=>'Author','publisher'=>'Publisher','year'=>'Year','journal_title'=>'Journal Title','journal_issue'=>'Issue');


$selecthost = '<b>Saved items from: </b><select id="selecthost" onChange="javascript:selecthost()">';
for ($i=0;$i<2;$i++) {
	$selected = '';
	if ($i == $curhost)
		$selected = 'selected';
	$selecthost .= '<option value="'.$i.'_'.$arr_selecthost[$i][1].'" '.$selected.'>'.$arr_selecthost[$i][1].'</option>';
}
$selecthost .= '</select> <b>database</b>';

$html .= '<div id="printarea"><br><h2 align="center">'.$hostname.'</h2><br>';
$html .= '<div id="listviewtab"><table border=0 width="100%" cellpadding=1 cellspacing=1 align=center>';
$html .= '<tr bgcolor=white>';

foreach ($fields as $k => $v) {
	$html .= '<td class="sr_header" ><strong>';	
	$html .= $lang[$v];
	$html .= '</strong></td>';
}
$html .= '</tr>';

foreach ($marc as $ident => $value){
	if (in_array($ident,$ids)){
	$html .= '<tr bgcolor=white>';
	
	for ($i=0;$i<count($fields);$i++) {
		$fieldname = $fields[$i];
		$html .= '<td class="sr_row">'.parse($fieldname,$value).'</td>';
	}
	
	$html .= '</tr>';
	}
}
$html .= '</table></div>';
$html .= '</form></div></form>';

print $html;

unset($yazconn);
?>
</body>
</html>