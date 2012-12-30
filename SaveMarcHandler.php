<?php
session_start();
$marcsessids = explode (',',$_REQUEST['marcsessid']);
$marcsessids = explode (',',$_REQUEST['marcsessid']);

$hostname = $_REQUEST['hostname'];
for ($i=0;$i<count($marcsessids);$i++) {
	$tmp = explode('_',$marcsessids[$i]);
	$sessid = $tmp[0];
	//print_r($sessid);
	//print "$sessid\n";
	$ident = $tmp[1];
	$_SESSION[$hostname][$ident] = $_SESSION['marc_saved_results'][$sessid];
}
//print '<pre>';
//print_r($_SESSION);
//print_r($_REQUEST);
//print '</pre>';
print count($_SESSION[$hostname]);
?>