<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: request.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


require_once(MODDIR.'mylib/MyLibrary.class.php');

$mylib =& new MyLibrary();
if ($mylib->islogon) {
    if (isset($_REQUEST['sendrequest'])) {
        if ($mylib->request($_REQUEST['isbn'],$_REQUEST['title'],$_REQUEST['author'],$_REQUEST['publisher'],$_REQUEST['note'])) {
            $smarty->assign('message','<b>Your request was sent</b>');
            unset($_REQUEST);
        } else {
            $smarty->assign('error',$mylib->error);
            
        }
    }
    $content = THEMESDIR.THEME.'request.html';
} else {
    require_once(MODDIR.'mylib/login.php');
}
?>