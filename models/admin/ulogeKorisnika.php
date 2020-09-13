<?php 

	header("Content-type: application/json");
	require_once "../../config/connection.php";

	try{
		$uloge = generickiUpit("SELECT * FROM uloga");
		http_response_code(201);
		echo json_encode($uloge);

	}
	catch(PDOException $ex){
		http_response_code(500);
		echo json_encode(["poruka"=>"Greska u bazi"]);
		zabeleziGreske($ex->getMessage());
	}


	