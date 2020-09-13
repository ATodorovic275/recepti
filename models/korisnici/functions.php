<?php 

	// require_once "../../config/connection.php";

	
	// echo ispisLogova();

	function ispisLogova(){
		$fajlPutanja = BASE_URL."/data/log.txt";
		$podaci = file($fajlPutanja);

		$sadrzaj = "<table>
			<tr>
				<th>Url adresa</th>
				<th>Vreme pristupanja</th>
				<th>Ip adresa</th>
			</tr>";

		foreach ($podaci as $red) {
			$podatak = explode("\t", trim($red));
			// var_dump($podatak);
			$sadrzaj .= "
				<tr>
					<td>";
					echo $podatak[0];
					$sadrzaj.="</td>
					<td></td>
					<td></td>
				</tr>";
		}

		$sadrzaj .= "</table";

		return $sadrzaj;
	}




	// function proveraRegularni($regularni, $zaProveru, $porukaGreska, $niz){
	// 		if(!preg_match($regularni, $zaProveru)){
	// 			$niz[] = $porukaGreska;
	// 		}
	// 	}


	function korisnik($idKorisnik){
		global $conn;
		$priprema = $conn->prepare("SELECT * FROM korisnik where id_korisnik = ?");
		$priprema->execute([$idKorisnik]);
		return $priprema->fetch();
	}
	



	function autorPodaci(){
		return generickiUpitRed("SELECT * FROM autor");
	}


	function oNamaPodaci(){
		return generickiUpitRed("SELECT * FROM onama");
	}


	function receptiKorisnika($idKorisnik){
		global $conn;
		// $priprema = $conn->prepare("SELECT * FROM recept r INNER JOIN korisnik k on r.id_korisnik = k.id_korisnik WHERE k.id_korisnik = ?");
		$priprema = $conn->prepare("SELECT r.*, k.username, s.* FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik INNER JOIN slika s ON r.id_slika = s.id_slika WHERE k.id_korisnik = ?");
		$priprema->execute([$idKorisnik]);
		return $priprema->fetchAll();
	}



	function kategorijeRecepta(){
		return generickiUpit("SELECT * FROM kategorije");
	}


	function vremenaPripreme(){
		return generickiUpit("SELECT * FROM vreme_pripreme");
	}


	function recept($idRecept){
		global $conn;
		return $conn->query("SELECT * FROM recept WHERE id_recept = $idRecept")->fetch();
	}





 ?>