<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="#">My Elections</a></h1>
			<p style='color:white'>
					Big step towards E-democracy.
				</p>
		</div>
		
		<div id="menu">
			<ul>
				<li class="icon icon-ok current_page_item"><a href="temp.php" accesskey="1" title="">Home</a></li>
									
				<li class="icon icon-ok"><a href="result.php" accesskey="5" title="">Results</a></li>
				<li class="icon icon-ok"><a href="apply.php" accesskey="5" title="">Apply for Voter Id</a></li>
			</ul>
		</div>
	</div>
</div>

		<!-- ****************************************************************************************************************** -->

			<div id="slider">
				<a href="#" class="button previous-button"><span class="icon icon-double-angle-left"></span></a>
				<a href="#" class="button next-button"><span class="icon icon-double-angle-right"></span></a>
				<div class="viewer">
					<div class="reel">
					
						<div class="slide">
							<a class="link" href="#">Full story ...</a>
							<img src="images/1.jpg" alt="" />
						</div>
						
						<div class="slide">
							<a class="link" href="#">Full story ...</a>
							<img src="images/2.jpg" alt="" />
						</div>
						<div class="slide">
							<a class="link" href="#">Full story ...</a>
							<img src="images/10.jpg" alt="" />
						</div>
						<div class="slide">
							<a class="link" href="#">Full story ...</a>
							<img src="images/3.jpg" alt="" />
						</div>
						
					</div>
				</div>
			</div>
			
			<script type="text/javascript">
				$('#slider').slidertron({
					viewerSelector: '.viewer',
					reelSelector: '.viewer .reel',
					slidesSelector: '.viewer .reel .slide',
					advanceDelay: 3000,
					speed: 'slow',
					navPreviousSelector: '.previous-button',
					navNextSelector: '.next-button',
					slideLinkSelector: '.link'
				});
			</script>

		<!-- ****************************************************************************************************************** -->
