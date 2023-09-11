<?php
include_once "dbconfig.php";
$login_msg=authenticate("anonymous");
if(isset($_REQUEST['save']))
{
	$voterid=$_REQUEST['voterid'];
	$pwd=$_REQUEST['pwd'];
	if(isset($_REQUEST['remme']))
		$remme="yes";
	else
		$remme="no";
	
$query="select count(*) from siteuser where voterid='$voterid' and pwd='$pwd'"	;
$n=my_one($query);
if($n==1)
{
	$_SESSION['sun']=$voterid;
	$_SESSION['spwd']=$pwd;
	if($remme=='yes')
	{
	setcookie('cun',$voterid,time()+60*60*24*7);
	setcookie('cpwd',$pwd,time()+60*60*24*7);
	}
$query="select role from siteuser where voterid='$voterid' and pwd='$pwd'"	;
$role=my_one($query);
$target=$role."_db.php";
header("Location:$target");
}
else
{
		header("Location:login_error.php");
}	
}

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
				<h2>SignIn</h2>
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
<td>Password</td>
<td>
<input type='password' name='pwd' id='pwd' maxlength='20'class="abc"  />
</td>
</tr>
<tr>
<td>Remember Me</td>
<td>
<input type='checkbox' name='remme' id='remme' value='yes' />
</td>
</tr>

<tr>
<td colspan='2' align="center">
<input type='submit' name='save' id='save' value='signIn' class='abc1' />
</td>
</tr>
</table>
</form>


					</div>
		<a href='forgetpwd.php' >Forget Password</a>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							New User <a href='signup.php'>SignUp</a>
		
		

	
	<?php include "bottom.php"; ?>
</body>
</html>
