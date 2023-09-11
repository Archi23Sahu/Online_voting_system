<?php
include_once "dbconfig.php";
$login_msg=authenticate("anonymous");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Fetchingly 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130903

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "head.php"; ?>

</head>
<body>
<?php include "top.php"; ?>

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>Login Error</h2>
				</div>
				
		<div class="panel-body">
							Invalid voterid or Password
						</div>
						<div class="panel-footer">
							Existing Users <a href='signin.php'>SignIn</a>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							New Users <a href='signup.php'>SignUp</a>
						</div>
			
	</div>
	<?php include "bottom.php"; ?>
</body>
</html>
