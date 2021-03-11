<script type="text/javascript">
$(document).ready(function(){
	$("#items tr:even").css("background-color", "#fff");
	});	
</script>
<h2 class="page-title">Inventory List</h2>
<p class="page-desc">You can see all added inventory here and can delete/edit them if necessary.</p>
<p class="page-desc"><a href="<?php echo site_url('admin/inventory/add') ?>" class="new">Add Inventory</a></p>
<table class="wide">
	<thead>                            
		<tr>
			<th scope="col">No.</th>
			<th scope="col">Date</th>
			<th scope="col">R.R# OR REL.#</th>
			<th scope="col">P.O# OR B/L#</th>
			<th scope="col">Carrier</th>
			<th scope="col">Joints In</th>
			<th scope="col">Joints Out</th>
			<th scope="col"></th>		
			<th scope="col"></th>		
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody id="items">
		<?php $i=$start+1;
			foreach($categoryList as $row)
			{
			?>
			<tr id='post-102' class='alternate'>
				<td class="centeralign tdfixedwidth"><?php echo $i++; ?></td>
				<td class="centeralign"><?php echo dateFormat2($row['c_date']); ?></td>
				<td class="centeralign"><?php echo $row['rr']; ?></td>
				<td class="centeralign"><?php echo $row['po']; ?></td>
				<td class="centeralign"><?php echo $row['carrier']; ?></td>
				<td class="centeralign"><?php echo $row['joints_in']; ?></td>
				<td class="centeralign"><?php echo $row['joints_out']; ?></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/inventory/view/'.$row['store_id']) ?>" rel="permalink" class="view">View</a></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/inventory/edit/'.$row['store_id']) ?>" class='edit'>Edit</a></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/inventory/delete/'.$row['store_id']) ?>" class='delete'  onclick="return(confirm('Are you sure you want to delete this Inventory?'));">Delete</a></td>
			</tr>
			<?php
			}
		?>	
	</tbody>
</table>
<ul class="pagination">
	<?php echo $links;?>
</ul> 