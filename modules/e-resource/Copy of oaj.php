<?php
require_once(INCDIR.'ez_sql_firebird.php');
require_once(MODDIR.'e-resource/OAJ.class.php');

$oaj = new oaj();
/*
print '<pre>';
print_r($oaj->getSubjects());
print '</pre>';
*/
function odd($num){
  $test_result = $num / 2;

  if(is_int($test_result)) 
	return "0";
  else
	return "1";			
}
if (isset($_REQUEST['url'])) {
	$content = '';
}
function oddfromtpl($arg){
	return odd($arg['lon']);
}
$smarty->register_function('odd2','oddfromtpl');
$smarty->assign('noofjournals',$oaj->getJournalCount());

if (isset($_REQUEST['category']) && $_REQUEST['category'] != "") {
	$category = $oaj->getSubjects($_REQUEST['category']);
	
	$smarty->assign('category',$category);
	$smarty->assign('category_name',$_REQUEST['category']);
	
	if (isset($_REQUEST['subject'])) {
		$subjectlist = $oaj->getSubjectEntries($_REQUEST['category'],$_REQUEST['subject']);
		$subject = $_REQUEST['subject'];
	} else {
		$subjectlist = $oaj->getSubjectEntries($category[0]['SUB_SETNAME']);
		$subject = $category[0]['SUB_SETNAME'];
	}
	$smarty->assign('subject',$subject);
	$smarty->assign('subjectlist',$subjectlist);
	$content = THEMESDIR.THEME.'/oaj_subjects.html';
	
} else {
	$category = $oaj->getCategory();
	$smarty->assign('category',$category);
	$content = THEMESDIR.THEME.'/oaj.html';
}	

?>