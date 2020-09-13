<?php 
	// session_start();
	
	if (isset($_POST['dodaj_recept'])) {
		
		include "../../config/connection.php";
		// $idKorisnik = idKorisnika();


		//podaci
		$naziv = $_POST['naziv'];
		$vremePripreme = $_POST['vreme'];
		$opis = $_POST['opis'];
		$kategorija = $_POST['kategorija'];
		$slika = $_FILES['slika'];


		//podaci o slici
		$tmpName = $slika['tmp_name'];
		$name = $slika['name'];
		// echo $name;
		$type = $slika['type'];
		$size = $slika['size'];
		$direktorijum = "assets/images/";
		$direktorijumMala = "assets/images/mala_";
		define("VELICINA_SLIKE", 3*1024*1024);
		// echo $type;

		//regularni
		$nazivRi = "/^[A-Z][a-z\s]+$/";
		$opisRi = "/^[A-Z][a-z\s!?.]{50,1000}+$/";
		$dozvoljeniFormati = ['image/jpg', "image/jpeg", "image/png"];


		$greske = [];


		if(!preg_match($nazivRi, $naziv)){
			$greske[] = "Naziv nije ok";
		}

		if(!in_array($type, $dozvoljeniFormati)){
			$greske[] = "Dozvoljeni formati: jpg, jpeg, png";
		}

		if($size > VELICINA_SLIKE){
			$greske[] = "Maksimalna velicina slike je 3MB";
		}

		if($vremePripreme == 0){
			$greske[] = "Niste izabrali vreme pripreme";
		}

		if($vremePripreme == 0){
			$greske[] = "Niste izabrali kategoriju";
		}






		if(count($greske) == 0){

			$noviNaziv = time().$name;
			$putanjaVelika = $direktorijum.$noviNaziv;
			$putanjaMala = $direktorijumMala.$noviNaziv;
			echo $putanjaMala."</br>";
			echo $putanjaVelika;

			// alt atributi
			$altVelika = explode(".", $name)[0];
			$altMala = $altVelika."_mala";
			echo "Alt = ".$altVelika;
			echo "Mala = ".$altMala;

			//sredjivanje slike

			//dohvatanje dimenzija stare slike
			list($sirina, $visina) = getimagesize($tmpName);


			//pretvaranje slik
			$trenutna = null;
			switch ($type) {
				case 'image/jpeg':
				case "image/jpg" :
					$trenutna = imagecreatefromjpeg($tmpName);
					break;
				
				case "image/png" :
					$trenutna = imagecreatefrompng($tmpName);
					break;
			}



			//pravljenje prazne slike velike
			$sirinaNova = 1280;
			$visinaNova = 720;
			$prazna = imagecreatetruecolor($sirinaNova, $visinaNova);


			// pravljenje prazne slike male
			$sirinaNovaMala = 500;
			$visinaNovaMala = 300;
			$praznaMala = imagecreatetruecolor($sirinaNovaMala, $visinaNovaMala);


			//popunjaavanje prazne
			imagecopyresampled($prazna, $trenutna, 0, 0, 0, 0, $sirinaNova, $visinaNova, $sirina, $visina);


			//popunjaavanje prazne male
			imagecopyresampled($praznaMala, $trenutna, 0, 0, 0, 0, $sirinaNovaMala, $visinaNovaMala, $sirina, $visina);




			//cuvanje slike
			$sacuvano = null;
			$sacuvanoMala = null;

			switch ($type) {
				case 'image/jpeg':
				case 'image/jpg':
					$sacuvano = imagejpeg($prazna, "../../".$putanjaVelika);
					$sacuvanoMala = imagejpeg($praznaMala, "../../".$putanjaMala);
					break;
				case "image/png" :
					$sacuvano = imagepng($prazna, "../../".$putanjaVelika);
					$sacuvanoMala = imagepng($praznaMala, "../../".$putanjaMala);
					break;
			}


			if($sacuvano && $sacuvanoMala){
				echo "Slika je uspesno sacuvana";

				// uneti sliku u bazu
				try{
					$upit = "INSERT INTO slika VALUES(NULL, ?, ?, ?, ?)";
					$priprema = $conn->prepare($upit);
					$sacuvanaSlika = $priprema->execute([$putanjaVelika, $altVelika, $putanjaMala, $altMala]);

					if($sacuvanaSlika){
						echo "Uspesno upisano u slike";
						$idSlike = $conn->lastInsertId();
						echo "idSlike = ".$idSlike;


						// upisivanje recepta za zadati idSlike
						try{
							$upit = "INSERT INTO recept(naziv, opis, id_korisnik, id_vreme_pripreme, id_kategorije, id_slika) VALUES(?, ?, ?, ?, ?, ?)";
							$priprema = $conn->prepare($upit);
							$rezultat = $priprema->execute([$naziv, $opis, $_SESSION['korisnik']->id_korisnik, $vremePripreme, $kategorija, $idSlike]);
							$idUnetogrecepta = $conn->lastInsertId(); 
							echo "Uspesno unet recept";

							// upisivanje u tabelu glasanje samo da bi se pojavio na pocetnoj strani
							if($rezultat){
								$upit = "INSERT INTO glasanje VALUES(NULL, ?, ?, NULL);";
								$priprema = $conn->prepare($upit);
								$priprema->execute([$idUnetogrecepta, $_SESSION['korisnik']->id_korisnik]);
							}
							header("Location: ../../index.php?strana=korisnik.php");
						}
						catch(PDOException $ex){
							echo $ex->getMessage();

						}
						

					}
					
				}
				catch(PDOException $ex){
					echo $ex->getMessage();
				}
				

			}
			else
				echo "Slika nije sacuvana";

		}
		else{
			// var_dump($greske);
			$_SESSION['greske'] = $greske;
			header("Location: ../../index.php?strana=korisnik.php");

		}


	}
	else
		header("Location: ../../index.php?strana=korisnik.php");

 ?>