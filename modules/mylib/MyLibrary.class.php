<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: MyLibrary.class.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


require_once(INCDIR.'ez_sql_firebird.php');

class MyLibrary {
    var $borrowid;
    var $password;
    var $error;
    var $islogon;
    var $jumpPage;
    
    function MyLibrary() {
        //global $vtlog;
        $this->jumpPage = "index.php?m=mylib&s=hist";
        if (!isset($_SESSION['islogon'])) {
            $_SESSION['islogon'] = false;
            //$vtlog->logthis('mylib: islogon=false','info');
        }
        if (!$_SESSION['islogon']) {
            $this->islogon = false;
        } else {
            $this->islogon = true;
        }
    }
    function validate($borrowid,$password) {
        global $db;
        //global $vtlog;
//        if (empty($password) && empty($borrowid)) {
        if ( empty($borrowid)) {
            $this->error = 'Enter ID and Password';
            return false;
        }
        if ($this->borrowidExists($borrowid)) {
            if($this->validUserPassword($borrowid,$password)) {
 
				$_SESSION['islogon'] = true;
                $this->islogon = true;
                $this->getUserInfo($borrowid,$password);
				if (empty($password)) {
					//print '<script type="text/javascript">alert(); document.location="index.php?m=mylib&s=pass"; </script>';
					print '<html><body><script type="text/javascript">alert("For your privacy, please make a password."); document.location="index.php?m=mylib&s=pass&a=new"; </script></body></html>';exit();
				} else {
					header("location: index.php?m=mylib&s=hist");exit();
				}				
                //header("location: ".$this->jumpPage);
            } else {
                $this->islogon = false;
                $this->error = 'Invalid Password';
              //  $this->error = 'Invalid  password';
                return false;
                //$this->gotoLogin();
            }
        } else {
            $this->error = 'Invalid User ID';
            //$this->error = 'Invalid User ID';
            return false;
        }
    }
    function getUserInfo($borrowid,$password){
        global $db;

    	//require_once(INCDIR.'XPath.class.php');
    	
        //$xpath = & new XPath();
        
        $sql_pass = $this->getSqlPass($password);
        $sql = sprintf("select * from patrons where borrowid='%s' and %s",$borrowid,$sql_pass);    
        $dat = $db->get_row($sql);

        $_SESSION['borrowid'] = $dat->BORROWID;
        $_SESSION['passwd'] = $dat->UPASS;
        
        $fname = $dat->FNAME;
        $lname = $dat->LNAME;
        $_SESSION['fname'] = $dat->FNAME;
        $_SESSION['lname'] = $dat->LNAME;

    }


	function getUserGroupId($borrowid) {
		global $db;
		$sql = sprintf("select groupid from patrons where borrowid='%s'",$borrowid);  
		$dat = $db->get_row($sql);  
		return $dat;
	}

    function borrowidExists($borrowid){
        global $db;
        //global $vtlog;
        
        $sql = sprintf("select count(*) from patrons where borrowid = '%s'",$borrowid);
        if ($db->get_var($sql)) {
            //$vtlog->logthis("mylib: borrowid exists",'info');
            return true;
        }    
    }
    function encrypt($string) { //hash then encrypt a string
        //if ($string) {
        //    $crypted = crypt(md5($string), md5($string));
        //    return $crypted;
        //}
        return $string;
    }
    function passwordMatch($p1,$p2){
		/*
        if (empty($p1)) {
            $this->error = 'Passwords cannot be empty.';
            return false;
        }    
        if (strlen($p1) < 6) {
            $this->error = 'Password is too short';
            return false;
        } 
		*/

        if (strcmp($p1,$p2) == 0) {
            return true;
        } else {
            $this->error = 'Passwords do not match';
            return false;
        }
    }
    function getSqlPass($p) {
        if (!$p) {
            $sql_pass = "UPASS =''";
        } else {
            $sql_pass = sprintf("UPASS='%s'",$p);;
        }
        return $sql_pass;        
    }
    function validUserPassword($borrowid,$p){
        global $db;
        $sql_pass = $this->getSqlPass($p);
        $sql = sprintf("select count(*) from patrons where borrowid='%s' and %s",$borrowid,$sql_pass);

		//print $sql;

        if ($db->get_var($sql))
            return true;
		/*
        else {
            $this->error = 'User does not exists';
            return false;
        }
		*/
    }
    function changePassword($p1,$p2) {
        global $db;
        if ($this->passwordMatch($p1,$p2)) {
            if ($this->validUserPassword($_SESSION['borrowid'],$_SESSION['passwd'])) {
                $newpass = $this->encrypt($p1);
                $sql = sprintf("update patrons set upass='%s' where borrowid='%s'",$newpass,$_SESSION['borrowid']);
                if ($db->query($sql)){
                    $_SESSION['passwd'] = $newpass;
                    return true;
                } else {
                    $this->error = 'Server error. Password was not changed.';
                }   
            }else {
                return false;
            }
        }
    }
	function getCirculationItemByUserId($userid,$accession){
		global $db;
		//"select from "
	}
	function getRenewalDays($groupid) {
		global $db;
		$sql = "select settings from groups where code='$groupid'";
		$cXml = $db->get_var($sql);
		
		require_once ('include/XPath.class.php');
		$xmlOptions = array(XML_OPTION_CASE_FOLDING => TRUE, XML_OPTION_SKIP_WHITE => TRUE);
		$xPath =& new XPath(FALSE, $xmlOptions);

		if (!$xPath->importFromString($cXml)) { echo $xPath->getLastError(); exit; }
		return  $xPath->getData("/$groupid/DURATIONS/RENEWALS");
	}

