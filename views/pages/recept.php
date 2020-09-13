<div id="recept">
<div class="container">
	<div class="row">
		<?php 

			if (isset($_GET["id"])) :

				include "models/recepti/functions.php";

				$recept = jedanRecept($_GET['id']);
				// var_dump($recept);
				
			
		 ?>
		<div class="col-lg-8 col-md-8 no_padding">
			<div id="jedan_recept">
					<img src="<?=$recept->velika?>" class="img-responsive">				
				<header id="recept_info">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><?=$recept->username?></div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6"><?=datumObrada($recept->datum_postavljanja)?></div>
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">Ocena: <?=ocenaObrada($recept->Prosecna)?></div>
					</div>
				</header>
				<h3 class="naslov_recept"><?=$recept->naziv?></h3>
				<p><?=$recept->opis?>
				</p>
				<?php 
					if(isset($_SESSION["korisnik"]) && glasKorisnik($_SESSION['korisnik']->id_korisnik) != 1):
					
				 ?>
				<a href="" id="glasanjeBtn">
					Ocenite
				</a>

				<?php 
				endif;
			 ?>
				<div id="glasanje">
					<form>
						<input value='1' type="radio" name="btnRadio"/>1
						<input value='2' type="radio" name="btnRadio"/>2
						<input value='3' type="radio" name="btnRadio"/>3
						<input value='4' type="radio" name="btnRadio"/>4
						<input value='5' type="radio" name="btnRadio"/>5
						<input type="button" name="glasPosalji" id="glasPosalji" value="Glasaj" />
					</form>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4 col-md-4">
			<h3 class="naslov_slicni">Slicni recepti</h3>
			
			 <div id="slicni">
		 	<?php	 

				$slicni = receptiIzKategorije($_GET['id']);
				$broj = count($slicni);
				$brojac = 3;
				if($broj == 2){
					$brojac = 2;
				}
				// var_dump($slicni);

				for($i=0; $i<$brojac; $i++) :

				
			 ?>

				 <a href="index.php?strana=recept.php&id=<?=$slicni[$i]->id_recept?>"><img src="<?=$slicni[$i]->velika?>" class="img-responsive img_slicni"></a>
				  <!-- <p><?=$slicni[$i]->naziv?></p> -->
				<?php endfor; endif; ?>
			 </div>
		</div>
	</div>
</div>
</div>