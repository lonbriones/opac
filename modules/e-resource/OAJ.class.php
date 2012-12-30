<?php

class oaj {
	function getCategory(){
		global $db;
		return $db->get_results ("select setname,count(*) as ncnt from doajsubset group by setname");
	}
	function getSubjects($category=''){
		global $db;
		if (!$category) {
			$categories = oaj::getCategory();
			for ($i=0;$i<sizeof($categories);$i++) {
				$subjects[][$categories[$i]['SETNAME']] = $db->get_results ("select sub_setname,count(*) as ncnt from doajsubset where setname='".$categories[$i]['SETNAME']."' group by sub_setname");
			}
		} else {
			$subjects = $db->get_results ("select sub_setname,count(*) as ncnt from doajsubset where setname='".$category."' group by sub_setname");
		}
		return $subjects;
	}
	function getSubjectEntries($setname, $subject){
		global $db;
		$sql = "select IDENTIFIER from doajsubset where setname = '$setname' and sub_setname = '$subject'";
//select r.xml from doajrecord r, doajsubset s where s.identifier=r.identifier and  s.setname='Arts and Architecture' //and s.sub_setname='History of arts'
       // print $sql; 


		$dat = $db->get_results($sql);
         
       

		for ($i=0;$i<count($dat);$i++) {
			
//			$xml = $this->getXML($dat[$i]['DOAJSUBSET_ID']);
			$xml = $this->getXML($dat[$i]['IDENTIFIER']);
			$dat[$i]['XML'] = $xml;
		}
		return $dat;
	}
	function getXML($IDENTIFIER){
		global $db;
		
// print 'CHUNG'.$IDENTIFIER;

		$xmlString = $db->get_blob("select xml from doajrecord where IDENTIFIER = '".$IDENTIFIER."'");
		$pos=strpos($xmlString,"?>"); 
		$xmlString = substr($xmlString,$pos+2); 
		$xml_encoding = '<?xml version="1.0" encoding="ISO-8859-1"?>'; 
		$xmlString = $xml_encoding.$xmlString;
		$xh = xslt_create();
		$arguments = array('/_xml' => $xmlString);
		$parameters = array(
		);
		$xsl_dir = XSLPATH;
		$dat = (xslt_process($xh, 'arg:/_xml', "$xsl_dir/oai.xsl", NULL, $arguments,$parameters));
		
		return $dat;
	}
		function getJournalCount(){
		global $db;
		$sql ='select count(*) from doajRecord';
		return $db->get_var($sql);
		
	}

	
}
?>