	function renewItem($borrowid,$accessno,$new_due) {
		global $db;
		$sql = "update circ set due='$new_due',renew_flg=1 where userid='$borrowid' and accessno='$accessno' and chkin is null and renew_flg is null";
		return $db->query($sql);
	}
	
    function getCircHistory($type = ''){


        if (!isset($_SESSION['borrowid'])) return false;
		global $db;
        require_once(INCDIR.'YazConnectionManager.class.php');
        require_once(INCDIR.'marc_parser.php');
        

        $where = '';
        if ($type == 'borrowed') {
        	$where = ' and circ.chkin is not null '; //Please list all the items here.. must have date range..
        } elseif ($type == 'unreturned') {
        	$where = ' and circ.chkin is null ';
        } elseif ($type == 'renewal'){
			$where = ' and circ.chkin is null and (current_date <= circ.due ) and circ.renew_flg is null';
		} elseif ($type == 'overdue') {
        	//$where = ' and (chkin is null and chkin > due) ';
			$where = ' and (circ.chkin is null and current_date > circ.due and circ.LOSTDATE is null)'; 
			//<-- edited by wilson when rent is equal to 8 this mean that the item 
			//is known to be or set to be lost or missing.. and the flag must
			//be 5..
        }
        
        $sql = sprintf("select circ.*,control.* from circ,control where circ.accessno = control.accessno and circ.userid = '%s' $where order by chkin desc",$_SESSION['borrowid'] );



        $dat = $db->get_results($sql,ARRAY_A);


        $yazconn =& new YazConnectionManager();
        

        for($i=0;$i<count($dat);$i++) {
            $marc = $yazconn->yazSearchById($dat[$i]['FID'],0);
            $dat[$i]['TITLE'] = parse('title',$marc[0]);
            $dat[$i]['AUTHOR'] = parse('author',$marc[0]);
            
        }
        return $dat;
    }

    
    function request($ISBN,$TITLE,$AUTHOR,$PUBLISHER,$NOTE){
        global $db;
        $date_format = "m/d/Y";
        $date = date($date_format);
        
        if (trim($TITLE) == '' || trim($AUTHOR) == '') {
            $this->error = 'Please enter at least a <strong>title</strong> or <strong>author</strong>';
            return false;
        }
        $sql = sprintf("INSERT INTO REQUEST
                (REQUESTNO,PATRONID,RQDATE,STATUS,ISBN,TITLE,AUTHOR,PUBLISHER,RQYEAR,NOTE)
                VALUES(
                NULL,'%s','%s',NULL,'%s','%s','%s','%s',NULL,'%s');",
                $_SESSION['borrowid'],
				$db->escape($date),
				$db->escape($ISBN),
				$db->escape($TITLE),
				$db->escape($AUTHOR),
				$db->escape($PUBLISHER),
				$db->escape($NOTE));
        if ($db->query($sql)) {
            return true;
        } else {
            $this->error = "Server error. Your request was not sent. Sorry for the incovinience, please try again later.";
            return false;
        }
    }
	
