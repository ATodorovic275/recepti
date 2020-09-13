jQuery(document).ready(function($) {
	
	// $("#registracija1").click(registracijaIspis)
	// $("#registracija").on('click', registracijaIspis);

	$(document).on('click', '#registracija1', registracijaIspis);


	// console.log(url)


	// ispis korisnika dugme
	$("#korisnici").click(korisniciZahtev)

	// ispis svih recepata dugme
	$("#recepti").click(receptiPodaci)

	// ispis namirnica dugme
	$("#namirnice").click(kategorijePodaci)

	// za html stranu, pogledaj da sredis
	// nije potrebno
	$("#prijavaBtn").click(prijavaSlanje)


	// modal izlaz
	$("#izlaz").click(function(){
		location.reload();
	})
	




	// KORISNICI

	// $("#kor_nov_recept").click(receptiInsertFormaKorisnik);


	// edit korisnickog naloga
	$("#promeni_podatke").click(proveraEditKorisnik);




	// filtriranje dugme
	$("#search").keyup(filtriranje)



	// filtriranje po kategoriji
	$("#kategorije").change(filtriranjeKategorije)


	// filtriranje naziv
	$("#search2").keyup(filtriranjeNaziv)


	// sortiranje
	$("#sort").change(sortiranje)



	// glasanje
	$("#glasanjeBtn").click(function(e){
		e.preventDefault()

		$("#glasanje").css({
			display: 'block'
		});
	})



	$("#glasPosalji").click(glasanje)



	// ucitavanje
	$(document).on('click', '#jos_recept', ucitavanjeRecepata);


	$(".paginacija").click(paginacija)

});






function registracijaIspis (e) {
	e.preventDefault()

	let ispis = `
		<div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Registracija</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form class="forma-prijava">
				<label>Ime</label>
				<input type="text" id="ime" name="ime" class="form-width">
				<label>Prezime</label>
				<input type="text" id="prezime" name="prezime" class="form-width">
				<label>Username</label>
				<input type="text" id="username" name="username" class="form-width">
				<label>Email</label>
				<input type="text" id="email" name="email" class="form-width">
				<label>Password</label>
				<input type="text" id="pass" name="pass" class="form-width">
			</form>
	        	<a href="#" id="prijava" data-toggle="modal" data-target="#exampleModal2">Prijava</a>

	      </div>
	      <div id='ispis_gresaka'>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
	        <button id='registracijaBtn' type="button" class="btn btn-primary prijava_btn">Registracija</button>
	      </div>
	    </div>
	`


	$("#reg_ispis").html(ispis)

	$("#prijava").click(prijavaIspis)

	$("#registracijaBtn").click(registracijaProvera);

}



function prijavaIspis (e) {
	e.preventDefault()

	let ispis = `
		<div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Prijava</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	        <form class="forma-prijava">
	      <div class="modal-body">
	        	<label for="email">Email</label>
	        	<input type="text" id="email_prijava" name="email" class="form-width">
	        	<label for="sifra">Password</label>
	        	<input type="text" id="sifra_prijava" name="sifra" class="form-width">
	        
	        	<a href="#" id="registracija1" data-toggle="modal" data-target="#exampleModal2">Nemate nalog</a>	        
	      </div>
	      <div id='ispis_gresaka_prijava'>

	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
	        <button type="button" id='prijavaBtn' name='prijava' class="btn btn-primary prijava_btn">Prijava</button>
	      </div>
	    </div>
	  </div>
	   </form>
	` 

	$(".modal-dialog").html(ispis)

	// $("#registracija").click(registracijaIspis)


	// nije potrebno proveravace se samo u bazi
	$("#prijavaBtn").click(prijavaSlanje)

}




