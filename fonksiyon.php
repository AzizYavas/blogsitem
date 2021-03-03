<?php 

try {

    $db=new PDO("mysql:host=localhost;dbname=cvsitesi;charset=utf8","root","root");

}catch(PDOException $e) {

 echo "Bağlanamadı Hata Kodu : " . $e->getMessage() ;
}


class yonetim {

    public $normaltitle,$metatitle,$metadesc,$metakey,$metaout,$metaown,
    $metacopy,$logoyazi,$twit,$face,$ints,$mailadres,$film_baslik,
    $film_altbaslik;

    // bu kısım sayfa açıldığınad ve verileri kulllandığımızda ilk çalışn kod
        function __construct() {
    
            try {
    
                $db=new PDO("mysql:host=localhost;dbname=cvsitesi;charset=utf8","root","root");
            
            }catch(PDOException $e) {
            
             echo "Bağlanamadı Hata Kodu : " . $e->getMessage() ;
            }
            
            $ayarcek=$db->prepare("select * from ayarlar");
            $ayarcek->execute();
            $sorguson=$ayarcek->fetch();

            $introayar=$db->prepare("select * from intro");
            $introayar->execute();
            $introson=$introayar->fetch();

            $sonucresimyol=explode("/",$introson["resimyol"]);
    
            // köşeli parantez içindekiler databasedeki satır isimleri this den sonra gelende sayfalarda kullanıcamız değişkenler
            $this->normaltitle=$sorguson["title"];  
            $this->logoyazi=$sorguson["logoyazisi"];
            $this->twit=$sorguson["twit"];
            $this->face=$sorguson["face"];
            $this->ints=$sorguson["ints"];
            $this->mailadres=$sorguson["mailadres"];
            $this->baslikfilm=$sorguson["film_baslik"];
            $this->altbaslikfilm=$sorguson["film_altbaslik"];
            
        
        }
   

        function intro($introdb){

            $intro=$introdb->prepare("select * from intro");
            $intro->execute();
            $introsonuc=$intro->fetch(PDO::FETCH_ASSOC);

            $sonucresimyol=explode("/",$introsonuc["resimyol"]);
           
            ?>

            

        <header class="masthead" style="background-image: url(assets/img/<?php echo $sonucresimyol[3]; ?>); background-color: black; background-size: 1600px 1050px;">
            <div class="container">  
                <div class="masthead-subheading"><?php echo $introsonuc["yazi"]; ?></div>
                <div class="masthead-heading text-uppercase"><?php echo $introsonuc["yazi_alt"]; ?></div>
            </div>
        </header>



            <?php
        }

        function hakkimizda($hakkimizdadb){

            $hakkimizda=$hakkimizdadb->prepare("select * from hakkimizda");
            $hakkimizda->execute();
            $hakkimizdasonuc=$hakkimizda->fetch(PDO::FETCH_ASSOC);

            $sonucresimyol=explode("/",$hakkimizdasonuc["resim"]);

            ?>

                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $hakkimizdasonuc["baslik_ust"]; ?></h2>
                </div>
        
                <div class="team-member" style="text-align:center; background-size: contain; margin-bottom: 10px;"><img class="rounded-circle img-fluid" src="assets/img/about/<?php echo $sonucresimyol[4]; ?>" alt=""/></div>
                <div class="timeline-panel">
                    <div class="timeline-heading">
                        <h4 style="text-align: center; margin-top: 5px;" ><?php echo $hakkimizdasonuc["baslik"]; ?></h4>
                    </div>
                    <div style="text-align: center;"><p class="text-muted"><?php echo $hakkimizdasonuc["icerik"]; ?></p></div>
                </div>

                



            <?php
        }

        function dizifilmyeni($dizifilmdb){

            
            $dizifilm=$dizifilmdb->prepare("SELECT * FROM tavsiye ORDER BY id DESC LIMIT 6");
            $dizifilm->execute();

            while($sonucdizifilm=$dizifilm->fetch(PDO::FETCH_ASSOC)):

            ?>

                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="yazidetay.php?yazid=<?php echo $sonucdizifilm["id"]; ?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid"  src="assets/img/<?php $son=explode("/",$sonucdizifilm["yazi_resimyol"]); echo $son[3]; ?>" alt=""/> 
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"><?php echo $sonucdizifilm["yazi_ad"]; ?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $sonucdizifilm["yazi_tur"]; ?></div>
                                <div class="portfolio-caption-subheading text-muted"><b>IMDB</b> : <?php echo $sonucdizifilm["yazi_imdb"]; ?></div>
                                <div class="portfolio-caption-subheading text-muted"><b>PUANIM</b> : <?php echo $sonucdizifilm["yazi_benim"]; ?></div>
                            </div>
                        </div>
                    </div>

            <?php

        endwhile;

        }

