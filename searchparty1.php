<?php
include_once "dbconfig.php";
$party=$_REQUEST['party'];
//echo "chal ja $cand_voterid";
$query="select party_symbol_id from party where partyname='$party'";
//echo "<br />$query";
$n=my_one($query);
if($n!=0)
{
echo "<img src='down_db.php?id=$n&down=yes' width='100' />
<input type='hidden' name='party_symbol_id' id='party_symbol_id' value='$n' />";
}
else
{
echo "Select Symbol File
<input type='file' name='pfile' id='pfile' />";
}

?>