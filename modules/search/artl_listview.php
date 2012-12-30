<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: listview.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


$hidden .= "<input type=hidden name=mode value={$_REQUEST['mode']}>";
$hidden .= "<input type=hidden name=mode value={$_REQUEST['mode']}>";
$smarty->assign('hidden',$hidden);
unset($hidden);

require_once(INCDIR.'MarcTags.class.php');
require_once(INCDIR.'YazConnectionManager.class.php');
require_once(INCDIR.'YazQueryBuilder.class.php');
require_once(MODDIR.'search/DataGrid.class.php');
require_once(INCDIR.'marc_parser.php');


$yazq = new YazQueryBuilder();
$yazq->term=$term;
$yazq->field=$field;
$yazq->boolean=$boolean;
$wordopt = Language::getWordOpt();
$yazq->aWordOpt = $wordopt[$_REQUEST['word_opt']];

$hosts = $_REQUEST['host'];
$default_host = $hosts[0];
$curhost = isset($_REQUEST['curhost']) ? $_REQUEST['curhost'] : $default_host;
$curhost_name = YazConnectionManager::getHostName($curhost);
$query = $yazq->buildQuery();
$yazconn = new YazConnectionManager();

$other_hits = array();

for ($i=0;$i<count($hosts);$i++) {
    $yazconn->connect($hosts[$i],$query);
}
$limit = 10;
$start = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : 1;

$search_result = ($yazconn->getSearchResults($curhost,$start,$limit,false));
$curhost_hits = $yazconn->getHits($curhost);

$nav = getNavigationValues($start, $curhost_hits, $limit);

$rec = '';

function parsefromtpl ($arg){
    return parse($arg['field'],$arg['marc']);
}

$smarty->register_function('parse','parsefromtpl');
$smarty->assign('marc',$search_result);
$smarty->assign('hostname',$curhost_name);

if ($curhost_hits) {
    $hitsinfo = "Displaying : $start - {$nav['end_val']} of <strong>{$curhost_hits}</strong>";
    $nav = getNavArrows($nav,0);
    $smarty->assign('hitsinfo',$hitsinfo);
	$smarty->assign('curhost',$curhost);
    $smarty->assign('nav',$nav);
    $smarty->assign('mode',$mode);
	$savednum = count($_SESSION[$curhost_name]);
	$smarty->assign('savednum',$savednum);

    $content = THEMESDIR.THEME.'artl_listview_tab.html';
    //$smarty->assign('record',$rec_str);
} else {
    if ($errormsg = $yazconn->ErrMsg[$curhost]){
        $smarty->assign('hitsinfo',$errormsg);
    } else {
        $smarty->assign('hitsinfo','No record found.');
    }   
    $content = THEMESDIR.THEME.'listview_no_data.html';     
}



unset($yazconn);
?>