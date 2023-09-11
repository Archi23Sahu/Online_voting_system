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
				<h2>UpComing Election - To Nominate</h2>
				</div>
			<?php
date_default_timezone_set("asia/kolkata");
$date=date('Y-m-d');
$time=date('H:i:s a');
$query="select * from election where electiondate>'$date' ";
//echo "<br />$query";
echo "<br />$date and $time";
$rs=my_select($query);
$n=mysqli_num_rows($rs);
echo "<br />$n elections to nominate now";

	while($row=mysqli_fetch_array($rs))
	{
	echo "<hr />";
	$electionid=$row[0];
	echo "<br />Election Name : $row[1]";
	echo "<br />Election Date : $row[2]";
	echo "<br />Election Start Time : $row[3]";
	echo "<br />Election End Time :$row[4]";
	echo "<br /><a href='nominate.php?electionid=$row[0]'>Nominate</a>";
	$query1="select * from candidate where electionid=$electionid";
	$result1=my_select($query1);
	$n=mysqli_num_rows($result1);

// FOR SELECT QUERY FETCH RECORDS
if($n>0)
{
echo"<br/>$n Candidates Found";
echo "<Table border='1' align='center' cellspacing='0'
cellpadding='4' width='500'> ";
while($row1=mysqli_fetch_assoc($result1))
	{
	//print_r($row);
	//echo "<br />";
	echo "<tr>";
	echo "<td>Candidate Voter Id</td>";
	echo "<td>".$row1['cand_voterid']."</td>";
	$id=$row1['candidate_symbol_id'];
	echo "<td rowspan='4'>Party Symbol<br />
	<img src='down_db.php?id=$id&down=yes'  width='100' />
	</td>";
	
	echo "</tr><tr>";
	echo "<td>Party Symbol Name</td>";
	echo "<td>".$row1['candidate_symbol_name']."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Candidate Type</td>";
	echo "<td>".$row1['candidate_type']."</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td>Election</td>";
	$electionid=$row1['electionid'];
	$election=my_one("select electionname from election where electionid=$electionid");
	echo "<td>$election</td>";
	echo "</tr>";
	echo "<tr><td colspan='3'>&nbsp;</td></tr>";
	}
	
echo "</table>";
	
	
	
	}
	}
?>
					
						<div class="panel-footer">
							Welcome to Voter Section
						</div>	</div>
		
			
	
	<?php include "bottom.php"; ?>
</body>
</html>
