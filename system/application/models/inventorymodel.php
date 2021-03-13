<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class InventoryModel extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function getList($start = 0,$limit = 3,$order_by = '')
	{
		if($order_by == '')
			return  $this->db->query("SELECT * FROM store ORDER BY  store_id DESC LIMIT $start , $limit ")->result_array();		
		else
			return  $this->db->query("SELECT * FROM store ORDER BY  {$order_by} LIMIT $start , $limit ")->result_array();		
	}

	function getList2($order_by = 'store_id')
	{
		return  $this->db->query("SELECT * FROM store ORDER BY {$order_by} DESC")->result_array();		
	}	
	
	function add($data)
	{
		$this->db->insert('store',$data);
		return $this->db->affected_rows();
	}

	function getSingleData($store_id)
	{
		$query = $this->db->get_where('store', array('store_id' => $store_id));
		$result = $query->result_array();
		return $result;
	}	
	
	function edit($categoryData,$image_data)
	{
		$data = array(
					  'c_date'              => dateFormat($categoryData['c_date']),
					  'rr'                  => $categoryData['rr'],
					  'po'                  => $categoryData['po'],
					  'carrier'             => $categoryData['carrier'],
					  'received_transfarred'=> $categoryData['received_transfarred'],
					  'joints_in'           => $categoryData['joints_in'],
					  'joints_out'          => $categoryData['joints_out'],
					  'footage'             => $categoryData['footage'],
					  'manufacturer'        => $categoryData['manufacturer'],
					  'rack'                => $categoryData['rack'],
					  'afe'                 => $categoryData['afe'],
					  'customer_id'         => $categoryData['customer_id'],
					  'product_id'          => $categoryData['product_id'],
					  'attachment'          => $image_data
		             );
		$condition = array(
						'store_id'   => $categoryData['store_id']
					  );
		$this->db->where($condition);
		$this->db->update('store', $data);
	}
	
	function getProductInventory($product_id,$order_by,$selectedfield,$search_value)
	{
		if($selectedfield != '' AND $search_value != '')
		{
			if($selectedfield == 'c_date')
			{
				$search_value2 = dateFormat($search_value);
			}
			else
			{
				$search_value2 = $search_value;
			}
			
			
			return  $this->db->query("SELECT * 
			                          FROM store 
									  WHERE product_id = $product_id 
									  AND $selectedfield LIKE '%$search_value2%'
									  $order_by")->result_array();	
		}
		else
		{
			return  $this->db->query("SELECT * 
			                          FROM store 
									  WHERE product_id = $product_id 
									  $order_by")->result_array();		
		}
	}
}