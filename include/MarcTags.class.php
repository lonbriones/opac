<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: MarcTags.class.php,v 1.1 2006/09/04 07:51:18 lon.briones Exp $
class MarcTags {
    function getExcludedMonoTags() {
        return array(
         '020'
	    ,'010'
        ,'049'
		,'035'
		,'040'
        ,'008'
        ,'915'
        ,'998'
        ,'997'
        ,'999'
        ,'931'
        ,'913'
        ,'914'
        ,'005'
        ,'916'
        ,'930'
		,'362'
		,'510'
		,'852'
        );
    }
    function getLocalMonoTags(){
        return array(
         '998' //=> 'Isbn'
        //,'050' //=> 'Call No'
        ,'090' //=> 'Call No'
        //,'100' //=> 'Related Name'
        //,'110' //=> 'Corporate Name'
        //,'111' //=> 'Meeting Name'
        //,'130' //=> 'Uniform Title'
        //,'240' //=> 'Uniform Title'
        ,'245' //=> 'Title  / Author'
        //,'250' //=> 'Edition'
        ,'260' //=> 'Publication'
        //,'533' //=> 'Volume'
        //,'600' //=> 'Subject Related Name'
        //,'610' //=> 'Subject Meeting Name'
        //,'611' //=> 'Subject Uniform Title'
        //,'650' //=> 'Subject Topical'
        //,'700' //=> 'Related Name'
        //,'710' //=> 'Corporate Name'
        //,'711' //=> 'Meeting Name'
        //,'912' //=> 'Material Type'      
        );
    }
    function getLocalArticleTags() {
        return array(
         //'998' //=> 'Isbn'
        //,'050' //=> 'Call No'
        //,'090' //=> 'Call No'
        //,'100' //=> 'Related Name'
        //,'110' //=> 'Corporate Name'
        //,'111' //=> 'Meeting Name'
        //,'130' //=> 'Uniform Title'
        //,'240' //=> 'Uniform Title'
        '245' //=> 'Title  / Author'
        //,'250' //=> 'Edition'
        ,'260' //=> 'Publication'
        ,'533' //=> 'Volume'
        //,'600' //=> 'Subject Related Name'
        //,'610' //=> 'Subject Meeting Name'
        //,'611' //=> 'Subject Uniform Title'
        //,'650' //=> 'Subject Topical'
        //,'700' //=> 'Related Name'
        //,'710' //=> 'Corporate Name'
        //,'711' //=> 'Meeting Name'
        //,'912' //=> 'Material Type'      
        );        
    }
}
?>