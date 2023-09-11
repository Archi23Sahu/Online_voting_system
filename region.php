<?php
include_once "dbconfig.php";
$login_msg=authenticate("authorised","admin");
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
				<h2>Manage Regions</h2>
				</div>
					
		<form method='post'  >

<table  width='400' align='center' border='0' cellspacing='0' cellpadding='2'>
<tr>
	<td width='200'>Region Name</td>
	<td width='200'><input type='text' name='rname' id='rname' maxlength='30'
	class='abc'
	/></td>
	</tr>
<tr>
	<td width='200'>City</td>
	<td width='200'><input type='text' name='city' id='city' maxlength='30' class='abc' /></td>
	</tr>
<tr>
	<td width='200'>State</td>
	<td width='200'><input type='text' name='state' id='state' maxlength='30' class='abc' />	</td>
	</tr>
	
<tr>
	<td width='200'>Details</td>
	<td width='200'><textarea name='details' id='details' cols='23' style="resize:none"></textarea>
	</td>
</tr>

<tr>
	<td colspan='3'align='center'>
	<input type='submit' name='save' id='save' value='Save' style="width:80px" />
	<input type='submit' name='modify' id='modify' value='Modify' style="width:80px" />
	<input type='submit' name='remove' id='remove' value='Remove' style="width:80px" />
	<input type='submit' name='search1' id='search1' value='Search' style="width:80px" />
	</td>
</tr>
</table>
</form>

			
		
<div class="panel-footer">
	<?php
if(
isset($_REQUEST['save']) ||
isset($_REQUEST['modify']) ||
isset($_REQUEST['remove']) ||
isset($_REQUEST['search1']) 
)
 {
$regionname=$_REQUEST['rname'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$details=$_REQUEST['details'];



}
if(isset($_REQUEST['save']))
{ 
$sql="insert into region (regionname,city,state,details) values ('$regionname','$city','$state','$details')";
$n=my_iud($sql);
echo "<br />$n record saved";
}	

if(isset($_REQUEST['modify']))
 {
$sql="update region set city='$city',state='$state',details='$details' where regionname='$regionname'";
$n=my_iud($sql);
echo "<br />$n record modified";
 }	
 
 
 
 
if(isset($_REQUEST['remove']))
 {
$sql="delete from region where regionname='$regionname'";
$n=my_iud($sql);
echo "<br />$n record removed";
 }	
 
 
 
 
if(isset($_REQUEST['search1']))
 {
//CREATE A SQL QUERY
$sql="select * from region";
echo "<br />$sql<br />";
//EXECUTE THE QUERY
$result=my_select($sql);
$n=mysqli_num_rows($result);

// FOR SELECT QUERY FETCH RECORDS
if($n>0)
{
echo"<br/>$n Record searched";

echo "<table border='1' align='center' cellspacing='0'  cellpadding='5' width='400'>";
echo "<tr>";
echo "<th>Region </th>";
echo "<th>City </th>";
echo "<th>State </th>";
echo "<th>Details </th>";
echo "</tr>";

while($row=mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>".$row['regionname']."</td>";
echo "<td>".$row['city']."</td>";
echo "<td>".$row['state']."</td>";
echo "<td>".$row['details']."</td>";
echo "</tr>";
}
echo "</table>";

}


 }	
 ?></div>
 </div>
	<?php include "bottom.php"; ?>
</body>
</html>
