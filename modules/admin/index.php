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

/*
require_once(MODDIR.'acq/NewAcquisition.class.php');
require_once(MODDIR.'admin/Admin.class.php');
$notice =& new Admin();
$notice_dat = $notice->getNotice();

$smarty->assign('notice',$notice_dat);
$smarty->assign('theme',THEMESURL.THEME);

$acq = new NewAcquisition();
$dat = $acq->display('title','asc');
$s = '';
foreach ($dat as $subject => $value) {
    $s .= '<strong><u>'.$subject.'</u></strong>';
    $s .= '<blockquote>';
    for ($i=0;$i<count($value);$i++) {
        foreach ($value[$i] as $tag=>$v) {
            if ($tag != 'subject' && $tag != 'date') {
                if ($tag == 'title') {
                    $s .= '<strong>'.$v.'</strong>';
                } else {
                    $s .= $v;
                }
                $s .= '<br>';
            }
        }
        $s .= '<br>';
    }
    $s .= '</blockquote>';
    
}

$smarty->assign('dat',$s);
$content = THEMESDIR.THEME.'/home.html';
*/
if (!isset($_SESSION['isAdminLogon']) || $_SESSION['isAdminLogon'] == '')
	require_once(MODDIR.'admin/login.php');
else
require_once(MODDIR.'admin/notice.php');
?>