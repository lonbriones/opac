<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: login.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


require_once(MODDIR.'mylib/MyLibrary.class.php');

if (isset($_SESSION['islogon']) && $_SESSION['islogon']) {
    /*
    unset($_SESSION['islogon']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    */
    session_destroy();
    header("location: index.php?m=mylib&s=login");
}

$mylib =& new MyLibrary();
if (!$mylib->islogon) {
    $hidden = "
    <input type=\"hidden\" name=\"m\" value=\"$menu_sel\">
    <input type=\"hidden\" name=\"s\" value=\"login\">
    <input type=\"hidden\" name=\"login\" value=\"1\">
    ";
    
    if (isset($_REQUEST['login'])) {
        $borrowid = $_REQUEST['borrowid'];
        $smarty->assign('borrowid',$borrowid);
        $password = $_REQUEST['password'];
        if (!$mylib->validate($borrowid,MyLibrary::encrypt($password))) {
            $smarty->assign('error',$mylib->error);
        }
        
    }
    $smarty->assign('hidden',$hidden);
    $content = THEMESDIR.THEME.'login.html';
} else {
    header("location: index.php?m=mylib&s=hist");
}
?>