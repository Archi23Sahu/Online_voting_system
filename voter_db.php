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

</head>
<body>
<?php include "top.php"; ?>

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<h2 class="panel-title">
				Voter Dash Board</h2>
		<div class="panel-body">		
			<?php
date_default_timezone_set("asia/kolkata");
$date=date('Y-m-d');
$time=date('H:i:s a');
$query="select * from election where electiondate='$date' and election_start_time<= '$time' and election_end_time>='$time' ";
//echo "<br />$query";
echo "<br />$date and $time";
$rs=my_select($query);
$n=mysqli_num_rows($rs);
if($n>0)
{
echo "<h3>OnGoing Election - $n  <a href='ongoing.php'>Click To Vote</a></h3>";
}
else
{
echo "<h3>No Ongoing Election</h3>";
}

$query="select * from election where electiondate>'$date' ";
//echo "<br />$query";

$rs=my_select($query);
$n=mysqli_num_rows($rs);
if($n>0)
{
echo "<h3>UpComing Election - $n  <a href='upcoming.php'>Click To Nominate</a></h3>";
}
else
{
echo "<h3>No UpComing Election</h3>";
}	
?>
						</div>
						<div class="panel-footer">
							Welcome to Voter Section
						</div>	
						</div>
		
			
		

	
	<?php include "bottom.php"; ?>
</body>
</html>
