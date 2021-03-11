<form id="form1" class="form"  enctype="multipart/form-data" name="photo_form" method="post" action="<?php echo site_url('admin/product/') ?><?php if($edit !=1) echo '/add'; else echo '/edit/'.$customerData[0]['product_id']; ?>">
	<?php
	if($edit !=1)
	{
		?>
		<h2>Add Product</h2>
		<?
	}
	else
	{
		?>
		<h2>Edit Product</h2>
		<?
	}
	?>
	<p class="desc">Enter your product information.
		
	<dl>
		<dt><label for="message">Customer: </label></dt>
		<dd>	
			<select id="customer_id" name="customer_id" class="select60">
				<option value="0">Please select a customer</option>
				<?php
				foreach($customers as $row)
				{
				?>
				<option value="<?php echo $row['user_id']; ?>" <?php echo ($_POST['customer_id'] == $row['user_id']) ? 'selected="selected"' : '' ?><?php echo ($customerData[0]['customer_id'] == $row['user_id']) ? 'selected="selected"' : '' ?>><?php echo $row['full_name']; ?></option>
				<?php
				}
				?>
			</select>
			<?php if ($this->validation->customer_id_error)
			{
				echo $this->validation->customer_id_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Outside Diameter: </label></dt>
		<dd>
			<input type="text" name="outside_diameter" id="outside_diameter" class="medium <?php if ($this->validation->outside_diameter_error) echo 'error' ?>" value="<?php echo ($this->validation->outside_diameter!='')? $this->validation->outside_diameter : $customerData[0]['outside_diameter']; ?>" />
			<?php if ($this->validation->outside_diameter_error)
			{
				echo $this->validation->outside_diameter_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Wall Thickness: </label></dt>
		<dd>
			<input type="text" name="wall_thickness" id="wall_thickness" class="medium <?php if ($this->validation->wall_thickness_error) echo 'error' ?>" value="<?php echo ($_POST['wall_thickness'] !='')? $_POST['wall_thickness'] : $customerData[0]['wall_thickness']; ?>" />
			<?php if ($this->validation->wall_thickness_error)
			{
				echo $this->validation->wall_thickness_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Ibs Per Foot: </label></dt>
		<dd>
			<input type="text" name="ibs_per_foot" id="ibs_per_foot" class="medium <?php if ($this->validation->ibs_per_foot_error) echo 'error' ?>" value="<?php echo ($_POST['ibs_per_foot'] !='')? $_POST['ibs_per_foot'] : $customerData[0]['ibs_per_foot']; ?>" />
			<?php if ($this->validation->ibs_per_foot_error)
			{
				echo $this->validation->ibs_per_foot_error;
			}
			?>
		</dd>
		
		<dt><label for="title">End Type: </label></dt>
		<dd>
			<input type="text" name="end_type" id="end_type" class="medium <?php if ($this->validation->end_type_error) echo 'error' ?>" value="<?php echo ($_POST['end_type'] !='')? $_POST['end_type'] : $customerData[0]['end_type']; ?>" />
			<?php if ($this->validation->end_type_error)
			{
				echo $this->validation->end_type_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Grade: </label></dt>
		<dd>
			<input type="text" name="grade" id="grade" class="medium <?php if ($this->validation->grade_error) echo 'error' ?>" value="<?php echo ($_POST['grade'] !='')? $_POST['grade'] : $customerData[0]['grade']; ?>" />
			<?php if ($this->validation->grade_error)
			{
				echo $this->validation->grade_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Coating: </label></dt>
		<dd>
			<input type="text" name="coating" id="coating" class="medium <?php if ($this->validation->coating_error) echo 'error' ?>" value="<?php echo ($_POST['coating'] !='')? $_POST['coating'] : $customerData[0]['coating']; ?>" />
			<?php if ($this->validation->coating_error)
			{
				echo $this->validation->coating_error;
			}
			?>
		</dd>
		
		
		
		<dt><label for="title">Foreman: </label></dt>
		<dd>
			<input type="text" name="foreman" id="foreman" class="medium <?php if ($this->validation->foreman_error) echo 'error' ?>" value="<?php echo ($_POST['foreman'] !='')? $_POST['foreman'] : $customerData[0]['foreman']; ?>" />
			<?php if ($this->validation->foreman_error)
			{
				echo $this->validation->foreman_error;
			}
			?>
		</dd>
	</dl>	
	
	<?php
	if($edit !=1)
	{
		?>
		<input name="Submit" type="submit" class="btn" value="Add Product " />
		<input type="hidden" name="form_validation_code" value="<?php echo $_SESSION['form_validation_code']; ?>">
		<?
	}
	else
	{
		?>
		<input name="Submit" type="submit" class="btn" value="Edit Product " />
		<input type="hidden" name="product_id" value="<?php echo $customerData[0]['product_id']; ?>">
		<?
	}
	?>
</form>