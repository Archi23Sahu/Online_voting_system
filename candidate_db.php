<?php
include_once "dbconfig.php";
$login_msg=authenticate("authorised","candidate");
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
				<h2>Candidate Dash Board</h2>
				</div>
				
		<div class="body">
		<a href='voter_db.php'>Go For Voting</a>
		</div>
			
		
<div class="panel-footer">
							This is Candidate Section
						</div>
	</div>
	<?php include "bottom.php"; ?>
</body>
</html>
