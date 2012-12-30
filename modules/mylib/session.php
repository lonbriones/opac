<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: session.php,v 1.1 2006/09/04 07:51:41 lon.briones Exp $


if (!isset($_SESSION['islogon']) && $_SESSION['islogon']!= false) {
	$content = THEMESDIR.THEME.'login.html';
}
?>