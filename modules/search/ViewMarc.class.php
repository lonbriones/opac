<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: ViewMarc.class.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


require_once(INCDIR.'YazConnectionManager.class.php');

require_once(INCDIR.'marc_parser.php');
$hostid = $_REQUEST['curhost'];
if ($hostid === 1) {
	$marctags = language::getArticleMarcTags();
} else {
	$marctags = language::getMarcTags();
}
$yazconn = new YazConnectionManager();


class ViewMarc {
    var $fid;
    var $marc;
    
    function ViewMarc($fid){
        global $yazconn;
        
        $this->fid = $fid;
        
        $yazconn = new YazConnectionManager();
        
        $hostname = $yazconn->getHostName($hostid);
        $rec = $yazconn->yazSearchById($fid,$hostid);
        $this->marc = $rec[0];
        
    }
    function display(){
        
    }
}
?>