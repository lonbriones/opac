<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: holdings.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


class Holdings {
    var $fid;
    var $format;
    var $columnfields;
    var $accessnos;
    var $status;
    
    function Holdings($fid){
        global $db;
        $this->fid = $fid;
        $uniqueFields = array('CALLNO','FID','PRFX');
        
        $flag = language::getStatusFlag();
        
        $sql = sprintf("select ACCESSNO,LOCATION,REGDATE,RENT,FLAG from control where fid='%s'",$fid);


		require_once(MODDIR.'mylib/MyLibrary.class.php');
        $unreturned_items=MyLibrary::getCircHistory('unreturned');
        $dat = $db->get_results($sql);
        
        for ($i=0;$i<count($dat);$i++) {

			foreach($dat[$i] as $fieldname => $value) {
               // if ($value=0) {continue};
				//print 'asdfasdfas';
				if ($fieldname == 'RENT') {
					if ($value==1) {
						$value = 1;
					} else 
					{
						$value =0;
					}

					//print "REGDATE: ".$dat[$i]['REGDATE'].'<BR>' ;
					
					$dt = explode(' ',incday($dat[$i]['REGDATE'],PROCESS_DAY));
					$_d = explode('/',$dt[0]);
					
					$plus_process_date = "{$_d[2]}-{$_d[0]}-{$_d[1]}";
					//print "PROCESS DATE NO: ".PROCESS_DAY.'<BR>' ;
					//print "PLUS PROCESS DATE: ".$plus_process_date.'<BR>' ;
					$plus_process_date = date("Ymd",strtotime($plus_process_date));
					$today = date("Ymd");
					//print "TODAY: ".date("Y-m-d").'<BR>' ;
					
					if (  $plus_process_date >  $today) {
						$value = 10;
					}
					
					for($j=0;$j<count($unreturned_items);$j++) {
						if ($dat[$i]['ACCESSNO'] == $unreturned_items[$j]['ACCESSNO']) {
							$value = 7;
							break;
						}
					}
					$this->columnfields[$i][$fieldname] = $flag[$value];
					$this->columnfields[$i]['RENTID'] = $value;
					
				}else if ($fieldname == 'FLAG') {
					if ($value=='R') {
						$value = 4;
                        $this->columnfields[$i][$fieldname] = $flag[$value];
  					    $this->columnfields[$i]['RENTID'] = $value;
					} elseif ($value=='L') {
						$value = 5;
                        $this->columnfields[$i][$fieldname] = $flag[$value];
  					    $this->columnfields[$i]['RENTID'] = $value;
					} elseif ($value=='D') { 
						$value = 6;
                        $this->columnfields[$i][$fieldname] = $flag[$value];
  					    $this->columnfields[$i]['RENTID'] = $value;
					} elseif ($value=='B') { 
						$value =11;
                        $this->columnfields[$i][$fieldname] = $flag[$value];
  					    $this->columnfields[$i]['RENTID'] = $value;
					} 
                }elseif ($fieldname == 'LOCATION') {
					$location = $db->get_var("select descrip from location where code = '$value'");
					if ($location=='') {
 					   $this->columnfields[$i][$fieldname]=$value;
					} else {
					   $this->columnfields[$i][$fieldname]=$location;
					}
				} else{
				
                    if (!in_array($fieldname,$uniqueFields)) {
                        $this->columnfields[$i][$fieldname] = $value;
						
					}
                }
				



            }
        }
    }
    function getFormat($fid){
		
    }
    function getStatByAccessNo($accessno){
        return  $this->columnfields[$accessno]['FLAG'];
    }
}

?>