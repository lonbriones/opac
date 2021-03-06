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

require_once(INCDIR.'MarcTags.class.php');
require_once(INCDIR.'marc_parser.php');

$arr_selecthost = Language::getHosts();

$hostname = $arr_selecthost[0][1];
$curhost = $arr_selecthost[0][0];
if (isset($_REQUEST['hostname']) && $_REQUEST['hostname'] != '')
	$hostname = $_REQUEST['hostname'];
if (isset($_REQUEST['curhost']) && $_REQUEST['curhost'] != '')
	$curhost = $_REQUEST['curhost'];

if (isset($_REQUEST['checkall']) && count($_REQUEST['checkall'])){
	$items = $_REQUEST['checkall'];
	for ($i=0;$i <count($items);$i++) {
		$id = $items[$i];
		unset($_SESSION[$hostname][$id]);
	}
}
if (isset($_REQUEST['deleteall']) && $_REQUEST['deleteall'] == 1) {
	unset($_SESSION[$hostname]);
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
$html = '<center>'.$selecthost.'</center>';
$html .= '<center style="background-color:#F7FCE0" >';
$html .= '<table><tr><td><input type="button" value="Delete" onclick="deleteselected()"></td><td><input type="button" value="Delete ALL items" onclick="deleteall()"></td><td><img src="" width="60" height=1></td><td><img src="themes/blue/images/printicon.gif"></td><td><input type="button" Value="Print this page" onclick="printpage(\''.$curhost.'\',\''.$hostname.'\')"></td><td>&nbsp;</td><td><b>Send to email address</b>: <input type="text" name="email" id="email"><input type="button" Value="Send" onclick="emailpage(\''.$curhost.'\',\''.$hostname.'\')"></td></tr></table>';
$html .= '';
$html .= '</center>';

$html .= '<form action="" action="index.php?m=search&s=saved" name="ListViewForm" id="ListViewForm"><div id="printarea"><br><h2 align="center">'.$hostname.'</h2><br>';
$html .= '<input type="hidden" name="m" value="search">';
$html .= '<input type="hidden" name="s" value="saved">';
$html .= '<input type="hidden" name="curhost" value="'.$curhost.'">';
$html .= '<input type="hidden" name="hostname" value="'.$hostname.'">';
$html .= '<div id="listviewtab"><table border=0 width="100%" cellpadding=1 cellspacing=1 align=center>';
$html .= '<tr bgcolor=white>';
$html .= '<td class="sr_header">';
$html .= '<input type="checkbox" name="checkall" id="checkall" onclick="javascript:selectall()"/>';
$html .= '</td>';

foreach ($fields as $k => $v) {
	$html .= '<td class="sr_header" ><strong>';	
	$html .= $lang[$v];
	$html .= '</strong></td>';
}
$html .= '</tr>';

foreach ($marc as $ident => $value){
	$html .= '<tr bgcolor=white>';
	
	$html .= '<td><input type="checkbox" name="checkall[]" id="checkitem" value="'.$ident.'" onclick="javascript:checkthis()"/></td>';
	for ($i=0;$i<count($fields);$i++) {
		$fieldname = $fields[$i];
		$html .= '<td class="sr_row">'.parse($fieldname,$value).'</td>';
	}
	$html .= '</tr>';
}
$html .= '</table></div>';
$html .= '</form></div></form>';

$smarty->assign('saved',$html);
$content = THEMESDIR.THEME.'saved.html';

unset($yazconn);
?>