<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: login.php,v 1.1 2006/09/04 07:51:40 lon.briones Exp $


require_once(MODDIR.'admin/Admin.class.php');
$admin =& new Admin();
if (isset($_SESSION['isAdminLogon']) && $_SESSION['isAdminLogon']) {
    /*
    unset($_SESSION['islogon']);
    unset($_SESSION['fname']);
    unset($_SESSION['lname']);
    */
    session_destroy();
    $admin->islogon = 'false';
    header("location: index.php?m=mylib&s=login");
    
}


if (!$admin->islogon) {
    $hidden = "
    <input type=\"hidden\" name=\"login\" value=\"1\">
    ";
    if (isset($_REQUEST['login'])) {
        $password = $_REQUEST['password'];
        if (!$admin->validate($password)) {
            $smarty->assign('error',$admin->error);
        }
        
    }
    $smarty->assign('hidden',$hidden);
    $content = THEMESDIR.THEME.'AdminLogin.html';
} else {
		header("location: index.php?m=admin");
}
?>