<?php 

	require_once "../../config/connection.php";
	header("Content-type: application/json");
	

	try{
		$korisnici = generickiUpitRed("SELECT COUNT(*) AS brojRecepti FROM recept");
		http_response_code(201);
		echo json_encode($korisnici);
		
	}
	catch(PDOException $ex){
		http_response_code(500);
		echo json_encode(["poruka"=>"Greska u bazi"]);
		zabeleziGreske($ex->getMessage());
	}





 ?>