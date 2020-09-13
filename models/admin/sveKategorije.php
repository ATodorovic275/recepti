<?php 

	header("Content-type: application/json");
	require_once "../../config/connection.php";

	try{
		$kategorije = generickiUpit("SELECT * FROM kategorije");
		http_response_code(201);
		echo json_encode($kategorije);

	}
	catch(PDOException $ex){
		http_response_code(500);
		echo json_encode(["poruka"=>"Greska u bazi"]);
		zabeleziGreske($ex->getMessage());
	}


