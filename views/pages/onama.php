<div class="container">
	<div id="onama">
		<div class="row">
			<?php 
				include "models/korisnici/functions.php";
				$onama = oNamaPodaci();
				// var_dump($onama);

				// $podaci = explode("\n", $onama->op);
			 ?>
			<div id="slika_onama">	
				<img src="<?=$onama->slika?>" class="img-responsive" alt="onama">
			</div>	
			<div id="onama_tekst">
			<!-- 	<p><?=$podaci[0]?></p>
				<p><?=$podaci[1]?></p> -->
				<p><?=$onama->opis?></p>
			</div>
		</div>
	</div>
</div>