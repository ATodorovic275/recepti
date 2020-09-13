	<div class="container">		
		<?php 
			if (isset($_SESSION['korisnik'])) {
				// var_dump($_SESSION['korisnik']);
				// unset($_SESSION['korisnik']);
			}

			if (isset($_SESSION['greska'])) {
      			echo $_SESSION['greska'];
      			unset($_SESSION['greska']);
      		}

		 ?>
		<div class="banner-btm-agile">
			<div class="col-md-9 btm-wthree-left">
				<?php 

					include "models/recepti/functions.php";
					$recepti = sviReceptiIKorisnici();
					// var_dump($recepti);
					foreach ($recepti as $recept) :
				 ?>


				<div class="wthree-top">				
					<div class="w3agile-top">
						<div class="w3agile_special_deals_grid_left_grid">
							<a href="index.php?strana=recept.php&id=<?=$recept->id_recept?>"><img src="<?=$recept->velika?>" class="img-responsive" alt="<?=$recept->velika_alt?>" /></a>
						</div>
						<div class="w3agile-middle">
							<ul>
								<li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i><?=datumObrada($recept->datum_postavljanja);
								 ?></a></li>
								<li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>
								<?=ocenaObrada($recept->Prosecna);?></a></li>
								<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i><?=$recept->username?></a></li>
								
							</ul>
						</div>
					</div>
					
					<div class="w3agile-bottom">
						<div class="col-md-3 w3agile-left">
							<h5><?=$recept->nazivK?></h5>
						</div>
						<div class="col-md-9 w3agile-right">
							<h3><a href="index.php?strana=recept.php&id=<?=$recept->id_recept?>"><?=$recept->naziv?></a></h3>
							<p><?=$recept->opis?></p>
							<a name="read_more" class="agileits w3layouts" href="index.php?strana=recept.php&id=<?=$recept->id_recept?>">Read More <span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
						</div>
							<div class="clearfix"></div>
					</div>
				</div>

				
				<?php 
					endforeach;
				 ?>
				 <div id="jos">
					 <a id='jos_recept' href="">Jos recepata</a>		 	
				 </div>
			</div>


			<div class="col-md-3 w3agile_blog_left">
				<div class="wthreesearch">
							<form action="#" method="post">
								<input type="search" id="search" name="Search" placeholder="Pretrazite recepte" required="">
								<!-- <button type="submit" class="btn btn-default search" aria-label="Left Align">
									<i class="fa fa-search" aria-hidden="true"></i>
								</button> -->
							</form>
						
				</div>
				
				<div class="agileinfo_calender">
				<h3>Socijalne mreze</h3>
				<?php 
		      		

		      	 ?>
				<div class="w3ls-social-icons-1">
					<a class="facebook" href="http://www.facebook.com"><i class="fa fa-facebook"></i></a>
					<a class="twitter" href="http://www.twitter.com"><i class="fa fa-twitter"></i></a>
					<a class="pinterest" href="http://www.pinterest.com"><i class="fa fa-pinterest-p"></i></a>
					<a class="linkedin" href="http://www.linkedin.com"><i class="fa fa-linkedin"></i></a>
				</div>
				</div>
				<div class="w3ls_popular_posts">
					<h3>Popularni recepti</h3>
					<?php 

						$popularni = popularniRecepti();
						// var_dump($popularni);

						foreach ($popularni as $popularan) :

					 ?>
					<div class="agileits_popular_posts_grid">
						<a href="">
							<div class="w3agile_special_deals_grid_left_grid">
								<a href="index.php?strana=recept.php&id=<?=$popularan->id_recept?>"><img src="<?=$popularan->mala?>" class="img-responsive" alt="<?=$popularan->mala_alt?>" /></a>
							</div>
							<h4><a href="index.php?strana=recept.php&id=<?=$popularan->id_recept?>"><?=$popularan->naziv?></a></h4>
							<h5><i class="fa fa-calendar" aria-hidden="true"></i><?=datumObrada($popularan->datum_postavljanja)?></h5>
						</a>
					</div>

					<?php 
						endforeach;
					 ?>
					<!-- <div class="agileits_popular_posts_grid">
						<div class="w3agile_special_deals_grid_left_grid">
								<a href="singlepage.html"><img src="assets/images/p2.jpg" class="img-responsive" alt="" /></a>
							</div>
						<h4><a href="singlepage.html">Mauris Ut Odio Sed Nisi Convallis</a></h4>
						<h5><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</h5>
					</div>
					<div class="agileits_popular_posts_grid">
						<div class="w3agile_special_deals_grid_left_grid">
								<a href="singlepage.html"><img src="assets/images/p3.jpg" class="img-responsive" alt="" /></a>
						</div>
						<h4><a href="singlepage.html">Curabitur A Sapien Et Tellus Faucibus</a></h4>
						<h5><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</h5>
					</div> -->
				</div>
				
				<!-- <div class="w3l_categories">
					<h3>Categories</h3>
					<ul>
						<li><a href="singlepage.html"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>tellus faucibus eleifend sit amet</a></li>
						<li><a href="singlepage.html"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>Mauris ut odio sed nisi convallis</a></li>
						<li><a href="singlepage.html"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>Curabitur a sapien et tellus faucibus</a></li>
						<li><a href="singlepage.html"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>porta nunc eget, lobortis nulla</a></li>
						<li><a href="singlepage.html"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>Sed ut metus turpis cursus convallis</a></li>
						<li><a href="singlepage.html"><span class="glyphicon glyphicon-arrow-right" aria-hidden="true"></span>Maecenas cursus at ex a faucibus</a></li>
					</ul>
				</div>
				<div class="w3ls_recent_posts">
					<h3>Recent Posts</h3>
					<div class="agileits_recent_posts_grid">
						<div class="agileits_recent_posts_gridl">
							<div class="w3agile_special_deals_grid_left_grid">
									<a href="singlepage.html"><img src="assets/images/r1.jpg" class="img-responsive" alt="" /></a>
								</div>
						</div>
						<div class="agileits_recent_posts_gridr">
							<h4><a href="singlepage.html">velit esse quam nihil</a></h4>
							<h5><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</h5>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="agileits_recent_posts_grid">
						<div class="agileits_recent_posts_gridl">
							<div class="w3agile_special_deals_grid_left_grid">
									<a href="singlepage.html"><img src="assets/images/r2.jpg" class="img-responsive" alt="" /></a>
								</div>
						</div>
						<div class="agileits_recent_posts_gridr">
							<h4><a href="singlepage.html">Class aptent taciti </a></h4>
							<h5><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</h5>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div class="agileits_recent_posts_grid">
						<div class="agileits_recent_posts_gridl">
							<div class="w3agile_special_deals_grid_left_grid">
									<a href="singlepage.html"><img src="assets/images/r3.jpg" class="img-responsive" alt="" /></a>
								</div>
						</div>
						<div class="agileits_recent_posts_gridr">
							<h4><a href="singlepage.html">Maecenas eget erat </a></h4>
							<h5><i class="fa fa-calendar" aria-hidden="true"></i>FEB 15,2017</h5>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div> -->
			</div>	
		</div>
	</div>
	<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
	  Launch demo modal
	</button> -->

	