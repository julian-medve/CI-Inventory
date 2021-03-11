<form id="form1" class="form" name="form1" method="post" onsubmit="" action="" enctype="multipart/form-data" >
	<div id="writemain">
		<p class="page-desc"><a href="<?php echo site_url('admin/product/lists'); ?>" class="back">Go Back</a></p>
	    <h2>Product Details Information</h2>
		<p class="desc"></p>
		<div>
			<table align="center" cellpadding="3" width="100" id="profile-desc" class="nobordertable fixedtable">	
				<tr>
					<td width="40%">
						<table border="0" class="nobordertable">
							<tr>
								<td class="viewlabel">Outside Diameter:</td>
								<td><?php echo $results[0]['outside_diameter']; ?></td>
							</tr>
							<tr>
								<td class="viewlabel">Wall Thickness:</td>
								<td><?php echo $results[0]['wall_thickness'];?></td>
							</tr>	
							<tr>
								<td class="viewlabel">Ibs Per Foot:</td>
								<td><?php echo $results[0]['ibs_per_foot'];?></td>
							</tr>	
							<tr>
								<td class="viewlabel">End Type:</td>
								<td><?php echo $results[0]['end_type'];?></td>
							</tr>
							<tr>
								<td class="viewlabel">Grade:</td>
								<td><?php echo $results[0]['grade'];?></td>
							</tr>	
							<tr>
								<td class="viewlabel">Coating:</td>
								<td><?php echo $results[0]['coating'];?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div>
	</div>
</form>