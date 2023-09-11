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
				<h2>Manage Elections</h2>
				</div>
			
	<form method='post'  >

<table  width='400' align='center' border='0' cellspacing='0' cellpadding='2'>
<tr>
	<td width='200'>Election Name</td>
	<td width='200'><input type='text' name='ename' id='ename' maxlength='30'
	class='abc'
	/></td>
	</tr>
<tr>
	<td width='200'>Election Date</td>
	<td width='200'><input type='date' name='edate' id='edate'  class='abc' /></td>
	</tr>
<tr>
	<td width='200'>Election Start Time</td>
	<td width='200'><input type='time' name='stime' id='stime' maxlength='30' class='abc' />	</td>
	</tr>
<tr>
	<td width='200'>Election End Time</td>
	<td width='200'><input type='time' name='etime' id='etime' maxlength='30' class='abc' />	</td>
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

<?php
if(
isset($_REQUEST['save']) ||
isset($_REQUEST['modify']) ||
isset($_REQUEST['remove']) ||
isset($_REQUEST['search1']) 
)
 {
$ename=$_REQUEST['ename'];
$edate=$_REQUEST['edate'];
$stime=$_REQUEST['stime'];
$etime=$_REQUEST['etime'];



}
if(isset($_REQUEST['save']))
{ 
$sql="insert into election (electionname,electiondate,election_start_time,election_end_time) values ('$ename','$edate','$stime','$etime')";
$n=my_iud($sql);
echo "<br />$n record saved";
}	

if(isset($_REQUEST['modify']))
 {
$sql="update election  set electiondate='$edate',election_start_time='$stime',election_end_time='$etime' where electionname='$ename'";
$n=my_iud($sql);
echo "<br />$n record modified";
 }	
 
 
 
 
if(isset($_REQUEST['remove']))
 {
$sql="delete from election where electionname='$ename'";
$n=my_iud($sql);
echo "<br />$n record removed";
 }	
 
 
 
 
if(isset($_REQUEST['search1']))
 {
//CREATE A SQL QUERY
$sql="select * from election";
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
echo "<th>Election Name </th>";
echo "<th>Election Date </th>";
echo "<th>Start Time </th>";
echo "<th>End Time </th>";
echo "</tr>";

while($row=mysqli_fetch_assoc($result))
{
echo "<tr>";
echo "<td>".$row['electionname']."</td>";
echo "<td>".$row['electiondate']."</td>";
echo "<td>".$row['election_start_time']."</td>";
echo "<td>".$row['election_end_time']."</td>";
echo "</tr>";
}
echo "</table>";

}
 
 }	
 ?>
 </div>
	<?php include "bottom.php"; ?>
</body>
</html>
