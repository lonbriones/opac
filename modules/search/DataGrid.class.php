<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: DataGrid.class.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


//require(INCDIR.'Pear/DataGrid.php');
//require(INCDIR.'Pear/DataSource/Array.php');

class DataGrid {
    var $fields;
    
    function start(){
        //return '<table border="0">';
    }
    function getDetail($record,$isMarcView=false) {
        require_once(INCDIR.'MarcTags.class.php');
        $excludetags = MarcTags::getExcludedMonoTags();
        
        if ($record) {
            require_once(INCDIR.'marc_parser.php');
            $marc=readRawMarc($record,"","",1,0);
            for ($i=0 ; $i<count($marc) ;$i++) {
                
				if (!$isMarcView) $txt=removeSubField($marc[$i]);
				else $txt=replaceSubField($marc[$i]);
                $tag=substr($txt,0,3);
                $content=substr($txt,6,strlen($txt)-6);
                if (!in_array($tag,$excludetags))
                    $arr_detail[$tag][] = $content;                
            }
            return $arr_detail;
        }
    }
	/*
	function getRecordHeader($hostid){
	    
	    if ($hostid === 1) {
    	    $marctags = MarcTags::getLocalArticleTags();
    	    $marclabels = Language::getMarcTags();
	    } else {
    	    $marctags = MarcTags::getLocalMonoTags();
    	    $marclabels = Language::getMarcTags();
	    }
	    
	    $s2  = '<table width="100%" border="0" cellpadding="5" cellspacing="0">';
	    $s2 .= '<tr>';
	    for ($i=0;$i<count($marctags);$i++) {
                $s2 .= '<th>';
                $s2 .= $marclabels[$marctags[$i]];
                $s2 .= '</th>';
	    }
	    $s2 .= '</tr>';
	    return $s2;
	}
    function getRecordRows($record,$hostid){
	    require_once(INCDIR.'marc_parser.php');
	    if ($hostid === 1) {
    	    $marctags = MarcTags::getLocalArticleTags();
    	    $marclabels = Language::getMarcTags();
	    } else {
    	    $marctags = MarcTags::getLocalMonoTags();
    	    $marclabels = Language::getMarcTags();
	    }
        static $j=1;
        $class = ($j%2==0) ? 'row1' : 'row2';
        //$s = NL.TAB.'<div id="record" class="'.$class.'">';
        $s2 = '<tr>';
        for ($i=0;$i<count($marctags);$i++) {
            $display_value = marcParse($record,$marctags[$i],SUBFLD.'a');


	    if (strlen($display_value) > 60 || $marctags[$i] == '998'){
                if ($marctags[$i] == '998') {
			$display_value = substr($display_value,2,strlen($display_value));
		} else{
			$display_value = substr($display_value,0,60).'...';
		}
            }
            $code = marcParse($record,999,SUBFLD.'a');
            $s2 .= '<td class="'.$class.'">';
            if ($marctags[$i] == '245') {
                $s2 .= '<a href="?mode='.$_REQUEST['mode'].'&m=search&search=1&a=details&id='.$code.'&curhost='.$hostid.'">'.$display_value.'</a>';
            } else {
                $s2 .= $display_value.'&nbsp;';
            }
            $s2 .= '</td>';
        }
        $s2 .= '</tr>';
        global $limit;
        
        if ($j == $limit-1) {
            $s2 .= '</table>';
        }
        $j++;
		return $s2;        
    }
	*/
    function getContents($record,$start){
        static $i=1;
        $class = ($i%2==0) ? 'row1' : 'row2';
        //$s = NL.TAB.'<div id="record" class="'.$class.'">';
		$s = NL.TAB.'<p>';
        $s2 = '';
        foreach ($record as $k => $v) {
            if ($k != 'code') {
                if ($k == 'title') {
                    $s2 .= '<strong>';
                    $s2 .= '<a href="?m=search&search=1&a=details&id='.$record['code'].'">';
                    $s2 .= $v;
                    $s2 .= '</a></strong>';                    
                } else {
                    $s2 .= NL.TAB.$v.'&nbsp;';
                }
                $s2 .= '<br>';
            }
        }
        
        $i++;
        //return $s .= $s2.NL.TAB.'</div>'.NL.TAB;
		return $s .= $s2.NL.TAB.'</p>'.NL.TAB;
    }
    function end(){
        //return '</table>';
    }
    
}

?>