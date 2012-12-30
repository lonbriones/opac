<?php
$marc = "01104nam  22003734a 4504001000900000003000600009005001700015008004100032010001300073020002800086035001500114040002000129043001200149049000900161050002600170082001600196090001800212100003200230245006400262250001200326260004400338300002100382650003200403650005400435651002100489655003200510655002500542655002500567852008000592910002000672913000600692998001200698999002000710";

print_r(parse($marc,'245',chr(31).'a',1,0));

function parse($buf,$cTag,$cSub,$getArray,$getInd)
{
	print $record_length=substr($buf,"0","5");
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
		print "$entry_p<br>";
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

?>