<?php 
	// session_start();

	if (isset($_POST['update_recept'])) {
		
		include "../../config/connection.php";

		//podaci
		$naziv = $_POST['naziv'];
		$vremePripreme = $_POST['vreme'];
		$opis = $_POST['opis'];
		$kategorija = $_POST['kategorija'];
		$slika = $_FILES['slika'];
		$idRecept = $_POST['idRe'];

		//podaci o slici
		$tmpName = $slika['tmp_name'];
		$name = $slika['name'];
		$type = $slika['type'];
		$size = $slika['size'];
		$direktorijum = "assets/images/";
		define("VELICINA_SLIKE", 3*1024*1024);
		// echo $type;
		echo "Ime: ".$tmpName;

		//regularni
		$nazivRi = "/^[A-Z][a-z\s]+$/";
		$opisRi = "/^[A-Z][a-z\s!?.]{50,1000}+$/";
		$dozvoljeniFormati = ['image/jpg', "image/jpeg", "image/png"];


		$greske = [];

		proveraRegularni($nazivRi, $naziv, "Naziv nije u dobrom formatu", $greske);
		proveraRegularni($opisRi, $opis, "Opis nije dobar", $greske);

		if($tmpName == ""){

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
			$putanja = $direktorijum.$noviNaziv;
			echo $putanja;



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



			//pravljenje prazne slike
			$sirinaNova = 500;
			$visinaNova = 300;
			$prazna = imagecreatetruecolor($sirinaNova, $visinaNova);



			//popunjaavanje prazne
			imagecopyresampled($prazna, $trenutna, 0, 0, 0, 0, $sirinaNova, $visinaNova, $sirina, $visina);


			//cuvanje slike
			$sacuvano = null;
			switch ($type) {
				case 'image/jpeg':
				case 'image/jpg':
					$sacuvano = imagejpeg($prazna, "../../".$putanja);
					break;
				case "image/png" :
					$sacuvano = imagepng($prazna, "../../".$putanja);
					break;
			}


			if($sacuvano){
				echo "Slika je uspesno sacuvana";

				//upis u bazu

				$upit = "UPDATE recept SET naziv = ?, slika = ?, opis = ?, id_vreme_pripreme = ?, id_kategorije = ? WHERE id_recept = ?";
				$priprema = $conn->prepare($upit);
				// var_dump($_SESSION['korisnik']);
				try{
					$priprema->execute([$naziv, $putanja, $opis, $vremePripreme, $kategorija, $idRecept]);
					echo "Uspesno izmenjen recept";
					// $_SESSION['odgovor'] = "Uspesno izmenjen recept";
					// header("Location: ../../index.php?strana=korisnik_strana.php");

				}
				catch(PDOException $ex){
					echo $ex->getMessage();
				}
				
			}
			else
				echo "Slika nije sacuvana";




		}
		else{
			var_dump($greske);
		}


	}
	else
		// header("Location: ../../index.php?strana=korisnik_strana.php");
		echo "Redirekcija";

 ?>