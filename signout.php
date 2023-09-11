<?php 
session_start();
$_SESSION['sun']=null;
$_SESSION['spwd']=null;
session_destroy();

setcookie('cun',null,time()-60*60);setcookie('cpwd',null,time()-60*60);
header("Location:logoutdone.php");
?>