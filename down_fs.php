<?php 
include_once "dbconfig.php";
$fid=$_REQUEST['fid'];
$sql="Select * from up_fs where fid=$fid";
$rs=my_select($sql);
if($rs==false)
	echo "<Br />No data";
else
{
	$row=$rs->fetch_array();
	$name=$row[1];
	$type=$row[2];
	$size=$row[3];
	$path=$row[4];
	
	$fp=fopen($path,'r') or die('try again');
	$data=fread($fp,$size);
	fclose($fp);
	header("Content-type:$type");
	header("Content-disposition:attachment;filename=$name");
	echo $data;
}
?>