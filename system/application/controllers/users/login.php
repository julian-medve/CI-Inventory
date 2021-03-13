<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class Login extends Controller {

	var $data;

	function __construct()
	{
		parent::__construct();	
		
		$this->load->library('Validation');
		$this->load->model('EmailTemplate');
		$this->load->model('UsersModel');
		
		error_reporting(0);
	}	
	
	function index()
	{
		$this->data['title'] = "User Login";
		
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
				$this->load->view('admin/user_login',$this->data);
	        }
			else
			{
				if($validate = $this->UsersModel->validateUser($_POST))
				{
					if($validate[0]['user_role_id'] == '2')
					{
						//if validate then store the user_id into SESSION
						$_SESSION['user_id']       = $validate[0]['user_id'];
						$_SESSION['username']      = $validate[0]['username'];
						$_SESSION['email']         = $validate[0]['email'];
						$_SESSION['user_role_id']  = $validate[0]['user_role_id'];
						
						redirect('users/reports/summary');
					}
				}
				else
				{
					$this->data['loginerror'] = "<span class='error'><br>Invalid username or password.Please try again.</span>";
					
					redirect('users/login');
				}
			}
		}
		else
		{
			$this->load->view('admin/user_login',$this->data);
		}
	}
	
	function changePassword()
	{
		$this->UsersModel->checkAdminPermission2();		
		
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
				$this->layout->view('users/change_password_admin2',$this->data);
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
						
						$this->data['error_msg1'] = "Password has been changed successfully!";
					
						$this->layout->view('users/change_password_admin2',$this->data);
					}
					else
					{
						$this->data['error_msg1'] = "Passwords do not match - please enter the same password";
					
						$this->layout->view('users/change_password_admin2',$this->data);
					}
				}
				else
				{
					$this->data['error_msg2'] = "Please retype your correct password";
					
					$this->layout->view('users/change_password_admin2',$this->data);
				}
			}
		}
		else
		{	
			$this->layout->view('users/change_password_admin2',$this->data);
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
		$this->UsersModel->checkAdminPermission2();		
		
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
		$this->UsersModel->checkAdminPermission2();		
		
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
		
        redirect('users/login');
	}	
	
	function forgotpassword()
	{
		$this->data['title'] = "Forgot Password";
		
		$rules ['email']        = "required|valid_email";
		$this->validation->set_rules($rules);
		
		$fields['email']        = 'email';
		$this->validation->set_fields($fields);
		
        $this->validation->set_error_delimiters('<label class="error">', '</label>');
		
		if (count($_POST) > 0)
		{
			if ($this->validation->run() == FALSE)
			{
				$this->load->view('admin/forgot_password',$this->data);
			}
			else
			{
				$email = $this->input->post('email');
				
				$resutlt  = $this->UsersModel->getSingleUserData($email);
				
				$username     = $resutlt[0]['username'];
				$password     = $resutlt[0]['password_text'];
			
				//send email for request forgot password
				$server_name = site_url();
				$emailData   = array('username' => $username, 'server_name' => $server_name, 'new_link' => $server_name . "/users/login/newpassword/$username/$password/" );
				//print_r($emailData);
				$this->EmailTemplate->sendEmail($email, 'FORGOT_PASSWORD', $emailData);
				
				$this->data['succ_title']  = '<h1>Successfully sent an email</h1>';
				$this->data['succ_body']   = "<h2>An email has been sent to $email<h2>";
				
				$this->load->view('admin/forgot_password',$this->data);
			}
		}		
		else
		{
			$this->load->view('admin/forgot_password',$this->data);
		}
	}
	
	function newPassword()
	{
		$this->data['title'] = "New Password";
		
		$this->data['username']  = $this->uri->segment(4);
		$this->data['password']  = $this->uri->segment(5);
		
		//set validation rules
		$rules ['new_password']    = "required|max_length[25]|min_length[5]";
		$rules ['retype_password'] = "required|max_length[25]|min_length[5]|matches[new_password]";
		
		$this->validation->set_rules($rules);
		
		//define fields name
		$fields['new_password']    = 'new password';
		$fields['retype_password'] = 'retype password';
        
		// Define validation config
        $this->validation->set_fields( $fields );
 	    $this->validation->set_error_delimiters( '<p class="error">', '</p>' );
		
		if( count($_POST) )
		{
			if( $this->validation->run() == FALSE )
	        {
				$this->load->view('admin/new_password',$this->data);
	        }
			else
			{
				if($this->UsersModel->updateNewPassword($_POST))
				{
					$this->data['succ_title']  = '<h1>Successfully changed password</h1>';
					$this->data['succ_body']   = "<h2>Your Password has been changed successfully!<h2>";
					
					$this->load->view('admin/new_password',$this->data);
				}
			}
		}
		else
		{
			$this->load->view('admin/new_password',$this->data);
		}
	}	
}	