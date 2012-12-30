<?php
// +----------------------------------------------------------------------+
// | MARC PARSER                                                          |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006-2009 Kyung IL Tech, Inc.                          |
// +----------------------------------------------------------------------+
// |                                                                      |
// +----------------------------------------------------------------------+
// | Authors: Dionylon Briones <deform_perspective@yahoo.co.uk>           |
// |          Han Young Jung <chung@mae.co.kr>                            |
// +----------------------------------------------------------------------+
//
// $Id: marc_parser.php,v 1.1 2006/09/04 07:51:18 lon.briones Exp $

define ('SUBFLD',chr(31) );
define ('FLDTER',chr(30) );
define ('RECTER',chr(29) );
function getMarcLon($cRaw){
	$content = '';
	$i=0;
	for ($i=0;$cRaw{$i}!=FLDTER;$i++)
	{
		$content .= $cRaw{$i};
	}
	
	return $content;
	//return $cRaw;
}
function removeSubField($content)
{
	$cRtn="";
	$i=0;
	$tag = '';
   while ($content{$i}!=FLDTER && $content{$i}!="")
	{
			if ($content{$i}==SUBFLD)
				{
				   $tag = $content{$i+1};
				   $cRtn.=" ";
				   $i=$i+2;
				   continue;
				}
				else{
				   $val[$tag][] = $cRtn.=$content{$i};
				}
				$i++;
			}
		return $cRtn;
		//return $val;
}
function replaceSubField($content)
{
	$cRtn="";
	$i=0;
	$tag = '';
   while ($content{$i}!=FLDTER && $content{$i}!="")
	{
			if ($content{$i}==SUBFLD)
				{
				   $tag = $content{$i};
				   $cRtn.="$";
				}
				else{
				   $val[$tag][] = $cRtn.=$content{$i};
				}
				$i++;
			}
		return $cRtn;
		//return $val;
}

function getURL($cStr)
{
    $cRtn="";

	$nPos=strpos($cStr,SUBFLD."u");
    if ($nPos>0)
	{ 
        for ($i=$nPos+2;$i<strlen($cStr);$i++)
		{
           if ( (substr($cStr,$i,1)!=SUBFLD) && (substr($cStr,$i,1)!=FLDTER))
		     $cRtn.=substr($cStr,$i,1);
		   else break;
	    }
    }
	return $cRtn;
}

function readRawMarc($buf,$cTag,$cSub,$getArray,$getInd)
{
	$record_length=substr($buf,"0","5");
	if ($record_length < 25) exit ;
		$indicator_length=substr($buf,"10","1");
	$identifier_length=substr($buf,"11","1");
	$base_address=substr($buf,"12","4");
	$length_data_entry=substr($buf,"20","1");
	$length_starting=substr($buf,"21","1");
	$length_implementation=substr($buf,"22","1");
	
	for ($entry_p = 24; substr($buf,$entry_p,"1") != chr(30); )
	{
		$entry_p =$entry_p + 3+$length_data_entry+$length_starting;
		if ($entry_p >= $record_length) 
			exit;
	}
	$base_address = $entry_p+1;
	$content="";
	
	for ($entry_p = 24; substr($buf,$entry_p,"1") != chr(30); )
	{
		$tag=substr($buf,$entry_p,"3");
		$entry_p = $entry_p + 3;
		$data_length = substr($buf,$entry_p, $length_data_entry);
		$entry_p = $entry_p+$length_data_entry;
		$data_offset = substr($buf,$entry_p, $length_starting);
		$entry_p =$entry_p+ $length_starting;
		$ii = $data_offset + $base_address;
		$end_offset = $ii+$data_length-1;
		$cStr=$tag;
		
		if ($getArray==0 )
		{
			if ($tag==$cTag)
			{
				$content=substr($buf,"$ii","$data_length");
				break;
			}
		}
		else
		{
			$content=substr($buf,$ii,$data_length);
			if ($getInd==1)
			{
				if ($tag>"010") 
				{
					$arrMarc[]=$tag.$content;
				}
				else
				{
					$arrMarc[]=$tag.substr($buf,"$ii-2","$data_length").$content;
				}
			} 
			else 
				$arrMarc[]=$tag.$content;
		}
	}
	if ($getArray==0 )
		return $content;
	else
		return $arrMarc;

}


