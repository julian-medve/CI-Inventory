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
<form name="loginform" method="post" action="<?php echo site_url('users/login'); ?>">
	
	<?php echo $loginerror; ?>
	
	<table style="margin-top: 40px; width: 300px;" align="center" border="0" cellpadding="0" cellspacing="0">
	
	<tbody>
	<tr>
	<td>
	<fieldset>
	<legend>User Login</legend>

	<table border="0" cellpadding="2" cellspacing="0" width="100%">
	<tbody>

	<tr>
	<td width="40%">Username:</td>
	<td width="60%"><input type="text" name="username" id="username" value="<?php echo $this->validation->username ?>" style="width: 100%;"></td>
	<?php echo $this->validation->username_error; ?>
	</tr>

	<tr>
	<td>Password:</td>
	<td><input type="password" name="password" id="password" value="<?php echo $this->validation->password ?>" style="width: 100%;"></td>
	<?php echo $this->validation->password_error; ?>
	</tr>

	<tr>
	<td colspan="2" align="right">
	<input type="submit" value="Login">
	<input type="reset" value="Reset">
	</td>
	</tr>
	
	<tr>
	<td colspan="2" align="right">
	<a href="<?php echo site_url('users/login/forgotpassword'); ?>">Did you forget your login details?</a>
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