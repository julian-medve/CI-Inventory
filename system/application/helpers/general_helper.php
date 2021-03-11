<?php
function getProductInventory($product_id)
{
	$CI     =& get_instance();
	$result = $CI->db->query("SELECT joints_in,joints_out,footage FROM store WHERE product_id = $product_id ORDER BY store_id ASC")->result_array();		
	foreach($result as $row)
	{
		$in  += $row['joints_in'];
		$out += $row['joints_out'];
		$final= $in - $out;
		
		if($row['joints_in'] != '')
		{
			$in2  += $row['footage'];
		}
		else
		{
			$out2 += $row['footage'];
		}
		$final2 = $in2 - $out2;
	}
	return $final.'|'.$final2;
}

function dateFormat($date)
{
	$date2 = explode('/',$date);
	$date3 = $date2[2].'-'.$date2[0].'-'.$date2[1];
	return $date3;
}

function dateFormat2($date)
{
	if($date == '0000-00-00')
	{
		echo "";
	}
	else
	{
		$date2 = explode('-',$date);
		$date3 = $date2[1].'/'.$date2[2].'/'.$date2[0];
		return $date3;
	}
}