<div class="container">
	<div id="autor">
	<div class="row">
			<?php 
			include "models/korisnici/functions.php";
			$autor = autorPodaci();
			// var_dump($autor);
			$podaci = explode(" ", $autor->opis);
			 ?>
			<div class="col-lg-4">	
				<img src="<?=$autor->slika?>" class="img-responsive" alt="oautoru">
			</div>
			<div class="col-lg-8">
				<h3>Podaci o autoru</h3>
				<p>
					<?=$podaci[0]." ".$podaci[1]?>
				</p>
				<p>
					<?=$podaci[2]." ".$podaci[3]." ".$podaci[4]?>
				</p>
				<a href="models/korisnici/wordExport.php" class="btnBoja">Export u word</a>
			</div>
		</div>
	</div>
</div>