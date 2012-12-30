<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +---------------------------------------------------------------------+
//
// $Id: utils.php,v 1.1 2006/09/04 07:51:18 lon.briones Exp $

function getMenuIds($menu){
    $submenu = array();
    for ($i=0;$i<count($menu);$i++){
        $submenu['menu'][]= $menu[$i]['id'];
        for ($j=0;$j<count($menu[$i]['submenu']);$j++){
            $submenu['submenu_default'][$menu[$i]['id']] = $menu[$i]['submenu'][$j]['id'];
            $submenu['submenu'][]= $menu[$i]['submenu'][$j]['id'];
        }
    }
    return $submenu;
}




function generateBoolean($yazfields,$name,$selkey,$class){
	//$yazfields = Language::getSearchBoolean();
	  $s = '<select name="'.$name.'" class="'.$class.'">';
	  foreach ($yazfields as $k => $v) {
		$selected = ($v == $selkey) ? 'selected' : '';		
		$s .= '<option '.$selected.' value="'.$k.'">'.$v.'</option>';
	  }
	  $s .= '</select>';
	  return $s;    
}


function generateFieldOpt($yazfields,$name,$selkey,$class) {
	$s = '<select name="'.$name.'" class="'.$class.'">';

	foreach ($yazfields as $k => $v) {
//print $v.' ';
		$selected = ($v == $selkey) ? 'selected' : '';		
		$s .= '<option '.$selected.'>'.$k.'</option>';

	}
	$s .= '</select>';

	return $s;
}

/*
function generateFieldOpt($name,$selkey,$class) {
	$yazfields = Language::getLocalMonoSearchFields();
	$s = '<select name="'.$name.'" class="'.$class.'">';
	foreach ($yazfields as $k => $v) {
		$selected = ($v == $selkey) ? 'selected' : '';		
		$s .= '<option '.$selected.'>'.$k.'</option>';
	}
	$s .= '</select>';
	return $s;
}
*/


function getNavigationValues($start, $noofrows, $list_max_entries_per_page) {
	$navigation_array = Array ();
	$prevstartvalue = NULL;
	$endval = NULL;
	$nextstartvalue = NULL;
	//Setting the start to end counter
	$starttoendvaluecounter = $list_max_entries_per_page -1;
	//Setting the ending value
	if ($noofrows > $list_max_entries_per_page) {
		$end = $start + $starttoendvaluecounter;
		if ($end > $noofrows) {
			$end = $noofrows;
		}
		$startvalue = 1;
		$remainder = $noofrows % $list_max_entries_per_page;
		if ($remainder > 0) {
			$endval = $noofrows - $remainder +1;
		}
		elseif ($remainder == 0) {
			$endval = $noofrows - $starttoendvaluecounter;
		}
	} else {
		$end = $noofrows;
	}

	//Setting the next and previous value
	if (isset ($start) && $start != '') {
		$tempnextstartvalue = $start + $list_max_entries_per_page;
		if ($tempnextstartvalue <= $noofrows) {

			$nextstartvalue = $tempnextstartvalue;
		}
		if (($start > $list_max_entries_per_page)) {
			$prevstartvalue = $start - $list_max_entries_per_page;
		}
	} else {
		if ($noofrows > $list_max_entries_per_page) {
			$nextstartvalue = $list_max_entries_per_page +1;
		}
	}

	$navigation_array['start'] = $start;
	$navigation_array['end'] = $endval;
	$navigation_array['prev'] = $prevstartvalue;
	$navigation_array['next'] = $nextstartvalue;
	$navigation_array['end_val'] = $end;
	return $navigation_array;
}

function getNavArrows($nav_arr,$isImage) {
    
    $arr = array('start'=>'Start','prev'=>'Previous','next'=>'Next','end'=>'End');
    $nav_arr['start'] = 1;    
    if (!$nav_arr['next']) $nav_arr['end'] = null;
    if (!$nav_arr['prev']) $nav_arr['start'] = null;
    
    $qstr = explode('&',$_SERVER['QUERY_STRING']);
    for($i=0;$i<count($qstr);$i++) {
        if (!eregi("start=",$qstr[$i])){
            $qstr2[] = $qstr[$i];
        }    
    }
    unset($qstr);
    $url = implode('&',$qstr2);
    unset($qstr2);
    
    foreach ($arr as $k=>$v) {
    	
        if ($nav_arr[$k]) {
            //$s[] = '<span >';
    	    $s[] = "<a href=\"?$url&start={$nav_arr[$k]}\" class=\"submenulink\">";
    	    $s[] = '<img src="'.THEMESURL.THEME.'images/'.$k.'_on.gif" border=0/>';
    	    $s[] = '</a>';
            //$s[] = '</span>';    
    	} else {
    	    $s[] = '<a >';
    	    $s[] = '<img src="'.THEMESURL.THEME.'images/'.$k.'.gif" border=0/>';
    	    $s[] = '</a>';
    	}
    	
    }
    return implode('',$s);
}
function makeRoundedSquareBox($title,$contents){

}

function getDisplayDate($date,$dbtype='firebird') {
	if (!$date) return false;
	switch($dbtype) {
		case 'firebird' : 
			$dt = explode ('/',$date);
			$y = (string)$dt[2];
			$m = (string)$dt[0];
			$d = (string)$dt[1];
			return $date = date("M-d-Y",strtotime("$y$m$d"));
			
			break;
	}
}
function incday($date,$noofdays){
	//this is for interbase only for the meantime
	$dt = explode(' ',$date);
	
	$d = explode('/',$dt[0]);
	$t = explode(':',$dt[1]);
	
	$month = $d[0];
	$day = $d[1];
	$year = $d[2];
	
	$hour = $t[0];
	$min = $t[1];
	$sec = $t[2];
	
	return date("m/d/Y H:i:s", mktime($hour,$min,$sec,$month,$day,$year)+(24*$noofdays*60*60));
	
	
}

function genchksum13($isbn) {  
     $isbn = trim($isbn);  
     for ($i = 0; $i <= 12; $i++) {  
         $tc = substr($isbn, -1, 1);  
         $isbn = substr($isbn, 0, -1);  
         $ta = ($tc*3);  
         $tci = substr($isbn, -1, 1);  
         $isbn = substr($isbn, 0, -1);  
         $tb = $tb + $ta + $tci;  
     }  
     $tg = ($tb / 10);  
     $tint = intval($tg);  
     if ($tint == $tg) { return 0; }  
     $ts = substr($tg, -1, 1);  
     $tsum = (10 - $ts);  
     return $tsum;  
 }  
 function isbn10_to_13($isbn) {  
     $isbn = trim($isbn);  
     if(strlen($isbn) == 12){ // if number is UPC just add zero  
         $isbn13 = '0'.$isbn;}  
     else  
     {  
         $isbn2 = substr("978" . trim($isbn), 0, -1);  
         $sum13 = genchksum13($isbn2);  
         $isbn13 = "$isbn2$sum13";  
     }  
     return ($isbn13);  
 }  
   
 // usage //  
   
// echo isbn10_to_13('1234567890'); // returns ISBN13 
?>