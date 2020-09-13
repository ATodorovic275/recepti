<?php 
	// include "functions.php";
	include "../../config/connection.php";

	if(brisanjeKorisnika($_SESSION['korisnik']->id_korisnik)){
		unset($_SESSION['korisnik']);
		session_destroy();
		header("Location: ../../index.php");
	}
	

 ?>