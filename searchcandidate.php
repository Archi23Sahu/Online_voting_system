<?php
include_once "dbconfig.php";
$cand_voterid=$_REQUEST['cand_voterid'];
//echo "chal ja $cand_voterid";
$query="select count(*) from siteuser where voterid='$cand_voterid'";
$n=my_one($query);
if($n==0)
echo "<br /><font color='red'>voterid not exist</font>";
else
{
echo "<br /><font color='green'>voterid Exist</font>";
$query="select * from  siteuser where voterid='$cand_voterid'";

$result=my_select($query);
echo "<Table border='1' align='center' cellspacing='0'
cellpadding='4' width='500'> ";
$row=mysqli_fetch_assoc($result);
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
echo "</table>";

}
?>