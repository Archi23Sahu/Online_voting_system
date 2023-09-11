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
				<h2>FAQ</h2>
				</div>
				<form method='post' enctype='multipart/form-data' >
				<b>Email:</b> &nbsp  &nbsp &nbsp <input type='text' name='email' id='email' maxlength='30' class='abc' required /><br/><br/>
			<b>Write your queries here:</b><br/><br/><textarea name="ques" id="ques" rows="5" cols="50" style="resize:none"re  required ></textarea><br/><br/>
			<input type="submit" name="submit" id="submit" value="submit" />
			</form>
			
			<?php
			if(isset($_REQUEST['submit']))
			{
				
				extract ($_REQUEST);
				$sql="insert into faq values('$email','$ques')";
                //echo "$sql";
                $n=my_iud($sql);
                echo "query submitted";
			}
			?>
</div>
	
	<?php include "bottom.php"; ?>
</body>
</html>
