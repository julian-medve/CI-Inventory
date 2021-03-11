<form id="changepassword" class="form" name="changepassword" method="post" action="<?php echo site_url('admin/login/changeemail') ?>">
	
	<h2>Change Email</h2>
	<p class="desc">Enter your new email.</p>
	<dl>
		<dt><label for="name">New Email: </label></dt>
		<dd>
			<input type="text" name="email" id="old_password" name="old_password" class="medium <?php if ($this->validation->email_error) echo 'error' ?>" value="<?php echo ($this->validation->email!='')? $this->validation->email : $_SESSION['email']; ?>" />
			<?php if ($this->validation->email_error)
			{
				echo $this->validation->email_error;
			}
			?>
		</dd>
	</dl>
	<input name="Submit" type="submit" id="submit" class="btn" value="Change Email " />
</form>
