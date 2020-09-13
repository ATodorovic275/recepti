<?php 
	
 ?>

<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document" id="reg_ispis">
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

	</div>