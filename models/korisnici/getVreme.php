<?php 

	require_once "../../config/connection.php";
	header("Content-type: application/json");
	

	try{
		$vremePripreme = generickiUpit("SELECT * FROM vreme_pripreme");
		// var_dump($vremePripreme);
		http_response_code(201);
		echo json_encode($vremePripreme);
		
	}
	catch(PDOException $ex){
		http_response_code(500);
		echo json_encode(["poruka"=>"Greska u bazi"]);
		zabeleziGreske($ex->getMessage());
	}
	



 ?>