// ---------------------------ADMIN.PHP--------------------------------------





	// ispis svih korisnika
	function korisniciZahtev (e) {

		e.preventDefault()
		
		ajax("models/korisnici/getAllKorisnik.php", 
			function(data, statusText, xhr){
			korisniciIspis(data)
		})
	}




	function korisniciIspis (data) {
		let ispis = `
				<h2>Korisnici</h2>
				<a href="#" id='noviKorisnik' class='btnBoja'>Novi korisnik</a>

				<!-- tabela prikaza -->
				<table>
					<tr>
						<th>ID</th>
						<th>IME</th>
						<th>PREZIME</th>
						<th>EMAIL</th>
						<th>USERNAME</th>
						<th>ID ULOGA</th>
						<th>Obrisi</th>
					</tr>`
				
		data.forEach( function(korisnik) {
			ispis += `
				<tr>
					<td>${korisnik.id_korisnik}</td>
					<td>${korisnik.ime}</td>
					<td>${korisnik.prezime}</td>
					<td>${korisnik.email}</td>
					<td>${korisnik.username}</td>
					<td>${uloga(korisnik.id_uloga)}</td>
					<td><a href='#' class='del_korisnik' data-id='${korisnik.id_korisnik}'><i class="fa fa-trash" aria-hidden="true"></i></a></td>			
				</tr>`

			
		});
		
		ispis += "</table>"

		$("#ispis").html(ispis)

		$(".del_korisnik").click(deleteKorisnik)

		$("#noviKorisnik").click(korisnikForma)
	}





	function uloga (data) {		
		return data == 1 ? "Admin" : "Korisnik";
	}









	// DODAVANJE KORISNIAK


	function korisnikForma(e){

		e.preventDefault()



		// uloge
		ajax("models/admin/ulogeKorisnika.php", 
			function(data, statusText, xhr){
				ispisFormeKorisnika(data)
			})


		
	}





	function ispisFormeKorisnika(data){
		let ispis = `
			<h3 id='dodKor'>Dodaj korisnika</h3>
			<form>
			    <label>Ime</label>
			    <input type="text" id="ime" name="ime" >
			    <label>Prezime</label>
			    <input type="text" id="prezime" name="prezime" >
			    <label>Username</label>
			    <input type="text" id="username" name="username" >
			    <label>Email</label>
			    <input type="text" id="email"  name="email" >
			    <label>Password</label>
			    <input type="text" id="pass" placeholder="Unesite sifru" name="pass" >	    
			    <select id='uloga' class='test'>`
			    data.forEach( function(ele) {
			    	ispis += `<option value='${ele.id_uloga}'>${ele.naziv}</option>`
			    });

			    ispis += `</select><input type="button" name="dodaj_korisnika" class='sub' id="dodaj_korisnika" value="Dodaj"></form>`
			    ispis += `<div id='ispis_gresaka' class='greske_admin'></div>`
		$("#ispis").html(ispis)

		$("#dodaj_korisnika").click(proveraDodavanjeKorisnika)
	}





	function proveraDodavanjeKorisnika(){
		let ime = $("#ime").val();
		let prezime = $("#prezime").val();
		let username = $("#username").val();
		let email = $("#email").val();
		let password = $("#pass").val();
		let uloga = $("#uloga").val()
		// console.log(email)

		// regularni izrazi
		let imeRi = /^[A-Z][a-z]+$/
		let usernameRi = /^[a-z]\w+$/ 
		let emailRi = /^[a-z]\w+([#$%^&*!?]?\w)*@(gmail|hotmail|yahoo)\.com$/
		let passwordRi = /^[\w?@#$%^&*]{6,20}$/


		let greske = [];




		proveraRegularni(imeRi, ime, "dobro ime", "Ime nije u dobrom formatu",greske)

		proveraRegularni(imeRi, prezime, "dobro prezime", "Prezime nije u dobrom formatu",greske)

		proveraRegularni(usernameRi, username, "username ok", "Username nije u dobrom formatu",greske)

		proveraRegularni(emailRi, email, "dobro email", "Email nije u dobrom formatu",greske)

		proveraRegularni(passwordRi, password, "dobro password", "Password nije u dobrom formatu",greske)

	


		if(greske.length > 0){
			ispisGresaka(greske)	
			// alert(greske)
		}
		else{
			// slanje podataka serveru na obradu
			ajaxSaParametrima("models/admin/insertKorisnik.php",
				{ime: ime, prezime: prezime, username: username, email: email, password: password, uloga:uloga, poslato: true},
				function (data, statusText, xhr) {				
					$("#ispis_odgovor").html(xhr.responseJSON.poruka)
					$("#response").modal("show")
				})
		}






	}
































	function deleteKorisnik(e){

		e.preventDefault()

		let idKorisnik = $(this).data("id")
		console.log(idKorisnik)
		ajaxSaParametrima("models/admin/deleteKorisnik.php", {id: idKorisnik}, 
			function(data, statusText, xhr){
				sviKorisnici()
			})
	}






	function sviKorisnici(){

		ajax("models/korisnici/getAllKorisnik.php", 
			function(data, statusText, xhr){
				korisniciIspis(data)
				brojKorisnika(data)
			})
	}





	function brojKorisnika(){
		ajax("models/admin/brojKorisnika.php", 
			function(data, statusText, xhr){
				$("#brojKorisnika").html(data.brojKorisnika)
			})
	}









// PODACI ZA ISPIS RECEPATA

	function receptiPodaci (e) {

		e.preventDefault()

		ajax("models/admin/sviProizvodi.php", function (data, statusText, xhr) {
			receptiIspis(data)
			
		})


	}










	// ispis svih recepata
	function receptiIspis (recepti) {

		// e.preventDefault()

		let ispis = `
			<h2>Recepti</h2>
			<a href='models/admin/excelExport.php' class='btnBoja'>Izvezi u excel</a>

			<!-- tabela prikaza -->
			<div id='forma'>
				<table>
					<tr>
						<th>id</th>
						<th>naziv</th>
						<th>opis</th>
						<th>datum postavljanja</th>
						<th>korisnik</th>
						<th>vreme pripreme</th>		
						<th>kategorija</th>		
						<th>brisanje</th>														

					</tr>`


		recepti.forEach( function(rec) {
			ispis += `

				<tr>
					<td>${rec.id_recept}</td>
					<td>${rec.naziv}</td>
					<td><div class='tekstRecept'>${rec.opis}</div></td>
					<td>${rec.datum_postavljanja}</td>
					<td>${rec.korisnik}</td>
					<td>${rec.vremePripreme} minuta</td>
					<td>${rec.kategorija}</td>
					<td><a href='#' class='del_recept' data-id='${rec.id_recept}'><i class="fa fa-trash" aria-hidden="true"></i></a></td>

				</tr>


			`
		});

		ispis +=`</table></div>`

		$("#ispis").html(ispis)

		// $("#novi_recept").click(receptiInsertForma)

		$(".del_recept").click(deleteRecepti)
	}




	function deleteRecepti(e){

		e.preventDefault()

		let idRecept = $(this).data("id")

		ajaxSaParametrima("models/admin/deleteRecept.php", {id: idRecept},
			function(data, statusText, xhr){
				sviRecepti()
				brojRecepti()
			})
	}	





	function sviRecepti(){
		ajax("models/admin/sviProizvodi.php",
			function(data, statusText, xhr){
				receptiIspis(data)
			})
	}






	function brojRecepti(){
		ajax("models/admin/brojRecepti.php", 
			function(data, statusText, xhr){
				$("#brojRecepti").html(data.brojRecepti)
			})
	}







	function kategorijePodaci(e){

		e.preventDefault()

		ajax("models/admin/sveKategorije.php",
			function(data, statusText, xhr){
				ispisKategorija(data)
			})

	}





	function kategorijePodaci2(e){

		// e.preventDefault()

		ajax("models/admin/sveKategorije.php",
			function(data, statusText, xhr){
				ispisKategorija(data)
			})

	}





	function ispisKategorija(kategorije){
		

		let ispis =`
			<h2>Kategorije</h2>
				
			<div class="row">
				<div class="col-lg-6">
					<div id='forma'>
						<table>
							<tr>
								<th>id</th>
								<th>naziv</th>
								<th>edit</th>							
								<th>obrisi</th>							

							</tr>				
						
				

		`
		kategorije.forEach( function(kat) {
			ispis += `
				<tr>
					<td>${kat.id_kategorije}</td>
					<td>${kat.naziv}</td>
					<td><a href='#' class='edit_kat' data-id='${kat.id_kategorije}'><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
					<td><a href='#' class='delete_kat' data-id='${kat.id_kategorije}'><i class="fa fa-trash" aria-hidden="true"></a></td>
				</tr>`
		});

		ispis += `</table>
					</div>
				</div>`

		ispis +=`
			<div class="col-lg-6 forma_kat">
			<h3 id='naslovForme'>Dodaj kategoriju</h3>
			<form id='novaKat'>
				<input type='hidden' id='hdn' name='hdn'/>
				<input type="text" name="nazivKat" id="nazivKat" placeholder="Naziv">
				<input type="button" id='dodaj_kategoriju' name="dodaj_kategoriju" value="Dodaj" class='sub'>					
			</form>
		</div></div>`

		


		$("#ispis").html(ispis);

		$("#dodaj_kategoriju").click(insertKategorije)

		$(".edit_kat").click(jednaKategorija)

		$(".delete_kat").click(deleteKategorije)

	}





	function insertKategorije(){

		let idHdn = $("#hdn").val()
		let nazivKat = $("#nazivKat").val()

		if(idHdn == ""){

			ajaxSaParametrima("models/admin/insertKategorija.php", {naziv: nazivKat},
				function(data, statusText, xhr){
					kategorijePodaci2()
				})

		}
		else{
			// edit
			// console.log(idHdn)
			ajaxSaParametrima("models/admin/editKategorija.php", {id: idHdn, naziv: nazivKat},
				function(data, statusText, xhr){
					kategorijePodaci2()
				})

		}
		


	}





	function deleteKategorije(e){
		e.preventDefault()

		let idHdn = $(this).data('id')

		ajaxSaParametrima("models/admin/deleteKategorije.php", {id: idHdn},
			function(data, statusText, xhr){
				kategorijePodaci2()
				brojKategorija()
			})
	}





	function brojKategorija(){
		ajax("models/admin/brojKategorija.php", 
			function(data, statusText, xhr){
				$("#brojKategorija").html(data.brojKategorija)
			})
	}








	function jednaKategorija(e){
		e.preventDefault()

		let id = $(this).data("id")

		ajaxSaParametrima("models/admin/jednaKategorija.php", {id: id}, 
			function(data, statusText, xhr){
				popuniFormu(data)
			})

	}





	function popuniFormu (data) {
		$("#hdn").val(data.id_kategorije)
		$("#nazivKat").val(data.naziv);
		$("#naslovForme").html("Izmeni kategoriju")
	}











	// ispis namirnica
	function namirniceIspis (e) {

		e.preventDefault()

		let ispis = `
			<h2>Kategorije</h2>
			<a href="#" id="nova_namirnica">Nova namirnica</a>	

			<div id='forma'>
				<table>
					<tr>
						<th>id</th>
						<th>naziv</th>							
					</tr>				
				</table>
			</div>`


		$("#ispis").html(ispis)

		// forma za namirnice dugme
		$("#nova_namirnica").click(namirniceInsertForma)

	}



	// forma za namirnice
	function namirniceInsertForma (e) {

		e.preventDefault()

		let ispis = `
			<form>
				<input type="text" name="naziv" id="naziv" placeholder="Naziv">
				<input type="text" name="nutritivna" id="nutritivna" placeholder="Nutritivna vrednost">
				<span><label for="slika">Slika namirnice</label></span>
				<input type="file" name="slika" id="slika">
				<textarea placeholder="Opis namirnice..." cols="40" rows="6"></textarea>
				<input type="submit" name="dodaj_recept" value="Dodaj" class='sub'>					
			</form>`

		$("#forma").html(ispis)
	}


















//end






// REGISTRACIJA


function registracijaProvera () {
	
	// dohvatanje podataka iz forme	
	let ime = $("#ime").val();
	let prezime = $("#prezime").val();
	let username = $("#username").val();
	let email = $("#email").val();
	let password = $("#pass").val();

	// console.log(email)

	// regularni izrazi
	let imeRi = /^[A-Z][a-z]+$/
	let usernameRi = /^[a-z]\w+$/ 
	let emailRi = /^[a-z]\w+([#$%^&*!?]?\w)*@(gmail|hotmail|yahoo)\.com$/
	let passwordRi = /^[\w?@#$%^&*]{6,20}$/


	let greske = [];




	proveraRegularni(imeRi, ime, "dobro ime", "Ime nije u dobrom formatu",greske)

	proveraRegularni(imeRi, prezime, "dobro prezime", "Prezime nije u dobrom formatu",greske)

	proveraRegularni(usernameRi, username, "username ok", "Username nije u dobrom formatu",greske)

	proveraRegularni(emailRi, email, "dobro email", "Email nije u dobrom formatu",greske)

	proveraRegularni(passwordRi, password, "dobro password", "Password nije u dobrom formatu",greske)


	// console.log(greske)



	if(greske.length > 0){
		ispisGresaka(greske)		
	}
	else{
		

			$.ajax({
				url: "models/korisnici/registracija.php",
				method: "post",
				dataType: "json",
				data: {
					ime: ime,
					prezime: prezime,
					username: username,
					email: email,
					password: password,
					poslato: true		
				},
				success: function (data, statusText, xhr) {
					console.log(data);
					console.log(statusText);
					console.log(xhr);
					$("#ispis_odgovor").html(xhr.responseJSON.poruka)
					$("#response").modal("show")
					
				},
				error: function (xhr, statusText, err) {
					console.log(xhr);
					console.log(statusText);
					console.log(err);
					ispisGresaka(xhr.responseJSON)
				}
			})



	}
	



}





function proveraEditKorisnik () {

	// dohvatanje podataka iz forme	
	let ime = $("#ime").val();
	let prezime = $("#prezime").val();
	let username = $("#username").val();
	let email = $("#email").val();
	let password = $("#pass").val();
	let id = $("#hdn").val()

	// console.log(email)

	// regularni izrazi
	let imeRi = /^[A-Z][a-z]+$/
	let usernameRi = /^[a-z]\w+$/ 
	let emailRi = /^[a-z]\w+([#$%^&*!?]?\w)*@(gmail|hotmail|yahoo)\.com$/
	let passwordRi = /^[\w?@#$%^&*]{6,20}$/


	let greske = [];




	proveraRegularni(imeRi, ime, "dobro ime", "Ime nije u dobrom formatu",greske)

	proveraRegularni(imeRi, prezime, "dobro prezime", "Prezime nije u dobrom formatu",greske)

	proveraRegularni(usernameRi, username, "username ok", "Username nije u dobrom formatu",greske)

	proveraRegularni(emailRi, email, "dobro email", "Email nije u dobrom formatu",greske)

	proveraRegularni(passwordRi, password, "dobro password", "Password nije u dobrom formatu",greske)



	if(greske.length > 0){
		ispisGresaka(greske)		
	}
	else{
		

		$.ajax({
			url: "models/korisnici/editKorisnik.php",
			method: "post",
			dataType: "json",
			data: {
				ime: ime,
				prezime: prezime,
				username: username,
				email: email,
				password: password,
				id: id,
				poslato: true		
			},
			success: function (data, statusText, xhr) {
				console.log(data);
				console.log(statusText);
				console.log(xhr);
				$("#ispis_odgovor").html(xhr.responseJSON.poruka)
				$("#response").modal("show")
				
			},
			error: function (xhr, statusText, err) {
				console.log(xhr);
				console.log(statusText);
				console.log(err);
				ispisGresaka(xhr.responseJSON)
			}
		})
		
	}
	




	// ispis gresaka
	
}



function ispisGresaka (greske) {
		// console.log(lokacija)
		let ispis = "<ul>"
		greske.forEach( function(greska) {
			ispis += `

				<li>${greska}</li>

			`
		});

		ispis += "</ul>"

		$("#ispis_gresaka").html(ispis)
	}




function prijavaSlanje () {
	 

	ajaxSaParametrima("models/korisnici/login.php", 
		{email: $("#email_prijava").val(), password: $("#sifra_prijava").val(), poslato: true},
		function (data, statusText, xhr) {
			window.location.replace("index.php");
			
		})


}




// funkcija za proveru regularnim izrazima
function proveraRegularni(regularni, zaProveru, porukaDobro, porukaGreska, niz){
	if(!regularni.test(zaProveru)){
		niz.push(porukaGreska);
		console.log(porukaGreska)
	}
	else{
		console.log(porukaDobro)
	}
}








// FILTRIRANJE RECEPATA
function filtriranje (argument) {
	
	let unetaVrednost = $(this).val()
	console.log(unetaVrednost)


	ajaxSaParametrima("models/recepti/filtriranje.php", 
		{vrednost: unetaVrednost}, 
		function (data, statusText, xhr) {
			ispisRecepti(data)

		})


}







function ispisRecepti(recepti){
	let ispis = ""



	recepti.forEach( function(recept) {




		ispis += `

		<div class="wthree-top">				
			<div class="w3agile-top">
				<div class="w3agile_special_deals_grid_left_grid">
					<a href="index.php?strana=recept.php&id=${recept.id_recept}"><img src="${recept.velika}" class="img-responsive" alt="${recept.velika_alt}"></a>
				</div>
				<div class="w3agile-middle">
					<ul>
						<li><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i>${obradaDatuma(recept.datum_postavljanja)}</a></li>
						<li><a href="#"><i class="fa fa-thumbs-up" aria-hidden="true"></i>${obradaOcene(recept.Prosecna)}</a></li>
						<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i>${recept.username}</a></li>
						
					</ul>
				</div>
			</div>
			
			<div class="w3agile-bottom">
				<div class="col-md-3 w3agile-left">
					<h5>${recept.nazivK}</h5>
				</div>
				<div class="col-md-9 w3agile-right">
					<h3><a href="singlepage.html">${recept.naziv}</a></h3>
					<p>${recept.opis}</p>
					<a name="read_more" class="agileits w3layouts" href="index.php?strana=recept.php&id=${recept.id_recept}">Read More <span class="glyphicon agileits w3layouts glyphicon-arrow-right" aria-hidden="true"></span></a>
				</div>
					<div class="clearfix"></div>
			</div>
		</div>`
		

	});

	ispis += `
		<div id="jos">
			 <a id='jos_recept' href="">Jos recepata</a>		 	
		</div>`


	$(".btm-wthree-left").html(ispis)
}




function obradaDatuma(stariDatum){
	let datum = new Date(stariDatum);
	return  datum.getDate() + "-" + (datum.getMonth()+1) + "-" + datum.getFullYear() + " " + datum.getHours() + ":" + datum.getMinutes()
}

function obradaOcene(ocena){;
	if(ocena == null){
		return 0
	}
	else
		return ocena;
}



// ----------------------STRANICA RECEPTI.PHP------------------------


// filtriranje po kategoriji
function filtriranjeKategorije () {
	
	let kategorija = $(this).val()

	ajaxSaParametrima("models/recepti/filtriranjeKategorije.php", 
		{kategorija: kategorija},
		function (data, statusText, xhr) {
			ispisReceptiSvi(data)
			// $("#ispis_odgovor").html(xhr.responseJSON.poruka)
			// $("#response").modal("show")
			// alert(xhr.responseJSON.poruka)		
		})


	

}





function ispisReceptiSvi(recepti){
	let ispis = "";
	recepti.forEach( function(rec) {
		ispis += `
		<div class="col-lg-4 col-md-4 ">
			<a href="index.php?strana=recept.php&id=${rec.id_recept}" class="">
				<div class="recept">
					<img src="${rec.velika}" class="img-responsive">
					<h3>${rec.naziv}</h3>
					<p>${rec.opis}</p>
				</div>
			</a>	
		</div>`
	});

	$("#recepti2").html(ispis)
}







function filtriranjeNaziv(){
	let unetaVrednost = $(this).val()
	console.log(unetaVrednost)

	ajaxSaParametrima("models/recepti/filtriranje.php",
		{vrednost: unetaVrednost},
	 	function (data, statusText, xhr) {
			ispisReceptiSvi(data)
			// $("#ispis_odgovor").html(xhr.responseJSON.poruka)
			// $("#response").modal("show")
			// alert(xhr.responseJSON.poruka)
			
		})


	
}





function sortiranje(){

	let vrednost = $(this).val()

	ajaxSaParametrima("models/recepti/sortiranje.php", 
		{vrednost: vrednost},
		function (data, statusText, xhr) {
			ispisReceptiSvi(data)
			// $("#ispis_odgovor").html(xhr.responseJSON.poruka)
			// $("#response").modal("show")
			// alert(xhr.responseJSON.poruka)
			
		})	

	
}





// glasanje


function glasanje(){
	let radioBtns = document.getElementsByName("btnRadio")
	let cekirani

	radioBtns.forEach( function(rad) {
		if (rad.checked) {
			cekirani = rad.value;
		}

	});


	var url = window.location.href
	var split = url.split("=");

	let idRecept = split[split.length-1]


	ajaxSaParametrima("models/recepti/glasanje.php",
		{cekirani: cekirani.toString(),idRecept: idRecept},
		function (data, statusText, xhr) {
			$("#ispis_odgovor").html(xhr.responseJSON.poruka)
			$("#response").modal("show")
			// alert(xhr.responseJSON.poruka)
			
		})


}







// ucitavanje jos recapata
var broj = 3
console.log(broj)
function ucitavanjeRecepata(e){
	e.preventDefault()
	console.log(broj);

	ajaxSaParametrima("models/recepti/ucitavanjeRecepta.php", 
		{broj: broj = broj + 3},
		function (data, statusText, xhr) {
			ispisRecepti(data)	
		})


}









// paginacija




function paginacija(e){
	e.preventDefault()

	let limit = $(this).data("limit");
	console.log(limit)
   	ajaxSaParametrima("models/recepti/paginacija.php", {limit: limit},
	   	function (data, statusText, xhr) {
			ispisReceptiSvi(data)
		})

}














// ------------------------GENERICKE FUNKCIJE------------------------------


function ajax(url, funkcija){
	$.ajax({
		url: url,
		method: "post",
		dataType: "json",
		success: funkcija,
		error: function (xhr, statusText, err) {
			$("#ispis_odgovor").html(xhr.responseJSON.poruka)
			$("#response").modal("show")	
		}
	})
}




function ajaxSaParametrima(url, podaci, funkcija){
	$.ajax({
		url: url,
		method: "post",
		dataType: "json",
		data: podaci,
		success: funkcija,
		error: function (xhr, statusText, err) {
			$("#ispis_odgovor").html(xhr.responseJSON.poruka)
			$("#response").modal("show")	
		}
	})
}