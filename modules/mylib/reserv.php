<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: renew.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


require_once(MODDIR.'mylib/MyLibrary.class.php');

$mylib =& new MyLibrary();
if ($mylib->islogon) {
	$msg = '';
	if (isset($_REQUEST['act']) && $_REQUEST['act'] == 'reserve_item') {
		$mylib->setReserv($_SESSION['borrowid'],$_REQUEST['id']);
	}
	
	$dat = $mylib->getReserv($_SESSION['borrowid']);
	
	if (sizeof($dat))
	if (isset($_REQUEST['id']) && $_REQUEST['id'] != '' && !isset($_REQUEST['act'])) {
			$id = $_REQUEST['id'];
			$author = $dat[$id]['AUTHOR'];
			$title = $dat[$id]['TITLE'];
			$fid = $dat[$id]['FID'];
			$accessno = $dat[$id]['ACCESSNO'];
			$msg .= 'Are you sure you want to cancel the reservation for this item?';
			$msg .= '<br>&nbsp;&nbsp;Author.: '.$author;
			$msg .= '<br>&nbsp;&nbsp;Title: '.$title.'<br>';
			$msg .= ' [ <a href="?'.$_SERVER['QUERY_STRING'].'&ans=yes">Yes</a> ] ';
			$msg .= ' [ <a href="?'.$_SERVER['QUERY_STRING'].'&ans=no">No</a> ] ';
			
		if (isset($_REQUEST['ans']))  {
			$groupid = $mylib->getUserGroupId($_SESSION['borrowid']);
			$renewaldays = $mylib->getRenewalDays($groupid->GROUPID);
			if ($_REQUEST['ans'] == 'yes') {
				if ($mylib->cancelReserv($_SESSION['borrowid'],$fid,$accessno)) {
					$msg = '<strong>successful</strong>';
					
				} else {
					$msg = 'Cannot cancel this item.';
				}
			} else {
				$msg = '';
			}
			
			//print_r($dt);
			
			
		}
	} 
	
	$dat = $mylib->getReserv($_SESSION['borrowid']);
	$smarty->assign('isempty',count($dat));
	$smarty->assign('items',$dat);
	$smarty->assign('msg',$msg);
	$content =THEMESDIR.THEME.'/reservation.html';
	
	
} else {
    require_once(MODDIR.'mylib/login.php');
}





?>

