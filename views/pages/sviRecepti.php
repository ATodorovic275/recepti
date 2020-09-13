<div class="container svi_recepti">
	<div class="row">
		<div class="col-lg-4 col-md-4 filter">
			<div class="select">
				
			  <select id="kategorije" class="test" name='make'>
			    <option>Kategorije</option>
			    <?php 
			  		include "models/recepti/functions.php";

			  		$kategorije = kategorije();
			  		// var_dump($kategorije);
			  		foreach ($kategorije as $kat) {
			  			echo "<option value='$kat->id_kategorije'>$kat->naziv</option>";
			  		}
			  	 ?>
			  </select>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 filter">
			<div class="select">
			  <select id="sort" class="test" name='make'>
			    <option value='0'>Sortiraj</option>
			    <option value='1'>Datum rastuce</option>
			    <option value='2'>Datum opadajuce</option>
			    <option value='3'>Ocena rastuce</option>
			    <option value='4'>Ocena opadajuce</option>
			    
			  </select>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 filter">
			<div class="pretraga">
				<form action="#" method="post">
				<input type="search" id="search2" name="Search" placeholder="Pretrazite recepte" required="">
								
				</form>
			</div>
		</div>
	</div>
	<div id='recepti2' class="row">
		<?php 

            $limit =  isset($_GET['limit'])? $_GET['limit'] : 0;		
			$recepti = receptiSvi($limit);
			// var_dump($recepti);

			foreach ($recepti as $recept) :
		 ?>
		<div class="col-lg-4 col-md-4">
			<a href='index.php?strana=recept.php&id=<?=$recept->id_recept?>'>
				<div class="recept">
					<img src="<?=$recept->velika?>" class="img-responsive">
					<h3><?=$recept->naziv?></h3>
					<p><?=$recept->opis?></p>
				</div>
			</a>
		</div>

		<?php endforeach; ?>
	</div>
	<div id="paginacija">
		<div class="container">
			<ul class="pagination">
				<?php 

					$broj = brojUPaginaciji();
					// var_dump($broj);
					// echo $broj;
					for($i = 0; $i < $broj; $i++):
				 ?>

				 <!-- <li><a href="#">1</a></li> -->
				 <li><a href="#" class="paginacija" data-limit="<?= $i ?>"><?= $i+1 ?></a></li>

				<?php endfor; ?>
				<!-- 
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li> -->
			</ul>
		</div>
	</div>
</div>