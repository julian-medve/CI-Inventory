<form id="changepassword" class="form" name="changepassword" method="post" action="<?php echo site_url('admin/login/changeusername') ?>">
	
	<h2>Change username</h2>
	<p class="desc">Enter your new username.</p>
	<dl>
		<dt><label for="name">New username: </label></dt>
		<dd>
			<input type="text" name="username" id="old_password" name="old_password" class="medium <?php if ($this->validation->username_error) echo 'error' ?>" value="<?php echo ($this->validation->username!='')? $this->validation->username : $_SESSION['username']; ?>" />
			<?php if ($this->validation->username_error)
			{
				echo $this->validation->username_error;
			}
			?>
		</dd>
	</dl>
	<input name="Submit" type="submit" id="submit" class="btn" value="Change Username " />
</form>
