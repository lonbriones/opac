<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: pass.php,v 1.1 2006/09/04 07:51:40 lon.briones Exp $


require_once(MODDIR.'admin/Admin.class.php');
$smarty->assign('success','false');
$hidden = "
<input type=\"hidden\" name=\"changepass\" value=\"1\">
";
$smarty->assign('hidden',$hidden);


$admin =& new Admin();
if ($admin->islogon) {
    //if (isset($_REQUEST['changepass'])) {
//print "asdf lasdf";
		$p1 = $_REQUEST['p1'];
        $p2 = $_REQUEST['p2'];
        if ($admin->changePassword($p1,$p2)) {
            $smarty->assign('message','<strong>Password was changed</strong>');
            $smarty->assign('success','true');
        } else {
            $smarty->assign('message',$admin->error);
        }
    //}        
    $content = THEMESDIR.THEME.'AdminChangePassword.html';
} else {
    
}

?>