<?php 


	function brojKorisnika(){
		global $conn;
		return $conn->query("SELECT COUNT(*) as broj FROM korisnik")->fetch();
	}


	
	function brojRecepata(){
		global $conn;
		return $conn->query("SELECT COUNT(*) as broj FROM recept")->fetch();
	}



	function brojKategorija(){
		global $conn;
		return $conn->query("SELECT COUNT(*) as broj FROM kategorije")->fetch();
	}



	function brojTrenutnoLogovanihKorisnika(){
		$podaci = file(BASE_URL."/data/korisnici.txt");
		// var_dump($podaci);
		return $podaci;
	}



	
	function recepti(){
		return generickiUpit("SELECT r.*, k.username as username, ka.naziv as nazivKategorija, v.vreme as vreme FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik INNER JOIN vreme_pripreme v ON r.id_vreme_pripreme = v.id_vreme_pripreme INNER JOIN kategorije ka ON r.id_kategorije = ka.id_kategorije");
	}



	

	function posetaStranicama(){

		$file = file(BASE_URL."/data/log.txt");
		// $brIndex = 0;
		$datum = mktime(); // timestamp

		// echo "Datum = $datum</br>";
		// echo "Datum slovima:".date("d:m:Y", $datum)."</br>";

		$dvadesetCetriSataUSekundama = 86400;
		$datumSa24 = $datum - $dvadesetCetriSataUSekundama;
		// echo "Datum sa 24 sata: ".$datumSa24."</br>";

		$br = 0;
		$brojacIndex = 0;
		$brojacAdmin = 0;
		$brojacKorisnik = 0;
		$brojacOAutoru = 0;
		$brojacONama = 0;
		$brojacRecepti = 0;
		$ukupno = 0;

		foreach ($file as $red) {
			$stranica = explode("\t", $red)[0];
			$datumIzFajla = explode("\t", $red)[1];
			// echo $stranica."</br>";
			// echo $datumIzFajla."</br>";
			$datumUSekundama = strtotime($datumIzFajla);

			// echo "Datum iz fajla u sekundama: ".$datumUSekundama."</br>";
			// if($datumUSekundama > $datumSa24){
			// 	$br++;
			// 	// echo "jeste";
			// }
			if(($stranica == "index.php?strana=pocetna.php" || $stranica == "index.php") && ($datumUSekundama > $datumSa24)){
				$brojacIndex++;
			}
			else if($stranica == "index.php?strana=admin.php"  && $datumUSekundama > $datumSa24){
				$brojacAdmin++;
			}
			else if($stranica == "index.php?strana=korisnik.php" && $datumUSekundama > $datumSa24){
				$brojacKorisnik++;
			}
			else if($stranica == "index.php?strana=oautoru.php" && $datumUSekundama > $datumSa24){
				$brojacOAutoru++;
			}
			else if($stranica == "index.php?strana=onama.php" && $datumUSekundama > $datumSa24){
				$brojacONama++;
			}
			else if($stranica == "index.php?strana=recepti.php" && $datumUSekundama > $datumSa24){
				$brojacRecepti++;
			}

		}
		$ukupno = $brojacIndex+$brojacAdmin+$brojacKorisnik+$brojacOAutoru+$brojacONama+$brojacRecepti;
		// return round($brojacIndex*100/$ukupno, 2);
		return array(round($brojacIndex*100/$ukupno), round($brojacAdmin*100/$ukupno), round($brojacKorisnik*100/$ukupno), round($brojacOAutoru*100/$ukupno), round($brojacONama*100/$ukupno), round($brojacRecepti*100/$ukupno));

	}



	// function count($tabela){
	// 	global $conn;
	// 	return $conn->query("SELECT COUNT(*) as broj FROM $tabela")->fetch();
	// }
