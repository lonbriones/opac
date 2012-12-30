<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: Admin.class.php,v 1.1 2006/09/04 07:51:40 lon.briones Exp $


require_once(INCDIR.'ez_sql_firebird.php');

class Admin {
    var $password;
    var $islogon;
    var $error;
    function Admin() { 
        //global $vtlog;
        require_once(MODDIR.'admin/adminpass.php');
        $this->password = $password;
        if (!isset($_SESSION['isAdminLogon'])) {
            $_SESSION['isAdminLogon'] = false;
            //$vtlog->logthis('admin: islogon=false','info');
        }
        if (!$_SESSION['isAdminLogon']) {
            $this->islogon = false;
        } else {
            $this->islogon = true;
        }
    }
    function validate($password) {
        if ($this->password == $password) {
            $this->islogon = true;
            $_SESSION['isAdminLogon'] = true;
            header("location: index.php?m=admin&s=notice");
            return true;
        } else {
            $this->islogon = false;
            $_SESSION['isAdminLogon'] = false;
            $this->error = 'Invalid password';
            return false;
            
        }
    }
    function post($subject,$notice){
        global $db;
        

        if (trim($subject) == '' || trim($notice) == '') {
            $this->error = 'Please enter subject & notice';
            return false;
        }

        $notice = str_replace(chr(10),'<br>',$notice);
		

        $date = date('m/d/Y');
        
        $sql = sprintf("
        INSERT INTO NOTICE
          (NOTICENO,pdate,title,msg)
        VALUES
          (NULL,'%s','%s','%s')",$date,$db->escape($subject),$db->escape($notice));
        if (!$db->query($sql)) {
            $this->error = 'Server error';
            return false;
        } else {
            return true;
        }
    }
    function getNoticeDates() {
    	global $db;
    	$sql = "select count(pdate) as pdate_count,pdate from notice group by pdate order by pdate desc";
    	return $db->get_results($sql,ARRAY_A);
    }
    function deleteNotice($noticeno){
    	global $db;
    	$sql = sprintf("delete from notice where noticeno=%d",$noticeno);
    	return $db->query($sql);
    	
    }
    function getNotice($date=null){
        global $db;
        $where = '';
        if ($date) {
        	$where = " where pdate= '$date' ";
        }
        $sql = "select * from notice $where order by noticeno desc";
        return $db->get_results($sql,ARRAY_A);
    }
    function getUserRequests(){
        global $db;
        $sql = "select * from request order by requestno desc";
        return $db->get_results($sql,ARRAY_A);
    }
    function changePassword($p1,$p2) {
        global $db;
        if ($this->passwordMatch($p1,$p2)) {
            
                
                $filename = MODDIR.'admin/adminpass.php';
                
                $content = '<?php $password="'.$p1.'"?>';
                
                // Let's make sure the file exists and is writable first.
                if (is_writable($filename)) {
                    unlink($filename);
                    // In our example we're opening $filename in append mode.
                    // The file pointer is at the bottom of the file hence 
                    // that's where $somecontent will go when we fwrite() it.
                    if (!$handle = fopen($filename, 'a')) {
                         echo "Cannot open password file";
                         exit;
                    }
                
                    // Write $somecontent to our opened file.
                    if (fwrite($handle, $content) === FALSE) {
                        $this->error = "Cannot write to password file";
                        exit;
                    }
                    
                    fclose($handle);
                    $this->message = 'Password was changed';
                    return true;
                                    
                } else {
                    echo "The file $filename is not writable";
                }

            
        }
    }
    function passwordMatch($p1,$p2){
        if (empty($p1)) {
            $this->error = 'Passwords cannot be empty.';
            return false;
        }    
        if (strlen($p1) < 6) {
            $this->error = 'Password is too short';
            return false;
        } 
        if (strcmp($p1,$p2) == 0) {
            return true;
        } else {
            $this->error = 'Passwords do not match';
            return false;
        }
    }    
    
}
?>