        function dizifilmyenidetay($dizifilmdetaydb){

            $yazidetay=$dizifilmdetaydb->prepare("select * from tavsiye where id=".$_GET["yazid"]);
            $yazidetay->execute();
            $yazidetaysonuc=$yazidetay->fetch(PDO::FETCH_ASSOC);

            $resimdizifilm=explode("/",$yazidetaysonuc["yazi_resimyol"]);

            ?>

        <header class="masthead" style="background-image: url(assets/img/<?php echo $resimdizifilm[3]; ?>); background-color:black; background-position: 50% 50%; background-size: contain;">
            <div class="container">
                <div class="masthead-heading text-uppercase"><?php //echo $yazidetaysonuc["yazi_ad"]; ?></div> 
                <div class="masthead-subheading"><?php //echo $yazidetaysonuc["yazi_tur"]; ?></div>
            </div>
        </header>


        <section class="page-section">
            <div class="container">
                <div class="row">
                    
                <div class="col-lg-12">
                    <div class="modal-body">
                    <div class="text-center">
                        <h2 class="section-heading text-uppercase"><?php echo $yazidetaysonuc["yazi_ad"]; ?></h2>
                        <h3 class="section-subheading text-muted"><?php echo $yazidetaysonuc["yazi_tur"]; ?></h3>
                    </div>
                        <div style="text-align:center;">                  
                        <p>
                            <?php echo $yazidetaysonuc["yazi_icerik"];?>
                        </p>
                        </div>
                        <ul class="list-inline">
                            <b><li style="text-align: center;">
                                <p style="text-align: center;">İMDB PUANI</p>
                                <?php echo $yazidetaysonuc["yazi_imdb"];?>
                            </li></b>
                            <b><li style="text-align: center;">
                                <p style="text-align: center;">BENİM PUANIM</p>
                                <?php echo $yazidetaysonuc["yazi_benim"];?>
                            </li></b>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </section>
            
            <?php
        }

        function arsivimdizi($dizifilmdb){

    
            $dizifilm=$dizifilmdb->prepare("select * from tavsiye where yazidurum=2");
            $dizifilm->execute();

            while($sonucdizifilm=$dizifilm->fetch(PDO::FETCH_ASSOC)):

            ?>
    
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="yazidetay.php?yazid=<?php echo $sonucdizifilm["id"]; ?>">  
                            <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/<?php $son=explode("/",$sonucdizifilm["yazi_resimyol"]);  echo $son[3]; ?>" alt="" />
                            </a>
                            <div class="portfolio-caption">
                                <a href="yazidetay.php?yazid=<?php echo $sonucdizifilm["id"]; ?>"><div class="portfolio-caption-heading"><?php echo $sonucdizifilm["yazi_ad"]; ?></div></a>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $sonucdizifilm["yazi_tur"]; ?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $sonucdizifilm["yazi_imdb"]; ?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $sonucdizifilm["yazi_benim"]; ?></div>
                            </div>
                        </div>
                    </div>
            <?php

        endwhile;

        }

        function arsivimfilm($dizifilmdb){


            $dizifilm=$dizifilmdb->prepare("select * from tavsiye where yazidurum=1");
            $dizifilm->execute();

            while($sonucdizifilm=$dizifilm->fetch(PDO::FETCH_ASSOC)):

            ?>
    
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" href="yazidetay.php?yazid=<?php echo $sonucdizifilm["id"]; ?>">  
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/<?php $son=explode("/",$sonucdizifilm["yazi_resimyol"]); echo $son[3]; ?>" alt="" />
                            </a>
                            <div class="portfolio-caption">
                                <a href="yazidetay.php?yazid=<?php echo $sonucdizifilm["id"]; ?>"><div class="portfolio-caption-heading"><?php echo $sonucdizifilm["yazi_ad"]; ?></div></a>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $sonucdizifilm["yazi_tur"]; ?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $sonucdizifilm["yazi_imdb"]; ?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $sonucdizifilm["yazi_benim"]; ?></div>
                            </div>
                        </div>
                    </div>
            <?php

        endwhile;

        }


       

        




}






?>