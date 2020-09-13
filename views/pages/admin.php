<?php
	if(isset($_SESSION['korisnik'])){
		if($_SESSION['korisnik']->id_uloga == 2){
			header("Location: index.php");
		}
	}
	else{
		$_SESSION['greske'] = "Nije admin";
		header("Location: index.php");
	}

?>
	<div id="omot">
		<div class="container">
			<div class="row padding1">
				<?php 
					include "models/admin/functions.php";

					$log = brojTrenutnoLogovanihKorisnika();
				 ?>
				<div class="col-lg-12 info-text">
					<span>Admin: <?=$_SESSION['korisnik']->username?></span>
					<p>Broj logovanih korisnika: <?=count($log);?></p>
					<?php 

					

			
						// echo "brojac: ".$br;
						// echo $brojacIndex."</br>";
						// echo $brojacAdmin."</br>";
						// echo $brojacKorisnik."</br>";
						// echo $brojacOAutoru."</br>";
						// echo $brojacONama."</br>";
						// echo $brojacRecepti."</br>";

						// echo $brIndex/100;

					 ?>
				</div>
				<div class="col-lg-4 col-md-4 manji_padding">
					<div class="column">
						<i class="fa fa-user" aria-hidden="true"></i>
						<?php 
							

							$brojK = brojKorisnika();
							$brojR = brojRecepata();
							$brojKategorija = brojKategorija();
							// var_dump($broj);
						 ?>
						<p id="brojKorisnika"><?=$brojK->broj?></p>
						<a href="#" id="korisnici">Korisnici</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 manji_padding">
					<div class="column">
						<i class="fa fa-cutlery" aria-hidden="true"></i>
						<p id="brojRecepti"><?=$brojR->broj?></p>
						<a href="#" id="recepti">Recepti</a>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 manji_padding">
					<div class="column">
						<i class="fa fa-leaf" aria-hidden="true"></i>
						<p id="brojKategorija"><?=$brojKategorija->broj?></p>
						<a href="#" id="namirnice">Kategorije</a>
					</div>
				</div>
			</div>
		</div>

		<section>
			<div class="container">
				<div class="row">
					<div id="ispis">

						<h2>Pristup stranicama u poslednjih 24 sata</h2>
						<table>
							<tr>
								<th>Index</th>
								<th>Admin</th>
								<th>Moji recepti</th>
								<th>O autoru</th>
								<th>O nama</th>
								<th>Recepti</th>							
							</tr>
							<tr>
						
						<?php 

							include "models/korisnici/functions.php";

							$podaci = posetaStranicama();

							foreach ($podaci as $stranica) :
						 ?>
		
								<td><?=$stranica?>%</td>
						
						<?php endforeach; ?>
							</tr>


							</table>

					</div>
				</div>
			</div>
		</section>
	</div>
	