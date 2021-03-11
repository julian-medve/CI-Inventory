<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class ProductModel extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	function getList($start = 0,$limit = 3,$order_by = 'product_id')
	{
		return  $this->db->query("SELECT * FROM products ORDER BY  {$order_by} DESC LIMIT $start , $limit ")->result_array();		
	}

	function getList2($order_by = 'product_id')
	{
		return  $this->db->query("SELECT * FROM products ORDER BY {$order_by} DESC")->result_array();		
	}	
	
	function getInventoryCustomer()
	{
		return  $this->db->query("SELECT DISTINCT(i.customer_id) as customer_id,
		                                 u.full_name as full_name
		                          FROM products i 
								  INNER JOIN users u on u.user_id = i.customer_id
		                        ")->result_array();		
	}
	
	function getCustomerInventory($customer_id)
	{
		return  $this->db->query("SELECT * FROM products WHERE customer_id = $customer_id ORDER BY product_id ASC")->result_array();		
	}
	
	function add($data)
	{
		$this->db->insert('products',$data);
		return $this->db->affected_rows();
	}

	function getSingleData($product_id)
	{
		$query = $this->db->get_where('products', array('product_id' => $product_id));
		$result = $query->result_array();
		return $result;
	}	
	
	function edit($categoryData)
	{
		$data = array(
					  'outside_diameter'    => $categoryData['outside_diameter'],
					  'wall_thickness'      => $categoryData['wall_thickness'],
					  'ibs_per_foot'        => $categoryData['ibs_per_foot'],
					  'end_type'            => $categoryData['end_type'],
					  'grade'               => $categoryData['grade'],
					  'coating'             => $categoryData['coating'],
					  'foreman'             => $categoryData['foreman'],
					  'customer_id'         => $categoryData['customer_id']
		             );
		$condition = array(
						'product_id'   => $categoryData['product_id']
					  );
		$this->db->where($condition);
		$this->db->update('products', $data);
	}
	
	function getCustomerProduct($customer_id,$order_by,$selectedfield,$search_value)
	{
		if($selectedfield != '' AND $search_value != '')
		{
			return  $this->db->query("SELECT * 
		                          FROM products 
								  WHERE customer_id = $customer_id 
								  AND $selectedfield LIKE '%$search_value%'
								  $order_by")->result_array();		
		}
		else
		{
			return  $this->db->query("SELECT * 
			                          FROM products 
									  WHERE customer_id = $customer_id 
									  $order_by")->result_array();		
		}
	}
}