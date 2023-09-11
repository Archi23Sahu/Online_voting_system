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
				<h2>SignUp</h2>
				</div>
			<form method='post' enctype='multipart/form-data'
onsubmit="return checkpwd()" >

<table  width='400' align='center' border='0' cellspacing='0' cellpadding='2'>
<tr>
	<td width='200'>Voter Id</td>
	<td width='200'><input type='text' name='voterid' id='voterid' maxlength='30'
	class='abc' required
	/></td>
	</tr>
<tr>
	<td width='200'>Password</td>
	<td width='200'><input type='password' name='pwd' id='pwd' maxlength='30' class='abc' onblur='checkpwd()' required/></td>
	</tr>
<tr>
	<td width='200'>Confirm Password</td>
	<td width='200'><input type='password' name='cpwd' id='cpwd' maxlength='30' class='abc' onblur='checkpwd()' required/>
	<br /><div id='ans1'></div>
	</td>
	</tr>
	
<tr>
	<td width='200'>First Name</td>
	<td width='200'><input type='text' name='f_name' id='f_name' maxlength='30' class='abc' required/>
	</td>
</tr>
<tr>
	<td width='200'>Last Name</td>
	<td width='200'><input type='text' name='lname' id='lname' maxlength='30' class='abc' required/>
	</td>
</tr>
<tr>
	<td width='200'>Date of Birth</td>
	<td width='200'><input type='date' name='dob' id='dob' class='abc' required />
	</td>
</tr>
<tr>
	<td width='200'>Gender</td>
	<td width='200'>
	<input type='radio' name='gender' id='gender' value='male' checked />Male	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' name='gender' id='gender' value='female' />Female
	</td>
</tr>
<tr>
	<td width='200' >Email Id</td>
	<td width='200' colspan='2'><input type='text' name='email' id='email' maxlength='30' class='abc' required/>
					
	</td>
</tr>
<tr>
	<td width='200'>Contact No.</td>
	<td width='200'><input type='text' name='contact' id='contact' maxlength='30' class='abc' required/>
	</td>
</tr>
<tr>
	<td width='200' valign='top'>Address</td>
	<td width='200'><textarea name='address' id='address' rows='3' cols='25' style='resize:none' class='abc'required></textarea>
	</td>
</tr>
<tr>
	<td width='200'>Hint Question</td>
	<td width='200'><select name='hint_que' id='hint_que' class='abc' required>
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
	<td width='200'><input type='text' name='hint_ans' id='hint_ans' maxlength='30' class='abc' required/>
	</td>
</tr>
<tr>
	<td>Select Photo File</td>
	<td>
	<input type='file' name='pfile' id='pfile' required />
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
	<input type='submit' name='save' id='save' value='SignUp' style="width:80px" />
	</td>
</tr>
</table>
</form>
			
		<?php
if(isset($_REQUEST['save']))
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
$role='voter';
$active='yes';
$region=$_REQUEST['region'];
//----------------------

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
			$target=__DIR__."/data/$fname";
		    $ans=move_uploaded_file($ftname,$target);
			$data=addslashes($data);
			
			$query="insert into up_db (filename,filetype,filesize,filedata,purpose,udate,utime) values ('$fname','$ftype','$fsize','$data','voterpic','$udate','$utime')";
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
//-----------------------



}
if(isset($_REQUEST['save']))
{ 
$sql="insert into siteuser values ('$voterid','$pwd','$f_name','$lname','$dob','$gender','$email','$contact','$address','$hint_que','$hint_ans','$role','$active','$fileid','$region')";
$n=my_iud($sql);
echo "<br />$n record saved";
}	

 ?>
			</div>
		

	
	<?php include "bottom.php"; ?>
</body>
</html>
