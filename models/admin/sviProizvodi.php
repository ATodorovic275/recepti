<?php 

	header("Content-type: application/json");
	require_once "../../config/connection.php";

	try{
		$recepti = generickiUpit("SELECT r.*, k.naziv as kategorija, ko.username as korisnik, v.vreme as vremePripreme FROM recept r INNER JOIN kategorije k ON r.id_kategorije = k.id_kategorije INNER JOIN korisnik ko ON r.id_korisnik = ko.id_korisnik INNER JOIN vreme_pripreme v ON r.id_vreme_pripreme = v.id_vreme_pripreme");
		http_response_code(201);
		echo json_encode($recepti);

	}
	catch(PDOException $ex){
		http_response_code(500);
		echo json_encode(["poruka"=>"Greska u bazi"]);
		zabeleziGreske($ex->getMessage());
	}



