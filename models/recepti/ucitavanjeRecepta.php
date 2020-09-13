<?php 
	
	include "../../config/connection.php";
	include "functions.php";

	$brojRecepata = $_POST['broj'];

	echo json_encode(receptiLimit($brojRecepata));


 ?>