<?php 
	define("BASE_URL", $_SERVER['DOCUMENT_ROOT']);
	// /echo BASE_URL;


	//echo env("SERVER");


	define("SERVER", env("SERVER"));
	define("DATABASE", env("DATABASE"));
	define("USERNAME", env("USERNAME"));
	define("PASSWORD", env("PASSWORD"));


	function env($param){
		$file = file(BASE_URL."/Recepti sajt/config/.env");
		$vrednost = "";

		foreach ($file as $red) {
			$podatak = explode("=", trim($red));
			if($param == $podatak[0]){
				$vrednost = $podatak[1];
			}
		}

		return $vrednost;
	}


 ?>