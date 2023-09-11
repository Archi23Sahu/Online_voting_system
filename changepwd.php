<?php 
include_once "dbconfig.php";
$login_msg=authenticate("authentic");
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
<script language='javascript'>
function checkpwd(x,y,sp)
{
	
	if(x.value.length==0 || y.value.length==0)
	{
	valid=false;
	sp.innerHTML="Blank Password not allowed";
	sp.style.backgroundColor="orange";
	
	}
	else
	if(x.value==y.value)
	{
		sp.innerHTML="Password Matched";
		sp.style.backgroundColor="lightgreen";
		valid=true;
	}
	else
	{
		sp.innerHTML="Password Not Verified";
		sp.style.backgroundColor="orange";
		valid=false;
	}
	
	
	
	return valid;
}
</script>
</head>
<body>
<?php include "top.php"; ?>
<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>Change Password</h2>
				 </div>
			<p> 	</p>
			

<form method='post' onsubmit="return checkpwd(npwd,cnpwd,ans)">
<table border='0' width='600' cellspacing='0' cellpadding='8' align='left' >
<tr>
<td>Username</td>
<td>
<?php 
echo  fetchvoterid();
?>
</td>
</tr>
<tr>
<td>Current Password</td>
<td>
<input type='password' name='cpwd' id='cpwd' maxlength='20'class="abc"  />
</td>
</tr>
<tr>
<td>New Password</td>
<td>
<input type='password' name='npwd' id='npwd' maxlength='20'class="abc"  onblur="checkpwd(this,cnpwd,ans)" />
</td>
</tr>
<tr>
<td>Confirm New Password</td>
<td>
<input type='password' name='cnpwd' id='cnpwd' maxlength='20'class="abc" 
onblur="checkpwd(npwd,this,ans)" />
</td>
</tr>
<tr>
<td colspan='2' >
<div id='ans' style="padding:10px;font-size:20px;text-align:center" ></div>
</td>
</tr>
<tr>
<td colspan='2' align='center'>
<input type='submit' name='save' id='save' value='Change Password' class='abc1' />
</td>
</tr>
</table>
</form>
<br /><br />
	
</div>	
	<?php 

if(isset($_REQUEST['save']))
{
	$username=fetchvoterid();
	$cpwd=$_REQUEST['cpwd'];
	$npwd=$_REQUEST['npwd'];
	$cnpwd=$_REQUEST['cnpwd'];
	if($npwd==$cnpwd)
	{
	
$query="update siteuser set pwd='$npwd' where voterid='$voterid' and pwd='$cpwd'"	;
$n=my_iud($query);
if($n==1)
	echo "<br />Password Successfully Changed";
else
	echo "<br />Server Busy, Try again";
	}
	else
	{
		echo "<br />Password not confirmed";
	}
}



?>
						
						<div class="panel-footer" >
								<a href='signin.php'>SignIn</a>To Continue
					
						</div>
						 
	<?php include "bottom.php"; ?>
</body>
</html>
