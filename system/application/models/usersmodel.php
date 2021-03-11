<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class UsersModel extends Model
{
	function __construct()
	{
		parent::Model();
	}
	
	/**
	 *check login
	 *
	 *This function will check user validaty
	 *
	 * @author Starshine
	 * @param $data
	 * @return  mixed_array
	 *
	*/		
	function validateUser( $data )
	{
		$password = md5($data['password']);
		$username    = $data['username'];

		$this->db->select('user_id, email, username, user_role_id');
		$query = $this->db->get_where('users', array('username' => $username, 'password' => $password, 'status' => 'active'));
		$result = $query->result_array();
		
		return $result;
	}
	/**
	 *check permission
	 *
	 *This function will check user permission
	 *
	 * @author Starshine
	 * @param none
	 * @return  mixed_array
	 *
	*/		
	function checkAdminPermission()
	{
		if($_SESSION['user_role_id'] != 1)
		{
			redirect('admin/login');
		}
	}
	
	function checkAdminPermission2()
	{
		if($_SESSION['user_role_id'] != 2)
		{
			redirect('users/login');
		}
	}

	/**
	 *Data Retrieve
	 *
	 *This function will retrieve data from writers table
	 *
	 * @author Starshine
	 * @param $userID, $previous(previous password)
	 * @return  mixed_array
	 *
	*/	
	function checkPasswordAvailability($user_id, $previous)
	{
		$result =  $this->db->query("SELECT * FROM users WHERE user_id = $user_id AND password  = '$previous' ")->result_array();
		return $result;
	}

	/**
	 *Update
	 *
	 *This function will update password
	 *
	 * @author Starshine
	 * @param $userID, $new_pass
	 * @return  affected_rows
	 *
	*/	
	function changePassword($new_pass, $user_id)
	{
		$data = array(
						"password "  => $new_pass
					 );
		
		$this->db->where('user_id', $user_id);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}

	function changeEmail($email)
	{
		$data = array(
						"email "  => $email
					 );
		
		$this->db->where('user_id', $_SESSION['user_id']);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}
	
	function getSingleUserData($email)
	{
		$query = $this->db->get_where('users', array('email' => "$email"));
		$result = $query->result_array();
		return $result;
	}
	
	function updateNewPassword($upDate)
	{
		$data = array(
		              'password'      => MD5($upDate['new_password']),
					  'password_text' => $upDate['new_password']
					 );
					 
		$condition = array(
				'username'   => $upDate['username']
			  );

		$this->db->where($condition);
		$this->db->update('users', $data);
		return $this->db->affected_rows();
	}
}