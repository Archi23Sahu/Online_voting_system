<?php
include_once "dbconfig.php";
$query="select fid,fname,ftype,fsize from up_db ";
$rs=my_select($query);
$n=mysqli_num_rows($rs);
if($n==0)
echo "<br />no data";
else
{
echo "<br />$n records found";
	echo "<table border='1' align='center' cellspacing='0' cellpadding='6' width='500'>";
	echo "<tr>
	<th width='100'>Id</th>
	<th width='100'>Name</th>
	<th width='100'>Type</th>
	<th width='100'>Size</th>
	<th width='100'>Preview</th>
	</tr>";
while($row=mysqli_fetch_array($rs))
	{
	echo "<tr>";
	echo "<td>$row[0]</td>";
	echo "<td><a href='down_db.php?id=$row[0]&down=yes'>$row[1]</a></td>";
	echo "<td>$row[2]</td>";
	echo "<td>$row[3]</td>";
	echo "<td>
<img src='down_db.php?id=$row[0]&down=yes' width='100' />
</td>";
	echo "</tr>";
	}

	echo "</table>";

}
?>