	function getReserv($borrowid=''){
		global $db;
        require_once(INCDIR.'YazConnectionManager.class.php');
        require_once(INCDIR.'marc_parser.php');
		$dat2 = $dat = array();
		

		//$sql = "select r.*,c.accessno from reservations r,control c  where c.fid = r.fid and userid = '$borrowid' //and stat in ('0','1')";
		$sql = "select ACCESSNO from reservations where userid = '$borrowid' order by RES_DATE desc ";

		$dat = $db->get_results($sql,ARRAY_A);
		
		for ($i=0;$i<count($dat);$i++) {
			$dat[$i] = $dat[$i];
			$dat2[] = $db->get_row("select * from control where fid='{$dat[$i]['ACCESSNO']}'", ARRAY_A);
		}

		$yazconn =& new YazConnectionManager();
		
		
		
		for ($i=0;$i<sizeof($dat2);$i++) {
            $marc = $yazconn->yazSearchById($dat2[$i]['FID'],0);
            $dat2[$i]['TITLE']  = parse('title',$marc[0]);
			$dat2[$i]['CALLNO'] = parse('callno',$marc[0]);
            $dat2[$i]['AUTHOR'] = parse('author',$marc[0]);
              
			if ($dat2[$i]['FID']='0') {
               $dat2[$i]['STATUS'] = 'On Shelf';
			} else {
               $dat2[$i]['STATUS'] = 'On Loan';
			}


		}
		
		return $dat2;
	}


	function setReserv($borrowid,$accessno) {
		global $db;

        $date = date('m/d/Y');

		if ($db->get_var("select flag from control where accessno='$accessno'")!='B' )
		{

		  $sql = "insert into reservations (userid,accessno,RES_DATE) values ('$borrowid','$accessno', '$date' )";
		  $db->query($sql);
 	      $sql = "update control set flag = 'B' where accessno='$accessno' ";
		  return $db->query($sql);
		  
		} else {
		}
		
		/*
		if ($db->get_var("select count(*) from reservations where userid='$borrowid' and fid='$fid'")){
			$sql = "update reservations set stat = '1' where userid='$borrowid' and fid='$fid'";
			return $db->query($sql);
		} else {
			$sql = "insert into reservations (userid,fid,stat) values ('$borrowid','$fid','0')";
			return $db->query($sql);
		}
		*/
	}
	function cancelReserv($borrowid,$fid,$accessno) {
		global $db;

		$sql = "delete from RESERVATIONS where USERID='$borrowid' and accessno = '$accessno'";
		$db->query($sql);
//		$sql = "update reservations set stat = '3' where userid='$borrowid' and fid='$fid'";
//		$db->query($sql);
		$sql = "update control set FLAG=' ' where accessno = '$accessno'";
		$db->query($sql);
		return true;
	}
    function getUserRequests(){
        global $db,$LANG;
        $sql = "select * from request where patronid = '".$_SESSION['borrowid']."' order by requestno desc ";
		$dat = $db->get_results($sql,ARRAY_A);
		for ($i=0;$i<count($dat);$i++) {
			foreach($dat[$i] as $k => $v) {
				if ($k == 'STATUS') {
					
					$dat[$i]['STATUS'] = $LANG['onhold'];
					
					if (trim($v) != '') {
						if ($v == '1') {
							$sql = "select * from acqu where requestno = ".$dat[$i]['REQUESTNO'];
							$dat2 = $db->get_row($sql,ARRAY_A);
							

							$dat[$i]['STATUS'] = $LANG['placedorder'].'<br>';
							$dat[$i]['STATUS'] .= '&nbsp;&nbsp;&nbsp;'.$LANG['date_order'].': '.$dat2['ORDERED'].'<BR>';
							$dat[$i]['STATUS'] .= '&nbsp;&nbsp;&nbsp;'.$LANG['date_received'].': '.$dat2['RECEIVED'].'<BR>';
							$dat[$i]['STATUS'] .= '&nbsp;&nbsp;&nbsp;'.$LANG['date_released'].': '.$dat2['RELEASED'].'<BR>';
							
							
						} elseif ($v == '2') {
							$dat[$i]['STATUS'] = $LANG['rejected'].' - '.$dat[$i]['REJECT'];
						}
					} 
					
				}
			}
			/*
			while (current($dat[$i])) {
				$key = trim(key($dat[$i]));
			   if ($key == 'STATUS') {
				   $dat[$i]['STATUS'] = 'on hold';
				   if ($dat[$i]['STATUS'] != '') {
				   		$dat[$i]['STATUS'] = 'On Process';
				   } 
			   }
			   next($dat[$i]);
			}
			*/
		}
		reset($dat);
        return $dat;
    }
	
}


?>