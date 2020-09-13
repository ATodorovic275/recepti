<section id="kor_prikaz">
    <div class="container">
        <div class="row">
            <div id="linkovi_korisnik" class="col-lg-4 col-md-4 col-sm-4">
                <?php 
                        $idKorisnik = idKorisnika();                    
                ?>
                <a href="index.php?strana=korisnik.php&value=recept&id=<?=$idKorisnik?>" id="kor_nov_recept">Novi recept</a>
                <a href="index.php?strana=korisnik.php&value=select&id=<?=$idKorisnik?>">Moji recepti</a>
                <a href="index.php?strana=korisnik.php&value=edit&id=<?=$idKorisnik?>">Promeni podatke</a>
            </div>