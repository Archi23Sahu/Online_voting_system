<?php
session_start();
?>
<html>
<head>
<title>Capcha Example</title>
</head>
<body>
<h2>Capcha Example</h2>
<img src='capha.php'  width='100' />
<br />
<form method='post'>
<input type='text' name='abc' id='abc' />

<br />
<input type='submit' name='s1' id='s1' value='save' />
</form>

<?php
if(isset($_REQUEST['s1']))
{
	$abc=$_REQUEST['abc'];
	$capcha=$_SESSION['capcha'];
	if($abc==$capcha)
		echo "<br />Capcha is verified";
	else
		echo "<br />Failed to verify Capcha";
}
?>
</body>
</html>