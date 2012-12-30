<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: other.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


$smarty->assign('base',isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
$hidden = "
<input type=\"hidden\" name=\"m\" value=\"$menu_sel\">
<input type=\"hidden\" name=\"s\" value=\"other\">
";
$hosts = Language::getHosts();
for ($i=2;$i<count($hosts);$i++) {
    //$hidden .= "<input type=\"hidden\" name=\"host[]\" value=\"$i\">";
}

$smarty->assign('hidden',$hidden);
$smarty->assign('img_title','search_local.gif');

$search = (isset($_REQUEST['search'])) ? true : false;

$term = (isset($_REQUEST['term']) && !empty($_REQUEST['term'])) ? $_REQUEST['term'] : false;
$field = (isset($_REQUEST['field']) && !empty($_REQUEST['field'])) ? $_REQUEST['field'] : false;
$boolean = (isset($_REQUEST['boolean']) && !empty($_REQUEST['boolean'])) ? $_REQUEST['boolean'] : false;
$act = (isset($_REQUEST['a']) && !empty($_REQUEST['a'])) ? $_REQUEST['a'] : false;
$id = (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) ? $_REQUEST['id'] : false;
$isTerm = true;
$j =0;
for($i=0;$i<count($term);$i++) {	
	
    if(!empty($term[$i])) {
		$j++;
	}
}

if ($j < 1) $isTerm = false;

if ($search && $isTerm) {
	$smarty->assign('kw',$term);
	require(MODDIR.'search/other_listview.php');
	
} else {
	if (empty($kw) && $search) {
		$smarty->assign('errormsg','Please enter keyword');
	}
	/*
	$smarty->assign('field0',generateFieldOpt('field[0]','',''));
	$smarty->assign('field1',generateFieldOpt('field[1]','',''));
	$smarty->assign('field2',generateFieldOpt('field[2]','',''));
    */
	$fieldNames = Language::getLocalMonoSearchFields();
	$smarty->assign('field0',generateFieldOpt($fieldNames,'field[0]','','input'));
	$smarty->assign('field1',generateFieldOpt($fieldNames,'field[1]','',''));
	$smarty->assign('field2',generateFieldOpt($fieldNames,'field[2]','',''));
/*
	$smarty->assign('boolean0',generateBoolean('boolean[0]','',''));
	$smarty->assign('boolean1',generateBoolean('boolean[1]','',''));
*/
    $condNames = Language::getSearchBoolean();
	$smarty->assign('boolean0',generateBoolean($condNames,'boolean[0]','',''));
	$smarty->assign('boolean1',generateBoolean($condNames,'boolean[1]','',''));

	$databases = Language::getHosts();
	$dblist = '';
	$select_first = 1;
	for ($i=2;$i<count($databases);$i++) {
		if ($select_first == 1) {
			$selected = 'checked';
		} else {
			$selected = '';
		}
		$dblist .='<input name="host[]" type="radio" value="'.$i.'" '.$selected.' />'.$databases[$i][1]."<br>";
		$select_first++;
	}
	$smarty->assign('databases','Please select a server from the list:<br>'.$dblist);
	$smarty->assign('hidden',$hidden);
    
	if ($act == 'details') {
	    require(MODDIR.'search/other_detailview.php');
	} else {
		if (isset($_REQUEST['mode']) &&  $_REQUEST['mode'] == 'advanced') {
			$smarty->assign('searchmode','form.AdvancedSearch.html');
		} else {
		   $smarty->assign('searchmode','form.BasicSearch.html');
		}
        $smarty->assign('searchtitle','Search Other Resources');
		$content = THEMESDIR.THEME.'local.html';	
	}
}
unset($search);
unset($isTerm);
?>