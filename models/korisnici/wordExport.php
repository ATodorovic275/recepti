<?php 
	include "../../config/connection.php";
	include "functions.php";
	

	$word = new COM("word.application");
	
	$word->Visible = 1;

	$word->Documents->Add();
	
	$autor = autorPodaci();

	$podaci = explode(" ", $autor->opis);


	$word->Selection->TypeText("Podaci o autoru"."\n");
	$word->Selection->TypeText($podaci[0]." ".$podaci[1]."\n");
	$word->Selection->TypeText($podaci[2]." ".$podaci[3]." ".$podaci[4]);

	$word->Documents[1]->SaveAs("autor.doc");

	$word->Quit();
	
	$word = null;
	
	header("Location: ../../index.php");

 ?>