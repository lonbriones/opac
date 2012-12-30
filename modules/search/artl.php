<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: artl.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


$smarty->assign('base',$_REQUEST['s']);
$hidden = "
<input type=\"hidden\" name=\"m\" value=\"$menu_sel\">
<input type=\"hidden\" name=\"s\" value=\"artl\">
<input type=\"hidden\" name=\"host[]\" value=\"1\">
";

$smarty->assign('hidden',$hidden);
$smarty->assign('img_title','search_local.gif');

$search = (isset($_REQUEST['search'])) ? true : false;

$wordopt = '
Word Option:
<input name="word_opt" type="radio" value="Any_Order" checked="checked"/>
Any order 
<input name="word_opt" type="radio" value="Left_anchor"  />
Left Anchor
';

$smarty->assign('wordopt',$wordopt);

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

	require(MODDIR.'search/artl_listview.php');
	
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
	
	$smarty->assign('boolean0',generateBoolean('boolean[0]','',''));
	$smarty->assign('boolean1',generateBoolean('boolean[1]','',''));
	
	
	$smarty->assign('hidden',$hidden);
    
	if ($act && $id) {
	    require(MODDIR.'search/detailview.php');
	} else {
		if (isset($_REQUEST['mode']) &&  $_REQUEST['mode'] == 'advanced') {
			$smarty->assign('searchmode','form.AdvancedSearch.html');
		} else {
		   $smarty->assign('searchmode','form.BasicSearch.html');
		}
		$smarty->assign('searchtitle','Search Article');
		
		$content = THEMESDIR.THEME.'local.html';	
	}
}
unset($search);
unset($isTerm);
?>