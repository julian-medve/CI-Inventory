<script type="text/javascript">
$(function()
{

	/*
	** Author: Yunus Ali Khan[yunus.alikhan@gmail.com]
	** check old password availability
	*/
	$("#old_password").blur( function() 
	{ 
		$.ajax({
  		type: "POST",
  		url: "<?php echo site_url("users/login/checkOldPassword")?>",
  		data: "old_password=" +$('#old_password').val(),
  		success: function(msg){
    	//alert( "Data Saved: " + msg );
		$('#message').empty();
		$('#message').append(msg);
		$('#message').show();
	}
	});
	});
	
	/*
	** Author: Yunus Ali Khan[yunus.alikhan@gmail.com]
	** check newpassword and retype password
	*/	
	$("#retype_password").blur(function()
	{
		n_password = $('#new_password').val();
		r_password = $('#retype_password').val();
		if (!(n_password == r_password))
		{
			$('#tpmatch').empty();
			$('#tpmatch').append('<b>Passwords do not match</b>');
			$('#tpmatch').show();
		}
		else
		{
			$('#tpmatch').empty();
			$('#blank_submit').empty();
		}
	});
});
</script>

<form id="changepassword" class="form" name="changepassword" method="post" action="<?php echo site_url('users/login/changepassword') ?>">
	
	<h2>Change Password</h2>
	<p class="desc">Enter your old password, new password.</p>
	<dl>
		<dt><label for="name">Old password: </label></dt>
		<dd>
			<input type="password" name="old_password" id="old_password" class="medium" value="" />
			<?php echo $this->validation->old_password_error; ?>
			<div id="message" style="display:none; color:red;"></div>
			<p class="error"><?php echo $error_msg1; ?></p>
		</dd>
		
		<dt><label for="name">New Password: </label></dt>
		<dd>
			<input type="password" name="new_password" id="new_password" class="medium" value="" />
			<?php echo $this->validation->new_password_error; ?>
		</dd>
		
		<dt><label for="name">Retype Password: </label></dt>
		<dd>
			<input type="password" name="retype_password" id="retype_password" class="medium" value="" />
			<div id="tpmatch" style="display:none; color:red;"></div>
			<div id="blank_submit" style="display:none; color:red;"></div>
			<p class="error"><?php echo $error_msg2; ?></p>
		</dd>
	</dl>
	<input name="Submit" type="submit" id="submit" class="btn" value="Change Password " />
</form>