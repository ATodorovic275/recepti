<?php 

	if (isset($_POST['vrednost'])) {
		include "functions.php";
		include "../../config/connection.php";
		
		$sort = $_POST['vrednost'];
		$upit = receptiSort();

		switch ($sort) {
			case 1:
				$upit .= " ORDER BY datum_postavljanja";
				break;
			case 2:
				$upit .= " ORDER BY datum_postavljanja DESC";
				break;
			case 3:
				$upit .= " ORDER BY AVG(g.ocena)";				
				break;
			case 4:
				$upit .= " ORDER BY AVG(g.ocena) DESC";
				break;
			default:
				$upit = recepti();
				break;
		}



		try{
			$recepti = generickiUpit($upit);

			http_response_code(201);
			echo json_encode($recepti);

		}
		catch(PDOException $ex){
			http_response_code(500);
			echo json_encode(["poruka"=>"Greska"]);
			zabeleziGreske($ex->getMessage());
		}

	}
	else{
		http_response_code(404);
		echo json_encode(["poruka"=>"Pogresno prosledjeni podaci"]);
	}

 ?>