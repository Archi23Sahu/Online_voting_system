		<div id="sidebar">
			<div id="stwo-col">
				
				<div class="sbox2">
					<h2></h2>
					<ul class="style2">
						<?php 
if(verifyuser()==false)
{
?>
	<li class="icon icon-ok"><a href="signup.php">SignUp</a></li>
	<li class="icon icon-ok"><a href="signin.php">SignIn</a></li>
	<li class="icon icon-ok"><a href="forgetpwd.php">Forget Password</a></li>
<?php 
}
else{
	?>
	<li class="icon icon-ok"><a href="changepwd.php">Change Password</a></li>	
	<li class="icon icon-ok"><a href="voter_list.php">Voter List</a></li>
	<?php
	if(fetchrole()=='admin')
	{
	?>
	<li class="icon icon-ok"><a href="manage_users.php">Users</a></li>		
	<li class="icon icon-ok"><a href="party.php">Party</a></li>
	<li class="icon icon-ok"><a href="candidate.php">Candidates</a></li>
	<li class="icon icon-ok"><a href="election.php">Election</a></li>
	<li class="icon icon-ok"><a href="region.php">Region</a></li>
	<?php
	}
}

?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="banner-wrapper">
		<div id="banner" class="container">
			
			<div class="box" align="center"> <?php
			                    echo "<p style='color:black;font-size:20px'>";
								echo $login_msg;
								echo "</p>";
								?></div>
		</div>
	</div>
	<div id="featured-wrapper">
		<div id="featured" class="container">
			<div class="column1"> <span class="icon icon-group"></span><a href="about_us.php">
				<div class="title">
					<h2>About Us</h2>
				</div>
				
			</div>
			<div class="column2"> <span class="icon icon-phone"></span><a href="contact_us.php">
				<div class="title">
					<h2>Contact Us</h2>
				</div>
				
			</div>
			<div class="column3"> <span class="icon icon-picture"></span><a href="gallery.php">
				<div class="title">
					<h2>Gallery</h2>
				</div>
				
			</div>
			<div class="column4"> <span class="icon icon-group"></span><a href="faq.php">
				<div class="title">
					<h2>FAQ</h2>
				</div>
				
			</div>
		</div>
	</div>
</div>
<div id="copyright" class="container">
	<p>&copy; Untitled. All rights reserved. </p>
</div>