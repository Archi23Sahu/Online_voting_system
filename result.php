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
				<h2>Election Results</h2>
			</div>
				
			<?php
date_default_timezone_set("asia/kolkata");
$date=date('Y-m-d');
$time=date('H:i:s a');
$query="select * from election where electiondate<'$date' ";
//echo "<br />$query";
echo "<br />$date and $time";
$rs1=my_select($query);
$n=mysqli_num_rows($rs1);
echo "<br />$n elections Result is declared ";

	while($row1=mysqli_fetch_array($rs1))
	{
	echo "<hr color='blue' size='5' />";
	$electionid=$row1[0];
	$electionname=$row1[1];
	echo "<br />Election Name : $row1[1]";
	echo "<br />Election Date : $row1[2]";
	echo "<br />Election Start Time : $row1[3]";
	echo "<br />Election End Time :$row1[4]";
	
	$query="Select distinct regionid from votes where electionid=$electionid";
	//echo "<br />$query";
	$rs2=my_select($query);
			while($row2=mysqli_fetch_array($rs2))
			{
				$regionid=$row2[0];
			$query="select regionname from region where regionid=$regionid";
			//echo "<br />$query";
			$regionname=my_one($query);
			echo "<hr /><h4>Region is $regionname and Election is $electionname</h4> ";	
			
		
			$query="select cand_voterid,count(*) as vcount  from votes where regionid=$regionid and electionid=$electionid group by cand_voterid order by vcount desc";
			//echo "<br />$query";
			echo "<Table border='1' align='center' cellspacing='0' cellpadding='5' width='300'>";
			echo "<tr>";
			echo "<th width='150'>Candidate</th>";
			echo "<th width='150'>Party</th>";
			echo "<th width='150'>Votes</th>";
			echo "<th width='150'>Rank</th>";
			echo "</tr>";
			$rs3=my_select($query);
			$rank=1;
			while($row3=mysqli_fetch_array($rs3))
			{
				echo "<tr>";
				echo "<td>$row3[0]</td>";
				$party=my_one("select partyid from candidate where cand_voterid='$row3[0]'");
				$party=my_one("select partyname from party where partyid=$party");
				echo "<td>$party</td>";
				echo "<td>$row3[1]</td>";
				echo "<td>$rank</td>";
				echo "</tr>";
				$rank++;
			}
			echo "</table>";
			}
	}
	
	?>		
		
	    
	
	
	<br /> <br /> <br /><p><b> Hope you are happy with Results</b></p>


	</div>
							
					
	<?php include "bottom.php"; ?>
</body>
</html>
