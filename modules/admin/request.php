<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: request.php,v 1.1 2006/09/04 07:51:40 lon.briones Exp $




require_once(MODDIR.'admin/Admin.class.php');
$request = new Admin();

if ($request->islogon) {
	
    $smarty->assign('requestdat',$request->getUserRequests());
    $content = THEMESDIR.THEME.'/viewrequest.html';
} else {
    
}
?>