<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: detailview.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


require(MODDIR.'search/DataGrid.class.php');
require(INCDIR.'YazConnectionManager.class.php');
require_once(INCDIR.'ez_sql_firebird.php');

require_once(INCDIR.'marc_parser.php');
$hostid = $_REQUEST['curhost'];
if ($hostid == 1) {
	$marctags = language::getArticleMarcTags();
} else {
	$marctags = language::getMarcTags();
}
/*
$yazconn2 =& new YazConnectionManager();
$hostname = $yazconn2->getHostName($hostid);
$yazconn2->isDisplayMarc = true;
$rec = $yazconn2->yazSearchById($id,$hostid);
print $marc = $rec[0];
*/
$yazconn =& new YazConnectionManager();
$hostname = $yazconn->getHostName($hostid);
$rec = $yazconn->yazSearchById($id,$hostid);
$marc = $rec[0];

$preview_link = "/index.php?m=search&a=preview&id=$id&curhost=$hostid&mode=";
$detailview_link = "/index.php?m=search&a=details&id=$id&curhost=$hostid&mode=";

$smarty->assign('preview_link', $preview_link);
$smarty->assign('detailview_link', $detailview_link);

if (isset($_REQUEST['save_marc'])) {
	$new_name = date("YmdHim").'.mrc';
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // some day in the past
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Content-type: application/x-download");
	header("Content-Disposition: attachment; filename={$new_name}");
	header("Content-Transfer-Encoding: binary");
	print $marc;
	exit;
	//$content = THEMESDIR.THEME.'view_raw_marc.html';
} else {
	$smarty->assign('FID',$id);
	//$marc = $_SESSION['marc'][$id];
	$format = marcParse($marc,"998",SUBFLD.'a'); 
	
	if (isset($_REQUEST['marc_view']))
		$detail = DataGrid::getDetail($marc,true);
	else 
		$detail = DataGrid::getDetail($marc);
	
	$titleauthor = explode('/',$detail[245][0]);
	$title = $titleauthor[0];
	$author = '';
	if (isset($titleauthor[1]))
		$author = $titleauthor[1];
	//$author = "<a href=\"?mode={$_REQUEST['mode']}&m=search&s=local&search=1&field%5B0%5D=Author&term%5B0%5D=$author&host%5B%5D=$hostid\">".$author.'</a>';
//	$smarty->assign('title',$title);
//	$smarty->assign('author',$author);
    $isbn = marcParse($marc,"020",SUBFLD.'c'); 
	$isbn = str_replace('-', '', $isbn);
	$isbn = trim($isbn);
	$isbn13 = isbn10_to_13($isbn);
	$smarty->assign('isbn',$isbn);
	$smarty->assign('isbn13',$isbn13);
	
	
	global $db;
	$sql = sprintf("select * from cover where isbn='%s' or isbn='%s'",$isbn,$isbn13);    
	$cover = $db->get_row($sql);
	$has_cover = !empty($cover->LARGEIMG);
	
	$comments = '';
	if ($cover) {
		$pos1 = strpos($cover->COMMENTS, '<Summary>');
		if ($pos1 !== FALSE) {
			$pos2 = strpos($cover->COMMENTS, '</Summary>');
			$len = $pos1 -$pos2."<br>";
			$comments = substr($cover->COMMENTS, $pos1+9, $len)."<br>";
		}
	}
	$marc = array ();
	$i = 0;
	foreach ($detail as $tag => $vals) {

		if ($tag != 999) {
			
			if (isset($_REQUEST['marc_view']))
				$marc[$i]['tag'] = $tag.":";
			else $marc[$i]['tag'] = isset($marctags[$tag]) ? $marctags[$tag] : $tag.":";


 		    foreach ($vals as $k => $v) {
				if ($tag == '260') {
					//$marc[$i]['value'] = "<a href=\"?mode={$_REQUEST['mode']}&m=search&s=local&search=1&field%5B0%5D=Publisher&term%5B0%5D=$v&host%5B%5D=$hostid\">$v</a>";
					$marc[$i]['value'] = $v;
				} elseif ($tag == '650') {
					//$marc[$i]['value'] = "<a href=\"?mode={$_REQUEST['mode']}&m=search&s=local&search=1&field%5B0%5D=Subject&term%5B0%5D=$v&host%5B%5D=$hostid\">$v</a>";
					$marc[$i]['value'] = $v;
				} elseif ($tag == '856'){
					$pos=strpos($v,'http');
					//print substr($v,$pos);
					if ($pos === false) {
						$link='<a href="'.substr($v,$pos).'">';
					} else {
						$link='<a href="'.$v.'">';
					}
					$marc[$i]['value'] = '<a href="'.substr($v,$pos).'">'.$v.'</a>';
				} else {
					$marc[$i]['value'] = $v;
				}
			$i++;

			}
		}
		
	}
	if ($comments) {
		$marc[$i]['tag'] = 'Comments';
		$marc[$i]['value'] = $comments;
	}
	$smarty->assign('marc',$marc);
	$smarty->assign('has_cover',$has_cover);
	
	require(MODDIR.'search/moreinfo.php');
	if ($format == 'zzSerials') {
		require(MODDIR.'search/serial.php');
	}
	
	$content = THEMESDIR.THEME.'detailview_limited_preview.html';
	$content .= <<<JS
        
JS;
}
?>