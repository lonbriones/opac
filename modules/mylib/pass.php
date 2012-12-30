<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: pass.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


require_once(MODDIR.'mylib/MyLibrary.class.php');
$smarty->assign('success','false');
$hidden = "
<input type=\"hidden\" name=\"m\" value=\"$menu_sel\">
<input type=\"hidden\" name=\"s\" value=\"pass\">
<input type=\"hidden\" name=\"changepass\" value=\"1\">
";
$act = @$_REQUEST['a'];
$smarty->assign('hidden',$hidden);
$smarty->assign('change_password_title', ($act=='new') ? 'Please make a password' : 'Change password');
$mylib =& new MyLibrary();
if ($mylib->islogon) {
    if (isset($_REQUEST['changepass'])) {
        $p1 = $_REQUEST['p1'];
        $p2 = $_REQUEST['p2'];
        if ($mylib->changePassword($p1,$p2)) {
            $smarty->assign('message','<strong>Password was changed</strong>');
            $smarty->assign('success','true');
        } else {
            $smarty->assign('message',$mylib->error);
        }
    }        
    $content = THEMESDIR.THEME.'ChangePassword.html';
} else {
    
}

?>