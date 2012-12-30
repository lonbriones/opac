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
	$action = '';
    if (isset($_REQUEST['action']))
    	$action = $_REQUEST['action'];
    	
	$dat = $mylib->getCircHistory($action);
    $smarty->assign('items',$dat);
    if ($count = sizeof($dat)) {
        for ($i=0;$i<$count;$i++) {
            $title = $dat[$i]->TITLE;
        }
    } else {
        $message = "No records";
    }
    
    $content =THEMESDIR.THEME.'/circ.html';
} else {
    require_once(MODDIR.'mylib/login.php');
}
?>