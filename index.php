
<?php 

include_once 'fonksiyon.php';

$yonetim = new yonetim();


?>

<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="<?php echo $yonetim->metaout; ?>" />
        <title><?php echo $yonetim->normaltitle; ?></title>
        <link rel="icon" type="image/x-icon"  href="assets/img/favicon.ico"/>
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php#page-top"><?php echo $yonetim->logoyazi; ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#about">Hakkımda</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#portfolio">Yeni Tavsiyeler</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="arsiv.php">Film Arşivim</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php#iletisim">İletişim</a></li>

                    </ul>

                    
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        
        <?php $yonetim->intro($db); ?>

        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                   
            <?php $yonetim->hakkimizda($db); ?>

            <div class="col-lg-12" style="text-align: center;">

                <h3>SOSYAL MEDYA</h3>

                <a class="btn btn-dark btn-social mx-2" href="<?php echo $yonetim->ints; ?>"><i class="fab fa-instagram"></i></a>

            </div>

            </div>

        </section>
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $yonetim->baslikfilm; ?></h2>
                    <h3 class="section-subheading text-muted"><?php echo $yonetim->altbaslikfilm; ?></h3>
                </div>
                <div class="row">
                    
                <?php $yonetim->dizifilmyeni($db); ?>

                </div>
            </div>
        </section>

        <!-- İLETİŞİM -->

        <section class="page-section" id="iletisim">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">İLETİŞİM</h2>
                </div>        
               
            <div class="col-lg-12" style="text-align: center;">

            <h4>Mail : uazizyavas@gmail.com</h4>
                <br>
            <div class="text-center">
                <div id="success"></div>
                    <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">MAİL GÖNDER</button>
                </div>
            </div>


            </div>
            </section>

       
        <!-- Footer-->
        <footer class="footer py-4" id="son">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12 my-3 my-lg-0">
                    <div class="col-lg-12 text-lg-center">Copyright © Your Website 2020</div>
                        
                    </div>
                </div>
            </div>
        </footer>
       
        
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <!-- Contact form JS-->
        <script src="assets/mail/jqBootstrapValidation.js"></script>
        <script src="assets/mail/contact_me.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
