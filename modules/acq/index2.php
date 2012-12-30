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

require_once(MODDIR.'acq/NewAcquisition.class.php');
require_once(INCDIR.'YazConnectionManager.class.php');
require_once(INCDIR.'marc_parser.php');
$acq = new NewAcquisition();
$last_no_of_months = 5;
unset($_SESSION['countbymonths']);
if (!isset($_SESSION['countbymonths'])) {
	for ($i =0; $i < $last_no_of_months; $i++) {
		$count = $acq->getLastMonthCount($i);
		$countbymonths[$i]['COUNT'] = $count;
		$dt = $acq->getLastMonthRange($i);
		$dt = explode('-',getDisplayDate($dt[0]));
		$dt = $dt[0].'-'.$dt[2];
		$countbymonths[$i]['DATE'] = $dt;
		$countbymonths[$i]['QRYSTR'] = $_SERVER['QUERY_STRING'].'&month='.$i;
		
	}
	$_SESSION['countbymonths'] = $countbymonths;
}
unset($_SESSION['newacq_dat']);
if (isset($_REQUEST['month'])) {
	$nMonth = $_REQUEST['month'];
	if (!isset($_SESSION['newacq_dat'])) {
		$dat = $acq->getLastMonth($nMonth);
		$_SESSION['newacq_dat'] = $dat;
	}
	if (isset($_REQUEST['page']))
		$page = $_REQUEST['page'];
	else
		$page = 1;
	$rec_per_page = 10;	
	
	$start = 0;
	$end = $start + $rec_per_page;
	if ($end > sizeof($_SESSION['newacq_dat']))
		$end = sizeof($_SESSION['newacq_dat']);
	$j=0;	
	
	$yazconn =& new YazConnectionManager();

	$hostname = $yazconn->getHostName(0);

	for ($i=$start; $i<$end;$i++) {
		$newacq_dat[$j]['LOCATION'] = $_SESSION['newacq_dat'][$i]['LOCATION'];
		$fid = $_SESSION['newacq_dat'][$i]['FID'];
		$rec = $yazconn->yazSearchById($fid,0);
		$marc = $rec[0];
		
		$newacq_dat[$j]['TITLE'] = parse('title',$marc);
		$newacq_dat[$j]['AUTHOR'] = parse('author',$marc);
		$newacq_dat[$j]['DATE'] = parse('year',$marc);
		$newacq_dat[$j]['PUBLISHER'] = parse('publisher',$marc);
		$newacq_dat[$j]['CALLNO'] = parse('callno',$marc);
		$j++;
	}
	
	/*
	print '<pre>';
	print_r($newacq_dat);
	print '</pre>';
	*/
	
	$smarty->assign('newacq_dat',$newacq_dat);
}


	

	
	
$smarty->assign('countbymonths',$_SESSION['countbymonths']);
$content = THEMESDIR.THEME.'NewAcquisition.html';	
?>