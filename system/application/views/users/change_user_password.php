<script type="text/javascript">
$(function()
{
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

<form id="changepassword" class="form" name="changepassword" method="post" action="<?php echo site_url('admin/customer/changepassword').'/'.$user_id ?>">
	
	<h2>Change Password</h2>
	<p class="desc">Enter your new password.</p>
	<?php echo $succMsg; ?>
	<dl>
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
			<?php echo $this->validation->retype_password_error; ?>
		</dd>
	</dl>
	<input name="Submit" type="submit" id="submit" class="btn" value="Change Password " />
	<input type="hidden" name="user_id" id="user_id" value="<?php echo $user_id; ?>">
</form>