<script type='text/javascript' src='<?php echo base_url() ?>public/js/date.js'></script>
<script type='text/javascript' src='<?php echo base_url() ?>public/js/jquery.datePicker.js'></script>
<link href="<?php echo base_url(); ?>public/css/datePicker.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function(){
		$('#c_date').datePicker({startDate:'2008-01-01'});
		$('#c_date').click( function () {$('#c_date').datePicker(); } );
	});

function getProduct(customer_id)
{
	$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>admin/product/getProduct",
			data: "customer_id=" +customer_id,
			success: function(msg){
				$('#product_id').html(msg);
			}
	});
}	
</script>

<form id="form1" class="form"  enctype="multipart/form-data" name="photo_form" method="post" action="<?php echo site_url('admin/inventory/') ?><?php if($edit !=1) echo '/add'; else echo '/edit/'.$customerData[0]['store_id']; ?>">
	<?php
	if($edit !=1)
	{
		?>
		<h2>Add Inventory</h2>
		<?
	}
	else
	{
		?>
		<h2>Edit Inventory</h2>
		<?
	}
	?>
	<p class="desc">Enter your inventory information.
		
	<dl>
		<dt><label for="message">Customer: </label></dt>
		<dd>	
			<select id="customer_id" name="customer_id"  onChange="getProduct(this.value)">
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
		
		<dt><label for="title">Product: </label></dt>
		<dd>
			<select id="product_id" name="product_id">
				<option value="0">Please select a product</option>
				<?php foreach($productList as $row)
				{
					?>
					<option value="<?php echo $row['product_id']; ?>" <?php echo ($customerData[0]['product_id'] == $row['product_id']) ? 'selected="selected"' : ''?><?php echo ($_POST['product_id'] == $row['product_id']) ? 'selected="selected"' : ''?>><?php echo $row['outside_diameter'].','.$row['wall_thickness'].','.$row['ibs_per_foot'].','.$row['end_type'].','.$row['grade'].','.$row['coating']; ?></option>
					<?
				}
				?>
			</select>
			<?php if ($this->validation->product_id_error)
			{
				echo $this->validation->product_id_error;
			}
			?>
		</dd>
		
		<dt><label for="title">PDF: </label></dt>
		<dd>
			<input type="file" name="userfile" />
		</dd>
		
		<dt><label for="title">Date: </label></dt>
		<dd>
			<input type="text" name="c_date" id="c_date" class="medium <?php if ($this->validation->c_date_error) echo 'error' ?>" value="<?php echo ($this->validation->c_date!='')? $this->validation->c_date : $c_date; ?>" />
			<?php if ($this->validation->c_date_error)
			{
				echo $this->validation->c_date_error;
			}
			?>
			<br /><br />
		</dd>
		
		<dt><label for="title">AFE: </label></dt>
		<dd>
			<input type="text" name="afe" id="afe" class="medium <?php if ($this->validation->afe_error) echo 'error' ?>" value="<?php echo ($_POST['afe'] !='')? $_POST['afe'] : $customerData[0]['afe']; ?>" />
			<?php if ($this->validation->afe_error)
			{
				echo $this->validation->afe_error;
			}
			?>
		</dd>
		
		<dt><label for="title">R.R# OR REL.#: </label></dt>
		<dd>
			<input type="text" name="rr" id="rr" class="medium <?php if ($this->validation->rr_error) echo 'error' ?>" value="<?php echo ($_POST['rr'] !='')? $_POST['rr'] : $customerData[0]['rr']; ?>" />
			<?php if ($this->validation->rr_error)
			{
				echo $this->validation->rr_error;
			}
			?>
		</dd>
		
		<dt><label for="title">P.O# OR B/L#: </label></dt>
		<dd>
			<input type="text" name="po" id="po" class="medium <?php if ($this->validation->po_error) echo 'error' ?>" value="<?php echo ($_POST['po'] !='')? $_POST['po'] : $customerData[0]['po']; ?>" />
			<?php if ($this->validation->po_error)
			{
				echo $this->validation->po_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Carrier: </label></dt>
		<dd>
			<input type="text" name="carrier" id="carrier" class="medium <?php if ($this->validation->carrier_error) echo 'error' ?>" value="<?php echo ($_POST['carrier'] !='')? $_POST['carrier'] : $customerData[0]['carrier']; ?>" />
			<?php if ($this->validation->carrier_error)
			{
				echo $this->validation->carrier_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Received From Transfarred To: </label></dt>
		<dd>
			<input type="text" name="received_transfarred" id="received_transfarred" class="medium <?php if ($this->validation->received_transfarred_error) echo 'error' ?>" value="<?php echo ($_POST['received_transfarred'] !='')? $_POST['received_transfarred'] : $customerData[0]['received_transfarred']; ?>" />
			<?php if ($this->validation->received_transfarred_error)
			{
				echo $this->validation->received_transfarred_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Joints In: </label></dt>
		<dd>
			<input type="text" name="joints_in" id="joints_in" class="medium <?php if ($this->validation->joints_in_error) echo 'error' ?>" value="<?php echo ($_POST['joints_in'] != '')? $_POST['joints_in'] : $customerData[0]['joints_in']; ?>" />
			<?php if ($this->validation->joints_in_error)
			{
				echo $this->validation->joints_in_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Joints Out: </label></dt>
		<dd>
			<input type="text" name="joints_out" id="joints_out" class="medium <?php if ($this->validation->joints_out_error) echo 'error' ?>" value="<?php echo ($_POST['joints_out'] !='')? $_POST['joints_out'] : $customerData[0]['joints_out']; ?>" />
			<?php if ($this->validation->joints_out_error)
			{
				echo $this->validation->joints_out_error;
			}
			?>
			<span class="previous"><?php echo $customerData[0]['joints_out']; ?></span>
		</dd>
		
		<dt><label for="title">Footage: </label></dt>
		<dd>
			<input type="text" name="footage" id="footage" class="medium <?php if ($this->validation->footage_error) echo 'error' ?>" value="<?php echo ($_POST['footage'] !='')? $_POST['footage'] : $customerData[0]['footage']; ?>" />
			<?php if ($this->validation->footage_error)
			{
				echo $this->validation->footage_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Manufacturer: </label></dt>
		<dd>
			<input type="text" name="manufacturer" id="manufacturer" class="medium <?php if ($this->validation->manufacturer_error) echo 'error' ?>" value="<?php echo ($_POST['manufacturer'] !='')? $_POST['manufacturer'] : $customerData[0]['manufacturer']; ?>" />
			<?php if ($this->validation->manufacturer_error)
			{
				echo $this->validation->manufacturer_error;
			}
			?>
		</dd>
		
		<dt><label for="title">Rack#: </label></dt>
		<dd>
			<input type="text" name="rack" id="rack" class="medium <?php if ($this->validation->rack_error) echo 'error' ?>" value="<?php echo ($_POST['rack'] !='')? $_POST['rack'] : $customerData[0]['rack']; ?>" />
			<?php if ($this->validation->rack_error)
			{
				echo $this->validation->rack_error;
			}
			?>
		</dd>
	</dl>	
	
	<?php
	if($edit !=1)
	{
		?>
		<input name="Submit" type="submit" class="btn" value="Add Inventory " />
		<input name="Submit" type="submit" class="btn" value="Save and Add New" />
		<input type="hidden" name="form_validation_code" value="<?php echo $_SESSION['form_validation_code']; ?>">
		<?
	}
	else
	{
		?>
		<input name="Submit" type="submit" class="btn" value="Edit Inventory " />
		<input type="hidden" name="store_id" value="<?php echo $customerData[0]['store_id']; ?>">
		<input type="hidden" name="attachment" value="<?php echo $customerData[0]['attachment']; ?>">
		<?
	}
	?>
</form>