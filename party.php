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
				<h2>Manage Parties</h2>
				</div>
				
		<form method='post' enctype='multipart/form-data' >

<table  width='400' align='center' border='0' cellspacing='0' cellpadding='2'>
<tr>
	<td width='200'>Party Name</td>
	<td width='200'><input type='text' name='partyname' id='partyname' maxlength='30'
	class='abc'
	/></td>
	</tr>
	<td width='200'>Party Symbol Name</td>
	<td width='200'><input type='text' name='party_symbol_name' id='party_symbol_name' maxlength='30'
	class='abc'
	/></td>
	</tr>
	<tr>
	<td>Select Symbol File</td>
	<td>
	<input type='file' name='pfile' id='pfile' />
	</td>
</tr>
	<tr>
	<td width='200'>Party Type</td>
	<td width='200'>
	<input type='radio' name='partytype' id='partytype' value='National' checked />National
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type='radio' name='partytype' id='partytype' value='Regional' checked />Regional
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
$partyname=$_REQUEST['partyname'];
$party_symbol_name=$_REQUEST['party_symbol_name'];
$partytype=$_REQUEST['partytype'];
//----------------------
if(isset($_REQUEST['save']) || isset($_REQUEST['modify'])  )
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
			
			$query="insert into up_db (filename,filetype,filesize,filedata,purpose,udate,utime) values ('$fname','$ftype','$fsize','$data','partysymbol','$udate','$utime')";
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


}
if(isset($_REQUEST['save']))
{ 
$sql="insert into party (partyname,party_symbol_name,party_symbol_id,partytype) values ('$partyname','$party_symbol_name','$fileid','$partytype')";
$n=my_iud($sql);
echo "<br />$n record saved";
}	

if(isset($_REQUEST['modify']))
 {
$sql="update party set party_symbol_name='$party_symbol_name',party_symbol_id='$fileid',partytype='$partytype' where partyname='$partyname'";
$n=my_iud($sql);
echo "<br />$n record modified";
 }	
 
 
 
 
if(isset($_REQUEST['remove']))
 {
$sql="delete from party where partyname='$partyname'";
$n=my_iud($sql);
echo "<br />$n record removed";
 }	
 
 
 
 
if(isset($_REQUEST['search1']))
 {
//CREATE A SQL QUERY
$sql="select * from party ";

//EXECUTE THE QUERY
$result=my_select($sql);
$n=mysqli_num_rows($result);

// FOR SELECT QUERY FETCH RECORDS
if($n>0)
{
echo"<br/>$n Record searched";
echo "<Table border='1' align='center' cellspacing='0'
cellpadding='4' width='500'> ";
while($row=mysqli_fetch_assoc($result))
	{
	//print_r($row);
	//echo "<br />";
	echo "<tr>";
	echo "<td>Party Name</td>";
	echo "<td>".$row['partyname']."</td>";
	$id=$row['party_symbol_id'];
	echo "<td rowspan='3'>
	<img src='down_db.php?id=$id&down=yes'  width='100' />
	</td>";
	
	echo "</tr>";
	echo "<td>Party Symbol Name</td>";
	echo "<td>".$row['party_symbol_name']."</td>";
	echo "</tr>";
	echo "</tr>";
	echo "<td>Party Type</td>";
	echo "<td>".$row['partytype']."</td>";
	echo "</tr>";
	
	echo "<tr><td colspan='3'>&nbsp;</td></tr>";
	}
	
echo "</table>";

}
 }	
 ?>
 </div>
 </div>
	<?php include "bottom.php"; ?>
</body>
</html>
