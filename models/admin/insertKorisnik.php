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
		$uloga = $_POST['uloga'];

		// regularni izrazi
		$imeRi = "/^[A-Z][a-z]+$/";
		$usernameRi = "/^[a-z]\w+$/"; 
		$emailRi = "/^[a-z]\w+([#$%^&*!?]?\w)*@(gmail|hotmail|yahoo)\.com$/";
		$passwordRi = "/^[\w?@#$%^&*]{6,20}$/";


		// provera

		function proveraRegularni($regularni, $zaProveru, $porukaGreska, $niz){
			if(!preg_match($regularni, $zaProveru)){
				$niz[] = $porukaGreska;
			}
		}




		$greske = [];

		proveraRegularni($imeRi, $ime, "Ime nije ok", $greske);

		proveraRegularni($imeRi, $prezime, "Prezime nije ok", $greske);	

		proveraRegularni($usernameRi, $username, "Username nije ok", $greske);

		proveraRegularni($emailRi, $email, "Email nije ok", $greske);

		proveraRegularni($passwordRi, $password, "Password nije ok", $greske);


		if(count($greske) > 0){
			$data = $greske;
			$status = 422;
		}
		else{
			// upis u bazu

			$upit = "INSERT INTO korisnik(ime, prezime, email, username, sifra, id_uloga) VALUES(?, ?, ?, ?, ?, ?)";
			$priprema = $conn->prepare($upit);
			try{
				$priprema->execute([$ime, $prezime, $email, $username, $password, $uloga]);
				$status = 201;
				$data = ['poruka'=>'Uspesno ste dodali korisnika'];
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