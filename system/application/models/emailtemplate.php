<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

class EmailTemplate extends Model
{

	   function __construct()
	   {
	   	  parent::__construct();
	   }
	   
	   function sendEmail($emailTo, $template, $data)
	   {
	   	  $CI =& get_instance();
	   	  $CI->load->library('email');
	   	  
	   	  $template     = $this->db->query("SELECT * FROM email_template WHERE type = '$template'")->result_array();	
	   	  $emailBody    = $template[0]['plain_body'];
	   	  $emailSubject = $template[0]['subject'];
	   	  
	   	  foreach ($data as $key => $value)
	   	  {
	     	  	$emailBody = str_replace( "{" . trim($key) . "}", $value, $emailBody);
	   	  }
	   	  
	   	  try
	   	  {	
	    	  	$CI->email->from('admin@runnersutah.com', 'runnersutah');
	    	  	$CI->email->to($emailTo);
	    	  	$CI->email->subject($emailSubject);
	    	  	$CI->email->message($emailBody);
	    	  	
	    	  	
	    	  	$CI->email->send();
	    	  	
	    	  	return true;
	   	  }
	   	  catch (Exception $e)
	   	  {
	   	    	echo "Server not found";
	   	  }
	   }
}