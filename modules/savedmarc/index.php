<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: local.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


$smarty->assign('base',isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
$content = THEMESDIR.THEME.'local.html';
unset($search);
unset($isTerm);
?>