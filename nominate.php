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
$(document).ready(function(){
//alert("namaste, jquery working");
$("#cand_voterid").blur(function(){
//alert("blur is working");
$.post("searchcandidate.php",
{cand_voterid:$("#cand_voterid").val()},
function(data)
{
$("#candidate_answer").html(data);
}
);
});

$("#party").change(function(){
//alert("blur is working");
$.post("searchparty.php",
{party:$("#party").val()},
function(data)
{
//alert("data is "+data);
$("#party_symbol_name").val(data);
}
);
});

$("#party").change(function(){
//alert("blur is working");
$.post("searchparty1.php",
{party:$("#party").val()},
function(data)
{

$("#symbol").html(data);
}
);
});
});



</script>
</head>
<body>
<?php include "top.php"; ?>

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>Nominate for Election</h2>
				</div>
				
		<form method='post' enctype='multipart/form-data' >

<table  width='400' align='center' border='0' cellspacing='0' cellpadding='2'>
<tr>
	<td width='200'>Candidate Voter Id</td>
	<td width='200'><?php echo fetchvoterid(); ?>
	</td>
	</tr>
	<tr>
	<td colspan='2'>
	<div id='candidate_answer'></div>
	</td>
	</tr>
	<tr>
	<td width='200'>Qualification</td>
	<td width='200'><select name='qualification' id='qualification'
	class='abc'>
	<option value='UnEducated'>UnEducated</option>
	<option value='Primary'>Primary</option>
	<option value='Middle'>Middle</option>
	<option value='10th'>10th</option>
	<option value='12th'>12th</option>
	<option value='B.E'>B.E.</option>
	<option value='B.A'>B.A.</option>
	<option value='B.Com.'>B.Com.</option>
	<option value='B.Sc.'>B.Sc.</option>
	<option value='B.C.A'>B.C.A</option>
	<option value='B.B.A'>B.B.A</option>
	<option value='M.A'>M.A.</option>
	<option value='M.C.A'>M.C.A</option>
	<option value='M.Sc'>M.Sc</option>
	<option value='M.Tech'>M.Tech.</option>
	<option value='M.B.B.S'>M.B.B.S</option>
	<option value='M.B.A'>M.B.A.</option>
	</select></td>
	</tr>
	<tr>
	<td width='200'>Candidate Type</td>
	<td width='200'><select name='candidatetype' id='candidatetype'
	class='abc'>
	<option value='SC Female'>SC Female</option>
	<option value='ST Female'>ST Female</option>
	<option value='OBC Female'>OBC Female</option>
	<option value='SC'>SC </option>
	<option value='ST'>ST</option>
	<option value='OBC'>OBC</option>
	<option value='General'>General</option>
	</select></td>
	</tr>
	<tr>
	<td>party</td>
	<td>
	<select name='party' id='party'>
	<option value=''>Select One</option>
	<?php 
	$rs=my_select("select partyid,partyname from party");
	while($row=mysqli_fetch_array($rs))
	{
	$pid=$row[0];
	$pname=$row[1];
	echo "<option value='$pname'>$pname</option>";
	}
	?>
	</select>
	</td>
</tr>
	<tr>
	<td width='200'>Party Symbol Name</td>
	<td width='200'><input type='text' name='party_symbol_name' id='party_symbol_name' maxlength='30'
	class='abc'
	/></td>
	</tr>
	<tr>
	<td colspan='2'>
	<div id='symbol'></div>
	</td>
</tr>
	
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
<tr>
	<td>election</td>
	<td>
	
	<?php 
	$electionid=$_REQUEST['electionid'];
	$electionname=my_one("select electionname from election where electionid=$electionid");
	echo $electionname;
	?>
	
	</td>
</tr>
<tr>
	<td colspan='3'align='center'>
	<input type='submit' name='save' id='save' value='Nominate' style="width:80px" />
	</td>
</tr>
</table>
</form>


		

	<?php
if(isset($_REQUEST['save']) )
 {
$cand_voterid=fetchvoterid();
$qualification=$_REQUEST['qualification'];
$candidatetype=$_REQUEST['candidatetype'];
$party=$_REQUEST['party'];
$election=$electionid;
$partyid=my_one("select partyid from party where partyname='$party'");
$candidate_symbol_name=$_REQUEST['party_symbol_name'];

if(isset($_REQUEST['party_symbol_id']))
{
$candidate_symbol_id=$_REQUEST['party_symbol_id'];
}
else
{
//file upload, party symbol id, fetch code 
//----------------------
if(isset($_FILES['pfile']))
{
$error=$_FILES['pfile']['error'];
	if($error!=0)
		{
		echo "<br />Some error try again (1)";
		//1. not uploaded to tmp folder
		}
		else
		{
		//fetch file information
			$fname=$_FILES['pfile']['name'];
			$ftype=$_FILES['pfile']['type'];
			$fsize=$_FILES['pfile']['size'];
			$ftname=$_FILES['pfile']['tmp_name'];
			
			$fp=fopen($ftname,'r');
			$data=fread($fp,$fsize);
			
			$data=addslashes($data);
			
			$query="insert into up_db (filename,filetype,filesize,filedata,purpose,udate,utime) values ('$fname','$ftype','$fsize','$data','candidatesymbol','$udate','$utime')";
			//	echo "<br />$query";
			$n=my_iud($query);
			if($n==1)
				{
				echo "<br />Uploaded successfully";
				$sql="select max(fileid) from up_db where filename='$fname' and filetype='$ftype' and filesize='$fsize'";
				$fileid=my_one($sql);
				echo "<br />Uploaded file id is $fileid";
				}
				else
				{
				echo "<br />Some error,try again(2)";
				#2. not saved information to database 
				}
			
			
			
		}
$candidate_symbol_id=$fileid;
		}
//-----------------------

}
$regionid=$_REQUEST['region'];




}
if(isset($_REQUEST['save']))
{ 
$sql="insert into candidate   values ('$cand_voterid','$qualification','$candidatetype','$partyid','$candidate_symbol_name','$candidate_symbol_id','$regionid','$election')";
echo "<br />$sql";
$n=my_iud($sql);
echo "<br />$n record saved";
$query="update siteuser set role='candidate' where voterid='$cand_voterid'";
$n=my_iud($query);
}	

 ?>
</div>
	<?php include "bottom.php"; ?>
</body>
</html>
