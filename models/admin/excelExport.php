<?php 
	include "../../config/connection.php";
	include "functions.php";

	$excel = new COM('excel.application');
	$excel->visible = 1;

	$workbook = $excel->Workbooks->Add();

	$worksheet = $workbook->Worksheets("Sheet1");

	$worksheet->activate;

	$podaci = recepti();

	$br = 1;
	foreach ($podaci as $recept) {
		$polje = $worksheet->Range("A".$br);
		$polje->activate;
		$polje->value = $recept->id_recept;


		$polje = $worksheet->Range("B".$br);
		$polje->activate;
		$polje->value = $recept->naziv;


		$polje = $worksheet->Range("C".$br);
		$polje->activate;
		$polje->value = $recept->datum_postavljanja;

		$polje = $worksheet->Range("D".$br);
		$polje->activate;
		$polje->value = $recept->username;

		$polje = $worksheet->Range("E".$br);
		$polje->activate;
		$polje->value = $recept->vreme;


		$polje = $worksheet->Range("F".$br);
		$polje->activate;
		$polje->value = $recept->nazivKategorija;

		$br++;
	}

	if($workbook->_SaveAS()){
		header("Location: ../../index.php?strana=admin.php");
	}

 ?>