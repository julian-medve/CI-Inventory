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
			<th scope="col"><a href="<?php echo site_url("admin/inventory/lists"); ?>/c_date/<?php echo ($_SESSION['order'] == 'c_date')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">Date<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'c_date')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/inventory/lists"); ?>/rr/<?php echo ($_SESSION['order'] == 'rr')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">R.R# OR REL.#<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'rr')? $_SESSION['by'] : 'asc'; ?>.png"></a></th></th>
			<th scope="col"><a href="<?php echo site_url("admin/inventory/lists"); ?>/po/<?php echo ($_SESSION['order'] == 'po')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">P.O# OR B/L#<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'po')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/inventory/lists"); ?>/carrier/<?php echo ($_SESSION['order'] == 'carrier')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">Carrier<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'carrier')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/inventory/lists"); ?>/joints_in/<?php echo ($_SESSION['order'] == 'joints_in')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">Joints In<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'joints_in')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/inventory/lists"); ?>/joints_out/<?php echo ($_SESSION['order'] == 'joints_out')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">Joints Out<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'joints_out')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
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