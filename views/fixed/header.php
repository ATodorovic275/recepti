<body>
<!-- header -->
	<header>
		<div class="w3layouts-top-strip">
			<div class="container">
				<div class="logo">
					<h1><a href="index.php">Kuvajte zdravo</a></h1>
					<p>brzo i jednostavno</p>
				</div>
				<div class="w3ls-social-icons">
					<a class="facebook" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a>
					<a class="twitter" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a>
					<a class="pinterest" href="http://www.pinterest.com"><i class="fa fa-pinterest-p"></i></a>
					<a class="linkedin" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a>
				</div>
			</div>
		</div>
		<!-- navigation -->
			<nav class="navbar navbar-default">
			  <div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav">

				  	<?php include "models/meni.php";?>
					<!-- <li><a class="active" href="index.html">Pocetna</a></li> -->
					<!-- <li><a href="about.html">Recepti</a></li>
					<li><a href="lifestyle.html">Namirnice</a></li>
					
					<li><a href="fashion.html">O autoru</a></li> -->
					<!-- <li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Short Codes <span class="caret"></span></a>
					  <ul class="dropdown-menu">
					  <li><a href="icons.html">Icons Page</a></li>
						<li><a href="typo.html">Typography</a></li>
						
					  </ul>
					</li> -->
					<!-- <li><a href="photography.html">Photography</a></li>
					<li><a href="features.html">Features</a></li>
					<li><a href="contact.html">Contact</a></li> -->
				  </ul>
				</div>
				<!-- /.navbar-collapse -->
				<div class="w3_agile_login">
							<div class="cd-main-header">
								

								<?php 
									if (!isset($_SESSION['korisnik'])) :
								 ?>
								<a href="#" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-sign-in" aria-hidden="true"></i></a>
								<?php 
									endif;
								 ?>
							</div>
							<!-- <div id="cd-search" class="cd-search">
								<form action="#" method="post">
									<input name="Search" type="search" placeholder="Search...">
								</form>
							</div> -->
				</div>
				<div class="clearfix"> </div>

			  </div><!-- /.container-fluid -->
			</nav>
			
		<!-- //navigation -->
	</header>