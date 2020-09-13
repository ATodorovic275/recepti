<?php 

	if (isset($_POST['kategorija'])) {
		include "functions.php";
		include "../../config/connection.php";
		
		$kategorija = $_POST['kategorija'];
		$upit = recepti();

		if($kategorija != 0){
			$upit .= " WHERE id_kategorije = ?"; 
		}		
		// echo $upit;
		$priprema = $conn->prepare($upit);

		try{
			$priprema->execute([$kategorija]);
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