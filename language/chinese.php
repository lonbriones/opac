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
	'language' => 'Chinese'
	,'charset'=>'utf-8'
	,'font-size' => '13px'
	,'search'=>'查詢'
	,'title'=>'書名'
	,'author'=>'作者'
	,'login'=>'註冊'
	,'library'=>'圖書館'
	,'mylibrary'=>'我的圖書館'
	,'admin'=>'圖書管理'
	,'logout'=>'註銷'
	,'local_resources'=>'本圖書館收藏'
	,'other_resources'=>'其他圖書館收藏'
	,'library_rules'=>'圖書館規則'
	,'library_guides'=>'圖書館指引'
	,'my_library'=>'我的圖書館'
	,'circ_history'=>'借還書流動記錄'
	,'check_reservation'=>'檢查預約'
	,'admin'=>'圖書管理'
	,'notice'=>'通知'
	,'onhold'=>'被借出/未還'
	,'rejected'=>'被拒絕'
	,'placedorder'=>''
	,'date_order'=>'訂購日期'
	,'date_received'=>'接受日期'
	,'date_released'=>'發佈日期'
	//Menu
	,'home'=>'首頁'
	,'back_to_home'=>'回首頁'
	,'notice_archive' => '通知檔案'
	,'user_login' => '<strong>使用者註冊</strong>'
	
	,'search_local_library' => '查詢本地圖書館'
	,'search_article' => '查詢文章'
	,'search_other_resources' => '查詢其他資源'
	,'view_saved_items' => 'View Saved Items'
	,'new_acquisition' => '新書承購'
	,'library_guide' => '圖書館指引'
	,'my_library' => '我的圖書館'
	,'circulation_history' => '借還書流動記錄'
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
	,'word_option' => '詞選擇'
	,'left_anchor' => '首字出現'
	,'any_order' => '任何選擇'
	,'field' => '範圍'
	,'advancedsearch' => '高級搜索'
	,'simplesearch' => 'Simple Search'
	,'please_enter_keyword' => 'Please enter keyword'
	,'search_term' => '查詢詞'
	,'reset' => '從新安置'
	//Search Form dropdown fields
	,'mono_fields' => array(
		'Any'           => '@attr 1=1016'
		,'書名'         => '@attr 1=4'
		,'作者'       => '@attr 1=1003'
		,'ISBN'         => '@attr 1=7'
		,'出版社'    => '@attr 1=1018'
		,'主題'      => '@attr 1=21'
		,'索引書號'       => '@attr 1=20'
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
			,'search_mono'=>'本圖書館收藏'
			,'search_article'=>'Search Article'
			,'search_other'=>'其他圖書館收藏'
			,'search'=>'查詢'
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
		,'出版社'    => '@attr 1=1018'
		,'主題'      => '@attr 1=21'
		,'CallNo'       => '@attr 1=20'
		,'Date'         => '@attr 1=30'
		);		
    }

    function getLocalmtypeFields(){
		return array(
		'Any'               => ''
		,'書籍收藏'            => 'zzBooks'
		,'電腦文件'   => 'zzComputerFiles'
		,'地圖'             => 'zzMaps'
		,'音樂'            => 'zzMusic'
		,'連續刊'          => 'zzSerials'
		,'視覺材料' => 'zzVisualMaterials'
		,'混雜材料'  => 'zzMixedMaterials'
		,'論文'           => 'zzThesis'
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
        ,'zzBooks'=>'書籍收藏'
        ,'zzComputerFiles'=>'電腦文件'
        ,'zzMaps'=>'地圖'
        ,'zzMusic'=>'音樂'
        ,'zzSerials'=>'連續刊'
        ,'zzVisualMaterials'=>'視覺材料'
        ,'zzMixedMaterials'=>'混雜材料'
        ,'zzThesis'=>'論文');
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
