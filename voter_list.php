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
			<div class="title">
				<h2>Voter List Region Wise</h2>
				</div>
			 <form method='post' enctype='multipart/form-data'
onsubmit="return checkpwd()" >

<table  width='400' align='center' border='0' cellspacing='0' cellpadding='2'>

<tr>
	<td>Region</td>
	<td>
	<select name='region' id='region'>
	<?php 
	$rs=my_select("select regionid,regionname from region");
	while($row=mysqli_fetch_array($rs))
	{
	$rid=$row[0];
	$rname=$row[1];
	echo "<option value='$rid'>$rname</option>";
	}
	?>
	</select>
	</td>
</tr>
<tr><td></br></td></tr>
<tr>
	<td colspan='3'align='center'>
<input type='submit' name='list' id='list' value='List' style="width:100px" />
	</td>
</tr>
</table>
</form>	
		<?php
if(isset($_REQUEST['list']) )
 {
$region=$_REQUEST['region'];
//CREATE A SQL QUERY
$sql="select * from siteuser where regionid=$region";

//EXECUTE THE QUERY
$result=my_select($sql);
$n=mysqli_num_rows($result);

// FOR SELECT QUERY FETCH RECORDS
if($n>0)
{
echo"<br/>$n Record searched";
echo "<Table border='1' align='center' cellspacing='0'
cellpadding='4' width='500'> ";
while($row=mysqli_fetch_assoc($result))
	{
	//print_r($row);
	//echo "<br />";
	echo "<tr>";
	echo "<td>voterid</td>";
	echo "<td>".$row['voterid']."</td>";
	echo "<td colspan='2'></td>";
	$id=$row['photoid'];
	echo "<td rowspan='5'>
	<img src='down_db.php?id=$id&down=yes'  width='100' />
	</td>";
	
	echo "</tr>";
	echo "<tr>";
	echo "<td>First Name</td>";
	echo "<td>".$row['fname']."</td>";
	echo "<td>Last Name</td>";
	echo "<td>".$row['lname']."</td>";
	
	echo "</tr>";
	echo "<tr>";
	echo "<td>Date of Birth</td>";
	echo "<td>".$row['dob']."</td>";
	
	echo "<td>Gender</td>";
	echo "<td>".$row['gender']."</td>";
	echo "</tr>";
	
	echo "</tr>";
	echo "<tr>";
	echo "<td>Email</td>";
	echo "<td>".$row['email']."</td>";
	
	echo "<td>Contact</td>";
	echo "<td>".$row['contact']."</td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>Address</td>";
	echo "<td>".$row['address']."</td>";
	
	echo "<td>Region</td>";
	$rid=$row['regionid'];
	$region=my_one("select regionname from region where regionid=$rid");
	echo "<td>$region</td>";
	echo "</tr>";
	echo "<tr><td colspan='5'>&nbsp;</td></tr>";
	}
	
echo "</table>";
}

 }	
 ?>
	</div>		
	
	<?php include "bottom.php"; ?>
</body>
</html>
