<?php 
	ob_start();
 ?>
<?php 
	require_once "config/connection.php";

	include "views/fixed/head.php";
	include "views/fixed/header.php";

	if (isset($_GET['strana'])) {
		switch ($_GET['strana']) {
			case 'admin.php':
				include "views/pages/admin.php";
				break;	
			case 'recept.php':
				include "views/pages/recept.php";
				break;
			case 'korisnik.php':
				include "views/pages/korisnik.php";
				break;
			case 'recepti.php':
				include "views/pages/sviRecepti.php";
				break;
			case 'oautoru.php':
				include "views/pages/oautoru.php";
				break;
			case 'onama.php':
				include "views/pages/onama.php";
				break;
			default:
				include "views/pages/pocetna.php";			
				break;
		}
	}
	else
		include "views/pages/pocetna.php";



	include "views/fixed/modal_login.php";
	include "views/fixed/modal_registration_succses.php";
	include "views/fixed/futer.php";

 ?>


