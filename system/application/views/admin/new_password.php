<html>
<head>
<title><?php echo $title; ?></title>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="<?php echo base_url()?>public/css/admin_login.css" type="text/css"  media="screen"/>
</head>
<body>
<table id="bodyPanel" align="center" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr>
<td>
<form name="loginform" method="post" action="<?php echo site_url("users/login/newpassword").'/'.$username.'/'.$password; ?>">
	
	<?php echo $succ_title; ?>
	<?php echo $succ_body; ?>
	
	<table style="margin-top: 40px; width: 300px;" align="center" border="0" cellpadding="0" cellspacing="0">
	
	<tbody>
	<tr>
	<td>
	<fieldset>
	<legend>New Password</legend>

	<table border="0" cellpadding="2" cellspacing="0" width="100%">
	<tbody>

	<tr>
	<td width="40%">New Password:</td>
	<td width="60%"><input type="text" name="new_password" id="new_password" value="<?php echo $this->validation->new_password ?>" style="width: 100%;"></td>
	<?php echo $this->validation->new_password_error; ?>
	</tr>

	<tr>
	<td>Retype Password:</td>
	<td><input type="password" name="retype_password" id="retype_password" value="<?php echo $this->validation->retype_password ?>" style="width: 100%;"></td>
	<?php echo $this->validation->retype_password_error; ?>
	</tr>
	
	<tr>
	<td colspan="2" align="right">
	<input type="submit" value="Reset Password">
	<input type="hidden" name="username" value="<?php echo $username; ?>">
	<input type="hidden" name="password" value="<?php echo $password; ?>">
	</td>
	</tr>
	
	<tr>
	<td colspan="2" align="right">
	<a href="<?php echo site_url('users/login'); ?>">Login Here...</a>
	</td>
	</tr>

	</tbody>
	</table>
	</fieldset>
	</td>
	</tr>
	</tbody>
	</table>

	</form>
</td>
</tr>
</tbody>
</table>
</body>
</html>