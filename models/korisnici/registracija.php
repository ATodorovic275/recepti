<?php 
	
	header("Content-type: application/json");
	$status = 404;
	$data = null;

	if (isset($_POST['poslato'])) {
		
		include "../../config/connection.php";
		include "../korisnici/functions.php";
		
		// podaci iz forme
		$ime = $_POST['ime'];
		$prezime = $_POST['prezime'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];


		// regularni izrazi
		$imeRi = "/^[A-Z][a-z]+$/";
		$usernameRi = "/^[a-z]\w+$/"; 
		$emailRi = "/^[a-z]\w+([#$%^&*!?]?\w)*@(gmail|hotmail|yahoo)\.com$/";
		$passwordRi = "/^[\w?@#$%^&*]{6,20}$/";




		$greske = [];

		if(!preg_match($imeRi, $ime)){
			$greske[] = "Ime nije ok";
		}
		if(!preg_match($imeRi, $prezime)){
			$greske[] = "Prezime nije ok";
		}
		if(!preg_match($usernameRi, $username)){
			$greske[] = "Username nije ok";
		}
		if(!preg_match($emailRi, $email)){
			$greske[] = "Email nije ok";
		}
		if(!preg_match($passwordRi, $password)){
			$greske[] = "Ime nije ok";
		}
		


		



		if(count($greske) > 0){
			$data = $greske;
			$status = 422;
		}
		else{
			// upis u bazu

			$upit = "INSERT INTO korisnik(ime, prezime, email, username, sifra) VALUES(?, ?, ?, ?, ?)";
			$priprema = $conn->prepare($upit);
			try{
				$priprema->execute([$ime, $prezime, $email, $username, $password]);
				$status = 201;
				$data = ['poruka'=>'Uspesno ste se registrovali'];
			}
			catch(PDOException $ex){
				$data = ['poruka'=>"Greska u bazi"];
				$status = 500;
				zabeleziGreske($ex->getMessage());
			}

		}



		// funkcije 


	}
	
	echo json_encode($data);
	http_response_code($status);


 ?>