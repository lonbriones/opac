<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>            |
// +----------------------------------------------------------------------+
//
// $Id: index.php,v 1.2 2006/09/04 08:02:00 lon.briones Exp $

session_start();
error_reporting(E_ALL);
//error_reporting(~E_NOTICE && ~E_WARNING);

ini_set('display_errors','Off');
require ('config.php');
 
require (INCDIR.'utils.php');

if ($handle = opendir(LANGDIR)) {
    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) {
		$file_parts = explode('.', $file);
		if (count($file_parts) == 2 && $file_parts[1] == 'php') {
			@include LANGDIR.$file;
			if ($file != '.' && $file != '..') {
				$_t = explode('.', $file);
				$languages[$_t[0]] = $LANG['language'];
			}
		}
    }
    closedir($handle);
}

$current_language = LANG;
if (isset($_REQUEST['lang'])) {
	$current_language = $_REQUEST['lang'];
	$_SESSION['lang'] = $current_language;
}

if (isset($_SESSION['lang'])) {
	$current_language = $_SESSION['lang'];
}






$lang_sel = '<form action="" id="language_dd" method="post">';
$lang_sel .= '<select name="lang" onchange="this.form.submit();">';
foreach ($languages as $k => $v) {
	if ($k == $current_language) {
		$selected = "selected = 'selected'";
	} else {
		$selected = '';
	}
	$lang_sel .= "<option value='$k' $selected>$v</option>";	
}
$lang_sel .= '</select>';
$lang_sel .= '</form>';



include (LANGDIR.$current_language.'.php');
require (SMARTYDIR.'Smarty.class.php');




$smarty = new Smarty;
$smarty->template_dir = THEMESDIR."blue/";
$smarty->compile_dir = THEMESDIR."blue/compile/";

$smarty->assign('language_dropdown', $lang_sel);
$smarty->assign("title","WEBOPAC2");
$smarty->assign("charset",$LANG['charset']);    
$smarty->assign("THEMESDIR",THEMESURL.THEME);

$smarty->assign("libraryname",LIBRARY_NAME);
$smarty->assign("libraryaddress",LIBRARY_ADDRESS);
$smarty->assign("libraryphone",LIBRARY_PHONE);

/** menu:start **/
require(INCDIR.'Menu.class.php');

$menu = new menu();

$menu->addMainItem('home',$LANG['home']);
$menu->addSubItem('home','home', $LANG['back_to_home']);
$menu->addSubItem('home','notice_archive',$LANG['notice_archive']);
if (!isset($_SESSION['islogon']) || !$_SESSION['islogon'])    {
	$menu->addSubItem('home','login',$LANG['user_login']);
}
$menu->addMainItem('search',$LANG['search']);
$menu->addSubItem('search','local', $LANG['search_local_library']);
$menu->addSubItem('search','artl', $LANG['search_article']);

$menu->addSubItem('search','other', $LANG['search_other_resources']);
$arr_selecthost = Language::getHosts();
$menu->addSubItem('search','saved', $LANG['view_saved_items']);

$menu->addMainItem('acq', $LANG['new_acquisition']);
$menu->addMainItem('library', $LANG['library_guide']);

$menu->addMainItem('mylib', $LANG['my_library']);
$menu->addSubItem('mylib','hist', $LANG['circulation_history']);
$menu->addSubItem('mylib','renew',$LANG['renewal']);
$menu->addSubItem('mylib','request', $LANG['request_a_book']);
$menu->addSubItem('mylib','check_request',$LANG['check_requested_books']);
$menu->addSubItem('mylib','reserv', $LANG['check_reservation']);

$menu->sublist['mylib']['login'] = array();
$menu->sublist['mylib']['pass'] = array();
if (!isset($_SESSION['islogon']) || !$_SESSION['islogon'])    {
    $utils = '<a href="index.php?m=mylib&s=login" class="submenulink"><img src="'.THEMESURL.THEME.'images/login.gif" border=0></a>';
} else {
    $utils = $LANG['hello'].', <strong>'.ucwords(strtolower($_SESSION['lname']))."</strong><img src='' height=1 width=2><br>";
    $utils .= '<a href="index.php?m=mylib&s=pass" class="submenulink">'.$LANG['change_password'].'</a> | ';
    $utils .= '<a href="index.php?m=mylib&s=login" class="submenulink">'.$LANG['logout'].'</a>';	
}

$smarty->assign('utils',$utils);
if (isset($LANG['font-size'])) {
	$smarty->assign('body_style', ' style="font-size:'.$LANG['font-size'].' !important;"');
}


$menu->addMainItem('admin',$LANG['admin']);
if (!isset($_SESSION['isAdminLogon']) || $_SESSION['isAdminLogon'] == '')    {
    $menu->addSubItem('admin','login','<u>'.$LANG['admin_login'].'</u>');
} else {
    
}    
$menu->sublist['admin']['notice'] = array();
if (isset($_SESSION['isAdminLogon']) && $_SESSION['isAdminLogon'])    {
    $menu->addSubItem('admin','notice', $LANG['add_notice']);
    $menu->addSubItem('admin','post_subscription', $LANG['post_journal']);
    $menu->addSubItem('admin','post_libraryguide', $LANG['post_library_guide']);
    
    $menu->addSubItem('admin','request', $LANG['view_user_requests']);
    $menu->addSubItem('admin','pass', $LANG['change_password']);
    $menu->addSubItem('admin','login','<u>'.$LANG['admin-logout'].'</u>');
}

$menu_sel = (isset($_REQUEST['m']) && !empty($_REQUEST['m'])) ? $_REQUEST['m'] : 'home';
$submenu_sel = (isset($_REQUEST['s']) && !empty($_REQUEST['s'])) ? $_REQUEST['s'] : '';


$smarty->assign('menu',($menu->mainmenu));
$smarty->assign('menu_sel',$menu_sel);
$submenu = array();

for ($i=0;$i<count($menu->submenu);$i++) {
    if (key($menu->submenu[$i]) == $menu_sel) {
        $submenu[] = $menu->submenu[$i][$menu_sel][key($menu->submenu[$i][$menu_sel])];
    }
}

        
$smarty->assign('submenu',$submenu);
        

if ($menu->inMainItems($menu_sel)) {
	if (!empty($submenu_sel)) {
		if ($menu->inSubItems($menu_sel,$submenu_sel)) {
			$incFile = $menu_sel.'/'.$submenu_sel;
		} else {
			$incFile = 'errors/badrequest';
		}
	} else {
		$incFile = $menu_sel.'/index';
	}	
} else {
	$incFile = 'errors/badrequest';
}



$smarty->assign("menu_sel",$menu_sel);
$smarty->assign("submenu_sel",$submenu_sel);

$smarty->assign("menulist", $menu->menulist);
$smarty->assign("sublist", $menu->sublist);
$smarty->assign('islogon', @$_SESSION['islogon']);
$smarty->assign('borrower_name', @$_SESSION['lname']);

/** menu:end **/

/** content:start **/

if (file_exists(MODDIR.'/'.$incFile.'.php')){
    //$vtlog->logthis('incfile:'.MODDIR.'/'.$incFile.'.php','info');
	
    require (MODDIR.'/'.$incFile.'.php');    
} else {
    //$vtlog->logthis('incfile: file missing: '.MODDIR.'/'.$incFile.'.php','info');
    require (MODDIR.'/errors/filenotfound.php');    
    
}
    
$smarty->assign('content',$content);
/** content:end **/

$smarty->display(THEMESDIR.THEME.'/index.html');
//$vtlog->logthis("----------------- webopac end ----------------",'info');

?>