function alreadyHave($cTar,$cCmp)
{
  $cRtn=0;

  $cTmp=$cTar;

  while ($cTmp!="")
  {
     $nPos=strpos($cTmp,RECTER);
	 if ($nPos>0) 
	 {
        $cStr=substr($cTmp,0,$nPos+1);
		$cTmp=substr($cTmp,$nPos+1);
	 }
	 else
     {
        $cStr=$cTmp;
		$cTmp="";
	 }
     if ($cStr==$cCmp)
	 {
	   $cRtn=1;
	   break;
	 }
  } 
	
  return $cRtn;

}

function marcParse($buf="",$cTag="",$cSub="")
{
	$content="";
    $content=readRawMarc($buf,$cTag,$cSub,0,0);
	if ( empty($content) )
	{
       return "";
	   exit;
	}
	
	$nPos=strpos($content,$cSub);

	if ($nPos > 0) 
  	   $content = substr($content,$nPos+2);

	// it's funny how the subfield u is missing
	// so i have to manually cut the string before subfield y
	// this will return the subfield u
	
    if ($cTag=="856" && $cSub==SUBFLD.'u')
	{
		//echo $content;
		$nPos=strpos($content,SUBFLD.'y');
		
	    if ($nPos>0 )
  			$content = substr($content,0,$nPos);
	}

    if ($cTag=="998" && $cSub==SUBFLD.'a')
	{
		$nPos=strpos($content,SUBFLD.'b');
	    if ($nPos>0 )
  			$content = substr($content,0,$nPos);
	}

    if ($cTag=="998" && $cSub==SUBFLD.'b')
	{
		$nPos=strpos($content,SUBFLD.'c');
	    if ($nPos>0 )
  			$content = substr($content,0,$nPos);
	}

    if ($cTag=="997" && $cSub==SUBFLD.'a')
	{
		$nPos=strpos($content,SUBFLD.'a');
		
	    if ($nPos>0 )
  			$content = substr($content,0,$nPos);
	}

	if ($cTag=="245")
	{
		$nPos=strpos($content,SUBFLD.'c');
		if ($nPos==0 )
  			$nPos=strpos($content,SUBFLD.'d');
	    if ($nPos>0 )
  			$content = substr($content,0,$nPos);
	}

    if ($cTag=="260" && $cSub==SUBFLD.'b')
	{
		$nPos=strpos($content,SUBFLD.'c');
	    if ($nPos>0 )
  			$content = substr($content,0,$nPos);
	}

    if ($cTag=="090")
	{
		$content=trim(str_replace(SUBFLD.'b',"/",$content));
		if ($content[0]=="/")
           $content=substr($content,1);
	}

	$cRtn="";
	$i=0;
	/*	
	while ($content{$i}!=FLDTER && $content{$i}!="")
	{
		if ($content{$i}==SUBFLD)
		{
			$cRtn.=" ";
			$i=$i+2;
			continue;
		}
		else
			$cRtn.=$content{$i++};
	}
	*/

	for ($i=0;$i<strlen($content);$i++){
		if ($content{$i}!=FLDTER && $content{$i}!=""){
			if ($content{$i}==SUBFLD){
				$cRtn.=" ";
				$i=$i+1;
				continue;
			}
			else
				$cRtn.=$content{$i};

		}else{
			break;
		}
	}
    if ($cTag=="260" && $cSub==SUBFLD.'c')
    {
      $cRtn = str_replace("]", "",  $cRtn);
      $cRtn = str_replace("[", "",  $cRtn);
      $cRtn = str_replace("c", "",  $cRtn);
      $cRtn = str_replace("C", "",  $cRtn);
      $cRtn = str_replace(",", "",  $cRtn);
      $cRtn = str_replace(".", "",  $cRtn);
      $cRtn = str_replace("-", "",  $cRtn);
    } 

	$cRtn=trim($cRtn);
	if (empty($cRtn)){
		$cRtn=" ";
	}
	if ( $cRtn{strlen($cRtn)-1}=="/" || $cRtn{strlen($cRtn)-1}==",")
	  $cRtn=substr($cRtn,0,strlen($cRtn)-1);
	
    return $cRtn;
}


