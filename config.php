<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: config.php,v 1.2 2006/09/04 08:02:00 lon.briones Exp $

define('WEBADDR','http://localhost:80/index.php',true);
define('ABSDIR','c:/Files/webopac/',true);
define('INCDIR',ABSDIR .'include/',true);
define('SMARTYDIR',INCDIR.'Smarty-2.6.12/libs/',true);
define('THEMESDIR',ABSDIR .'themes/',true);
define('THEMESURL','themes/',true);
define('LANGDIR',ABSDIR.'language/',true);
define('MODDIR',ABSDIR.'modules/',true);
define("XSLPATH","file://".ABSDIR."modules/e-resource/xsl");

define('LANG','en',true);
define('NL',"\n",true);
define('TAB',"\t",true);
define('THEME','blue/',true);

define('DBNAME','localhost:C:\MAELISA3\DB\MAELISA3.FDB',true);
define('DBPASS','masterkey',true);
define('DBUSER','SYSDBA',true);
define('DBCHARSET','',true);
define('PROCESS_DAY','0');

define('LIBRARY_NAME','Welcome to UP Main Library');
define('LIBRARY_ADDRESS','Intramuros Manila');
define('LIBRARY_PHONE','Tel : 02) 525-0217');

/*
define('DEFAULT_SEARCH_PAGE','artl');   
*/
define('DEFAULT_SEARCH_PAGE','local');  

/**
 * based on you mail configuration choose from these 3 mailers
 * mail, sendmail, smtp
 **/
//define('MAILER','mail');
//define('MAILER','sendmail');
define('MAILER','smtp');

define('MAIL_SERVER','mail.maelisa.com');
define('MAIL_USERNAME','deform_perspective');
define('MAIL_PASSWORD','');
define('MAIL_PORT',25);
define('MAIL_SUBJECT','LIBRARY SEARCH RESULT');
define('MAIL_FROM','deform_perspective@yahoo.co.uk');
define('MAIL_FROMNAME','lon briones');

?>