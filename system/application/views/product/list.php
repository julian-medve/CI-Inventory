<script type="text/javascript">
$(document).ready(function(){
	$("#items tr:even").css("background-color", "#fff");
	});	
</script>
<h2 class="page-title">Product List</h2>
<p class="page-desc">You can see all added products here and can delete/edit them if necessary.</p>
<p class="page-desc"><a href="<?php echo site_url('admin/product/add') ?>" class="new">Add Product</a></p>
<table class="wide">
	<thead>                            
		<tr>
			<th scope="col">Outisde Diameter</th>
			<th scope="col">Wall Thickness</th>
			<th scope="col">lbs per ft</th>
			<th scope="col">End Type</th>
			<th scope="col">Grade</th>
			<th scope="col">Coating</th>
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
				<td class="centeralign"><?php echo $row['outside_diameter']; ?></td>
				<td class="centeralign"><?php echo $row['wall_thickness']; ?></td>
				<td class="centeralign"><?php echo $row['ibs_per_foot']; ?></td>
				<td class="centeralign"><?php echo $row['end_type']; ?></td>
				<td class="centeralign"><?php echo $row['grade']; ?></td>
				<td class="centeralign"><?php echo $row['coating']; ?></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/product/view/'.$row['product_id']) ?>" rel="permalink" class="view">View</a></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/product/edit/'.$row['product_id']) ?>" class='edit'>Edit</a></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/product/delete/'.$row['product_id']) ?>" class='delete'  onclick="return(confirm('Are you sure you want to delete this product?'));">Delete</a></td>
			</tr>
			<?php
			}
		?>	
	</tbody>
</table>
<ul class="pagination">
	<?php echo $links;?>
</ul> 