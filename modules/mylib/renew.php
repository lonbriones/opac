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
	$dat = $mylib->getCircHistory('renewal');
	//print_r($dat);
	$msg = '';
	if (sizeof($dat))
	if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
			$id = $_REQUEST['id'];
			$accessno = $dat[$id]['ACCESSNO'];
			$title = $dat[$id]['TITLE'];
			$due = $dat[$id]['DUE'];
			$msg .= 'Are you sure you want to renew this item?';
			$msg .= '<br>&nbsp;&nbsp;Accs. No.: '.$accessno;
			$msg .= '<br>&nbsp;&nbsp;Title: '.$title.'<br>';
			$msg .= ' [ <a href="?'.$_SERVER['QUERY_STRING'].'&ans=yes">Yes</a> ] ';
			$msg .= ' [ <a href="?'.$_SERVER['QUERY_STRING'].'&ans=no">No</a> ] ';
			
		if (isset($_REQUEST['ans']))  {
			$groupid = $mylib->getUserGroupId($_SESSION['borrowid']);
			$renewaldays = $mylib->getRenewalDays($groupid->GROUPID);
			$new_due = incday($due,$renewaldays);
			if ($_REQUEST['ans'] == 'yes') {
				if ($mylib->renewItem($_SESSION['borrowid'],$accessno,$new_due)) {
					$msg = '<strong>Renewal successful</strong>';
					$dat = $mylib->getCircHistory('renewal');
				} else {
					$msg = 'Cannot renew this item.';
				}
			} else {
				$msg = '';
			}
			
			//print_r($dt);
			
			
		}
	}
	$smarty->assign('isempty',count($dat));
    $smarty->assign('items',$dat);
    $smarty->assign('msg',$msg);
    $content =THEMESDIR.THEME.'/renew.html';
} else {
    require_once(MODDIR.'mylib/login.php');
}





?>

