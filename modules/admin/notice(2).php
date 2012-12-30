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

if ($notice->islogon) {
    $hidden = "
    <input type=\"hidden\" name=\"m\" value=\"$menu_sel\">
    <input type=\"hidden\" name=\"s\" value=\"notice\">
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
    
}
?>

