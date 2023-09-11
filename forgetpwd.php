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
				<h2>Forget Password</h2>
				</div>
			
		
			
<form method='post'>
<table border='0' width='600' cellspacing='0' cellpadding='8' align='center' >
<tr>
<td>voterid</td>
<td>
<input type='text' name='voterid' id='voterid' maxlength='20' class="abc" />
</td>
</tr>
<tr>
<td>Hint Question</td>
<td>
<select  name='hintq' id='hintq' class='abc' >
<option value=''>Select One</option>
<option value='1'>Prashna 1</option>
<option value='2'>Prashna 2</option>
<option value='3'>Prashna 3</option>
<option value='4'>Prashna 4</option>
<option value='5'>Prashna 5</option>
</select>
</td>
</tr>
<tr>
<td>Hint Answer</td>
<td>
<input type='text' name='hinta' id='hinta' maxlength='20' class='abc'/>
</td>
</tr>

<tr>
<td colspan='2' align='center'>
<input type='submit' name='save' id='save' value='Recover Password' class='abc1' />
</td>
</tr>
</table>
</form>
<br /><br /><br /><br /><br /><br />

		
<?php 

if(isset($_REQUEST['save']))
{
	$voterid=$_REQUEST['voterid'];
	$hintq=$_REQUEST['hintq'];
	$hinta=$_REQUEST['hinta'];
	
$query="select pwd from  siteuser where voterid='$voterid' and hintq='$hintq' and hinta='$hinta'"	;
$n=my_one($query);
if(strlen($n)>0)
	echo "<br />Password is $n";
else
	echo "<br />Password is blank or Invalid Credentials";
	
}



?>
						</div>
						<div class="panel-footer" align='center'>
						<a href='signin.php'>SignIn</a> To Continue
						</div>
	
	<?php include "bottom.php"; ?>
</body>
</html>
