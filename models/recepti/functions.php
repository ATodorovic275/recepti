<?php 
	
	define("OFFSET", 3);


	function sviReceptiIKorisnici(){
		// return generickiUpit("SELECT * FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik LIMIT 3");
		// return generickiUpit("SELECT *, ROUND(AVG(g.ocena), 1) AS Prosecna FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik INNER JOIN glasanje g ON r.id_recept = g.id_recept GROUP BY g.id_recept");
		// return generickiUpit("SELECT r.*, k.username, s.* FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik INNER JOIN slika s ON r.id_slika = s.id_slika LIMIT 3");
		return generickiUpit("SELECT ROUND(AVG(g.ocena), 1) AS Prosecna, r.*, k.username, s.*, ka.naziv as nazivK FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik INNER JOIN slika s ON r.id_slika = s.id_slika INNER JOIN glasanje g ON r.id_recept = g.id_recept INNER JOIN kategorije ka ON r.id_kategorije = ka.id_kategorije GROUP BY r.id_recept LIMIT 3");
	}

	// function proveraRegularni($regularni, $zaProveru, $porukaGreska, $niz){
	// 	if(!preg_match($regularni, $zaProveru)){
	// 		$niz[] = $porukaGreska;
	// 	}
	// }

	function receptiLimit($limit){
		// return generickiUpit("SELECT r.*, k.username, s.* FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik INNER JOIN slika s ON r.id_slika = s.id_slika LIMIT $limit");
		return generickiUpit("SELECT ROUND(AVG(g.ocena), 1) AS Prosecna, r.*, k.username, s.*, ka.naziv as nazivK FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik INNER JOIN slika s ON r.id_slika = s.id_slika INNER JOIN glasanje g ON r.id_recept = g.id_recept INNER JOIN kategorije ka ON r.id_kategorije = ka.id_kategorije GROUP BY r.id_recept LIMIT $limit");
	}




	function receptiKorisnici(){
		return "SELECT ROUND(AVG(g.ocena), 1) AS Prosecna, r.*, k.username, s.* FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik INNER JOIN slika s ON r.id_slika = s.id_slika INNER JOIN glasanje g ON r.id_recept = g.id_recept";
	}



	function datumObrada($datum){
		$timestamp = strtotime($datum);
		return date("d-n-Y G:i", $timestamp);
	}


	function ocenaObrada($ocena){
		return $ocena == null ? "Nema" : $ocena;
	}



	function sviRecepti(){
		return generickiUpit(recepti());
	}


	function popularniRecepti(){
		return generickiUpit("SELECT r.*, AVG(g.ocena) as Prosecna, s.* FROM recept r INNER JOIN slika s ON r.id_slika = s.id_slika INNER JOIN glasanje g ON r.id_recept = g.id_recept GROUP BY r.id_recept ORDER BY AVG(g.ocena) DESC LIMIT 3");
	}



	function recepti(){
		return "SELECT * FROM recept r INNER JOIN slika s ON r.id_slika = s.id_slika";
	}


	function receptiSort(){
		return "SELECT * FROM recept r INNER JOIN slika s ON r.id_slika = s.id_slika INNER JOIN glasanje g ON r.id_recept = g.id_recept GROUP BY r.id_recept";
	}


	function kategorije(){
		return generickiUpit("SELECT * FROM kategorije");
	}


	function jedanRecept($idRecept){
		global $conn;
		$priprema = $conn->prepare("SELECT *, ROUND(AVG(g.ocena), 1) as Prosecna FROM recept r INNER JOIN korisnik k ON r.id_korisnik = k.id_korisnik INNER JOIN glasanje g ON r.id_recept = g.id_recept INNER JOIN slika s ON r.id_slika = s.id_slika WHERE r.id_recept = ?");
		$priprema->execute([$idRecept]);
		return $priprema->fetch();
		
	}



	function receptiIzKategorije($idRecept){
		global $conn;
		$priprema = $conn->prepare("SELECT * FROM recept r INNER JOIN slika s ON r.id_slika = s.id_slika WHERE id_recept != ? AND id_kategorije = (SELECT id_kategorije FROM recept WHERE id_recept = ?)");
		$priprema->execute([$idRecept, $idRecept]);
		return $priprema->fetchAll();
	}



	function glasKorisnik($idKorisnik){
		// mora da se proveri i za koji recept
		global $conn;
		$upit = "SELECT * FROM glasanje WHERE id_korisnik = ?";
		$priprema = $conn->prepare($upit);
		$priprema->execute([$idKorisnik]);
		return $priprema->rowCount();
	}



	function receptiSvi($limit = 0){
	    global $conn;
	    try{
	        $select = $conn->prepare("SELECT * FROM recept r INNER JOIN slika s ON r.id_slika = s.id_slika LIMIT :limit, :offset");
	        

	        $limit = ((int) $limit) * 3;
	        
	        $select->bindParam(":limit", $limit, PDO::PARAM_INT); 

	        $offset = 3;
	        $select->bindParam(":offset", $offset, PDO::PARAM_INT);

	        $select->execute(); 

	        $recepti = $select->fetchAll();

	        return $recepti;
	    }
	    catch(PDOException $ex){
	        return null;
	        zabeleziGreske($ex->getMessage());
	    }
	}











	function receptiBroj(){
		return generickiUpitRed("SELECT COUNT(*) as brojRecepti FROM recept");
	}



	function brojUPaginaciji(){
		$brojRecepti = receptiBroj()->brojRecepti;

		return ceil($brojRecepti / OFFSET);
	}









 ?>