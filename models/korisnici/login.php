<?php 
	
	require_once "../../config/connection.php";
	// session_start();
	// include "functions.php";

	header("Content-type: application/json");

	if (isset($_POST['poslato'])){

		// preuzimanje podataka
		$email = $_POST['email'];
		$password = $_POST['password'];


		// provera da li postoji korisnik u bazi sa parametrima
		$upit = "SELECT * FROM korisnik WHERE email = ? AND sifra = ?";
		$priprema = $conn->prepare($upit);
		
		try{
			$priprema->execute([$email, $password]);
			if($priprema->rowCount() == 1){
				$rez = $priprema->fetch();

				// sesija korisnika
				$_SESSION['korisnik'] = $rez;
				http_response_code(201);

				upisiKorisnika($rez);

				echo json_encode("Uspesno logovan");				
				// header("Location: ../../index.php");
			}
			else{
				// $_SESSION['greska'] = "Pogresna email adresa ili lozinka";
				http_response_code(422);
				echo json_encode(['poruka'=>'Pogresna email adresa ili lozinka']);
				// header("Location: ../../index.php");

			}
		}
		catch(PDOException $ex){
			// echo $ex->getMessage();
			http_response_code(500);
			echo json_encode(['poruka'=>'Greska u bazi']);


			zabeleziGreske($ex->getMessage());
			
		}

	}
	else
		// header("Location:".BASE_URL."/index.php");
		http_response_code(404);
		// header("Location: ../../index.php");





 ?>