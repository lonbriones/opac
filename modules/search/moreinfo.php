<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: moreinfo.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


require_once (INCDIR.'ez_sql_firebird.php');
require_once(MODDIR.'search/holdings.php');
$holdings = new Holdings($id);
$dat = $holdings->columnfields;
$smarty->assign('collection_status',$dat);



/*
$sql = sprintf("select contents from MOREINFO where fid='%s'",$id);
$contents = $db->get_var($sql);

require_once (INCDIR.'XPath.Class.php');
$xPath =& new XPath();
$xPath->importFromString($contents);

$dat= $xPath->getData('/MOREINFO/INDEX');
$dat=str_replace(chr(10),'<br>',$dat);
$smarty->assign('book_INDEX',$dat);

$dat= $xPath->getData('/MOREINFO/AUTHOR_INTR');
$dat=str_replace(chr(10),'<br>',$dat);
$smarty->assign('AUTHOR_INTR',$dat);

$dat= $xPath->getData('/MOREINFO/PREFACE');
$dat=str_replace(chr(10),'<br>',$dat);
$smarty->assign('PREFACE',$dat);

$dat= $xPath->getData('/MOREINFO/ABSTRACT');
$dat=str_replace(chr(10),'<br>',$dat);
$smarty->assign('ABSTRACT',$dat);

*/

/*
$s = '';

if ($count = count($dat)){
   
    $s .= "<table border=0 cellpadding=5 cellspacing=1 width=600>";
    $s .= "<tr>";
    $s .= "<th>Accession No.</th>";
    $s .= "<th>Location</th>";
    $s .= "<th>Status</th>";
    $s .= "</tr>";
    
    for ($i=0;$i<count($dat);$i++) {
        $s .= "<tr>";
        $s .= "<td class=row1>{$dat[$i]['ACCESSNO']}</td>";
        $s .= "<td class=row1>{$dat[$i]['LOCATION']}</td>";
        $s .= "<td class=row1>{$dat[$i]['FLAG']}</td>";
    }
    $s .= "</tr></table>";
}
*/
/*
    [CTLNO] => 2
    [FID] => 060810023504729
    [PRFX] => 
    [CALLNO] => 781.5/g555l-c1904
    [ACCESSNO] => 00000005
    [LOCATION] => 2nd Floor College Library
    [REGDATE] => 08/10/2006
    [FLAG] => 1
    [FLDATE] => 08/10/2006
    [RENT] => 
*/
//$smarty->assign('moreinfo',$s);

?>