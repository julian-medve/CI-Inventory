<form id="form1" class="form" name="form1" method="post" onsubmit="" action="" enctype="multipart/form-data" >
	<div id="writemain">
		<p class="page-desc"><a href="<?php echo site_url('admin/customer/lists'); ?>" class="back">Go Back</a></p>
	    <h2><?php echo $results[0]['username']."'s"; ?> information</h2>
		<p class="desc"></p>
		<div>
			<table align="center" cellpadding="3" width="100" id="profile-desc" class="nobordertable fixedtable">	
				<tr>
					<td width="40%">
						<table border="0" class="nobordertable">
							<tr>
								<td class="viewlabel">Name:</td>
								<td><?php echo $results[0]['full_name']; ?></td>
							</tr>
							<tr>
								<td class="viewlabel">Username:</td>
								<td><?php echo $results[0]['username'];?></td>
							</tr>	
							<tr>
								<td class="viewlabel">Email:</td>
								<td><?php echo $results[0]['email'];?></td>
							</tr>	
							<tr>
								<td class="viewlabel">Phone:</td>
								<td><?php echo $results[0]['work_phone'];?></td>
							</tr>
							<tr>
								<td class="viewlabel">Address:</td>
								<td><?php echo $results[0]['address'];?></td>
							</tr>							
						</table>
					</td>
				</tr>
			</table>
		</div>
	</div>
</form>