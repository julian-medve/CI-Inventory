<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Customer extends Controller {

	var $data;

	function __construct()
	{
		parent::__construct();	
		
		$this->load->library('Validation');
		$this->load->library('pagination');
		$this->load->model('ProductModel');
		$this->load->model('UsersModel');
		$this->load->model('CustomerModel');
		$this->load->model('InventoryModel');
		
		error_reporting(0);
		
		$this->UsersModel->checkAdminPermission();
	}	
	
	function lists()
	{
		global $per_page,$start,$limit;
		
		if($this->uri->segment(5) == 'asc' || $this->uri->segment(5) == 'desc')
		{
			$order             = $this->uri->segment(4);
			$by                = $this->uri->segment(5);
			$_SESSION['order'] = $order;
			$_SESSION['by']    = ($this->uri->segment(5) == 'asc')? 'asc' : 'desc';
			$order_by          = "$order $by";
		}
		else
		{
			// if(isset($_SESSION['order']))
			// {
			// 	$order    = $_SESSION['order'];
			// 	$by       = $_SESSION['by'];
			// 	$order_by = "$order $by";
			// }
			// else
			// {
				$order_by = "user_id DESC";
			// }
		}

		$this->setPaginationParams($order_by);
		
		$start = $this->uri->segment(7);
		if (empty($start)) 
		{
		   	$start = 0;
		}
		$_SESSION['start'] = $start;

		$limit=$per_page;
		$links = $this->pagination->create_links();
		
		$result_array	= $this->CustomerModel->getAdminList($start,$limit,2, $order_by);
		
		$links = $this->pagination->create_links();
		$data = array(
				"adminList"           => $result_array,
				"links"               => $links,
				"per_msg"			  			=> $per_msg1,
				"title"	              => 'Customer List'  
			  );
		
		// For Menu Order
		if($this->uri->segment(5) == 'asc' || $this->uri->segment(5) == 'desc')
		{
			$_SESSION['by']    = ($this->uri->segment(5) == 'asc')? 'desc' : 'asc';
		}
		$this->layout->view('users/admin_list', $data);
	}
	
	function add()
	{
		$data['title'] = "Customer Add";
		
		//set the validation rules
		$rules ['full_name']       = "required|max_length[100]|min_length[2]";
		$rules ['email']           = "required|valid_email|callback_email_check";
		$rules ['username']        = "required|max_length[50]|min_length[5]|callback_username_check";
		$rules ['password']        = "required|max_length[32]|min_length[5]";
		$rules ['retype_password'] = "required|max_length[32]|min_length[5]|matches[password]";
		$this->validation->set_rules($rules);
		
		$fields['full_name']       = 'full name';
		$fields['email']           = 'email';
		$fields['username']        = 'user name';
		$fields['password']        = 'password';
		$fields['retype_password'] = 'retype password';
		$this->validation->set_fields($fields);
		
		$this->validation->set_fields($fields);
		$this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if (count($_POST) > 0)
		{
			if ($this->validation->run() == FALSE)
			{
				$this->layout->view('users/admin_add',$data);
			}
			else
			{
				$userData = array(
								  'username'       => $_POST['username'],
								  'full_name'      => $_POST['full_name'],
								  'password'       => MD5($_POST['password']),
								  'password_text'  => $_POST['password'],
								  'work_phone'     => $_POST['work_phone'],
								  'address'        => $_POST['address'],
								  'email'          => $_POST['email'],
								  'created_date'   => date('Y-m-d H:m:s'),
								  'status'         => 'active',
								  'added_by'       => $_SESSION['user_id'],
								  'user_role_id'   => 2
				                 );
				if($user_id = $this->CustomerModel->addAdmin($userData))
				{
					redirect('admin/customer/lists');
				}
			}
		}
		else
		{
			$this->layout->view('users/admin_add', $data);
		}
	}
	
	function username_check($str)
	{
		$query = $this->db->query("SELECT * FROM users WHERE username='$str'");
		
		if($query->num_rows() > 0)
		{
			$this->validation->set_message('username_check', 'This username is already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function email_check($str)
	{
		$query = $this->db->query("SELECT * FROM users WHERE email='$str'");
		
		if($query->num_rows() > 0)
		{
			$this->validation->set_message('email_check', 'This email is already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}	
	
	function setPaginationParams($order_by)
	{
		global $per_page;
		
		//get parameter from URL as an Associative array.
		$params = $this->uri->uri_to_assoc();
		//If prameter from url are empty the initialize with default value;
		if( empty( $params ) )
		{
		    $params = array(
		                    	'per_page'   => 20
		                	);
		}
		
	  $result = $this->db->query( "SELECT * FROM users WHERE user_role_id = 2 ORDER BY " . $order_by )->result_array();
		$per_page = 20;
		if(empty($params['per_page']))
		{
			$per_page = 20;
		}
		else
		{
			$per_page = $params['per_page'];
		}
		if($per_page == '1')
		{	
			$per_page = count($result);
		}

		$order = explode(" ", $order_by)[0];
		$by = explode(" ", $order_by)[1];

		$config['base_url']   = site_url().'/admin/customer/lists/' . $order . '/' . $by . "/per_page/";
	  $config['total_rows'] = count($result);
		$config['per_page']   = $per_page;
		$config['uri_segment']   = 7;

		$this->pagination->initialize($config);
	}

	function view($user_id)
	{
		$data['title'] = "User View";
		
		$data['results'] = $this->CustomerModel->getSingleUserData($user_id);
		
		$this->layout->view('users/admin_view', $data);
	}	
	
	function edit($user_id)
	{
		
		$data['title']   = 'Customer Edit';
		$data['edit']    = 1;
		$data['user_id'] = $user_id;
		
		//get article data using passing article id
		$data['results'] = $this->CustomerModel->getSingleUserData($user_id);
		
		//set the validation rules
		$rules ['full_name']      = "required|max_length[100]|min_length[2]";
		$this->validation->set_rules($rules);
		
		$fields['full_name']      = 'full name';
		$this->validation->set_fields($fields);
		
		$this->validation->set_fields($fields);
        $this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if (count($_POST) > 0)
		{
			if ($this->validation->run() == FALSE)
			{
				$this->layout->view('users/admin_edit',$data);
			}
			else
			{
				$this->CustomerModel->editAdmin($_POST);
				redirect('admin/customer/lists');
			}
		}
		else
		{
			$this->layout->view('users/admin_edit', $data);
		}
	}
	
	function delete($user_id)
	{
		$this->db->where('user_id', $user_id);
		$this->db->delete('users');	
		
		if($this->db->affected_rows() > 0)
		{
			redirect('admin/customer/lists');
		}
	}
	
	function changePassword($user_id)
	{
		$data['title']   = "Change Password";
		$data['user_id'] = $user_id;
		
		//set the validation rules
		$rules ['new_password']	      = "required|max_length[32]|min_length[5]";
		$rules ['retype_password']	  = "required|max_length[32]|min_length[5]";

		$this->validation->set_rules($rules);
		// set fields names
		$fields['new_password']    = 'new password' ;
		$fields['retype_password'] = 'retype password' ;
		
		$this->validation->set_fields($fields);
        $this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if (count($_POST) > 0)
		{
			if ($this->validation->run() == FALSE)
			{
				$this->layout->view('users/change_user_password',$data);
			}
			else
			{
				if($_POST['new_password'] == $_POST['retype_password'])
				{
					if($this->CustomerModel->changePassword($_POST))
					{
						$data['succMsg'] = '<p style="font-size:24px;color:red;padding-bottom:10px;">New Password has been changed successfully!</p>';
						$this->layout->view('users/change_user_password',$data);
					}
				}
				else
				{
					$data['error_msg2'] = "<b>Passwords do not match</b>";
					$this->layout->view('users/change_user_password',$data);
				}
			}
		}
		else
		{
			$this->layout->view('users/change_user_password', $data);
		}
	}
	
	function changeStatus()
	{
		$fieldValue = $this->input->post('fieldValue');
		$fieldName  = $this->input->post('fieldName');
		$tableName  = $this->input->post('tableName');
		$status     = $this->input->post('status');
		
		if($getStatus = $this->CustomerModel->changeCommentStatus($fieldValue, $fieldName, $tableName, $status))
		{
			$ggg = ucfirst($getStatus);
			echo "<a href=\"javascript:void(0)\" onclick=\"changeStatus($fieldValue, '$fieldName', '$tableName','$getStatus')\" title=\"Change status\">$ggg</span></a>";
		}
	}

	function summary($customer_id)
	{
		$data['title']     = "Details Report";
		$data['results']   = $this->CustomerModel->getSingleUserData($customer_id);
		$data['products']  = $this->ProductModel->getCustomerProduct($customer_id);
		
		$this->layout->view('reports/summary', $data);
	}
}	