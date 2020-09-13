<?php 

	header("Content-type: application/json");
	require_once "../../config/connection.php";

	if(isset($_POST['naziv'])){

		$naziv = $_POST['naziv'];

		try{
			$upit = "INSERT INTO kategorije VALUES(NULL, ?)";
			$priprema = $conn->prepare($upit);
			$priprema->execute([$naziv]);

			http_response_code(204);
			// echo json_encode($recepti);

		}
		catch(PDOException $ex){
			http_response_code(500);
			echo json_encode(["poruka"=>"Greska u bazi"]);
			zabeleziGreske($ex->getMessage());
		}
	}
	else
		http_response_code(400);

	



