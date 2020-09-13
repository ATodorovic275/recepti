<?php 

	if (isset($_POST['vrednost'])) {
		include "functions.php";
		include "../../config/connection.php";
		
		$vrednost = strtolower("%".$_POST['vrednost']."%");

		$upit = receptiKorisnici()." WHERE LOWER(naziv) LIKE ? GROUP BY r.id_recept";
		// echo $upit;
		$priprema = $conn->prepare($upit);

		try{
			$priprema->execute([$vrednost]);
			$recepti = $priprema->fetchAll();

			http_response_code(201);
			echo json_encode($recepti);

		}
		catch(PDOException $ex){
			http_response_code(500);
			echo json_encode(["poruka"=>"Greska"]);
			zabeleziGreske($ex->getMessage());
		}

	}
	else{
		http_response_code(404);
		echo json_encode(["poruka"=>"Pogresno prosledjeni podaci"]);
	}

 ?>