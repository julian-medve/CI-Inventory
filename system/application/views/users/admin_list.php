<script type="text/javascript">
$(document).ready(function(){
	$("#items tr:even").css("background-color", "#fff");
	});	
</script>
<h2 class="page-title">Customer Lists</h2>
<p class="page-desc">You can see all added customers here and can delete/edit password if necessary.</p>
<p class="page-desc"><a href="<?php echo site_url('admin/customer/add') ?>" class="new">Add Customer</a></p>

<table class="wide">
	<thead>                            
		<tr>
			<th scope="col"><a href="<?php echo site_url("admin/customer/lists"); ?>/full_name/<?php echo ($_SESSION['order'] == 'full_name')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">Full Name<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'full_name')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/customer/lists"); ?>/username/<?php echo ($_SESSION['order'] == 'username')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">User Name<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'username')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/customer/lists"); ?>/email/<?php echo ($_SESSION['order'] == 'email')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">Email<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'email')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"><a href="<?php echo site_url("admin/customer/lists"); ?>/status/<?php echo ($_SESSION['order'] == 'status')? $_SESSION['by'] : 'asc'; ?>/per_page/<?php echo $_SESSION['start']; ?>">Status<img src="<?php echo base_url().'public/images/'; ?><?php echo ($_SESSION['order'] == 'status')? $_SESSION['by'] : 'asc'; ?>.png"></a></th>
			<th scope="col"></th>
			<th scope="col"></th>
			<th scope="col"></th>			
			<th scope="col"></th>	
		</tr>
	</thead>
	<tbody id="items">
		<?php $i=$start+1;
			foreach($adminList as $row)
			{
			?>
			<tr id='post-102' class='alternate'>
				<td class="centeralign"><a href="<?php echo site_url('admin/reports/summary/'.$row['user_id']) ?>" rel="permalink"><?php echo $row['full_name']; ?></a></td>
				<td class="centeralign"><?php echo $row['username']; ?></td>
				<td class="centeralign"><?php echo $row['email']; ?></td>
				<td class="centeralign" id="status_<?php echo $row['user_id']; ?>"><a href="javascript:void(0)" onclick="changeStatus(<?php echo $row['user_id']; ?>,'user_id','users','<?php echo $row['status']?>')" title="Change user status"><?php echo ucfirst($row['status']); ?></a></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/customer/view/'.$row['user_id']) ?>" rel="permalink" class="view">View</a></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/customer/edit/'.$row['user_id']) ?>" class='edit'>Edit</a></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/customer/changepassword/'.$row['user_id']) ?>" class='edit'>Change Password</a></td>
				<td class="tdfixedwidth"><a href="<?php echo site_url('admin/customer/delete/'.$row['user_id']) ?>" class='delete'  onclick="return(confirm('Are you sure you want to delete this Customer?'));">Delete</a></td>
			</tr>
			<?php
			}
		?>	
	</tbody>
</table>
<ul class="pagination">
	<?php echo $links;?>
</ul> 