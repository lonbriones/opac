<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: local.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


$smarty->assign('base',isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
$smarty->assign('field_label', $LANG['field']);
$smarty->assign('advancedsearch', $LANG['advancedsearch']);
$smarty->assign('search_term', $LANG['search_term']);
$smarty->assign('reset', $LANG['reset']);

$hidden = "
<input type=\"hidden\" name=\"m\" value=\"$menu_sel\">
<input type=\"hidden\" name=\"s\" value=\"local\">
<input type=\"hidden\" name=\"host[]\" value=\"0\">
";


$smarty->assign('hidden',$hidden);
$smarty->assign('img_title','search_local.gif');

$wordopt = $LANG['word_option'].':
<input name="word_opt" type="radio" value="Left_anchor"  />
'.$LANG['left_anchor'].'
<input name="word_opt" type="radio" value="Any_Order" checked="checked"/>
'.$LANG['any_order'];

$smarty->assign('wordopt',$wordopt);
$search = (isset($_REQUEST['search'])) ? true : false;

//chung

$mtype = (isset($_REQUEST['mtype']) && !empty($_REQUEST['mtype'])) ? $_REQUEST['mtype'] : false;
$location = (isset($_REQUEST['location']) && !empty($_REQUEST['location'])) ? $_REQUEST['location'] : false;
$term = (isset($_REQUEST['term']) && !empty($_REQUEST['term'])) ? $_REQUEST['term'] : false;
$field = (isset($_REQUEST['field']) && !empty($_REQUEST['field'])) ? $_REQUEST['field'] : false;
$boolean = (isset($_REQUEST['boolean']) && !empty($_REQUEST['boolean'])) ? $_REQUEST['boolean'] : false;
$act = (isset($_REQUEST['a']) && !empty($_REQUEST['a'])) ? $_REQUEST['a'] : false;
$id = (isset($_REQUEST['id']) && !empty($_REQUEST['id'])) ? $_REQUEST['id'] : false;
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';



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
	require(MODDIR.'search/listview.php');
	
} else {

	if (empty($kw) && $search) {
		$smarty->assign('errormsg', $LANG['please_enter_keyword']);
	}
	
	$fieldNames =$LANG['mono_fields'] ;
	if ($mode == 'advanced') {
	  $smarty->assign('field0',generateFieldOpt($fieldNames,'field[0]','@attr 1=4','input'));
	  $smarty->assign('field1',generateFieldOpt($fieldNames,'field[1]','@attr 1=1003',''));
	  $smarty->assign('field2',generateFieldOpt($fieldNames,'field[2]','@attr 1=21',''));
	} else  
 	  $smarty->assign('field0',generateFieldOpt($fieldNames,'field[0]','','input'));
	/*
	$smarty->assign('field1',generateFieldOpt($fieldNames,'field[1]','',''));
	$smarty->assign('field2',generateFieldOpt($fieldNames,'field[2]','',''));
    */
    $condNames = Language::getSearchBoolean();
	$smarty->assign('boolean0',generateBoolean($condNames,'boolean[0]','',''));
	$smarty->assign('boolean1',generateBoolean($condNames,'boolean[1]','',''));

//chung
    $condNames = Language::getSearchCond();
	$smarty->assign('mtype','Material Type '.generateBoolean($condNames,'mtype[0]','',''));


//Location filter


	require_once(INCDIR.'ez_sql_firebird.php');
    global $db;

	if ( $loc = $db->get_results('SELECT * FROM LOCATION'))
    {
  	   $s='<select name="Location"><option value="All">Any</option>';
  
       foreach ( $loc as $loc )
		{
          //print_r ($loc);
		  $c='ll'.$loc['CODE'];
		  $d=$loc['DESCRIP'];
		  $s .= '<option value="'.$c.'">'.$d.'</option>';
		}
	   $smarty->assign('location','Location '.$s);
	}

///////////////////


	$smarty->assign('hidden',$hidden);
    
	if ($act && $id) {
		if ($act == 'details') {
			require(MODDIR.'search/detailview.php');
		} else {
			require(MODDIR.'search/detailview_limited_preview.php');
		}
	} else {
		if ($mode == 'advanced') {
			$smarty->assign('searchmode','form.AdvancedSearch.html');
 		    $smarty->assign('searchtitle',$LANG['advancedsearch']);
		} else {
		    $smarty->assign('searchmode','form.BasicSearch.html');
 		    $smarty->assign('searchtitle', $LANG['simplesearch']);
		}
		$content = THEMESDIR.THEME.'local.html';	
	}
}
unset($search);
unset($isTerm);
