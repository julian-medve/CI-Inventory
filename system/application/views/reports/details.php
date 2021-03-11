<script type="text/javascript">
$(document).ready(function(){
	$("#items tr:even").css("background-color", "#fff");
	});	
</script>
<div id="search_records">
	<form id="form1" class="form"  enctype="multipart/form-data" name="photo_form" method="post" action="<?php echo site_url("admin/reports/details/$product_id") ?>">
		<select name="selectedfield">
			<option value="">Please select a Field</option>
			<option value="c_date" <?php echo ($_SESSION['selectedfield2'] == "c_date")? 'selected="selected"' : ''; ?>>Date</option>
			<option value="rr" <?php echo ($_SESSION['selectedfield2'] == "rr")? 'selected="selected"' : ''; ?>>RR OR REL#</option>
			<option value="po" <?php echo ($_SESSION['selectedfield2'] == "po")? 'selected="selected"' : ''; ?>>PO OR B/L#</option>
			<option value="carrier" <?php echo ($_SESSION['selectedfield2'] == "carrier")? 'selected="selected"' : ''; ?>>Carrier</option>
			<option value="received_transfarred" <?php echo ($_SESSION['selectedfield2'] == "received_transfarred")? 'selected="selected"' : ''; ?>>Received from Transferred to</option>
			<option value="joints_in" <?php echo ($_SESSION['selectedfield2'] == "joints_in")? 'selected="selected"' : ''; ?>>Joints IN</option>
			<option value="joints_out" <?php echo ($_SESSION['selectedfield2'] == "joints_out")? 'selected="selected"' : ''; ?>>Joints OUT</option>
			<option value="footage" <?php echo ($_SESSION['selectedfield2'] == "footage")? 'selected="selected"' : ''; ?>>Footage</option>
			<option value="manufacturer" <?php echo ($_SESSION['selectedfield2'] == "manufacturer")? 'selected="selected"' : ''; ?>>Manufacturer</option>
			<option value="rack" <?php echo ($_SESSION['selectedfield2'] == "rack")? 'selected="selected"' : ''; ?>>Rack #</option>
			<option value="afe" <?php echo ($_SESSION['selectedfield2'] == "afe")? 'selected="selected"' : ''; ?>>AFE</option>
		</select>
		<input type="text" name="search_value" value="<?php echo $_SESSION['search_value2']; ?>">
		<input type="submit" class="themebutton" value="Search" name="submit">
	</form>
</div>

