<form id="form1" class="form"  enctype="multipart/form-data" name="photo_form" method="post" action="<?php echo site_url('admin/customer/add') ?>">
	<h2>Add Customer</h2>
	<p class="desc">Enter your customer information.
		
	<dl>
		<dt><label for="title">Full Name: </label></dt>
		<dd>
			<input type="text" name="full_name" id="full_name" class="medium <?php if ($this->validation->full_name_error) echo 'error' ?>" value="<?php echo ($this->validation->full_name!='')? $this->validation->full_name : $results[0]['full_name']; ?>" />
			<?php if ($this->validation->full_name_error)
			{
				echo $this->validation->full_name_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Email: </label></dt>
		<dd>
			<input type="text" name="email" id="email" class="medium <?php if ($this->validation->email_error) echo 'error' ?>" value="<?php echo ($this->validation->email!='')? $this->validation->email : $results[0]['email']; ?>" />
			<?php if ($this->validation->email_error)
			{
				echo $this->validation->email_error;
			}
			?>
		</dd>
		
		<dt><label for="title">User Name: </label></dt>
		<dd>
			<input type="text" name="username" id="username" class="medium <?php if ($this->validation->username_error) echo 'error' ?>" value="<?php echo ($this->validation->username!='')? $this->validation->username : $results[0]['username']; ?>" />
			<?php if ($this->validation->username_error)
			{
				echo $this->validation->username_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Phone: </label></dt>
		<dd>
			<input type="text" name="work_phone" id="work_phone" class="medium <?php if ($this->validation->work_phone_error) echo 'error' ?>" value="<?php echo ($_POST['work_phone'] !='')? $_POST['work_phone'] : $results[0]['work_phone']; ?>" />
			<?php if ($this->validation->work_phone_error)
			{
				echo $this->validation->work_phone_error;
			}
			?>
		</dd>		
		
		<dt><label for="title">Address: </label></dt>
		<dd>
			<input type="text" name="address" id="address" class="medium <?php if ($this->validation->address_error) echo 'error' ?>" value="<?php echo ($_POST['address'] !='')? $_POST['address'] : $results[0]['address']; ?>" />
			<?php if ($this->validation->address_error)
			{
				echo $this->validation->address_error;
			}
			?>
		</dd>	
		
		<dt><label for="title">Password: </label></dt>
		<dd>
			<input type="password" name="password" id="password" class="medium <?php if ($this->validation->password_error) echo 'error' ?>" value="<?php echo ($this->validation->password!='')? $this->validation->password : ''; ?>" />
			<?php if ($this->validation->password_error)
			{
				echo $this->validation->password_error;
			}
			?>
		</dd>
	
		<dt><label for="title">Retype Password: </label></dt>
		<dd>
			<input type="password" name="retype_password" id="retype_password" class="medium <?php if ($this->validation->retype_password_error) echo 'error' ?>" value="<?php echo ($this->validation->retype_password!='')? $this->validation->retype_password : ''; ?>" />
			<?php if ($this->validation->retype_password_error)
			{
				echo $this->validation->retype_password_error;
			}
			?>
		</dd>	
	</dl>
	
	<input name="Submit" type="submit" class="btn" value="  Add Customer " />
</form>