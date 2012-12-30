<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: NewAcquisition.class.php,v 1.1 2006/09/04 07:51:40 lon.briones Exp $


//require_once(INCDIR.'ez_sql_firebird.php');
class NewAcquisition {
    var $data;
    function _NewAcquisition() {
        global $db;
        $sql = "select * from acqu,jmarc where acqu.fid = jmarc.fid";
        $this->data = $db->get_results($sql);
    }
    function sortByDate(){
        
    }
	function monthAgo($nMonth){
		$curr_month = date("m-01-Y",mktime(0,0,0,date("m")+$nMonth,"01",date("Y")));
		
		return $curr_month;
	}
    function getLastMonthRange($nMonth,$formatted=false) {
		$lastmonth = date("Y/m/01",mktime(0,0,0,date("m")-$nMonth,"01",date("Y")));
    	$date = $lastmonth;
    	//$date_end = date("m/t/Y",strtotime($date));
    	//$date_start = date("m/01/Y",strtotime($date));
		if (!$formatted) {
			$date_end = date("Ymt",strtotime($date));
			$date_start = date("Ym01",strtotime($date));
			$date_start = substr($date_start,2,strlen($date_start));
			$date_end = substr($date_end,2,strlen($date_end));
		}else {
    		$date_end = date("m/t/Y",strtotime($date));
    		$date_start = date("m/01/Y",strtotime($date));
		}
    	$dt[0] = $date_start;
    	$dt[1] = $date_end;
    	return $dt;
    }

    function getLastMonth($nMonth){
    	global $db;
    	$dt = $this->getLastMonthRange($nMonth);
    	$sql = "select j.marc,j.fid,c.location from jmarc j,control c where c.regdate between '".$dt[0]."' and '".$dt[1]."' order by c.regdate desc";
    	return $db->get_results($sql);
    }    
    function getLastMonthCount($nMonth){
    	global $db;
    	$dt = $this->getLastMonthRange($nMonth);
    	$sql = "select count(*) from jmarc j,control c where c.regdate between '".$dt[0]."' and '".$dt[1]."'";
    	return $db->get_var($sql);
    }    
    function display($sortby='date',$sorttype='asc'){
        $value = array();
        for ($i=0;$i<count($this->data);$i++) {
            $dat   = $this->data[$i];
            $date  = $dat->RECEIVED;
            $marc = $this->parsemarc($dat->MARC);
            
            for ($j=0;$j<count($marc);$j++) {
                foreach ($marc[$j] as $k=>$v) {
                    if ($k==245) {
                        $title = str_replace(' /','',$v['a']);
                        $author = str_replace(' /','',$v['c']);
                    }elseif ($k==650){
                        $subject = $v['a'];
                    }
                }
            }
            if (!isset($subject)){
                $subject = 'No Subject';
            }
            $val['title'] = $title;
            $val['author'] = $author;
            $val['date'] = $date;
            $val['subject'] = $subject;
            
            
            if ($sortby == 'date') {
                $value[$date][] = $val;
            } else {
                $value[$subject][] = $val;
            }
            
        }
        if ($sorttype == 'asc') {
            asort($value);
        } else {
            rsort($value);
        }
        return $value;
    }
    function parsemarc($s) {
        $SUBFLD='$';
        $FLDTER='%';
        $arr_marc = explode("\n",$s);
        $marc = array();
        for ($i=3;$i<count($arr_marc);$i++) {
            $tag = substr($arr_marc[$i],0,3);
            $value = substr($arr_marc[$i],5,strlen($arr_marc[$i]));
            $cRtn="";
            $j=0;
            while ($value{$j}!=$FLDTER && $value{$j}!="") {
                if ($value{$j}==$SUBFLD) {
                    $field = $value{$j+1};
                    $cRtn = '';
                    
                    $j=$j+2;
                    continue;
                } else {
                    $val[$field] = $cRtn.=$value{$j};
                }
                $j++;
            }
            $marc[][$tag]=$val;
        }
        return $marc;
    }
}

?>
