<?php
include_once "dbconfig.php";
$party=$_REQUEST['party'];
//echo "chal ja $cand_voterid";
$query="select party_symbol_name from party where partyname='$party'";
//echo "<br />$query";
$n=my_one($query);
echo $n;

?>