<h2 class="page-title" style="text-align:center;font-size:30px;"><?php echo $results[0]['full_name']; ?></h2>
<h2 class="page-title" style="text-align:center;font-size:20px;">Line Pipe Description</h2>
<table class="wide">
	<thead>                            
		<tr>
			<th scope="col" colspan="16">
				<?php
				echo $product[0]['outside_diameter'];
				echo ($product[0]['wall_thickness'] != "")? ' '.$product[0]['wall_thickness'].' ' : '';
				echo ($product[0]['ibs_per_foot'] != "")? ' '.$product[0]['ibs_per_foot'].' ' : '';
				echo ($product[0]['end_type'] != "")? ' '.$product[0]['end_type'].' ' : '';
				echo ($product[0]['grade'] != "")? ' '.$product[0]['grade'].' ' : '';
				echo ($product[0]['manufacturer'] != "")? ' '.$product[0]['manufacturer'].' ' : '';
				echo ($product[0]['rack'] != "")? ' '.$product[0]['rack'].' ' : '';
				echo ($product[0]['coating'] != "")? ' '.$product[0]['coating'].' ' : '';
				echo ($product[0]['afe'] != "")? ' '.$product[0]['afe'].' ' : '';
				?>
			</th>
		</tr>
		<tr>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>	
			<th scope="col"></th>		
			<th scope="col"></th>		
			<th scope="col"></th>		
			<th scope="col" colspan="2">Balance</th>
			<th scope="col"></th>		
			<th scope="col"></th>		
		</tr>
		<tr>
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/c_date"); ?>/<?php echo ($_SESSION['order2'] == 'c_date')? $_SESSION['by2'] : 'asc'; ?>">Date <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'c_date')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/afe"); ?>/<?php echo ($_SESSION['order2'] == 'afe')? $_SESSION['by2'] : 'asc'; ?>">AFE <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'afe')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>		
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/rr"); ?>/<?php echo ($_SESSION['order2'] == 'rr')? $_SESSION['by2'] : 'asc'; ?>">RR OR REL# <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'rr')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/po"); ?>/<?php echo ($_SESSION['order2'] == 'po')? $_SESSION['by2'] : 'asc'; ?>">PO OR B/L# <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'po')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/carrier"); ?>/<?php echo ($_SESSION['order2'] == 'carrier')? $_SESSION['by2'] : 'asc'; ?>">Carrier <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'carrier')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/received_transfarred"); ?>/<?php echo ($_SESSION['order2'] == 'received_transfarred')? $_SESSION['by2'] : 'asc'; ?>">Received from Transferred to <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'received_transfarred')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/joints_in"); ?>/<?php echo ($_SESSION['order2'] == 'joints_in')? $_SESSION['by2'] : 'asc'; ?>">In <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'joints_in')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/joints_out"); ?>/<?php echo ($_SESSION['order2'] == 'joints_out')? $_SESSION['by2'] : 'asc'; ?>">Out <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'joints_out')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/footage"); ?>/<?php echo ($_SESSION['order2'] == 'footage')? $_SESSION['by2'] : 'asc'; ?>">Footage <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'footage')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>		
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/manufacturer"); ?>/<?php echo ($_SESSION['order2'] == 'manufacturer')? $_SESSION['by2'] : 'asc'; ?>">Manufacturer <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'manufacturer')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/reports/details/$product_id/rack"); ?>/<?php echo ($_SESSION['order2'] == 'rack')? $_SESSION['by2'] : 'asc'; ?>">Rack # <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order2'] == 'rack')? $_SESSION['by2'] : 'asc'; ?>.png"></a></th>		
			<th scope="col">Joints</th>
			<th scope="col">Footage</th>
			<th scope="col">Download</th>
			<th scope="col"></th>		
		</tr>
	</thead>
	<tbody id="items">
		<?php $i=$start+1;
			foreach($inventory as $row)
			{
				$in  += $row['joints_in'];
				$out += $row['joints_out'];
				$final= $in - $out;
				
				if($row['joints_in'] != '')
				{
					$in2  += $row['footage'];
				}
				else
				{
					$out2 += $row['footage'];
				}
				$final2 = $in2 - $out2;
			?>
			<tr id='post-102' class='alternate'>
				<td class="centeralign"><?php echo dateFormat2($row['c_date']); ?></td>
				<td class="centeralign"><?php echo $row['afe']; ?></td>
				<td class="centeralign"><?php echo $row['rr']; ?></td>
				<td class="centeralign"><?php echo $row['po']; ?></td>
				<td class="centeralign"><?php echo $row['carrier']; ?></td>
				<td class="centeralign"><?php echo $row['received_transfarred']; ?></td>
				<td class="centeralign"><?php echo $row['joints_in']; ?></td>
				<td class="centeralign"><?php echo $row['joints_out']; ?></td>
				<td class="centeralign"><?php echo $row['footage']; ?></td>
				<td class="centeralign"><?php echo $row['manufacturer']; ?></td>
				<td class="centeralign"><?php echo $row['rack']; ?></td>
				<td class="centeralign"><?php echo $final; ?></td>
				<td class="centeralign"><?php echo $final2; ?></td>
				<td class="centeralign">
					<?php
					if($row['attachment'] != '')
					{
					?>
					<a href="<?php echo base_url().'public/pdf/'.$row['attachment'];?>" target="_blank">PDF</a>
					<?php
					}
					?>
				</td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/inventory/edit/'.$row['store_id']) ?>" class='edit'>Edit</a></td>
			</tr>
			<?php
			}
		?>	
	</tbody>
</table>
<ul class="pagination">
	<?php echo $links;?>
</ul> 