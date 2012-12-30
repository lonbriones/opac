<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: notice.php,v 1.1 2006/09/04 07:51:40 lon.briones Exp $




require_once(MODDIR.'admin/Admin.class.php');
$notice =& new Admin();
$msg = '';
if ($notice->islogon) {
	if (isset($_REQUEST['action']) && isset($_REQUEST['noticeno'])) {
		if (!isset($_REQUEST['confirm'])) {
			$link = '<a href="?'.$_SERVER['QUERY_STRING'].'&';
			$yes_link = $link .'confirm=yes">';
			$no_link = $link . 'confirm=no">';
			
			$msg = 'Delete this item? ['.$yes_link.'Yes</a>] ['.$no_link.'No</a>]';
		}
		if ($_REQUEST['action']=='delete' && $_REQUEST['noticeno'] && (isset($_REQUEST['confirm']) && $_REQUEST['confirm']=='yes')) {
			$notice->deleteNotice($_REQUEST['noticeno']);
		}
	}
	$smarty->assign('msg',$msg);
    $hidden = "
    <input type=\"hidden\" name=\"m\" value=\"$menu_sel\">
    <input type=\"hidden\" name=\"s\" value=\"notice\"> <input type=\"hidden\" name=\"login\" value=\"1\">
    ";    
    $smarty->assign('hidden',$hidden);
    if (isset($_REQUEST['addnotice'])) {
        $subject = $_REQUEST['subject'];
        $noticemsg = $_REQUEST['notice'];
        if ($notice->post($subject,$noticemsg)) {
            $smarty->assign('message','Notice added.');
        } else {
            $smarty->assign('subject',$subject);
            $smarty->assign('notice',$noticemsg);
            $smarty->assign('error',$notice->error);
            
        }
    }
    $max_notice = 10;
    $dat = $notice->getNotice();
	$notice_dat =array();
	for($i=0;$i<$max_notice;$i++) {
		if (isset($dat[$i]))
			$notice_dat[] = $dat[$i];
	}
    $smarty->assign('notice',$notice_dat);
    
    $content = THEMESDIR.THEME.'/notice.html';
} else {
	require_once(MODDIR.'admin/login.php');
}
?>

