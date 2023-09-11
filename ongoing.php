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
				<h2>On Going Election</h2>
				</div>
				<div class="panel-footer">
							Welcome to Voter Section
						</div>
			<form method='post'>
						
							<?php
date_default_timezone_set("asia/kolkata");
$date=date('Y-m-d');
$time=date('H:i:s a');
$me=fetchvoterid();
$myregion=my_one("select regionid from siteuser where voterid='$me'");
$query="select * from election where electiondate='$date' and election_start_time<= '$time' and election_end_time>='$time' ";
//echo "<br />$query";
echo "<br />$date and $time";
$rs=my_select($query);
$n=mysqli_num_rows($rs);
echo "<br />$n elections to vote now";

		if(isset($_REQUEST['submit']))
	{
		$cand_voterid=$_REQUEST['vote'];
		$voter_voterid=fetchvoterid();
		$electionid=$_REQUEST['electionid'];
		//echo "<br />$electionid,$cand_voterid,$voter_voterid";
		$query="insert into votes (electionid,voter_voterid,cand_voterid,regionid) values ($electionid,'$voter_voterid','$cand_voterid',$myregion)";
		//echo "<br />$query";
		$n=my_iud($query);
		if($n==1)
			echo "<br />Thanks for casting your vote";
		else
			
			echo "<br />Some Error try again";
	}
	
	while($row=mysqli_fetch_array($rs))
	{
	echo "<hr />";
	$electionid=$row[0];
	echo "<br />Election Name : $row[1]";
	echo "<br />Election Date : $row[2]";
	echo "<br />Election Start Time : $row[3]";
	echo "<br />Election End Time :$row[4]";
	echo "<input type='hidden' name='electionid' id='electionid' value='$row[0]' />";

	
	
	$n1=my_one("select count(*) from votes where electionid=$row[0] and voter_voterid='$me'");
	if($n1!=0)
	{
		echo "<br />You have already Casted Your vote";
	}
	else
	{
	
	$query1="select * from candidate where electionid=$electionid  and  regionid=$myregion";
	//echo "<br />$query1";
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
	echo "<td>Candidate Name</td>";
	echo "<td>".$row1['cand_voterid']."</td>";
	$id=$row1['candidate_symbol_id'];
	echo "<td rowspan='4'>Party Symbol<br />
	<img src='down_db.php?id=$id&down=yes'  width='100' />
	</td>";
	echo "<td rowspan='4' width='60' align='center'><input type='radio' name='vote' id='vote' value='".$row1['cand_voterid']."' />";
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
	echo "<tr><td colspan='4'>&nbsp;</td></tr>";
	}
	echo "<tr><td colspan='4' align='center'>
	<input type='submit' name='submit' id='submit' value='vote' />
	</td></tr>";
echo "</table>";
	echo "</form>";
	
	
	}
	}
	}
	

?>
			

	</div>
	<?php include "bottom.php"; ?>
</body>
</html>