function get_flag_info($stat,$icon_name,$code,$act_page,$recNum){
	if ($stat=='F'){
		return '<img src="maez_schemes/default/icons/'.$icon_name.'.gif" border="0">';	
	}
	if ($stat=='T'){
		
		return '<a href=attach.php?recNum='.$recNum.'&act_page='.$act_page.'&code='.$code.'&type='.$icon_name.' ><img src="images/icons/'.$icon_name.'_ON.gif" border="0"></a>';
	}
}

function makeShort($cStr,$len)
{
    $cRtn=$cStr;
    if ( strlen($cRtn)>$len )
	{
	   $cRtn=substr($cRtn,0,$len-5);
	   $nPos=strrpos($cRtn," ");

	   if ($nPos>0)
		 $cRtn=substr($cRtn,0,$nPos);
	   $cRtn.=" ....";
	}

    return $cRtn;
}

function onlyDigit($cStr)
{
  $cRtn="";
  for($i=0 ; $i<strlen($cStr) ; $i++)
	{
	   if ( ($cStr[$i]>="0") &&  ($cStr[$i]<="9") )
          $cRtn.=$cStr[$i];
	}
  if (strlen($cRtn)>4 )
     $cRtn=substr($cRtn,0,4);
  if (strlen($cRtn)<4 )
     $cRtn.="-";
  return $cRtn;
}

function parse($s,$cRaw)
{
	
	switch ($s) {
		case "callno":
		      $cCall=marcParse($cRaw,"090",SUBFLD.'a'); 
			if ($cCall=="")
		           $cCall=marcParse($cRaw,"050",SUBFLD.'a'); 
			if ($cCall=="")
		           $cCall=marcParse($cRaw,"082",SUBFLD.'a'); 
			 
			return $cCall; 
			break;
		case "title":
			return marcParse($cRaw,"245",SUBFLD.'a');   
			break;
		case "isbn":
			return marcParse($cRaw,"020",SUBFLD.'c');			
			break;			
		case "journal_title":
			return marcParse($cRaw,"440",SUBFLD.'a');   
			break;
		case "journal_issue":
			return marcParse($cRaw,"360",SUBFLD.'a');   
			break;
		case "subject":
			return marcParse($cRaw,"653",SUBFLD.'a');   
			break;
		case "author":
            $author=marcParse($cRaw,"100",SUBFLD.'a');   
			if (empty($author))
 			  $author=marcParse($cRaw,"110",SUBFLD.'a');   
			if (empty($author))
			  $author=marcParse($cRaw,"700",SUBFLD.'a');   
		    return $author;
			break;
		case "publisher":
			return marcParse($cRaw,"260",SUBFLD.'b');   
			break;
		case "location":
			return marcParse($cRaw,"997",SUBFLD.'a');   
			break;
		case 'year':
			return onlyDigit(marcParse($cRaw,"260",SUBFLD.'c'));   
			break;		
		case 'attach':
			return $flags=marcParse($cRaw,"998",SUBFLD.'b');  //'FFTF
			break;			
		case 'fmt':
		    $format = marcParse($cRaw,"998",SUBFLD."a");
		    $format = substr($format,2,strlen($format));
			return $format;
			break;			
		case 'mastcode':
			return marcParse($cRaw,"998",SUBFLD."d");
			break;			
		case 'code':
			return marcParse($cRaw,"999",SUBFLD."l");
			break;			
	}
}
?>
