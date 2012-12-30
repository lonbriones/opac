<?php

require_once(MODDIR.'admin/Admin.class.php');
$notice =& new Admin();
$notice_dates = $notice->getNoticeDates();
$date = null;
if (isset($_REQUEST['date']) && $_REQUEST['date'] != '') {
	$date = $_REQUEST['date'];
}
$notice_dat = $notice->getNotice($date);

function getDisplayDatefromtpl ($arg){
    return getDisplayDate($arg['pdate']);
}

$smarty->register_function('getDisplayDate','getDisplayDatefromtpl');
$smarty->assign('notice_dates',$notice_dates);
$smarty->assign('notice',$notice_dat);
$smarty->assign('curdate','Displaying '.(($date) ? getDisplayDate($date) : 'all notices'));

$content = THEMESDIR.THEME.'/notice_archive.html';

?>