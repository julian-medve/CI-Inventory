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
<form name="loginform" method="post" action="<?php echo site_url('users/login/forgotpassword'); ?>">
	
	<?php echo $succ_title; ?>
	<?php echo $succ_body; ?>
	
	<table style="margin-top: 40px; width: 300px;" align="center" border="0" cellpadding="0" cellspacing="0">
	
	<tbody>
	<tr>
	<td>
	<fieldset>
	<legend>Forgot Password</legend>

	<table border="0" cellpadding="2" cellspacing="0" width="100%">
	<tbody>

	<tr>
	<td width="40%">Email:</td>
	<td width="60%"><input type="text" name="email" id="email" value="<?php echo $this->validation->email ?>" style="width: 100%;"></td>
	<?php echo $this->validation->email_error; ?>
	</tr>
	
	<tr>
	<td colspan="2" align="right">
	<input type="submit" value="Send">
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