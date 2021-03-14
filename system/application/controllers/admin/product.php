<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product extends Controller {

	var $data;

	function __construct()
	{
		parent::__construct();	
		
		$this->load->library('Validation');
		$this->load->library('pagination');
		
		$this->load->model('ProductModel');
		$this->load->model('CustomerModel');
		$this->load->model('UsersModel');
		
		$this->UsersModel->checkAdminPermission();		
		error_reporting(0);
	}	
	
	function lists()
	{	
		global $per_page,$start,$limit;
		
		$this->setPaginationParams();
		
		$start = $this->uri->segment(5);
		if (empty($start)) 
		{
		   	$start = 0;
		}
		$limit=$per_page;
		$links = $this->pagination->create_links();
		
		$result_array	= $this->ProductModel->getList($start,$limit);
		
		$links = $this->pagination->create_links();
		$data = array(
				"categoryList"        => $result_array,
				"links"               => $links,
				"per_msg"			  => $per_msg1,
				"title"	              => 'Product List'  
			  );
		
		$this->layout->view('product/list', $data);
	}
	
	function setPaginationParams()
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
		
	  	$result = $this->db->query( "SELECT * FROM products" )->result_array();
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
		$config['base_url']   = site_url().'/admin/product/lists/'		                      
	                        			. "/per_page/";
	    $config['total_rows'] = count($result);
		$config['per_page']   = $per_page;
		
		$this->pagination->initialize($config);
	}	
	
	function add()
	{
		$data['title'] = "Product Add";
		
		$data['customers'] = $this->CustomerModel->getList2();
		
		//set the validation rules
		$rules ['outside_diameter'] = "required|max_length[100]|min_length[2]";
		$rules ['customer_id']      = "required|callback_customer_id_check";
		$this->validation->set_rules($rules);
		// set fields names
		$fields['outside_diameter'] = 'outside diameter' ;
		$fields['customer_id']      = 'customer' ;
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
				$this->layout->view('product/add',$data);
			}
			else
			{
				$categoryData = array(
				                  'outside_diameter'    => $_POST['outside_diameter'],
													'wall_thickness'      => $_POST['wall_thickness'],
													'ibs_per_foot'        => $_POST['ibs_per_foot'],
													'end_type'            => $_POST['end_type'],
													'grade'               => $_POST['grade'],
													'coating'             => $_POST['coating'],
													'foreman'             => $_POST['foreman'],
													'customer_id'         => $_POST['customer_id']
				                 );
				if($this->ProductModel->add($categoryData))
				{
					redirect('admin/product/lists');
				}
			}
		}
		else
		{
			$data['form_validation_code'] = $_SESSION['form_validation_code'] = time();
			$this->layout->view('product/add', $data);
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
	
	function edit($product_id)
	{
		$data['title'] = 'Edit Product';
		$data['edit']  = 1;
		$data['customers'] = $this->CustomerModel->getList2();
		//get article data using passing article id
		$data['customerData'] = $this->ProductModel->getSingleData($product_id);
		//set the validation rules
		$rules ['outside_diameter'] = "required|max_length[100]|min_length[3]";
		$rules ['customer_id']      = "required|callback_customer_id_check";
		$this->validation->set_rules($rules);
		// set fields names
		$fields['outside_diameter'] = 'outside diameter' ;
		$fields['customer_id']      = 'customer' ;
		$this->validation->set_fields($fields);
		
        $this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if (count($_POST) > 0)
		{
			if ($this->validation->run() == FALSE)
			{
				$this->layout->view('product/add',$data);
			}
			else
			{
				
				$this->ProductModel->edit($_POST);
				redirect('admin/product/lists');
			}
		}
		else
		{
			$this->layout->view('product/add',$data);
		}
	}
	
	function view($product_id)
	{
		$data['title'] = "Product View";
		
		$data['results'] = $this->ProductModel->getSingleData($product_id);
		
		$this->layout->view('product/view',$data);
	}
	
	function delete($product_id)
	{
		$this->db->where('product_id', $product_id);
		$this->db->delete('products');	
		
		if($this->db->affected_rows() > 0)
		{
			redirect('admin/product/lists');
		}
	}

	function getProduct()	
	{
		$customer_id = $_POST['customer_id'];
		$teamList = $this->ProductModel->getCustomerProduct($customer_id,'ORDER BY outside_diameter ASC');
		$str = "";
		$str .="<option value='0'>Please select a product</option>";
		foreach($teamList as $row)
		{
			$product_id       = $row['product_id'];
			$outside_diameter = $row['outside_diameter'].','.$row['wall_thickness'].','.$row['ibs_per_foot'].','.$row['end_type'].','.$row['grade'].','.$row['coating'];
			
			$str .="<option value='$product_id'>$outside_diameter</option>";
		}
		
		echo $str;
	}
}