<?php
require 'config.php';
require_once(INCDIR.'ez_sql_firebird.php');
require_once(INCDIR.'utils.php');

$isbn = @$_REQUEST['isbn'];
$type = @$_REQUEST['type'];

if (empty($isbn)) die('invalid isbn');

$isbn13 = isbn10_to_13($isbn);

global $db;
$sql = sprintf("select * from cover where isbn='%s' or isbn='%s'",$isbn,$isbn13);    

$cover = $db->get_row($sql);
if (!$cover) die("no record found for $isbn");

switch($type) {
		case 'comments':
			
			$pos1 = strpos($cover->COMMENTS, '<Summary>');
			$comments = '';
			if ($pos1 !== FALSE) {
				$pos2 = strpos($cover->COMMENTS, '</Summary>');
				$len = $pos1 -$pos2."<br>";
				$comments = substr($cover->COMMENTS, $pos1+9, $len)."<br>";
			}
			print $comments;
			break;
		default:
			header('Content-type:image/jpeg');
			header("Content-Disposition:inline; filename=$isbn.jpg");
			print $cover->LARGEIMG;
}

//end