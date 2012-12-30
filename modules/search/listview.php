<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: listview.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


$hidden .= "<input type=hidden name=mode value={$_REQUEST['mode']}>";
$hidden .= "<input type=hidden name=mode value={$_REQUEST['mode']}>";
$smarty->assign('hidden',$hidden);
unset($hidden);

require_once(INCDIR.'MarcTags.class.php');
require_once(INCDIR.'YazConnectionManager.class.php');
require_once(INCDIR.'YazQueryBuilder.class.php');
require_once(MODDIR.'search/DataGrid.class.php');
require_once(INCDIR.'marc_parser.php');
require_once (INCDIR.'ez_sql_firebird.php');
require_once(MODDIR.'search/holdings.php');

$yazq = new YazQueryBuilder();
$yazq->term=$term;
$yazq->field=$field;
$yazq->boolean=$boolean;
$wordopt = Language::getWordOpt();
$yazq->aWordOpt = $wordopt[$_REQUEST['word_opt']];

$yazq->aMtypeOpt = $mtype;
$yazq->locationOpt = $_REQUEST['Location'];
$sortdir = (isset($_REQUEST['sortdir']) && $_REQUEST['sortdir'] != '') ? $_REQUEST['sortdir'] : 'ia';
$sort = (isset($_REQUEST['sort']) && $_REQUEST['sort'] != '') ? $_REQUEST['sort'] : '';
$hosts = $_REQUEST['host'];
$default_host = $hosts[0];
$curhost = isset($_REQUEST['curhost']) ? $_REQUEST['curhost'] : $default_host;
$curhost_name = YazConnectionManager::getHostName($curhost);
$query = $yazq->buildQuery();
$yazconn = new YazConnectionManager();

$other_hits = array();

for ($i=0;$i<count($hosts);$i++) {
    $yazconn->connect($hosts[$i],$query);
}
$limit = 10;
$start = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : 1;

$search_result = ($yazconn->getSearchResults($curhost,$start,$limit,false));
$curhost_hits = $yazconn->getHits($curhost);

$nav = getNavigationValues($start, $curhost_hits, $limit);

$rec = '';
require_once(INCDIR.'ez_sql_firebird.php');
function get_isbns($arg) {
	$marc = $arg['marc'];
	$len = count($marc);
	$isbn = array();
	for ($i = 0; $i < $len; $i++) {
		$isbn = parse('isbn', $marc[$i]);
		$isbn = str_replace('-', '', $isbn);
		$isbn = trim($isbn);
		$isbns[] = $isbn;
	}
	return implode(",", $isbns);
}
function get_isbn($arg) {
	$isbn = parse($arg['field'],$arg['marc']);
	
	
	$isbn = str_replace('-', '', $isbn);
	$isbn = trim($isbn);
	
	
	$isbn13 = isbn10_to_13($isbn);
	return $isbn;

}
function get_holdings($id) {
	$holdings = new Holdings($id);
	$dat = $holdings->columnfields;
	print_r($id);
	return $dat;
}

function has_cover($arg) {
	global $db;
	
	$isbn = parse($arg['field'],$arg['marc']);
	
	
	$isbn = str_replace('-', '', $isbn);
	$isbn = trim($isbn);
	
	
	$isbn13 = isbn10_to_13($isbn);
	
	$sql = sprintf("select * from cover where isbn='%s' or isbn='%s'",$isbn,$isbn13);    
	
	
	$cover = $db->get_row($sql);
	
	$has_cover = !empty($cover->LARGEIMG);
	if ($has_cover) {
		print '<div id=isbn-'.$isbn.' class="cover"><img src="cover.php?isbn='.$isbn.'"/></div>';
	} else {
		print '<div id=isbn-'.$isbn.' class="cover"><img src="themes/blue/images/book-no-preview.gif"/></div>';
	}
}

function display_holdings($arg) {
	global $smarty, $curhost;
	
	$id = parse('code',$arg['marc']);

	$preview_link = "/index.php?m=search&a=preview&id=$id&curhost=$curhost&mode=";	
    
	//$smarty->assign('search_url', $_SESSION['search_url']);
	//$smarty->assign('preview_link', $preview_link);
	
	$holdings = new Holdings($id);
	
	$dat = $holdings->columnfields;
	
	$html = '<div class="preview_link" style="display:none">'.$preview_link.'</div>';
	if ($count = count($dat)) {
		$html .= "<table>";
		$html .= "<tr>";
		$html .= "<th>Accession</th><th>Location</th><th>Availability</th>";
		$html .= "</tr>";
		
		for ($i = 0; $i < 1; $i++) {			
			$html .= "<tr><td>{$dat[$i]['ACCESSNO']}</td><td>{$dat[$i]['LOCATION']}</td><td class='status{$dat[$i]['RENTID']}'>{$dat[$i]['RENT']}</td></tr>";
		}
		$html .= "</table>";
	}
	print $html;
	
}

function parsefromtpl ($arg){
    return parse($arg['field'],$arg['marc']);
}

$smarty->register_function('parse','parsefromtpl');
$smarty->register_function('has_cover','has_cover');
$smarty->register_function('get_isbn','get_isbn');
$smarty->register_function('get_holdings','get_holdings');
$smarty->register_function('display_holdings','display_holdings');
$smarty->register_function('get_isbns','get_isbns');
$smarty->assign('marc',$search_result);
$smarty->assign('hostname',$curhost_name);

if ($curhost_hits) {	
    $hitsinfo = "Displaying : $start - {$nav['end_val']} of <strong>{$curhost_hits}</strong>";
    $nav = getNavArrows($nav,0);
	
    $smarty->assign('hitsinfo',$hitsinfo);
	$smarty->assign('curhost',$curhost);
    $smarty->assign('nav',$nav);
    $smarty->assign('mode',$mode);
	$url = array();
	foreach ($_REQUEST as $k => $v) {
		if ($k != 'sortdir' && $k != 'sort') {
			$url[] = $k.'='.$v;
		}
	}
	
	$sortfields = array('title','author','callno','publisher','year');
	if (!empty($sort)){
		$url[] = 'sort='.$sort;
		$url[] = 'sortdir='.$sortdir;
	}
	if ($sortdir == 'ia'){
		$sortdir = 'id';
	} else {
		$sortdir = 'ia';
	}
	$smarty->assign('sortdir',$sortdir);
	$savednum = count($_SESSION[$curhost_name]);
	$smarty->assign('savednum',$savednum);
	$_SESSION["search_url"] = $_SERVER['REQUEST_URI'];
    $content = THEMESDIR.THEME.'listview.html';
    //$smarty->assign('record',$rec_str);
} else {
    if ($errormsg = $yazconn->ErrMsg[$curhost]){
        $smarty->assign('hitsinfo',$errormsg);
    } else {
        $smarty->assign('hitsinfo','No record found.');
    }   
    $content = THEMESDIR.THEME.'listview_no_data.html';     
}



unset($yazconn);
?>