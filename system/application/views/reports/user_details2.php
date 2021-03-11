<script type="text/javascript">
$(document).ready(function(){
	$("#items tr:even").css("background-color", "#fff");
	});	
</script>
<div id="search_records">
	<form id="form1" class="form"  enctype="multipart/form-data" name="photo_form" method="post" action="<?php echo site_url('users/reports/summary') ?>">
		<select name="selectedfield">
			<option value="">Please select a Field</option>
			<option value="outside_diameter" <?php echo ($_SESSION['selectedfield'] == "outside_diameter")? 'selected="selected"' : ''; ?>>Outside Diameter</option>
			<option value="wall_thickness" <?php echo ($_SESSION['selectedfield'] == "wall_thickness")? 'selected="selected"' : ''; ?>>Wall Thickness</option>
			<option value="ibs_per_foot" <?php echo ($_SESSION['selectedfield'] == "ibs_per_foot")? 'selected="selected"' : ''; ?>>lbs per ft</option>
			<option value="end_type" <?php echo ($_SESSION['selectedfield'] == "end_type")? 'selected="selected"' : ''; ?>>End Type</option>
			<option value="grade" <?php echo ($_SESSION['selectedfield'] == "grade")? 'selected="selected"' : ''; ?>>Grade</option>
			<option value="coating" <?php echo ($_SESSION['selectedfield'] == "coating")? 'selected="selected"' : ''; ?>>Coating</option>
		</select>
		<input type="text" name="search_value" value="<?php echo $_SESSION['search_value']; ?>">
		<input type="submit" class="themebutton" value="Search" name="submit">
	</form>
</div>

<h2 class="page-title" style="text-align:center;font-size:30px;"><?php echo $results[0]['full_name']; ?></h2>
<table class="wide">
	<thead>                            
		<tr>
			<th scope="col" colspan="6">Pipe Description</th>
			<th scope="col">Total Joints</th>
			<th scope="col">Footage</th>
			<th scope="col">Foreman</th>
		</tr>
		<tr>
			<th scope="col"><a href="<?php echo site_url("users/reports/summary/outside_diameter"); ?>/<?php echo ($_SESSION['order'] == 'outside_diameter')? $_SESSION['by'] : 'asc'; ?>">Outisde Diameter <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'outside_diameter')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("users/reports/summary/wall_thickness"); ?>/<?php echo ($_SESSION['order'] == 'wall_thickness')? $_SESSION['by'] : 'asc'; ?>">Wall Thickness <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'wall_thickness')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("users/reports/summary/ibs_per_foot"); ?>/<?php echo ($_SESSION['order'] == 'ibs_per_foot')? $_SESSION['by'] : 'asc'; ?>">lbs per ft <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'ibs_per_foot')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("users/reports/summary/end_type"); ?>/<?php echo ($_SESSION['order'] == 'end_type')? $_SESSION['by'] : 'asc'; ?>">End Type <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'end_type')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("users/reports/summary/grade"); ?>/<?php echo ($_SESSION['order'] == 'grade')? $_SESSION['by'] : 'asc'; ?>">Grade <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'grade')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>		
			<th scope="col"><a href="<?php echo site_url("users/reports/summary/coating"); ?>/<?php echo ($_SESSION['order'] == 'coating')? $_SESSION['by'] : 'asc'; ?>">Coating <img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'coating')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>				
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody id="items">
		<?php $i=$start+1;
			foreach($products as $row)
			{
				$results = getProductInventory($row['product_id']);
				$final   = explode('|',$results);
			?>
			<tr id='post-102' class='alternate'>
				<td class="centeralign"><a href="<?php echo site_url('users/reports/details/'.$row['product_id']) ?>" rel="permalink"><?php echo $row['outside_diameter']; ?></a></td>
				<td class="centeralign"><?php echo $row['wall_thickness']; ?></td>
				<td class="centeralign"><?php echo $row['ibs_per_foot']; ?></td>
				<td class="centeralign"><?php echo $row['end_type']; ?></td>
				<td class="centeralign"><?php echo $row['grade']; ?></td>
				<td class="centeralign"><?php echo $row['coating']; ?></td>
				<td class="centeralign"><?php echo $final[0]; ?></td>
				<td class="centeralign"><?php echo $final[1]; ?></td>
				<td class="centeralign"><?php echo $row['foreman']; ?></td>
			</tr>
			<?php
			}
		?>	
	</tbody>
</table>
<ul class="pagination">
	<?php echo $links;?>
</ul> 