<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends Controller {

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
		$this->UsersModel->checkAdminPermission();		
		error_reporting(0);
	}	
	
	function summary($customer_id)
	{
		$data['title']       = "Details Report";
		$data['customer_id'] = $this->uri->segment(4);
		
		if($this->uri->segment(6) == 'asc' OR $this->uri->segment(6) == 'desc')
		{
			$order             = $this->uri->segment(5);
			$by                = $this->uri->segment(6);
			$_SESSION['order'] = $order;
			$_SESSION['by']    = ($this->uri->segment(6) == 'asc')? 'desc' : 'asc';
			$order_by          = "ORDER BY $order $by";
		}
		else
		{
			// if(isset($_SESSION['order']))
			// {
			// 	$order    = $_SESSION['order'];
			// 	$by       = $_SESSION['by'];
			// 	$order_by = "ORDER BY $order $by";
			// }
			// else
			// {
				$order_by = "ORDER BY product_id DESC";
			// }
		}
		
		if($_POST)
		{
			$selectedfield              = $_POST['selectedfield'];
			$search_value               = $_POST['search_value'];
			
			$_SESSION['selectedfield']  = $selectedfield;
			$_SESSION['search_value']   = $search_value;
		}
		else
		{
			if($this->uri->segment(5) == '')
			{
				$selectedfield = $_SESSION['selectedfield'] = "";
				$search_value  = $_SESSION['search_value']  = "";
			}
			else
			{
				$selectedfield              = $_SESSION['selectedfield'];
				$search_value               = $_SESSION['search_value'];
			}
		}
		
		$data['results']     = $this->CustomerModel->getSingleUserData($customer_id);
		$data['products']    = $this->ProductModel->getCustomerProduct($customer_id,$order_by,$selectedfield,$search_value);
		
		$this->layout->view('reports/summary', $data);
	}
	
	function details($product_id)
	{
		$data['title']     = "Details Report";
		$data['product_id'] = $this->uri->segment(4);
		if($this->uri->segment(6) == 'asc' OR $this->uri->segment(6) == 'desc')
		{
			$order             = $this->uri->segment(5);
			$by                = $this->uri->segment(6);
			$_SESSION['order2'] = $order;
			$_SESSION['by2']    = ($this->uri->segment(6) == 'asc')? 'desc' : 'asc';
			$order_by          = "ORDER BY $order $by";
		}
		else
		{
			if(isset($_SESSION['order2']))
			{
				$order    = $_SESSION['order2'];
				$by       = $_SESSION['by2'];
				$order_by = "ORDER BY $order $by";
			}
			else
			{
				$order_by = "ORDER BY store_id ASC";
			}
		}
		
		if($_POST)
		{
			$selectedfield              = $_POST['selectedfield'];
			$search_value               = $_POST['search_value'];
			
			$_SESSION['selectedfield2']  = $selectedfield;
			$_SESSION['search_value2']   = $search_value;
		}
		else
		{
			if($this->uri->segment(5) == '')
			{
				$selectedfield = $_SESSION['selectedfield2'] = "";
				$search_value  = $_SESSION['search_value2']  = "";
			}
			else
			{
				$selectedfield              = $_SESSION['selectedfield2'];
				$search_value               = $_SESSION['search_value2'];
			}
		}
		
		$data['product']   = $this->ProductModel->getSingleData($product_id);
		$customer_id       = $data['product'][0]['customer_id'];
		$data['results']   = $this->CustomerModel->getSingleUserData($customer_id);
		$data['inventory'] = $this->InventoryModel->getProductInventory($product_id,$order_by,$selectedfield,$search_value);
		
		$this->layout->view('reports/details', $data);
	}
}