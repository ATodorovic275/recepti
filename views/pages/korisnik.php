<?php 
    include "views/fixed/korisnik/sidebar.php";
    include "models/korisnici/functions.php";
    if(isset($_SESSION['greske'])){
        $greske = $_SESSION['greske'];
        foreach ($greske as $greska) {
            echo "<p>$greska</p>";
        }
        unset($_SESSION['greske']);
        unset($greske);

    }   
 ?>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div id="ispis_recepti_kor">
                    <?php 

                        if (isset($_GET['value'])) :
                            
                            if($_GET['value'] == 'edit'):

                    ?>
                    <?php 

                        $podaciKorisnika = korisnik($_GET['id']);

                     ?>
                            <form class="forma-prijava" >
                                <input type="hidden" name="hdn" id="hdn" value="<?=$podaciKorisnika->id_korisnik?>">
                                <label>Ime</label>
                                <input type="text" id="ime" value='<?=$podaciKorisnika->ime?>' name="ime" class="form-width">
                                <label>Prezime</label>
                                <input type="text" id="prezime" value='<?=$podaciKorisnika->prezime?>' name="prezime" class="form-width">
                                <label>Username</label>
                                <input type="text" id="username" value='<?=$podaciKorisnika->username?>' name="username" class="form-width">
                                <label>Email</label>
                                <input type="text" id="email" value='<?=$podaciKorisnika->email?>' name="email" class="form-width">
                                <label>Password</label>
                                <input type="text" id="pass" placeholder="Unesite novu sifru" name="pass" class="form-width">
                                <input type="button" name="promeni_podatke" id="promeni_podatke" value="Posalji" class='sub'>
                            </form>
                            <div id="ispis_gresaka"></div>

                            <?php 

                                endif;
                             ?>


                             <?php 

                                if($_GET['value'] == "select") :
                                $recepti = receptiKorisnika($_GET['id']);
                                // var_dump($recepti);
                                // ISPISATI DA NEMA RECEPATA
                                if(count($recepti) != 0) :
                                    foreach ($recepti as $recept) :
                              ?>


                            <div class="row padd">
                                <div class="col-lg-4 col-md-4">
                                    <img src="<?=$recept->mala?>" class="img-responsive">
                                </div>
                                <div class="col-lg-8 col-md-8 ">
                                    
                                    <p class="recept_opis"><?=$recept->opis?></p>
                                    <a id='editBtn' href="index.php?strana=korisnik.php&value=recept&id=<?=$idKorisnik?>&idRecept=<?=$recept->id_recept?>">Edit</a>
                                </div>

                            </div>

                            <?php
                                endforeach;
                                endif; 
                                if(count($recepti) == 0)
                                    echo '<h2>Nemate ni jedan recept</h2>';
                             ?>


                            <?php 
                                endif; // korisnik
                             ?>
                            

                            <?php 

                                // vrednost pri insertu recepta
                                $strana = "insertRecept.php";
                                $nameButton = "dodaj_recept"; 
                                $valueButton = "Dodaj";

                                if($_GET['value'] == "recept") :
                                $kategorije = kategorijeRecepta();
                                // var_dump($kategorije);

                                $vremena = vremenaPripreme();

                                if(isset($_GET['idRecept'])){
                                    $strana = "updateReceptKor.php";
                                    $nameButton = "update_recept";
                                    $valueButton = "Izmeni";


                                    $recept = recept($_GET['idRecept']);
                                    // var_dump($recept);
                                    // echo isset($recept);

                                }

                             ?>

                                <form method="post" action="models/recepti/<?=$strana?>" enctype="multipart/form-data">
                                    <input type="hidden" name="idRe" id="idRe" value="<?= isset($recept) ? $recept->id_recept : ""?>" /> 
                                    <input type="text" value="<?php echo isset($recept) ? $recept->naziv : ""?>"   name="naziv" id="naziv" placeholder="Naziv">
                                    <select name="kategorija">
                                        <option value="0">Kategorija</option>
                                        <?php 
                                            foreach ($kategorije as $kat) {
                                                if(isset($recept)){
                                                    if($kat->id_kategorije == $recept->id_kategorije){
                                                        echo "<option selected value='$kat->id_kategorije'>$kat->naziv</option>";
                                                    }
                                                    else
                                                        echo "<option value='$kat->id_kategorije'>$kat->naziv</option>";
                                                }
                                                else
                                                    echo "<option value='$kat->id_kategorije'>$kat->naziv</option>";
                                            }
                                         ?>
                                    </select>
                                    <select name="vreme">
                                        <option value="0">Vreme pripreme</option>
                                          <?php 
                                            foreach ($vremena as $vreme) {
                                                if (isset($recept)) {
                                                    if ($vreme->id_vreme_pripreme == $recept->id_vreme_pripreme) {
                                                        echo "<option selected value='$vreme->id_vreme_pripreme'>$vreme->vreme</option>";                                                       
                                                    }
                                                    else
                                                        echo "<option value='$vreme->id_vreme_pripreme'>$vreme->vreme</option>";

                                                }
                                                else
                                                  echo "<option value='$vreme->id_vreme_pripreme'>$vreme->vreme</option>";
                                            }
                                           ?>  
                                    </select><br>
                                    <span><label for="slika">Slika recepta</label></span>
                                    <input type="file" name="slika" id="slika">
                                    <textarea name="opis" placeholder="Opis recepta..." cols="40" rows="6"><?php echo isset($recept) ? $recept->opis : ""?></textarea>
                                    <input type="submit" name="<?=$nameButton?>" value="<?=$valueButton?>" class='sub'>                 
                                </form>

                             <?php 
                                endif; //recept
                              ?>

                     <?php 
                         endif; 
                         // glavni if 
                     ?>   
                </div>
            </div>
        </div>
    </div> 
</section> 