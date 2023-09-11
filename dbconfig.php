<?php 
session_start();
date_default_timezone_set('asia/kolkata');
$udate=date('Y-m-d');
$utime=date('h:i:s');
			
$dbserver="127.0.0.1";
$dbuser="root";
$dbpwd="";
$dbname="election";
//insert,update,delete
function my_iud($sql)
{
global $dbserver,$dbuser,$dbpwd,$dbname;
$conn=mysqli_connect($dbserver,$dbuser,$dbpwd,$dbname) or die('try again');
mysqli_query($conn,$sql);
$n=mysqli_affected_rows($conn);
mysqli_close($conn);
return $n;
}
//data -sql Multiple values 
function my_select($sql)
{
global $dbserver,$dbuser,$dbpwd,$dbname;
$conn=mysqli_connect($dbserver,$dbuser,$dbpwd,$dbname) or die('try again');
$rs=mysqli_query($conn,$sql);
mysqli_close($conn);
return $rs;
}
//datum-sql single value 
function my_one($sql)
{
global $dbserver,$dbuser,$dbpwd,$dbname;
$conn=mysqli_connect($dbserver,$dbuser,$dbpwd,$dbname) or die('try again');
$rs=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($rs);
mysqli_close($conn);
return $row[0];
}

function verifyuser()
{
$u="";
$p="";
if(isset($_COOKIE['cun']) && isset($_COOKIE['cpwd']))
{
$u=$_COOKIE['cun'];
$p=$_COOKIE['cpwd'];
}
else 
if(isset($_SESSION['sun']) && isset($_SESSION['spwd']))
{
$u=$_SESSION['sun'];
$p=$_SESSION['spwd'];
}

$sql="select count(*) from siteuser where voterid='$u' and pwd='$p' ";
$n=my_one($sql);

if($n==1)
{
	return true;
}
else
{
	return false;
}
}





function fetchvoterid()
{
$u="";
$p="";
if(isset($_COOKIE['cun']) && isset($_COOKIE['cpwd']))
{
$u=$_COOKIE['cun'];
$p=$_COOKIE['cpwd'];
}
else 
if(isset($_SESSION['sun']) && isset($_SESSION['spwd']))
{
$u=$_SESSION['sun'];
$p=$_SESSION['spwd'];
}

$sql="select count(*) from siteuser where voterid='$u' and pwd='$p' ";
$n=my_one($sql);

if($n==1)
{
	return $u;
}
else
{
	return false;
}
}



function fetchrole()
{
$u="";
$p="";
if(isset($_COOKIE['cun']) && isset($_COOKIE['cpwd']))
{
$u=$_COOKIE['cun'];
$p=$_COOKIE['cpwd'];
}
else 
if(isset($_SESSION['sun']) && isset($_SESSION['spwd']))
{
$u=$_SESSION['sun'];
$p=$_SESSION['spwd'];
}

$sql="select count(*) from siteuser where voterid='$u' and pwd='$p' ";
$n=my_one($sql);

if($n==1)
{
	$sql="select role from siteuser where voterid='$u' and pwd='$p' ";
	$role=my_one($sql);
	return $role;
}
else
{
	return false;
}
}

