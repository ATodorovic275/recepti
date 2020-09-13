<?php 

	header("Content-type: application/json");
	require_once "../../config/connection.php";

	if(isset($_POST['id'])){

		$id = $_POST['id'];

		try{
			$upit = "DELETE FROM recept WHERE id_recept = ?";
			$priprema = $conn->prepare($upit);
			$priprema->execute([$id]);

			http_response_code(204);
		}
		catch(PDOException $ex){
			http_response_code(500);
			echo json_encode(["poruka"=>"Greska u bazi"]);
			zabeleziGreske($ex->getMessage());
		}
	}
	else
		http_response_code(400);

	



