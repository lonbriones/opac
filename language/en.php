<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Author: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// +----------------------------------------------------------------------+
//
// $Id: en.php,v 1.2 2006/09/04 08:04:08 lon.briones Exp $

$LANG = array(
//	'charset'=>'iso-8859-1'
	'language' => 'English' 
	,'charset'=>'utf-8'
	,'search'=>'Searchss'
	,'title'=>'title'
	,'author'=>'author'
	,'login'=>'login'
	,'library'=>'library'
	,'mylibrary'=>'my library'
	,'admin'=>'admin'
	,'logout'=>'logout'
	,'local_resources'=>'local resources'
	,'other_resources'=>'other resources'
	,'library_rules'=>'library rules'
	,'library_guides'=>'library guides'
	,'my_library'=>'my library'
	,'circ_history'=>'circulation history'
	,'check_reservation'=>'check reservation'
	,'admin'=>'admin'
	,'notice'=>'notice'
	,'onhold'=>'On Hold'
	,'rejected'=>'Rejected'
	,'placedorder'=>''
	,'date_order'=>'Date of Order'
	,'date_received'=>'Date Received'
	,'date_released'=>'Date Released'
	//Menu
	,'home'=>'Home'
	,'back_to_home'=>'Back to home'
	,'notice_archive' => 'Notice Archive'
	,'user_login' => '<strong>User Login</strong>'
	
	,'search_local_library' => 'Search Local Library'
	,'search_article' => 'Search Article'
	,'search_other_resources' => 'Search Other Resources'
	,'view_saved_items' => 'View Saved Items'
	,'new_acquisition' => 'New Acquisition'
	,'library_guide' => 'Library Guide'
	,'my_library' => 'My Library'
	,'circulation_history' => 'Circulation History'
	,'renewal' => 'Renewal'
	,'request_a_book' => 'Request Book'
	,'check_requested_books' => 'Check Requested Book'
	,'check_reservation' => 'Check Reservation'
	,'change_password' => 'Change Password'
	,'hello' => 'Hello'
	,'admin_login' => 'Admin login'
	,'add_notice' => 'Add Notice'
	,'post_journal' => 'Post Journal'
	,'post_library_guide' => 'Post Library Guide'
	,'view_user_requests' => 'View User Requests'
	,'admin_logout' => 'Admin logout'		

	//Search Form
	,'word_option' => 'Word option'
	,'left_anchor' => 'Left anchor'
	,'any_order' => 'Any order'
	,'field' => 'Field'
	,'advancedsearch' => 'Advanced Search'
	,'simplesearch' => 'Simple Search'
	,'please_enter_keyword' => 'Please enter keyword'
	,'search_term' => 'Search term'
	,'reset' => 'Reset'

	//Search Form dropdown fields
	,'mono_fields' => array(
		'Any'           => '@attr 1=1016'
		,'Title'         => '@attr 1=4'
		,'Author'       => '@attr 1=1003'
		,'ISBN'         => '@attr 1=7'
		,'Publisher'    => '@attr 1=1018'
		,'Subject'      => '@attr 1=21'
		,'CallNo'       => '@attr 1=20'
		,'Date'         => '@attr 1=30'
	)



);
if (!class_exists('Language')) {
class Language {
    function getHosts(){
        return array (
			array('localhost:210/MONO','Local Collection') 
            ,array('localhost:210/arti','Local Article')   
            ,array('z3950.loc.gov:7090/Voyager','Library of Congress')
            ,array('olc1.ohiolink.edu:210/INNOPAC','OhioLINK')
            ,array('library.ox.ac.uk:210/ADVANCE','Oxford University')
        );
    }
	function getMenu(){
		return array(
			'home'=>'Home'
			,'search_mono'=>'Search Local Library'
			,'search_article'=>'Search Article'
			,'search_other'=>'Search Other Resources'
			,'search'=>'Search'
			,'e-resources'=>'e-Resources'
			,'library_subscription'=>'Our Library Subscription'
			,'open_access_journal'=>'Open Access Journal'
			,'new_acquisition'=>'New Acquisition' 
			,'library_guide'=>'Library Guide'
 			,'my_library'=>'My Library'
 			,'admin'=>'Admin'
		);
	}
    function getWordOpt(){
    	return array(
    		'Any_Order' => '',
    		'Left_anchor' => '@attr 3=1'
    	);
    }
    function getLocalMonoSearchFields(){
		return array(
		'Any'           => '@attr 1=1016'
		,'Title'         => '@attr 1=4'
		,'Author'       => '@attr 1=1003'
		,'ISBN'         => '@attr 1=7'
		,'Publisher'    => '@attr 1=1018'
		,'Subject'      => '@attr 1=21'
		,'CallNo'       => '@attr 1=20'
		,'Date'         => '@attr 1=30'
		//,'Language'     => '@attr 1=54'
		//,'Left_anchor'         => '@attr 3=1'
		//,'Greater_or_Equal' => '@attr 2=4'
		//,'Less_or_Equal'    => '@attr 2=2'
		//,'Equal'            => '@attr 2=3'
		//,'MaterialType'     => '@attr 1=1031'
		);		
		
    }

    function getLocalmtypeFields(){
		return array(
		'Any'               => ''
		,'Books'            => 'zzBooks'
		,'ComputerFiles'   => 'zzComputerFiles'
		,'Maps'             => 'zzMaps'
		,'Music'            => 'zzMusic'
		,'Serials'          => 'zzSerials'
		,'VisualMaterials' => 'zzVisualMaterials'
		,'MixedMaterials'  => 'zzMixedMaterials'
		,'Thesis'           => 'zzThesis'
		);		
		
    }


    function getSearchBoolean() {
        return array(
        '@and'=>'AND'
        ,'@or'=>'OR'
        ,'@not'=>'NOT');
    }

    function getSearchCond() {
        return array(
        ''=>'Any'
        ,'zzBooks'=>'Books'
        ,'zzComputerFiles'=>'Computer Files'
        ,'zzMaps'=>'Maps'
        ,'zzMusic'=>'Music'
        ,'zzSerials'=>'Serials'
        ,'zzVisualMaterials'=>'Visual Materials'
        ,'zzMixedMaterials'=>'Mixed Materials'
        ,'zzThesis'=>'Thesis');
    }



    function getStatusFlag(){
        return $flag = array(
        '0'=>'On Shelf',
		'1'=>'On-Loan',
        '2'=>'Acquisition',
        '3'=>'On Shelf',
        '4'=>'Reserved',
        '5'=>'Lost Reported',
        '6'=>'Discard',
		'7'=>'You borrowed this item.',
		'10'=>'On-Process',
		'11'=>'Booked'
		);
    }
    function getMarcTags(){
        return array (
         '001' => 'Control No'
        ,'008' => 'Control Field'
        ,'020' => 'Isbn'
        ,'022' => 'Issn'
        ,'041' => 'Language'
        ,'050' => 'LC Call No'
        ,'082' => 'DDC No'
        ,'090' => 'Local Call No'
        ,'100' => 'Author'
        ,'110' => 'Corporate Name'
        ,'111' => 'Meeting Name'
        ,'130' => 'Uniform Title'
        ,'240' => 'Uniform Title'
        ,'245' => 'Title'
		,'246' => 'Bind Title'
        ,'250' => 'Edition'
        ,'260' => 'Publication'
        ,'300' => 'Physical Desc'
		,'310' => 'Frequency'
        ,'440' => 'Bind Title'
        ,'490' => 'Series Title'
        ,'500' => 'General Note'
        ,'501' => 'Citation/References'
        ,'502' => 'Dissertation'
        ,'504' => 'Bibliography'
        ,'505' => 'Formatted Contents'
        ,'506' => 'Restrictions On Access'
        ,'507' => 'Scale Note'
        ,'520' => 'Abstract'
        ,'533' => 'Volume'
        ,'600' => 'Subject Related Name'
        ,'610' => 'Subject - Corporate Name'
        ,'611' => 'Subject - Meeting Name'
		,'630' => 'Subject - Uniform Title'
        ,'650' => 'Subject Topical'
        ,'653' => 'Index Term'
        ,'700' => 'Related Name'
        ,'710' => 'Corporate Name'
        ,'711' => 'Meeting Name'
        ,'730' => 'Uniform Title'
        ,'740' => 'Added Title'
        ,'785' => 'Related-periodical'
        ,'856' => 'Electronic Location'
        ,'830' => 'Series Added Entry'
        ,'876' => 'Date acquired'
        ,'912' => 'Material Type'
        ,'997' => 'Area / Section'
        ,'998' => 'Format'
        );        
    }
	
    function getArticleMarcTags(){
        return array (
         '001' => 'Control No'
        ,'008' => 'Control Field'
        ,'020' => 'Isbn'
        ,'022' => 'Issn'
        ,'041' => 'Language'
        ,'050' => 'LC Call No'
        ,'082' => 'DDC No'
        ,'090' => 'Local Call No'
        ,'100' => 'Author'
        ,'110' => 'Corporate Name'
        ,'111' => 'Meeting Name'
        ,'130' => 'Uniform Title'
        ,'240' => 'Uniform Title'
        ,'245' => 'Article Title'
		,'246' => 'Bind Title'
        ,'250' => 'Edition'
        ,'260' => 'Publication'
        ,'300' => 'Pages'
		,'310' => 'Frequency'
		,'360' => 'Issue'
        ,'440' => 'Serial Title'
        ,'500' => 'General Note'
        ,'501' => 'Citation/References'
        ,'502' => 'Dissertation'
        ,'504' => 'Bibliography'
        ,'505' => 'Formatted Contents'
        ,'506' => 'Restrictions On Access'
        ,'507' => 'Scale Note'
        ,'520' => 'Abstract'
        ,'533' => 'Volume'
        ,'600' => 'Subject Related Name'
        ,'610' => 'Subject - Corporate Name'
        ,'611' => 'Subject - Meeting Name'
		,'630' => 'Subject - Uniform Title'
        ,'650' => 'Subject Topical'
        ,'653' => 'Index Term'
        ,'700' => 'Related Name'
        ,'710' => 'Corporate Name'
        ,'711' => 'Meeting Name'
        ,'730' => 'Uniform Title'
        ,'740' => 'Added Title'
        ,'785' => 'Related-periodical'
        ,'856' => 'Electronic Location'
        ,'912' => 'Material Type'
        ,'997' => 'Area / Section'
        ,'998' => 'Format'
        );        
    }	
    
}
}
?>
