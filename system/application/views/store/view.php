<form id="form1" class="form" name="form1" method="post" onsubmit="" action="" enctype="multipart/form-data" >
	<div id="writemain">
		<p class="page-desc"><a href="<?php echo site_url('admin/inventory/lists'); ?>" class="back">Go Back</a></p>
	    <h2>Inventory Details Information</h2>
		<p class="desc"></p>
		<div>
			<table align="center" cellpadding="3" width="100" id="profile-desc" class="nobordertable fixedtable">	
				<tr>
					<td width="40%">
						<table border="0" class="nobordertable">
							<tr>
								<td class="viewlabel">Date:</td>
								<td><?php echo dateFormat2($results[0]['c_date']); ?></td>
							</tr>
							<tr>
								<td class="viewlabel">R.R# OR REL.#:</td>
								<td><?php echo $results[0]['rr'];?></td>
							</tr>	
							<tr>
								<td class="viewlabel">P.O# OR B/L#:</td>
								<td><?php echo $results[0]['po'];?></td>
							</tr>	
							<tr>
								<td class="viewlabel">Carrier:</td>
								<td><?php echo $results[0]['carrier'];?></td>
							</tr>
							<tr>
								<td class="viewlabel">Received From Transfarred To:</td>
								<td><?php echo $results[0]['received_transfarred'];?></td>
							</tr>
							<tr>
								<td class="viewlabel">Joints In:</td>
								<td><?php echo $results[0]['joints_in'];?></td>
							</tr>
							<tr>
								<td class="viewlabel">Joints Out:</td>
								<td><?php echo $results[0]['joints_out'];?></td>
							</tr>	
							<tr>
								<td class="viewlabel">Footage:</td>
								<td><?php echo $results[0]['footage'];?></td>
							</tr>
							<tr>
								<td class="viewlabel">Manufacturer:</td>
								<td><?php echo $results[0]['manufacturer'];?></td>
							</tr>
							<tr>
								<td class="viewlabel">Rack#:</td>
								<td><?php echo $results[0]['rack'];?></td>
							</tr>
							<tr>
								<td class="viewlabel">AFE:</td>
								<td><?php echo $results[0]['afe'];?></td>
							</tr>
							<tr>
								<td class="viewlabel">PDF:</td>
								<td><a href="<?php echo base_url().'public/pdf/'.$results[0]['attachment'];?>" target="_blank">Download</a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</div>
</form>