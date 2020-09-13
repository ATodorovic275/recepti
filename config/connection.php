<?php 
	session_start();
		
	require_once "config.php";

	try{

		zabeleziPristup();

		$conn = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
		$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $ex){
		echo $ex->getMessage();
	}



	function zabeleziPristup(){
	    $file = fopen(BASE_URL . "/Recepti sajt/data/log.txt", "a");

	    $string = basename($_SERVER['REQUEST_URI']) . "\t" . date("d.m.Y H:i:s") . "\t" . $_SERVER['REMOTE_ADDR'] . "\n";

	    fwrite($file, $string);
	    fclose($file);
	}




	function zabeleziGreske($greska){
		$fajl = BASE_URL."/data/error.txt";
		$veza = fopen($fajl, "a");

		$zaUpis = $greska."\t".date("d.m.Y H:i:s")."\n";
		// echo "greskaZa: ".$zaUpis;
		fwrite($veza, $zaUpis);
		fclose($veza);
	}


	

	function generickiUpit($upit){
		global $conn;
		return $conn->query($upit)->fetchAll();
	}

	function generickiUpitRed($upit){
		global $conn;
		return $conn->query($upit)->fetch();
	}

	// proverava da li zadati parametar zadovoljava regularni izraz
	// function proveraRegularni($regularni, $zaProveru, $porukaGreska, $niz){
	// 	if(!preg_match($regularni, $zaProveru)){
	// 		$niz[] = $porukaGreska;
	// 	}
	// 	return $niz;
	// }



	function idKorisnika(){
		if(isset($_SESSION['korisnik'])){
			return $_SESSION['korisnik']->id_korisnik;
		}
	}


	function upisiKorisnika($rez){
		$fajl = fopen(BASE_URL."/data/korisnici.txt", "a");
		$sadrzaj = "Id korisnika: ".$rez->id_korisnik."\t"."username: ".$rez->username."\n";
		fwrite($fajl, $sadrzaj);
		fclose($fajl);
	}





	function brisanjeKorisnika($idKorisnik){

		$file = file(BASE_URL."/data/korisnici.txt");

		foreach ($file as $red) {
			$podatak = explode("\t", trim($red))[0];
			$id = explode(":", $podatak)[1];
			$sadrzaj = "";
			// var_dump(trim($id));
			if(trim($id) != $idKorisnik){
				$sadrzaj .= $red;
			}
		}

		$file = fopen(BASE_URL."/data/korisnici.txt", "w");
		fwrite($file, $sadrzaj);
		$rez = fclose($file);
		return $rez;
	}

?>