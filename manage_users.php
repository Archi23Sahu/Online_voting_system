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
<script language='javascript'>
function checkpwd()
{
x=document.getElementById('pwd').value;
y=document.getElementById('cpwd').value;
if(x==y)
{
document.getElementById('ans1').innerHTML="<font color='green'>Password Matched</font>";
return true;
}
else
{
document.getElementById('ans1').innerHTML="<font color='red'>Password not Matched</font>";
return false;
}
}
</script>
</head>
<body>
<?php include "top.php"; ?>

<div id="wrapper">
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>Manage Users</h2>
				</div>
					
		<form method='post' enctype='multipart/form-data'
onsubmit="return checkpwd()" >

<table  width='400' align='center' border='0' cellspacing='0' cellpadding='2'>
<tr>
	<td width='200'>Voter Id</td>
	<td width='200'><input type='text' name='voterid' id='voterid' maxlength='30'
	class='abc'
	/></td>
	</tr>
<tr>
	<td width='200'>Password</td>
	<td width='200'><input type='password' name='pwd' id='pwd' maxlength='30' class='abc' onblur='checkpwd()'/></td>
	</tr>
<tr>
	<td width='200'>Confirm Password</td>
	<td width='200'><input type='password' name='cpwd' id='cpwd' maxlength='30' class='abc' onblur='checkpwd()'/>
	<br /><div id='ans1'></div>
	</td>
	</tr>
	
<tr>
	<td width='200'>First Name</td>
	<td width='200'><input type='text' name='f_name' id='f_name' maxlength='30' class='abc'/>
	</td>
</tr>
<tr>
	<td width='200'>Last Name</td>
	<td width='200'><input type='text' name='lname' id='lname' maxlength='30' class='abc'/>
	</td>
</tr>
<tr>
	<td width='200'>Date of Birth</td>
	<td width='200'><input type='date' name='dob' id='dob' class='abc' />
	</td>
</tr>
<tr>
	<td width='200'>Gender</td>
	<td width='200'>
	<input type='radio' name='gender' id='gender' value='male' checked />Male	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' name='gender' id='gender' value='female'/>Female
	</td>
</tr>
<tr>
	<td width='200' >Email Id</td>
	<td width='200' colspan='2'><input type='text' name='email' id='email' maxlength='30' class='abc'/>
					
	</td>
</tr>
<tr>
	<td width='200'>Contact No.</td>
	<td width='200'><input type='text' name='contact' id='contact' maxlength='30' class='abc'/>
	</td>
</tr>
<tr>
	<td width='200' valign='top'>Address</td>
	<td width='200'><textarea name='address' id='address' rows='3' cols='25' style='resize:none' class='abc'></textarea>
	</td>
</tr>
<tr>
	<td width='200'>Hint Question</td>
	<td width='200'><select name='hint_que' id='hint_que' class='abc'>
		<option value='0'>Select</option>
		<option value='1'>My favorite pet name</option>
		<option value='2'>My nick name</option>
		<option value='3'>My favorite player name</option>
		<option value='4'>My favorite teacher name</option>
		<option value='5'>My favorite book name</option>
		</select>
	</td>
</tr>
<tr>
	<td width='200'>Hint Answer</td>
	<td width='200'><input type='text' name='hint_ans' id='hint_ans' maxlength='30' class='abc'/>
	</td>
</tr>
<tr>
	<td width='200'>Role</td>
	<td><select name='role' id='role' class='abc'>
		<option value='voter'>Voter</option>
		<option value='candidate'>Candidate</option>
		<option value='officer'>Officer</option>
		
	</td>
</tr>
<tr>
	<td width='200'>active</td>
	<td width='200'><input type=checkbox name='active' id='active' value='yes'/>
	</td>
</tr>
<tr>
	<td>Select Photo File</td>
	<td>
	<input type='file' name='pfile' id='pfile' />
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
$voterid=$_REQUEST['voterid'];
$pwd=$_REQUEST['pwd'];
$f_name=$_REQUEST['f_name'];
$lname=$_REQUEST['lname'];
$dob=$_REQUEST['dob'];
$gender=$_REQUEST['gender'];
$email=$_REQUEST['email'];
$contact=$_REQUEST['contact'];
$address=$_REQUEST['address'];

$hint_que=$_REQUEST['hint_que'];
$hint_ans=$_REQUEST['hint_ans'];
$role=$_REQUEST['role'];
if(isset($_REQUEST['active']))
$active='yes';
else
$active='no';
$region=$_REQUEST['region'];
//----------------------
if(isset($_REQUEST['save']) ||isset($_REQUEST['modify'])  )
{
$error=$_FILES['pfile']['error'];
//print_r($_FILES);
echo "$error";
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
			$target=__DIR__."/data/$fname";
		    $ans=move_uploaded_file($ftname,$target);
			$data=addslashes($data);
			
			$query="insert into up_db (filename,filetype,filesize,filedata,purpose,udate,utime) values ('$fname','$ftype','$fsize','$data','voterpic','$udate','$utime')";
					//echo "<br />$query";
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
//-----------------------

}

}
if(isset($_REQUEST['save']))
{ 
$sql="insert into siteuser values ('$voterid','$pwd','$f_name','$lname','$dob','$gender','$email','$contact','$address','$hint_que','$hint_ans','$role','$active','$fileid','$region')";
echo "$sql";
$n=my_iud($sql);
echo "<br />$n record saved";
}	

if(isset($_REQUEST['modify']))
 {
$sql="update siteuser set email='$email',pwd='$pwd',fname='$f_name',lname='$lname',dob='$dob',gender='$gender',contact='$contact',address='$address',hintq='$hint_que',hinta='$hint_ans',role='$role',active='$active',photoid='$fileid',regionid='$region' where voterid='$voterid'";
echo "$sql";
$n=my_iud($sql);
echo "<br />$n record modified";
 }	
 
 
 
 
if(isset($_REQUEST['remove']))
 {
$sql="delete from siteuser where voterid='$voterid'";
$n=my_iud($sql);
echo "<br />$n record removed";
 }	
 
 
 
 
if(isset($_REQUEST['search1']))
 {
//CREATE A SQL QUERY
$sql="select * from siteuser";

//EXECUTE THE QUERY
$result=my_select($sql);
$n=mysqli_num_rows($result);

// FOR SELECT QUERY FETCH RECORDS
if($n>0)
{
echo"<br/>$n Record searched";
echo "<Table border='1'  cellspacing='0'
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
// CLOSE THE CONNECTION
 //mysqli_close($conn);
 }	
 ?>
 	</div>	
	
	<?php include "bottom.php"; ?>
</body>
</html>
