<?php 
	// session_start();
	// ucitava se iz index.php
	// include "../config/connection.php";

	$meni = generickiUpit("SELECT * FROM meni ORDER BY redosled");
	// var_dump($meni);

	foreach ($meni as $stavka) :
 ?>
 	<li><a href="index.php?strana=<?=$stavka->putanja?>"><?=$stavka->tekst?></a></li>

 	<?php 

 		endforeach;
 		if (isset($_SESSION['korisnik'])) {
 			if($_SESSION['korisnik']->id_uloga == 1){
 				echo "<li><a href='index.php?strana=admin.php'>Admin</a></li>";
 			}
 			echo "<li><a href='index.php?strana=korisnik.php&value=select&id=".$_SESSION['korisnik']->id_korisnik."'>"."Moji recepti</a></li>";
 			echo "<li><a href='models/korisnici/logout.php'>Logout</a></li>";

 		}
 	 ?>