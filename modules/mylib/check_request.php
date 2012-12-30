<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: hist.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


require_once(MODDIR.'mylib/MyLibrary.class.php');

$mylib =& new MyLibrary();
if ($mylib->islogon) {

    $smarty->assign('requestdat',$mylib->getUserRequests());
    $content = THEMESDIR.THEME.'/viewrequest_user.html';
} else {
    require_once(MODDIR.'mylib/login.php');
}	
	?>