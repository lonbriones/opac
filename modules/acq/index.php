<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: index.php,v 1.1 2006/09/04 07:51:40 lon.briones Exp $


//require_once(MODDIR.'acq/subj.php');

require(INCDIR.'YazConnectionManager.class.php');
require_once(INCDIR.'marc_parser.php');
$hostid = 0;
//$rec = $yazconn->yazSearchByDateRange('060901','061001',$hostid);
//print_r($rec);
$limit = 10;
$start = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : 1;

function parsefromtpl ($arg){
    return parse($arg['field'],$arg['marc']);
}
$last_no_of_months = 5;
require_once(MODDIR.'acq/NewAcquisition.class.php');
$acq = new NewAcquisition();

for ($i =0; $i < $last_no_of_months; $i++) {
	//$count = $acq->getLastMonthCount($i);
	$dt = $acq->getLastMonthRange($i);
	$yazconn =& new YazConnectionManager();


	$query =  '@attr 1=32[Date-of-acquisition] @attr 5=1[Right-Truncation] "'.substr($dt[1],0,strlen($dt[1])-2).'"';
	//print "<br>$query<br>";
	$yazconn->connect($hostid,$query);
	if (!$curhost_hits = $yazconn->getHits($hostid)) {
		$curhost_hits = 0;
	}
	
	$count = $curhost_hits;
	$countbymonths[$i]['COUNT'] = $count;
	
	$dt = $acq->getLastMonthRange($i,true);
	$dt = explode('-',getDisplayDate($dt[0]));
	$dt = $dt[0].'-'.$dt[2];
	$countbymonths[$i]['DATE'] = $dt;
	$countbymonths[$i]['QRYSTR'] = $_SERVER['QUERY_STRING'].'&month='.$i;
	unset($yazconn);
}

$nMonth = isset($_REQUEST['month']) ? $_REQUEST['month'] : 0;
$dt = $acq->getLastMonthRange($nMonth);
	$yazconn =& new YazConnectionManager();

	$query =  '@attr 1=32 @attr 5=1 "'.substr($dt[1],0,strlen($dt[1])-2).'"';
	//print "<br>$query<br>";
$yazconn->connect($hostid,$query);
$search_result = ($yazconn->getSearchResults($hostid,$start,$limit,false));
$curhost_hits = $yazconn->getHits($hostid);
if (!$curhost_hits = $yazconn->getHits($hostid)) {
	$curhost_hits = 0;
}
$rec = '';
$nav = getNavigationValues($start, $curhost_hits, $limit);


$smarty->assign('countbymonths',$countbymonths);
$smarty->register_function('parse','parsefromtpl');
$smarty->assign('marc',$search_result);
$hitsinfo = "Displaying : $start - {$nav['end_val']} of <strong>{$curhost_hits}</strong>";
$nav = getNavArrows($nav,0);
$smarty->assign('hitsinfo',$hitsinfo);
$smarty->assign('nav',$nav);
$content = THEMESDIR.THEME.'NewAcquisition.html';

?>