//default parameters, if $p2 is not passed
//it has default value abc 
function authenticate($p1,$p2="abc")
{
$login_msg="";
switch($p1)
	{
	case "anonymous":
		if(verifyuser())
			{
			$login_msg="Welcome ".fetchvoterid();
			$login_msg.=", <a href='signout.php'>Signout</a>";
			
			$sql="select * from siteuser where voterid='".fetchvoterid()."'";

//EXECUTE THE QUERY
$result=my_select($sql);
$n=mysqli_num_rows($result);

// FOR SELECT QUERY FETCH RECORDS
if($n>0)
{
$login_msg.= "<Table border='0' align='center' cellspacing='0'
cellpadding='4' width='200'> ";
$row=mysqli_fetch_assoc($result);
	
	//print_r($row);
	//$login_msg.= "<br />";
	$login_msg.= "<tr>";
	$login_msg.= "<td align='right'>Role</td>";
	$login_msg.= "<td>".$row['role']."</td>";
	$login_msg.= "</tr>";
	
	$login_msg.= "<tr>";
	$login_msg.= "<td align='right'>".$row['fname']."</td>";
	$login_msg.= "<td>".$row['lname']."</td>";
	$login_msg.= "</tr>";
	
	$login_msg.= "<tr>";
	$id=$row['photoid'];
	$login_msg.= "<td colspan='2' align='center'>
	<img src='down_db.php?id=$id&down=yes'  width='100' />
	</td>";
	$login_msg.= "</tr>";
	
	$login_msg.= "<tr>";
	$login_msg.= "<td align='right'>Region</td>";
	$rid=$row['regionid'];
	$region=my_one("select regionname from region where regionid=$rid");
	$login_msg.= "<td>$region</td>";
	$login_msg.= "</tr>";
	
	
	
$login_msg.= "</table>";
}
			
			}
			else	
			{
			$login_msg="Welcome Guest";
			$login_msg.="<br />New user <a href='signup.php'>Signup</a>";
			$login_msg.="<br />existing user <a href='signin.php'>SignIn</a>";
			}
		break;
	case "authentic":
		if(verifyuser())
			{
		$login_msg="Welcome ".fetchvoterid();
			$login_msg.=", <a href='signout.php'>Signout</a>";
			
			$sql="select * from siteuser where voterid='".fetchvoterid()."'";

//EXECUTE THE QUERY
$result=my_select($sql);
$n=mysqli_num_rows($result);

// FOR SELECT QUERY FETCH RECORDS
if($n>0)
{
$login_msg.= "<Table border='0' align='center' cellspacing='0'
cellpadding='4' width='200'> ";
$row=mysqli_fetch_assoc($result);
	
	//print_r($row);
	//$login_msg.= "<br />";
	$login_msg.= "<tr>";
	$login_msg.= "<td align='right'>Role</td>";
	$login_msg.= "<td>".$row['role']."</td>";
	$login_msg.= "</tr>";
	
	$login_msg.= "<tr>";
	$login_msg.= "<td align='right'>".$row['fname']."</td>";
	$login_msg.= "<td>".$row['lname']."</td>";
	$login_msg.= "</tr>";
	
	$login_msg.= "<tr>";
	$id=$row['photoid'];
	$login_msg.= "<td colspan='2' align='center'>
	<img src='down_db.php?id=$id&down=yes'  width='100' />
	</td>";
	$login_msg.= "</tr>";
	
	$login_msg.= "<tr>";
	$login_msg.= "<td align='right'>Region</td>";
	$rid=$row['regionid'];
	$region=my_one("select regionname from region where regionid=$rid");
	$login_msg.= "<td>$region</td>";
	$login_msg.= "</tr>";
	
	
	
$login_msg.= "</table>";
}
						}
			else	
			{
			header("Location:login_error.php");
			}
		break;
	case "authorised":
	if(verifyuser())
			{
				if(fetchrole()==$p2)
				{
	$login_msg="Welcome ".fetchvoterid();
			$login_msg.=", <a href='signout.php'>Signout</a>";
			
			$sql="select * from siteuser where voterid='".fetchvoterid()."'";

//EXECUTE THE QUERY
$result=my_select($sql);
$n=mysqli_num_rows($result);

// FOR SELECT QUERY FETCH RECORDS
if($n>0)
{
$login_msg.= "<Table border='0' align='center' cellspacing='0'
cellpadding='4' width='200'> ";
$row=mysqli_fetch_assoc($result);
	
	//print_r($row);
	//$login_msg.= "<br />";
	$login_msg.= "<tr>";
	$login_msg.= "<td align='right'>Role</td>";
	$login_msg.= "<td>".$row['role']."</td>";
	$login_msg.= "</tr>";
	
	$login_msg.= "<tr>";
	$login_msg.= "<td align='right'>".$row['fname']."</td>";
	$login_msg.= "<td>".$row['lname']."</td>";
	$login_msg.= "</tr>";
	
	$login_msg.= "<tr>";
	$id=$row['photoid'];
	$login_msg.= "<td colspan='2' align='center'>
	<img src='down_db.php?id=$id&down=yes'  width='100' />
	</td>";
	$login_msg.= "</tr>";
	
	$login_msg.= "<tr>";
	$login_msg.= "<td align='right'>Region</td>";
	$rid=$row['regionid'];
	$region=my_one("select regionname from region where regionid=$rid");
	$login_msg.= "<td>$region</td>";
	$login_msg.= "</tr>";
	
	
	
$login_msg.= "</table>";
}
							}
				else
				{
					header("Location:previledge_error.php");
				}
			}
			else	
			{
			header("Location:login_error.php");
			}
		break;
	}
	return $login_msg;
}
?>