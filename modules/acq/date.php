<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: date.php,v 1.1 2006/09/04 07:51:40 lon.briones Exp $

require_once(MODDIR.'acq/NewAcquisition.class.php');
$acq = new NewAcquisition();
$dat = $acq->getLastMonthCount(0);
print_r($dat);
$dat = $acq->display('date','asc');

$s = '';
foreach ($dat as $subject => $value) {
    $s .= '<h3>'.$subject.'</h3>';
    $s .= '<blockquote>';
    for ($i=0;$i<count($value);$i++) {
        
        foreach ($value[$i] as $tag=>$v) {
            if ($tag != 'date') {
                if ($tag == 'title') {
                    $s .= '<strong>'.$v.'</strong>';
                } else {
                    $s .= $v;
                }
                $s .= '<br>';
            }
        }
        $s .= '<br>';
    }
    $s .= '</blockquote>';
    
}

$smarty->assign('dat',$s);
$content = THEMESDIR.THEME.'NewAcquisition.html';	
?>