<form id="form1" class="form"  enctype="multipart/form-data" name="photo_form" method="post" action="<?php echo site_url("admin/customer/edit/$user_id") ?>">
	<h2>Edit Customer</h2>
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

		
		<dt><label for="title">Phone: </label></dt>
		<dd>
			<input type="text" name="work_phone" id="work_phone" class="medium <?php if ($this->validation->work_phone_error) echo 'error' ?>" value="<?php echo ($this->validation->work_phone!='')? $this->validation->work_phone : $results[0]['work_phone']; ?>" />
			<?php if ($this->validation->work_phone_error)
			{
				echo $this->validation->work_phone_error;
			}
			?>
		</dd>		
		
		<dt><label for="title">Address: </label></dt>
		<dd>
			<input type="text" name="address" id="address" class="medium <?php if ($this->validation->address_error) echo 'error' ?>" value="<?php echo ($this->validation->address!='')? $this->validation->address : $results[0]['address']; ?>" />
			<?php if ($this->validation->address_error)
			{
				echo $this->validation->address_error;
			}
			?>
		</dd>	
	</dl>
	
	<input name="Submit" type="submit" class="btn" value="Edit Customer" />
	<input type="hidden" name="user_id" id="user_id" value="<?php echo $results[0]['user_id']; ?>">
</form>