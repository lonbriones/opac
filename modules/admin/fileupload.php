<?php
/**
 * handles file upload
 */

$msg = '';

if (isset($_FILES['userfile']) && ($_FILES['userfile']['type'] == 'text/html' || strpos($_FILES['userfile']['type'],'image') >= 0)) {
	$uploadfile = $path.'/' . $_FILES['userfile']['name'];
	
	if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
	    $msg .=  "File is valid, and was successfully uploaded. ";
	} else {
	    $msg .=  "Upload file failed";
	}
} else {
	if (isset($_FILES['userfile']['type']))
		$msg .= '<font color=red><b>Cannot upload the file. The file is invalid!</b></font>';
}

//print '<pre>';
//print_r($_FILES['userfile']);
//print '</pre>';

/**
 * handles deleteion
 */
if (isset($_REQUEST['action']) && isset($_REQUEST['file'])){
	if (!empty($_REQUEST['action']) && !empty($_REQUEST['file'])){
		$file = $_REQUEST['file'];
		if (!isset($_REQUEST['ans']) || (isset($_REQUEST['ans']) && $_REQUEST['ans'] != 'no')) {
			$msg = '<font color=red>Are you sure you want to delete <b>'.$file.'</b>?</font> ';
			$msg .= ' [ <a href="?'.$_SERVER['QUERY_STRING'].'&ans=yes">Yes</a> ] ';
			$msg .= ' [ <a href="?'.$_SERVER['QUERY_STRING'].'&ans=no">No</a> ] ';
			if (isset($_REQUEST['ans']) && $_REQUEST['ans'] == 'yes') {
				if (unlink($path.'/'.$file)) {
					$msg = '<font color=red><b>'.$file.' was deleted!</b></font>';
				}
			}
		}
	}
}

$d = dir($path);

// read dir
$dir = '';
$dir .= '<script>';
$dir .= 'function confirmDelete(){';
$dir .= 'if (confirm("are you sure" )';
$dir .= 'return false';
$dir .= '}';
$dir .= '</script>';
while (false !== ($entry = $d->read())) {
	if ($entry != '.' && $entry != '..') {
		$dir .= '<a href="?m='.$_REQUEST['m'].'&s='.$_REQUEST['s'].'&action=delete&file='.$entry.'">';
		$dir .= 'Delete';
		$dir .= '</a> ';
		$dir .=  $entry;
		$dir .=  "<br>";
	}
}

$d->close();

$smarty->assign('dir',$dir);
$smarty->assign('msg',$msg);
$content = THEMESDIR.THEME.'/post_subscription.html';
$content = THEMESDIR.THEME.'/fileupload.html';
?>
