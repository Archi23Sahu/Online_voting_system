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
				<h2>Form For Voter Id</h2>
				</div>
			<form method='post' enctype='multipart/form-data' >

<table  width='400' align='center' border='0' cellspacing='0' cellpadding='2'>


	
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

	<td>Upload your document</td>
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

<tr><td width='200' valign="top">captcha is :</td>
	<td width='200'height='50' valign="top"><img src='capha.php'  width='240' />
	</td>
  
 </tr>
   
 
  <tr>
  <td width='200' ></td>
	<td width='200'>
        <input type="text" id="txt" name="txt"  /><br/>  
    </td>
</tr>
   
<tr>
	<td colspan='3' align='center'>
	
	<input type='submit' name='submit' id='submit' value='submit' style="width:80px" />
	</td>
</tr>
</table>
</form>


			
		<?php
if(isset($_REQUEST['submit']))
 {

$f_name=$_REQUEST['f_name'];
$lname=$_REQUEST['lname'];
$dob=$_REQUEST['dob'];
$gender=$_REQUEST['gender'];
$email=$_REQUEST['email'];
$contact=$_REQUEST['contact'];
$address=$_REQUEST['address'];
$role='voter';
$active='no';
$region=$_REQUEST['region'];
//----------------------


        $txt=$_REQUEST['txt'];
	    $capcha=$_SESSION['capcha'];
	    
    if($txt==$capcha)
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
			
			$query="insert into up_apply (filename,filetype,filesize,filedata,purpose,udate,utime) values ('$fname','$ftype','$fsize','$data','voterdoc','$udate','$utime')";
			//	echo "<br />$query";
			$n=my_iud($query);
			if($n==1)
				{
				echo "<br />Uploaded successfully";
				$sql="select max(fileid) from up_apply where filename='$fname' and filetype='$ftype' and filesize='$fsize'";
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



		$sql="insert into applyvoter values ('$f_name','$lname','$dob','$gender','$email','$contact','$address','$role','$active','$fileid','$region')";
        echo "<br/>$sql";
        $n=my_iud($sql);
		echo "<br />Capcha is verified";
        $msg='your voter id is send to your address after approval after that you can signup for online voting';
        echo "<script type='text/javascript'>";
        echo "alert('$msg');";
        echo "</script>";
        echo "<br />$n record submitted";
	}
	else
		echo "<br />Failed to verify Capcha,No record saved ";
	  
    
}	

 ?>
			</div>
		

	
	<?php include "bottom.php"; ?>
</body>
</html>
