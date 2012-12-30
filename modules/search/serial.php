<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: serial.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $

require_once(INCDIR.'ez_sql_firebird.php');

function getArticles($s2rchkinno){
	global $db;
	$s2ql = sprintf("select * from article where srchkinno = %d",$s2rchkinno,OBJECT);
	return $db->get_results($s2ql);	
}
function getVolumes($fid) {
	global $db;
	$s2ql = sprintf("select srchkin.* from srchkin where srchkin.serialno = (select  serialno from serial where fid = '%s')",$fid,OBJECT);
	return $db->get_results($s2ql);	
}

$vols = getVolumes($id);
//unset($s2);

require_once(MODDIR.'search/DataGrid.class.php');
require_once(INCDIR.'YazConnectionManager.class.php');

require_once(INCDIR.'marc_parser.php');
$hostid = $_REQUEST['curhost'];
if ($hostid === 1) {
	$marctags = language::getArticleMarcTags();
} else {
	$marctags = language::getMarcTags();
}
$yaz =& new YazConnectionManager();

//if (!isset($_REQUEST['srchkinno'])) {

	$s = '';
	$s22[] = '<p><b>Holdings Information</b></p>';
	$s22[] = '<table border=0 width=600 cellpadding=2 cellspacing=5><tr>
	<td><b>Volume Information</b></td>
	<td><b>Receive Date</b></td>
	</tr>';
	for ($i=0;$i<sizeof($vols);$i++) {
		
		$rcvdate = $vols[$i]['RCVDATE'];
		$articles = getArticles($vols[$i]['SRCHKINNO']);
		if (trim($rcvdate) != '') {
			//$s22[] = '<img src="'.THEMESURL.THEME.'/images/search_icon.png"> <a href="'.$_SERVER['REQUEST_URI'].'&srchkinno='.$i.'">'.$vols[$i]['ENUMERATION'].'</a>';
			$s22[] = '<tr><td>';
			//$s22[] = '<img src="'.THEMESURL.THEME.'/images/search_icon.png"> <a href="javascript:toggleart('.$i.')">'.$vols[$i]['ENUMERATION'].'</a>';
			$s22[] = $vols[$i]['ENUMERATION'];
			$s22[] = '</td><td>'.$rcvdate.'</td></tr><tr><td colspan=2>';

			/***details****/
				//$articles = getArticles($vols[$i]['SRCHKINNO']);
				/*
				$s22[] = '<div id="art_'.$i.'">';
				for ($j=0;$j<count($articles);$j++ ) {
					$article_identifier = $articles[$j]['ARTICLENO'];
					//print "<p>$hostid article".$article_identifier."</p>";
					$marc = $yaz->yazSearchById('article'.$article_identifier,1);
					
					$s22[] = '<tr><td>';
					if (isset($marc[0])) {
						$s22[] = '<b>'.parse('title',$marc[0]).'</b><br>';
						$s22[] = '<i>'.parse('author',$marc[0]).'</i><br>';
					}
					$s22[] = '</td></tr>';
				}
				*/
		} 
		
		$s22[] = '</td></tr>';
	
	}
	$s22[] = '</table>';
	/*
} else {

	$articles = getArticles($vols[$_REQUEST['srchkinno']]['SRCHKINNO']);
	$s22[] = '<table border=0 width=600 ><tr><td bgcolor=gray>';
	$s22[] = '<p><b>'.$vols[$_REQUEST['srchkinno']]['ENUMERATION'].'</b></p>';
	$s22[] = '</td></tr>';
	for ($i=0;$i<count($articles);$i++ ) {
		$article_identifier = $articles[$i]['ARTICLENO'];
		//print "<p>$hostid article".$article_identifier."</p>";
		$marc = $yaz->yazSearchById('article'.$article_identifier,1);
		//print_r($marc);
		$s22[] = '<tr><td>';
		$s22[] = '<b>'.parse('title',$marc[0]).'</b><br>';
		$s22[] = '<i>'.parse('author',$marc[0]).'</i><br>';
		$s22[] = '</td></tr>';
	}
	$s22[] = '</table>';
	
	
}
*/


$s22  = implode('',$s22);

$smarty->assign('serial',$s22);

?>