<?php 

	// header("Content-type: application/json");
	header('Content-type: application/json');	

	if (isset($_POST['cekirani'])) {
		require_once "../../config/connection.php";

		$ocena = $_POST['cekirani'];
		$korisnikId = $_SESSION['korisnik']->id_korisnik;
		$receptId = $_POST['idRecept'];

		$upit = "INSERT INTO glasanje VALUES(NULL, ?, ?, ?)";
		$priprema = $conn->prepare($upit);

		try{
			$priprema->execute([$receptId, $korisnikId, $ocena]);
			http_response_code(201);
			echo json_encode(['poruka'=>"Uspesno ste glasali"]);
		}
		catch(PDOException $ex){
			echo json_encode(['poruka'=>"Greska"]);
			// echo json_encode("test");
			http_response_code(500);
			zabeleziGreske($ex->getMessage());

		}

	}
	else{
		http_response_code(404);
	}




 ?>