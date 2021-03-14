<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inventory extends Controller {

	var $data;

	function __construct()
	{
		parent::__construct();	
		
		$this->load->library('Validation');
		$this->load->library('pagination');
		$this->load->model('ProductModel');
		$this->load->model('InventoryModel');
		$this->load->model('CustomerModel');
		$this->load->model('UsersModel');
		
		$this->UsersModel->checkAdminPermission();		
		error_reporting(0);
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
				$order_by = "store_id DESC";
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
		
		$result_array	= $this->InventoryModel->getList($start,$limit, $order_by);
		
		$links = $this->pagination->create_links();
		$data = array(
				"categoryList"        => $result_array,
				"links"               => $links,
				"per_msg"			  			=> $per_msg1,
				"title"	              => 'Inventory List'  
			  );
		
		
		// For Menu Order
		if($this->uri->segment(5) == 'asc' || $this->uri->segment(5) == 'desc')
		{
			$_SESSION['by']    = ($this->uri->segment(5) == 'asc')? 'desc' : 'asc';
		}

		$this->layout->view('store/list', $data);
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
		
	  $result = $this->db->query( "SELECT * FROM store ORDER BY " . $order_by)->result_array();
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

		$config['base_url']   = site_url().'/admin/inventory/lists/' . $order . '/' . $by. '/per_page/';
	  $config['total_rows'] = count($result);
		$config['per_page']   = $per_page;
		$config['uri_segment']   = 7;
		
		$this->pagination->initialize($config);
	}	
	
	function add()
	{
		$data['title'] = "Inventory Add";
		
		$data['customers'] = $this->CustomerModel->getList2();
		
		if($_POST['customer_id'])
		{
			$data['productList'] = $this->ProductModel->getCustomerProduct($_POST['customer_id'],'ORDER BY product_id DESC');
		}
		
		//set the validation rules
		$rules ['c_date']          = "required|max_length[100]|min_length[3]";
		$rules ['customer_id']     = "required|callback_customer_id_check";
		$rules ['product_id']      = "required|callback_product_id_check";
		$this->validation->set_rules($rules);
		// set fields names
		$fields['c_date']          = 'date' ;
		$fields['customer_id']     = 'customer' ;
		$fields['product_id']      = 'product' ;
		$this->validation->set_fields($fields);
		
		$this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if (count($_POST) > 0)
		{
			if($_SESSION['form_validation_code'] != $_POST['form_validation_code'])
			{
				redirect('admin/login/logout');
			}
			
			if ($this->validation->run() == FALSE)
			{
				$this->layout->view('store/add',$data);
			}
			else
			{
				//upload config initialization
				$config['upload_path']   = "./public/pdf";
				$config['allowed_types'] = 'pdf|PDF';
				$config['max_size']	     = "104857600";
				$config['max_width']     = '';
				$config['max_height']    = '';

				$config['encrypt_name']  = true;


				$this->load->library('upload', $config);

				if ($this->upload->do_upload())
				{
					$userData     = $this->upload->data();
					$uploadPath   = $userData['full_path'];
					$image_data   =  $userData['file_name'];
				}
				else
				{
					$image_data = '';
				}
				
				
				$categoryData = array(
				                  'c_date'              => dateFormat($_POST['c_date']),
								  'rr'                  => $_POST['rr'],
								  'po'                  => $_POST['po'],
								  'carrier'             => $_POST['carrier'],
								  'received_transfarred'=> $_POST['received_transfarred'],
								  'joints_in'           => $_POST['joints_in'],
								  'joints_out'          => $_POST['joints_out'],
								  'footage'             => $_POST['footage'],
								  'manufacturer'        => $_POST['manufacturer'],
								  'rack'                => $_POST['rack'],
								  'afe'                 => $_POST['afe'],
								  'customer_id'         => $_POST['customer_id'],
								  'product_id'          => $_POST['product_id'],
								  'added_by'            => $_SESSION['user_id'],
								  'created_date'        => date('Y-m-d H:m:s'),
								  'attachment'          => $image_data
				                 );
				if($this->InventoryModel->add($categoryData))
				{
					if($_POST['Submit'] == 'Save and Add New')
					{
						redirect('admin/inventory/add');
					}
					else
					{
						redirect('admin/inventory/lists/per_page/0');
					}
				}
			}
		}
		else
		{
			$data['form_validation_code'] = $_SESSION['form_validation_code'] = time();
			$this->layout->view('store/add',$data);
		}
	}	
	
	function edit($store_id)
	{
		$data['title'] = 'Edit Inventory';
		$data['edit']  = 1;
		$data['customers'] = $this->CustomerModel->getList2();
		//get article data using passing article id
		$data['customerData'] = $this->InventoryModel->getSingleData($store_id);
		$data['c_date']       = dateFormat2($data['customerData'][0]['c_date']);
		$data['productList']  = $this->ProductModel->getCustomerProduct($data['customerData'][0]['customer_id'],'ORDER BY product_id DESC');
		
		//set the validation rules
		$rules ['c_date']          = "required|max_length[100]|min_length[3]";
		$rules ['customer_id']     = "required|callback_customer_id_check";
		$rules ['product_id']      = "required|callback_product_id_check";
		$this->validation->set_rules($rules);
		// set fields names
		$fields['c_date']          = 'date' ;
		$fields['customer_id']     = 'customer' ;
		$fields['product_id']      = 'product' ;
		$this->validation->set_fields($fields);
		
		$this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if (count($_POST) > 0)
		{
			if ($this->validation->run() == FALSE)
			{
				$this->layout->view('store/add',$data);
			}
			else
			{
				//upload config initialization
				$config['upload_path']   = "./public/pdf";
				$config['allowed_types'] = 'pdf|PDF';
				$config['max_size']	     = "104857600";
				$config['max_width']     = '';
				$config['max_height']    = '';

				$config['encrypt_name']  = true;


				$this->load->library('upload', $config);

				if ($this->upload->do_upload())
				{
					$userData     = $this->upload->data();
					$uploadPath   = $userData['full_path'];
					$image_data   =  $userData['file_name'];
				}
				else
				{
					$image_data   = $_POST['attachment'];
				}
				
				
				$this->InventoryModel->edit($_POST,$image_data);
				redirect('admin/inventory/lists/per_page/0');
			}
		}
		else
		{
			$this->layout->view('store/add',$data);
		}
	}
	
	function view($store_id)
	{
		$data['title'] = "Inventory View";
		
		$data['results'] = $this->InventoryModel->getSingleData($store_id);
		
		$this->layout->view('store/view',$data);
	}
	
	function delete($store_id)
	{
		$this->db->where('store_id', $store_id);
		$this->db->delete('store');	
		
		if($this->db->affected_rows() > 0)
		{
			redirect('admin/inventory/lists/per_page/0');
		}
	}

	function customer_id_check($str)
	{
		if ($str == 0)
		{
			$this->validation->set_message('customer_id_check', 'please select a customer');
			return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}
	
	function product_id_check($str)
	{
		if ($str == 0)
		{
			$this->validation->set_message('product_id_check', 'please select a product');
			return FALSE;
		}
		else
		{
			return TRUE;
		}	
	}
}