<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class CustomerModel extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function addAdmin($data)
	{
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}

	function getAdminList($start = 0,$limit = 3,$user_role_id, $order_by = "user_id DESC")
	{
		return  $this->db->query("SELECT * FROM users WHERE user_role_id = $user_role_id ORDER BY $order_by LIMIT $start , $limit ")->result_array();		
	}

	function getList2($order_by = 'full_name')
	{
		return  $this->db->query("SELECT * FROM users WHERE user_role_id = 2 ORDER BY  {$order_by} ASC")->result_array();		
	}	
	
	function getSingleUserData($user_id)
	{
		$query = $this->db->get_where('users', array('user_id' => $user_id));
		$result = $query->result_array();
		return $result;
	}
	
	
	function editAdmin($results)
	{
		$data = array(
						"full_name"    => $results['full_name'],
						"address"      => $results['address'],
						"work_phone"   => $results['work_phone']
		             );
		$condition = array(
						'user_id'     => $results['user_id']
					  );
		$this->db->where($condition);
		$this->db->update('users', $data);
	}

	function changePassword($cngData)
	{
		$data = array(
						"password"       => MD5($cngData['new_password']),
						"password_text"  => $cngData['new_password']
					 );
		
		$this->db->where('user_id', $cngData['user_id']);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}
}