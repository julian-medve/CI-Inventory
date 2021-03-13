<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo ($_SESSION['user_role_id'] == 1)? 'Admin Panel' : 'User Panel'; ?> - <?php echo @$title ?></title>

    <!-- Style Sheets -->
    <link rel='stylesheet' href='<?php echo base_url() ?>public/css/reset-fonts-grids.css' type='text/css' />
    <link rel='stylesheet' href='<?php echo base_url() ?>public/css/newpanel.css' type='text/css' />

    <!-- JavaScript Libraries -->
    <script type='text/javascript' src='<?php echo base_url() ?>public/js/jquery-1.2.6.min.js'></script>
    <script type='text/javascript' src='<?php echo base_url() ?>public/js/acc.pack.js'></script>
    <script type='text/javascript' src='<?php echo base_url() ?>public/js/facebox.js'></script>
    <script type='text/javascript' src='<?php echo base_url() ?>public/js/ifixpng.js'></script>

	
    <script type="text/javascript">
    
	var rootPath = "<?php echo base_url(); ?>";
	
    function setWidgetBehaviors()
    {
        $(".widgettitle").click(function(){$(this).next('.widgetdata').slideToggle(300)});
        $(".widgettitle .closed > .widgetdata").hide();
    }
    
    $(document).ready( function(){
        setWidgetBehaviors();
    });

	/* for photo story */
	$(document).ready(function(){			
		// apply to all png images 
		$('.view').ifixpng();	
		$('.edit').ifixpng();	
		$('.delete').ifixpng();	
		$('.back').ifixpng();
	});	
	
    </script>
    
</head>

<body>

    <div id="admin-panel" class="yui-t2">
        <?php
		if($_SESSION['user_role_id'] == 1)
		{
		?>
        <div id="hd">
            <h1>Administration Panel</h1>
            <div id="utility">
                Logged in as <?php echo $_SESSION['username']; ?> <a href="<?php echo site_url('admin/login/logout'); ?>">[Logout]</a>
            </div>
        </div>
        
        <div id="bd">
            <div id="yui-main">
                <div class="yui-b">
                    <div id="middlecontent" class="yui-g">
                        <?php echo $content_for_layout ?>                     
                    </div>
                </div>
            </div>
			
        
            <div id="adminmenu" class="yui-b">
				<div class="widget" id="manage-container">
                    <h2 class="widgettitle"><span class="system">Customer Manage</span></h2>
					<div class="widgetdata">
                        <ul class="leftmenu">
							<li><a href="<?php echo site_url('admin/customer/lists'); ?>">Customer List</a></li>
							<li><a href="<?php echo site_url('admin/customer/add'); ?>">Add Customer</a></li>
						</ul>
                        <div class="bottom">&nbsp;</div>
                    </div>
                </div>
				
				<div class="widget" id="manage-container">
                    <h2 class="widgettitle"><span class="system">Product Manage</span></h2>
					<div class="widgetdata">
                        <ul class="leftmenu">
							<li><a href="<?php echo site_url('admin/product/lists'); ?>">Product List</a></li>
							<li><a href="<?php echo site_url('admin/product/add'); ?>">Add Product</a></li>
						</ul>
                        <div class="bottom">&nbsp;</div>
                    </div>
                </div>
				
				<div class="widget" id="manage-container">
                    <h2 class="widgettitle"><span class="system">Line Pipe Description</span></h2>
					<div class="widgetdata">
                        <ul class="leftmenu">
							<li><a href="<?php echo site_url('admin/inventory/lists/per_page/0'); ?>">Inventory List</a></li>
							<li><a href="<?php echo site_url('admin/inventory/add'); ?>">Add Inventory</a></li>
						</ul>
                        <div class="bottom">&nbsp;</div>
                    </div>
                </div>
				
				<div class="widget" id="write-container">
                    <h2 class="widgettitle"><span class="general">Administration</span></h2>
                    <div class="widgetdata">
                        <ul class="leftmenu">
							<li><a href="<?php echo site_url('admin/login/changepassword'); ?>">Change Password</a></li>
							<li><a href="<?php echo site_url('admin/login/changeusername'); ?>">Change Username</a></li>
							<li><a href="<?php echo site_url('admin/login/changeemail'); ?>">Change Email</a></li>
							<li><a href="<?php echo site_url('admin/login/logout'); ?>">Logout</a></li>
                        </ul>
                        <div class="bottom">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
		<?php
		}
		else
		{
		?>
		<div id="hd">
            <h1>Customer Panel</h1>
            <div id="utility">
                Logged in as <?php echo $_SESSION['username']; ?> <a href="<?php echo site_url('users/login/logout'); ?>">[Logout]</a>
            </div>
        </div>
        
        <div id="bd">
            <div id="yui-main">
                <div class="yui-b">
                    <div id="middlecontent" class="yui-g">
                        <?php echo $content_for_layout ?>                     
                    </div>
                </div>
            </div>
			
        
            <div id="adminmenu" class="yui-b">
				<div class="widget" id="manage-container">
                    <h2 class="widgettitle"><span class="system">Reports</span></h2>
					<div class="widgetdata">
                        <ul class="leftmenu">
							<li><a href="<?php echo site_url('users/reports/summary'); ?>">Summary</a></li>
						</ul>
                        <div class="bottom">&nbsp;</div>
                    </div>
                </div>
				
				<div class="widget" id="write-container">
                    <h2 class="widgettitle"><span class="general">Administration</span></h2>
                    <div class="widgetdata">
                        <ul class="leftmenu">
							<li><a href="<?php echo site_url('users/login/changepassword'); ?>">Change Password</a></li>
							<li><a href="<?php echo site_url('users/login/logout'); ?>">Logout</a></li>
                        </ul>
                        <div class="bottom">&nbsp;</div>
                    </div>
                </div>
            </div>
        </div>
		<?php
		}
		?>
        <div id="ft">&copy;Copyright 2013.  All rights reserved</div>
    </div>
</body>
</html>
