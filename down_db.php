<?php
if(isset($_REQUEST['down']))
{
include_once "dbconfig.php";
$id=$_REQUEST['id'];
#echo "<br />Trying to download $id";
$query="Select * from  up_db where fileid=$id";
$rs=my_select($query);
$row=mysqli_fetch_array($rs);
$fname=$row[1];
$ftype=$row[2];
$fsize=$row[3];
$data=$row[4];

header("Content-type:$ftype");
header("Content-disposition:attachment;filename=$fname");
echo $data;


}
?>