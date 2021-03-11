<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Controller {

	var $data;

	function __construct()
	{
		parent::Controller();	
		
		$this->load->library('Validation');
		
		$this->load->model('UsersModel');
		
		error_reporting(0);
	}	
	
	function index()
	{
		$this->data['title'] = "Admin Login";
		
		$this->data['loginerror'] = '';
		//set validation rules
		$rules ['username'] = "required|max_length[10]|min_length[5]";
		$rules ['password'] = "required|max_length[32]|min_length[5]";
		
		$this->validation->set_rules($rules);
		
		//define fields name
		$fields['username']  = 'username';
		$fields['password']  = 'password';
        
		// Define validation config
        $this->validation->set_fields( $fields );
 	    $this->validation->set_error_delimiters('<label for="error" class="error">', '</label>');
		
		if( count($_POST) )
		{
			if( $this->validation->run() == FALSE )
	        {
				$this->load->view('admin/adminlogin',$this->data);
	        }
			else
			{
				if($validate = $this->UsersModel->validateUser($_POST))
				{
					if($validate[0]['user_role_id'] == '1')
					{
						//if validate then store the user_id into SESSION
						$_SESSION['user_id']       = $validate[0]['user_id'];
						$_SESSION['username']      = $validate[0]['username'];
						$_SESSION['email']         = $validate[0]['email'];
						$_SESSION['user_role_id']  = $validate[0]['user_role_id'];
						
						redirect('admin/customer/lists');
					}
				}
				else
				{
					$this->data['loginerror'] = "<span class='error'><br>Invalid username or password.Please try again.</span>";
					
					redirect('admin/login');
				}
			}
		}
		else
		{
			$this->load->view('admin/adminlogin',$this->data);
		}
	}
	
	function changePassword()
	{
		$this->UsersModel->checkAdminPermission();		
		
		$this->data['title']	= "Change Password";
		
		//set the validation rules
		$rules ['old_password']	  = "required|max_length[32]|min_length[5]";
		$rules ['new_password']	  = "required|max_length[32]|min_length[5]";

		$this->validation->set_rules($rules);
		// set fields names
		$fields['old_password'] = 'old_password' ;
		$fields['new_password'] = 'new_password' ;
		
		$this->validation->set_fields($fields);
        $this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if(count($_POST))
		{
			if ($this->validation->run() == FALSE)
			{	
				$this->layout->view('users/change_password_admin',$this->data);
			}
			else
			{
				//get the old Password from post
				$old_password    = $this->input->post('old_password');
				$previous        = md5($old_password);

				//get the new password from post
				$new_password    = $this->input->post('new_password');
				$new_pass        = md5($new_password);

				//confirm the new password
				$retype_password = $this->input->post('retype_password');

				//get the user details with user ID
				if(count($this->UsersModel->checkPasswordAvailability($_SESSION['user_id'], $previous)) != 0)
				{
					//confirm new password validity
					if ($new_password == $retype_password)
					{
						$this->UsersModel->changePassword($new_pass, $_SESSION['user_id']);
						redirect('admin/login/changepassword/');
					}
					else
					{
						$this->data['error_msg1'] = "Passwords do not match - please enter the same password";
					
						$this->layout->view('users/change_password_admin',$this->data);
					}
				}
				else
				{
					$this->data['error_msg2'] = "Please retype your correct password";
					
					$this->layout->view('users/change_password_admin',$this->data);
				}
			}
		}
		else
		{	
			$this->layout->view('users/change_password_admin',$this->data);
		}
	}
	
	function checkOldPassword()
	{	
		//get the old Password
		$old_password    = $this->input->post('old_password');

		//make md5 the old password
		$previous        = md5($old_password);

		//check the password and id in database
		if(count($this->UsersModel->checkPasswordAvailability($_SESSION['user_id'], $previous)) == 0)
		{
			echo "<b>Please type your current password correctly</b>";
		}
	}
	
	function changeEmail()
	{
		$this->UsersModel->checkAdminPermission();		
		
		$this->data['title']	= "Change Password";
		
		//set the validation rules
		$rules ['email'] = "required|valid_email|max_length[100]|min_length[5]";
		$this->validation->set_rules($rules);
		// set fields names
		$fields['email'] = 'email' ;
		
		$this->validation->set_fields($fields);
        $this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if(count($_POST))
		{
			if ($this->validation->run() == FALSE)
			{	
				$this->layout->view('users/change_email_admin',$this->data);
			}
			else
			{
				$this->UsersModel->changeEmail($_POST['email']);
				unset($_SESSION['email']);
				$_SESSION['email'] = $_POST['email'];
				redirect('admin/login/changeemail');
			}
		}
		else
		{	
			$this->layout->view('users/change_email_admin',$this->data);
		}
	}
	
	function changeUsername()
	{
		$this->UsersModel->checkAdminPermission();		
		
		$this->data['title']	= "Change username";
		
		//set the validation rules
		$rules ['username'] = "required|max_length[100]|min_length[5]";
		$this->validation->set_rules($rules);
		// set fields names
		$fields['username'] = 'username' ;
		
		$this->validation->set_fields($fields);
        $this->validation->set_error_delimiters('<p class="error">', '</p>');
		
		if(count($_POST))
		{
			if ($this->validation->run() == FALSE)
			{	
				$this->layout->view('users/change_username_admin',$this->data);
			}
			else
			{
				$this->UsersModel->changeUsername($_POST['username']);
				unset($_SESSION['username']);
				$_SESSION['username'] = $_POST['username'];
				redirect('admin/login/changeusername');
			}
		}
		else
		{	
			$this->layout->view('users/change_username_admin',$this->data);
		}
	}	

	function logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
		unset($_SESSION['email']);
		unset($_SESSION['user_role_id']);
		
		session_destroy();
		
        redirect('admin/login');
	}	
}	