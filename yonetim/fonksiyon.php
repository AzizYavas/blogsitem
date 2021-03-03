
<?php


try {

$db=new PDO("mysql:host=localhost;dbname=cvsitesi;charset=utf8","root","root");

}catch(PDOException $e) {

echo "Bağlanamadı Hata Kodu : " . $e->getMessage();
}

class blog {


    function siteayar($siteayardb){

        if($_POST):

            $title=$_POST["title"];
            $metatitle=$_POST["metatitle"];
            $logoyazisi=$_POST["logoyazisi"];
            $twit=$_POST["twit"];
            $face=$_POST["face"];
            $ints=$_POST["ints"];
            $mailadres=$_POST["mailadres"];
            $film_baslik=$_POST["film_baslik"];
            $film_altbaslik=$_POST["film_altbaslik"];
            $kaytid=$_POST["kaytid"];
            

            if(empty($title) || empty($metatitle) || empty($logoyazisi) || empty($twit) || empty($face) || empty($ints) || empty($mailadres) || empty($film_baslik) || empty($film_altbaslik)):

                    echo '<div class="alert alert-danger">HİÇ BİR YER BOŞ OLAMAZ !!</div>';
                    header("refresh:2,url=control.php");

            else:

                $siteayar=$siteayardb->prepare("update ayarlar set 
                title=:title,
                metatitle=:metatitle,
                logoyazisi=:logoyazisi,
                twit=:twit,
                face=:face,
                ints=:ints,
                mailadres=:mailadres,
                film_baslik=:film_baslik,
                film_altbaslik=:film_altbaslik where id=:id");

                $siteayar->bindParam(":title",$title);
                $siteayar->bindParam(":metatitle",$metatitle);
                $siteayar->bindParam(":logoyazisi",$logoyazisi);
                $siteayar->bindParam(":twit",$twit);
                $siteayar->bindParam(":face",$face);
                $siteayar->bindParam(":ints",$ints);
                $siteayar->bindParam(":mailadres",$mailadres);
                $siteayar->bindParam(":film_baslik",$film_baslik);
                $siteayar->bindParam(":film_altbaslik",$film_altbaslik);
                $siteayar->bindParam(":id",$kaytid);

                if($siteayar->execute()):

                    echo '<div class="alert alert-success">VERİLER BAŞARIYLA GÜNCELLENDİ</div>';
                    header("refresh:2,url=control.php");

                else:

                    echo '<div class="alert alert-danger">GÜNCELLENMEDİ !!!</div>';
                    header("refresh:2,url=control.php");

                    

                endif;
                    
            endif;

        else:

            $siteayarcek=$siteayardb->prepare("select * from ayarlar");
            $siteayarcek->execute();

            $siteayarsonuc=$siteayarcek->fetch(PDO::FETCH_ASSOC);

            ?>
<br> 
    <div class="col-xl-10 col-lg-10">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <h1 class="h3 mb-2 text-gray-800">SİTE AYARLAR</h1>
   
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-8">
                <form role="form" action="" method="POST">
                  
                <div class="form-group">
                    <label>SİTE TİTLE</label>
                    <input class="form-control" name="title" value="<?php echo $siteayarsonuc["title"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>SİTE METATİTLE</label>
                    <input class="form-control" name="metatitle" value="<?php echo $siteayarsonuc["metatitle"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>LOGO YAZISI</label>
                    <input class="form-control" name="logoyazisi" value="<?php echo $siteayarsonuc["logoyazisi"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>TWİTTER ADRESİ</label>
                    <input class="form-control" name="twit" value="<?php echo $siteayarsonuc["twit"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>FACEBOOK ADRESİ</label>
                    <input class="form-control" name="face" value="<?php echo $siteayarsonuc["face"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>İNSTEGRAM ADRESİ</label>
                    <input class="form-control" name="ints" value="<?php echo $siteayarsonuc["ints"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>MASİL ADRESİ</label>
                    <input class="form-control" name="mailadres" value="<?php echo $siteayarsonuc["mailadres"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>TAVSİYE BAŞLIK</label>
                    <input class="form-control" name="film_baslik" value="<?php echo $siteayarsonuc["film_baslik"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>TAVSİYE ALTBAŞLIK</label>
                    <input class="form-control" name="film_altbaslik" value="<?php echo $siteayarsonuc["film_altbaslik"]; ?>">  
				</div>
				  
                      
                  <input type="submit" name="buton" class="btn btn-success btn-icon-split" value="Güncelle" >
                  <input type="hidden" name="kaytid" value="<?php echo $siteayarsonuc["id"]; ?>" ><br>

                </form>
              </div>
              
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>
     
            <?php

        endif;


    }


    function giriskontrol($giriskontroldb){


      if($_POST):

        $kulad=$_POST["kulaniciad"];
        $sifre=$_POST["kullanicisifre"];

        if(empty($kulad) || empty($sifre)):

          echo '<div class="alert alert-danger">BOŞ YER KALAMAZ !!! </div>';
          header("refresh:2,url=login.php");

        else:

          $giris=$giriskontroldb->prepare("select * from yonetim where kulad=:kulad and sifre=:sifre");
          $giris->bindParam(":kulad",$kulad);
          $giris->bindParam(":sifre",md5(sha1(md5($_POST["kullanicisifre"]))));
          $giris->execute();
          $girisson=$giris->fetch(PDO::FETCH_ASSOC);

          if($giris->rowCount()>0):

            $_SESSION["kulad"]=$kulad;
            echo '<div class="alert alert-success" style="text-align: center;">Yönetim Paneline Hoşgeldin<br><br><b>'.$girisson["kulad"].'</b></div>';
            header("refresh:2,url=control.php");


          else:

          echo '<div class="alert alert-danger">BÖYLE BİR KULLANICI YOK !!! </div>';
          header("refresh:2,url=login.php");


          endif;
        endif;

      else:

        ?>
              <form class="user" action="" method="POST">
                <div class="form-group">
                  <input type="text"  class="form-control form-control-user" name="kulaniciad" placeholder="Kullanıcı Adınız...">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="kullanicisifre"  placeholder="Şifreniz....">
                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="GİRİŞ">
              </form>

        <?php

      endif;

    }

    function sifreguncelle($sifreguncelledb) {

      if($_POST):

      $sifregetir=$sifreguncelledb->prepare("SELECT sifre FROM yonetim");
      $sifregetir->execute();
      $sifreson=$sifregetir->fetch(PDO::FETCH_ASSOC);

      $sifre=md5(sha1(md5($_POST["sifre"])));
      $anasifre=$_POST["anasifre"];

      $sifreguncelle=$sifreguncelledb->prepare("UPDATE yonetim SET sifre=:sifre");

      $sifreguncelle->bindParam(":sifre",$sifre);

      if(empty($anasifre) || empty($sifre)):

        echo '<div class="alert alert-danger" style="text-align: center;">ALANLAR BOŞ KALAMAZ</div>';
        header("refresh:2,url=control.php?islem=sifreguncelle");

      else:

        if($sifreson["sifre"]==$sifre):

          echo '<div class="alert alert-danger" style="text-align: center;">ESKİ ŞİFRE İLE AYNI</div>';
          header("refresh:2,url=control.php?islem=sifreguncelle");

        else:

      if($sifreguncelle->execute()):

        echo '<div class="alert alert-success" style="text-align: center;">ŞİFRENİZ GÜNCELLENDİ</div>';
        header("refresh:2,url=control.php?islem=sifreguncelle");

      else:

        echo '<div class="alert alert-danger" style="text-align: center;">GÜNCELLENEMEDİ</div>';
        header("refresh:2,url=control.php?islem=sifreguncelle");

      endif;
      
      endif;
      endif;

    endif;
      

      ?>

<div class="col-xl-10 col-lg-10">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <h1 class="h3 mb-2 text-gray-800">ŞİFRE GÜNCELLE</h1>
   
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6">
                <form role="form" action="" method="POST">
                  
                <div class="form-group">
                    <label>MEVCUT ŞİFRE</label>
                    <input class="form-control" name="anasifre">  
                </div>
                
                <div class="form-group">
                    <label>YENİ ŞİFRE</label>
                    <input class="form-control" name="sifre">  
                </div>
                
                  <input type="submit" name="buton" class="btn btn-success btn-icon-split" value="Güncelle" >
                
                </form>
              </div>
              
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>


      <?php

    }


    function kullaniciayar($kullaniciayardb){

      if($_POST["buton"]):

        $tip=array(
    
            "image/png",
            "image/jpg",
            "image/jpeg"
        );


        if($_FILES["resim"]["name"]==""):

        $kulad=$_POST["kulad"];
        $kaytid=$_POST["kaytid"];

        $yonetimguncelle=$kullaniciayardb->prepare("UPDATE yonetim SET 
                    
                    kulad=:kulad
                    
                    WHERE id=:id");
    
                    $yonetimguncelle->bindParam(":kulad",$kulad);
                    $yonetimguncelle->bindParam(":id",$kaytid);
                    
                    if($yonetimguncelle->execute()):
    
                        echo '<div class="alert alert-success">GÜNCELLEME BAŞARILI</div>';
                        header("refresh:2,url=control.php?islem=kullaniciayar");
    
                    else:
    
                      echo "oldu";

                        echo '<div class="alert alert-danger">GÜNCELLEME BAŞARISIZ !!!</div>';
                        header("refresh:2,url=control.php?islem=kullaniciayar");
    
    
                    endif;


        else:
          

        $kulad=$_POST["kulad"];
        $adminresim=$_POST["adminresim"];
        $kaytid=$_POST["kaytid"];


    
        if(empty($kulad) || empty($adminresim) || empty($_FILES["resim"]["name"])):
    
            echo '<div class="alert alert-danger">BOŞ YER KALAMAZ !!!</div>';
            header("refresh:2,url=control.php?islem=kullaniciayar");

            
        else:
            if(!in_array($_FILES["resim"]["type"],$tip)):
    
                echo '<div class="alert alert-danger">DOSYA TİPİ YALNIŞ !!!</div>';
                header("refresh:2,url=control.php?islem=kullaniciayar");

    
            else:
                if($_FILES["resim"]["size"]>1024*1024*5):
    
                    echo '<div class="alert alert-danger">DOSYA BOYUTU FAZLA !!!</div>'; 
                    header("refresh:2,url=control.php?islem=kullaniciayar");

    
                else:
    
                    unlink($adminresim);
    
                    $resimdosyauzantisi=explode(".",$_FILES["resim"]["name"]);
    
                    $resimyol='../assets/img/'.substr(md5(mt_rand(0,999999)),2,9).".".$resimdosyauzantisi[1];
    
                    move_uploaded_file($_FILES["resim"]["tmp_name"],$resimyol);
    
                    $introguncelle=$kullaniciayardb->prepare("UPDATE yonetim SET 
                    
                    kulad=:kulad,
                    adminresim=:adminresim 
                    
                    WHERE id=:id");
    
                    $introguncelle->bindParam(":kulad",$kulad);
                    $introguncelle->bindParam(":adminresim",$resimyol);
                    $introguncelle->bindParam(":id",$kaytid);
                    
                    if($introguncelle->execute()):
    
                        echo '<div class="alert alert-success">GÜNCELLEME BAŞARILI</div>';
                        header("refresh:2,url=control.php?islem=kullaniciayar");

    
                    else:
    
                      echo "olduuuuu";

                        echo '<div class="alert alert-danger">GÜNCELLEME BAŞARISIZ !!</div>';
                        header("refresh:2,url=control.php?islem=kullaniciayar");

    
    
                    endif;
    
                    endif;
    
                    endif;
                    endif;
                    endif;
                  
                  
                  else:
        

                $yonetim=$kullaniciayardb->prepare("SELECT * FROM yonetim");
                
                $yonetim->execute();

                $yonetimsonuc=$yonetim->fetch(PDO::FETCH_ASSOC);

      

        ?>

<div class="col-xl-10 col-lg-10">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <h1 class="h3 mb-2 text-gray-800">YÖNETİCİ AYARLAR</h1>
   
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-8">
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                  
                <div class="form-group">
                    <label>İNTRO BAŞLIK</label>
                    <input class="form-control" name="kulad" value="<?php echo $yonetimsonuc["kulad"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>İNTRO RESİM</label>
                    <img src="<?php echo $yonetimsonuc["adminresim"]; ?>" width="100" height="100" alt="">
                </div>

                <div class="form-group">
                    <label>RESİM YÜKLE</label>
                    <input type="file" name="resim">    
                </div>
  
                  <input type="submit" name="buton" class="btn btn-success btn-icon-split" value="Güncelle" >
                  <input type="hidden" name="kaytid" value="<?php echo $yonetimsonuc["id"]; ?>"><br>
                  <input type="hidden" name="adminresim" value="<?php echo $yonetimsonuc["adminresim"];?>">

                </form>
              </div>
              
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>

        <?php

              endif;

    }





    function introgoster($introguncel){


      if($_POST["buton"]):

        $tip=array(
    
            "image/png",
            "image/jpg",
            "image/jpeg"
        );


        if($_FILES["resim"]["name"]==""):

        $yazi=$_POST["yazi"];
        $yazi_alt=$_POST["yazi_alt"];
        $kaytid=$_POST["kaytid"];

        $introguncelle=$introguncel->prepare("UPDATE intro SET 
                    
                    yazi=:yazi,
                    yazi_alt=:yazi_alt
                    
                    WHERE id=:id");
    
                    $introguncelle->bindParam(":yazi",$yazi);
                    $introguncelle->bindParam(":yazi_alt",$yazi_alt);
                    $introguncelle->bindParam(":id",$kaytid);
                    
                    if($introguncelle->execute()):
    
                        echo '<div class="alert alert-success">GÜNCELLEME BAŞARILI</div>';
                        header("refresh:2,url=control.php?islem=introgoster");

    
                    else:
    
                      echo "oldu";

                        echo '<div class="alert alert-danger">GÜNCELLEME BAŞARISIZ !!!</div>';
                        header("refresh:2,url=control.php?islem=introgoster");

    
    
                    endif;


        else:
          

        $yazi=$_POST["yazi"];
        $yazi_alt=$_POST["yazi_alt"];
        $introresim=$_POST["introresim"];
        $kaytid=$_POST["kaytid"];


    
        if(empty($yazi) || empty($yazi_alt) || empty($introresim) || empty($_FILES["resim"]["name"])):
    
            echo '<div class="alert alert-danger">BOŞ YER KALAMAZ !!!</div>';
            header("refresh:2,url=control.php?islem=introgoster");

            
        else:
            if(!in_array($_FILES["resim"]["type"],$tip)):
    
                echo '<div class="alert alert-danger">DOSYA TİPİ YALNIŞ !!!</div>';
                header("refresh:2,url=control.php?islem=introgoster");

    
            else:
                if($_FILES["resim"]["size"]>1024*1024*5):
    
                    echo '<div class="alert alert-danger">DOSYA BOYUTU FAZLA !!!</div>'; 
                    header("refresh:2,url=control.php?islem=introgoster");

    
                else:
    
                    unlink($introresim);
    
                    $resimdosyauzantisi=explode(".",$_FILES["resim"]["name"]);
    
                    $resimyol='../assets/img/'.substr(md5(mt_rand(0,999999)),2,9).".".$resimdosyauzantisi[1];
    
                    move_uploaded_file($_FILES["resim"]["tmp_name"],$resimyol);

                    $introguncelle=$introguncel->prepare("UPDATE intro SET 
                    
                    yazi=:yazi,
                    yazi_alt=:yazi_alt,
                    resimyol=:resimyol 
                    
                    WHERE id=:id");
    
                    $introguncelle->bindParam(":yazi",$yazi);
                    $introguncelle->bindParam(":yazi_alt",$yazi_alt);
                    $introguncelle->bindParam(":resimyol",$resimyol);
                    $introguncelle->bindParam(":id",$kaytid);
                    
                    if($introguncelle->execute()):
    
                        echo '<div class="alert alert-success">GÜNCELLEME BAŞARILI</div>';
                        header("refresh:2,url=control.php?islem=introgoster");

    
                    else:
    
                      echo "olduuuuu";

                        echo '<div class="alert alert-danger">GÜNCELLEME BAŞARISIZ !!</div>';
                        header("refresh:2,url=control.php?islem=introgoster");

    
    
                    endif;
    
                    endif;
    
                    endif;
                    endif;
                    endif;
                  
                  
                  else:
        

                $intro=$introguncel->prepare("SELECT * FROM intro");
                
                $intro->execute();

                $introsonuc=$intro->fetch(PDO::FETCH_ASSOC);

      

        ?>

<div class="col-xl-10 col-lg-10">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <h1 class="h3 mb-2 text-gray-800">İNTRO AYARLAR</h1>
   
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-8">
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                  
                <div class="form-group">
                    <label>İNTRO BAŞLIK</label>
                    <input class="form-control" name="yazi" value="<?php echo $introsonuc["yazi"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>İNTRO ALT BAŞLIK</label>
                    <input class="form-control" name="yazi_alt" value="<?php echo $introsonuc["yazi_alt"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>İNTRO RESİM</label>
                    <img src="<?php echo $introsonuc["resimyol"]; ?>" width="100" height="100" alt="">
                </div>

                <div class="form-group">
                    <label>RESİM YÜKLE</label>
                    <input type="file" name="resim">    
                </div>
  
                  <input type="submit" name="buton" class="btn btn-success btn-icon-split" value="Güncelle" >
                  <input type="hidden" name="kaytid" value="<?php echo $introsonuc["id"]; ?>"><br>
                  <input type="hidden" name="introresim" value="<?php echo $introsonuc["resimyol"];?>">

                </form>
              </div>
              
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>

        <?php

              endif;

    
    }


    function hakkimizdaayar($hakkimizdaayardb){

        // burada sadece hepsini birden güncellmeke istersen güncelliyor tek güncellemiyor
        
            if($_POST["buton"]):

              $tip=array(
            
                "image/png",
                "image/jpg",
                "image/jpeg"
              );

               
              // yada bu if içerisini $_FILES["hakresim"]["name"]=="" şeklindede yazabiliriz 

                if(empty($_FILES["hakresim"]["name"])):                

                                $baslik_ust=$_POST["baslik_ust"];
                                $baslik=$_POST["baslik"];
                                $icerik=$_POST["icerik"];
                                $kaytid=$_POST["kaytid"];

                                $hakguncelle=$hakkimizdaayardb->prepare("UPDATE hakkimizda SET 
                            
                                baslik_ust=:baslik_ust,
                                baslik=:baslik,
                                icerik=:icerik 
                                WHERE id=:id");
                    
                                $hakguncelle->bindParam(":baslik_ust",$baslik_ust);
                                $hakguncelle->bindParam(":baslik",$baslik);
                                $hakguncelle->bindParam(":icerik",$icerik);                
                                $hakguncelle->bindParam(":id",$kaytid);                                
                                
                                if($hakguncelle->execute()):
                    
                                    echo '<div class="alert alert-success">GÜNCELLEME BAŞARILI</div>';
                                    header("refresh:2,url=control.php?islem=hakkimizda");

                    
                                else:
                    
                                    echo '<div class="alert alert-danger">GÜNCELLEME BAŞARIZZZZ !!</div>';
                                    header("refresh:2,url=control.php?islem=hakkimizda");

                    
                    
                                endif;

                
                else:

                  $hakresimyol=$_POST["resimyol"];
                  $baslik_ust=$_POST["baslik_ust"];
                  $baslik=$_POST["baslik"];
                  $icerik=$_POST["icerik"];
                  $kaytid=$_POST["kaytid"];
            
            if(empty($hakresimyol) || empty($baslik_ust) || empty($baslik) || empty($icerik) ):
            
                echo '<div class="alert alert-danger">BOŞ YER KALAMAZ !!!</div>';
                header("refresh:2,url=control.php?islem=hakkimizda");
                
            else:
            
                if(!in_array($_FILES["hakresim"]["type"],$tip)):
            
                    echo '<div class="alert alert-danger">DOSYA TİPİ YALNIŞ !!!</div>';
                    header("refresh:2,url=control.php?islem=hakkimizda");

            
                else:
            
                    if($_FILES["hakresim"]["size"]>1024*1024*5):
            
                        echo '<div class="alert alert-danger">DOSYA BOYUTU FAZLA !!!</div>'; 
                        header("refresh:2,url=control.php?islem=hakkimizda");

            
                    else:

                     
                        unlink($hakresimyol);
            
                        $resimdosyauzantisi=explode(".",$_FILES["hakresim"]["name"]);
            
                        $resimyol='../assets/img/about/'.substr(md5(mt_rand(0,999999)),2,9).".".$resimdosyauzantisi[1];
            
                        move_uploaded_file($_FILES["hakresim"]["tmp_name"],$resimyol);
            
                        
                        $hakguncelle=$hakkimizdaayardb->prepare("UPDATE hakkimizda SET 
            
                        baslik_ust=:baslik_ust,
                        baslik=:baslik,
                        icerik=:icerik,
                        resim=:resim
            
                         WHERE id=:id");
            
                        $hakguncelle->bindParam(":baslik_ust",$baslik_ust);
                        $hakguncelle->bindParam(":baslik",$baslik);
                        $hakguncelle->bindParam(":icerik",$icerik);
                        $hakguncelle->bindParam(":resim",$resimyol);
                        $hakguncelle->bindParam(":id",$kaytid);
                        
                        
                        if($hakguncelle->execute()):
            
                            echo '<div class="alert alert-success">GÜNCELLEME BAŞARILI</div>';
                            header("refresh:2,url=control.php?islem=hakkimizda");

            
                        else:
            
                            echo '<div class="alert alert-danger">GÜNCELLEME BAŞARIZZZZ !!</div>';
                            header("refresh:2,url=control.php?islem=hakkimizda");

            
            
                        endif;
            
                    endif;
            
                  endif;
            
                  endif;
                endif;
              

              else:
                

                $hakkimizdaayarcek=$hakkimizdaayardb->prepare("select * from hakkimizda");
                $hakkimizdaayarcek->execute();
                $hakkimizdasonuc=$hakkimizdaayarcek->fetch(PDO::FETCH_ASSOC);

            
            ?>
            
            
            <div class="col-xl-10 col-lg-10">
            <div class="row">
            <div class="col-lg-12">
            <div class="panel panel-default">
            <h1 class="h3 mb-2 text-gray-800">HAKKIMIZDA AYARLAR</h1>
            
            <div class="panel-body">
            <div class="row">
              <div class="col-lg-8">
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                  
                <div class="form-group">
                    <label>HAKKIMMIZDA ÜST BAŞLIK</label>
                    <input class="form-control" name="baslik_ust" value="<?php echo $hakkimizdasonuc["baslik_ust"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>HAKKIMIZDA BAŞLIK</label>
                    <input class="form-control" name="baslik" value="<?php echo $hakkimizdasonuc["baslik"]; ?>">  
                </div>
            
                <div class="form-group">
                    <label>HAKKIMIZDA İÇERİK</label>
                    <textarea class="ckeditor" name="icerik" rows="3"><?php echo $hakkimizdasonuc["icerik"];?></textarea>
                </div>
                
                <div class="form-group">
                    <label>HAKKIMIZDA RESİM</label>
                    <img src="<?php echo $hakkimizdasonuc["resim"]; ?>" width="100" height="100" alt="">
                </div>
            
                <div class="form-group">
                    <label>RESİM YÜKLE</label>
                    <input type="file" name="hakresim" >    
                </div>
            
                  <input type="submit" name="buton" class="btn btn-success btn-icon-split" value="Güncelle" >
                  <input type="hidden" name="kaytid" value="<?php echo $hakkimizdasonuc["id"]; ?>" >
                  <input type="hidden" name="resimyol" value="<?php echo $hakkimizdasonuc["resim"];?>">
            
                </form>
            
                
              </div>
              
              </div> 
            </div>
            </div>
            </div>
            </div>
            </div>
            
            <?php
            
          endif;
        
          
          
            }


            function yazilar($yazilardb){


              ?>

              <div class="container-fluid">
                        <h1 class="h3 mb-2 text-gray-800">FİLM VE DİZİ YAZILARIM</h1>
                        
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                          <div class="card-body">
                            <div class="table-responsive">
                            
                              <table class="table table-bordered" id="dataTable" width="75%" cellspacing="0">
                              
                                <thead>
                                <a href="control.php?islem=yaziekle" style="margin-bottom: 25px;" class="btn btn-success btn-sm">YAZI EKLE</a>
                                <br>
                                  <tr>
              
                                    <th>ADI</th>
                                    <th>TÜRÜ</th>
                                    <th>İÇERİK</th>
                                    <th>İMDB PUANI</th>
                                    <th>BENİM PUANIM</th>
                                    <th>YAZI RESİM</th>
                                    <th>DİZİ Mİ ? FİLM Mİ ?</th>
                                    <th>SİL</th>
                                    <th>GÜNCELLE</th>
                                    
                                  </tr>
                                </thead>
              
                      <?php
              
                      $intro=$yazilardb->prepare("SELECT * FROM tavsiye ORDER BY id DESC");
                      
                      if($intro->execute()):
                      
                      while($introson=$intro->fetch(PDO::FETCH_ASSOC)):
              

                          ?>
              
                                <tbody>
                                  <tr>
                                  
                                    <td><?php echo $introson["yazi_ad"]; ?></td>
                                    <td><?php echo $introson["yazi_tur"]; ?></td>
                                    <td>
                                    
                                    <?php 

                                    $tam=$introson["yazi_icerik"];

                                    $uzunluk=strlen($introson["yazi_icerik"]);

                                    $sınır=175;

                                    if($uzunluk>$sınır):

                                      $tam=substr($tam,0,$sınır). " <b>...</b> ";

                                    endif;
                                    
                                    echo $tam;
                                    
                                    
                                    ?>
                                    
                                    </td>
                                    <td><?php echo $introson["yazi_imdb"]; ?></td>
                                    <td><?php echo $introson["yazi_benim"]; ?></td>
                                    <td><img src="<?php echo $introson["yazi_resimyol"]; ?>" width="100" height="100" alt=""></td>
                                    <td>
                                      <?php 
                                      if($introson["yazidurum"]=="1"):  
                                      
                                      echo "FİLM";
                                      
                                      else:
                                      
                                        echo "DİZİ";

                                      endif;
                                                
                                      ?>
                                      </td>
                                    <td><a href="control.php?islem=yazisil&id=<?php echo $introson["id"]; ?>" class="btn btn-danger btn-sm" >SİL</a></td>
                                    <td><a href="control.php?islem=yazigüncelle&id=<?php echo $introson["id"]; ?>" class="btn btn-success btn-sm" >GÜNCELLE</a></td>
                                    
                                  </tr>
                                </tbody>
                                <?php
                                
                              endwhile;

                            endif;
                                
                                ?>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
      
              <?php


            }

            function yaziguncelle($yaziguncelledb){


              if(isset($_GET["id"])):

                $yaziguncelle=$yaziguncelledb->prepare("SELECT * FROM tavsiye WHERE id=".$_GET["id"]);
                $yaziguncelle->execute();
                $yaziguncelson=$yaziguncelle->fetch(PDO::FETCH_ASSOC);

              endif;

             

              ?>


<div class="col-xl-10 col-lg-10">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <h1 class="h3 mb-2 text-gray-800">YAZI GÜNCELLE</h1>
   
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-8">
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                  
                <div class="form-group">
                    <label>ADI</label>
                    <input class="form-control" name="yazi_ad" value="<?php echo $yaziguncelson["yazi_ad"]; ?>">  
                </div>

                <div class="form-group">
                    <label>TÜRÜ</label>
                    <input class="form-control" name="yazi_tur" value="<?php echo $yaziguncelson["yazi_tur"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>İÇERİK</label>
                    <textarea class="ckeditor" name="yazi_icerik" rows="4"><?php echo $yaziguncelson["yazi_icerik"]; ?></textarea>
                </div>

                <div class="form-group">
                    <label>BENİM PUANIM</label>
                    <input class="form-control" name="yazi_benim" value="<?php echo $yaziguncelson["yazi_benim"]; ?>">  
                </div>
                
                <div class="form-group">
                    <label>İMDB PUANI</label>
                    <input class="form-control" name="yazi_imdb" value="<?php echo $yaziguncelson["yazi_imdb"]; ?>">  
                </div>

              <div class="form-group">
                  <label for="">YAZI TÜRÜ</label>
                    <select name="yazidurum" id="">
                      <option value="1">FİLM</option>
                      <option value="2" <?php if($yaziguncelson["yazidurum"]=="2"):?> selected <?php endif; ?>>DİZİ</option>
                    </select> 
                </div>
                
                <div class="form-group">
                    <label>YAZI'NIN RESMİ</label>
                    <br>
                    <img src="<?php echo $yaziguncelson["yazi_resimyol"]; ?>" height="100" width="100" alt="">  
                </div>

              
                <div class="form-group">
                    <label>YENİ RESİM SEÇ</label>
                    <br>
                    <input type="file" name="resim">    
                </div>
  
                <div class="form-group" >
                  <input type="submit" name="kaydet" class="btn btn-success btn-icon-split" value="GÜNCELLE" >
                  <input type="hidden" name="kaytid" value="<?php echo $_GET["id"]; ?>" >
                  <input type="hidden" name="resimyol" value="<?php echo $yaziguncelson["yazi_resimyol"];?>">
                </div>

                </form>
              </div>
              
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>

            <?php

            if($_POST):

              $tip=array(

                "image/png",
                "image/jpg",
                "image/jpeg"
              );


              if(empty($_FILES["resim"]["name"])):

                  $yazi_ad=$_POST["yazi_ad"];
                  $yazi_tur=$_POST["yazi_tur"];
                  $yazi_icerik=$_POST["yazi_icerik"];
                  $yazi_benim=$_POST["yazi_benim"];
                  $yazi_imdb=$_POST["yazi_imdb"];
                  $yazidurum=$_POST["yazidurum"];
                  $id=$_POST["kaytid"];

                  $yaziguncel=$yaziguncelledb->prepare("UPDATE tavsiye SET
                    
                  yazi_ad=:yazi_ad,
                  yazi_tur=:yazi_tur,
                  yazi_icerik=:yazi_icerik,
                  yazi_benim=:yazi_benim,
                  yazi_imdb=:yazi_imdb,
                  yazidurum=:yazidurum

                  WHERE

                  id=:id                  
                
                 ");

                 $yaziguncel->bindParam(":yazi_ad",$yazi_ad);
                 $yaziguncel->bindParam(":yazi_tur",$yazi_tur);
                 $yaziguncel->bindParam(":yazi_icerik",$yazi_icerik);
                 $yaziguncel->bindParam(":yazi_benim",$yazi_benim);
                 $yaziguncel->bindParam(":yazi_imdb",$yazi_imdb);
                 $yaziguncel->bindParam(":yazidurum",$yazidurum);
                 $yaziguncel->bindParam(":id",$id);

                 if($yaziguncel->execute()):

                  echo '<div class="alert alert-success">YAZI GÜNCELLENDİ</div>';
                  header("refresh:2,url=control.php?islem=yazigüncelle");

                 else:

                  echo '<div class="alert alert-danger">!!! MAALESEF GÜNCELLENMEDİ !!!</div>';
                  header("refresh:2,url=control.php?islem=yazigüncelle");

                 endif;


                else:
              

            $yazi_ad=$_POST["yazi_ad"];
            $yazi_tur=$_POST["yazi_tur"];
            $yazi_icerik=$_POST["yazi_icerik"];
            $yazi_benim=$_POST["yazi_benim"];
            $yazi_imdb=$_POST["yazi_imdb"];
            $yazidurum=$_POST["yazidurum"];
            $yaziresim=$_POST["yazi_resimyol"];
            $id=$_POST["kaytid"];

           
            
 
            if(empty($yazi_ad) || empty($yazi_tur) || empty($yazi_icerik) || empty($yazi_benim) || empty($yazi_imdb) || empty($yazidurum) || empty($_FILES["resim"]["name"])):

              echo '<div class="alert alert-danger">BOŞ YER KALAMAZ !!!</div>';
              header("refresh:2,url=control.php?islem=yazigüncelle");

            else:
              if(!in_array($_FILES["resim"]["type"],$tip)):

                echo '<div class="alert alert-danger">DOSYA TİPİ YALNIŞ !!!</div>';
                header("refresh:2,url=control.php?islem=yazigüncelle");

              else:
                if($_FILES["resim"]["size"]>1024*1024*5):

                echo '<div class="alert alert-danger">DOSYA BOYUTU FAZLA !!!</div>';
                header("refresh:2,url=control.php?islem=yazigüncelle");

                else:

                  unlink($yaziresim);

                  $dosyauzanti=explode(".",$_FILES["resim"]["name"]);

                  $resimyol='../assets/img/'.substr(md5(mt_rand(0,999999)),2,9).".".$dosyauzanti[1];

                  move_uploaded_file($_FILES["resim"]["tmp_name"],$resimyol);

                  $yaziguncel=$yaziguncelledb->prepare("UPDATE tavsiye SET
                  
                  yazi_ad=:yazi_ad,
                  yazi_tur=:yazi_tur,
                  yazi_icerik=:yazi_icerik,
                  yazi_benim=:yazi_benim,
                  yazi_imdb=:yazi_imdb,
                  yazi_resimyol=:yazi_resimyol,
                  yazidurum=:yazidurum

                  WHERE

                  id=:id                  
                  
                   ");

                   $yaziguncel->bindParam(":yazi_ad",$yazi_ad);
                   $yaziguncel->bindParam(":yazi_tur",$yazi_tur);
                   $yaziguncel->bindParam(":yazi_icerik",$yazi_icerik);
                   $yaziguncel->bindParam(":yazi_benim",$yazi_benim);
                   $yaziguncel->bindParam(":yazi_imdb",$yazi_imdb);
                   $yaziguncel->bindParam(":yazi_resimyol",$resimyol);
                   $yaziguncel->bindParam(":yazidurum",$yazidurum);
                   $yaziguncel->bindParam(":id",$id);

                   if($yaziguncel->execute()):

                    echo '<div class="alert alert-success">YAZI GÜNCELLENDİ</div>';
                    header("refresh:2,url=control.php?islem=yazigüncelle");

                   else:

                    echo '<div class="alert alert-danger">!!! MAALESEF GÜNCELLENMEDİ !!!</div>';
                    header("refresh:2,url=control.php?islem=yazigüncelle");

                   endif;

                endif;
              endif;
            endif;
            endif;

          

            endif;

            }


            function yazisil($yazisildb){

              if(isset($_GET["id"])):

                $resimgetir=$yazisildb->prepare("SELECT yazi_resimyol FROM tavsiye WHERE id=".$_GET["id"]);
                $resimgetir->execute();
                $resimson=$resimgetir->fetch(PDO::FETCH_ASSOC);

                unlink($resimson["yazi_resimyol"]);

                $yazigetir=$yazisildb->prepare("SELECT * FROM tavsiye WHERE id=".$_GET["id"]);
                $yazigetir->execute();
                $yazison=$yazigetir->fetch(PDO::FETCH_ASSOC);


              $yazisil=$yazisildb->prepare("DELETE FROM tavsiye WHERE id=".$_GET["id"]);
              $yazisil->execute();

              echo '<div class="alert alert-danger">!!! <b>'.$yazison["yazi_ad"].'</b> YAZISI SİLİNDİ !!!</div>';
              header("refresh:2,url=control.php?islem=yazilar");


              endif;

            }



        function yaziekle($yaziekledb){

          if($_POST["kaydet"]):

            $tip=array(

              "image/png",
              "image/jpg",
              "image/jpeg"

            );

            $yazi_ad=$_POST["yazi_ad"];
            $yazi_tur=$_POST["yazi_tur"];
            $yazi_icerik=$_POST["yazi_icerik"];
            $yazi_benim=$_POST["yazi_benim"];
            $yazi_imdb=$_POST["yazi_imdb"];
            $yazidurum=$_POST["yazidurum"];

            if(empty($yazi_ad) || empty($yazi_tur) || empty($yazi_icerik) || empty($yazi_benim) || empty($yazi_imdb) || empty($yazidurum) || empty($_FILES["resim"]["name"])):

              echo '<div class="alert alert-danger">BOŞ YER KALAMAZ !!!</div>';
              header("refresh:2,url=control.php?islem=yaziekle");

            else:

              if(!in_array($_FILES["resim"]["type"],$tip)):

              echo '<div class="alert alert-danger">TÜR YALNIŞ !!!</div>';
              header("refresh:2,url=control.php?islem=yaziekle");

              else:

                if($_FILES["resim"]["size"]>1024*1024*5):

                  echo '<div class="alert alert-danger">BOYUT FAZLA !!!</div>';
                  header("refresh:2,url=control.php?islem=yaziekle");

                else:

                  $resimuzanti=explode(".",$_FILES["resim"]["name"]);

                  $resimyol='../assets/img/'.substr(md5(mt_rand(0,9999999)),2,9).".".$resimuzanti[1];

                  move_uploaded_file($_FILES["resim"]["tmp_name"],$resimyol);

                  $yaziekle=$yaziekledb->prepare("INSERT INTO tavsiye (yazi_ad,yazi_tur,yazi_icerik,yazi_benim,yazi_imdb,yazi_resimyol,yazidurum) VALUES (:yazi_ad,:yazi_tur,:yazi_icerik,:yazi_benim,:yazi_imdb,:yazi_resimyol,:yazi_durum)");

                  $yaziekle->bindParam(":yazi_ad",$yazi_ad);
                  $yaziekle->bindParam(":yazi_tur",$yazi_tur);
                  $yaziekle->bindParam(":yazi_icerik",$yazi_icerik);
                  $yaziekle->bindParam(":yazi_benim",$yazi_benim);
                  $yaziekle->bindParam(":yazi_imdb",$yazi_imdb);
                  $yaziekle->bindParam(":yazi_durum",$yazidurum);
                  $yaziekle->bindParam(":yazi_resimyol",$resimyol);

                  if($yaziekle->execute()):

                    echo '<div class="alert alert-success">YAZI EKLENDİ</div>';
                    header("refresh:2,url=control.php?islem=yaziekle");
                    
                  else:

                    echo '<div class="alert alert-danger">YAZI EKLENMEDİ !!!!</div>';
                    header("refresh:2,url=control.php?islem=yaziekle");


                endif;

            endif;

          endif;

          endif;

          endif;



             ?>

<div class="col-xl-10 col-lg-10">
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
        <h1 class="h3 mb-2 text-gray-800">YAZI EKLE</h1>
   
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-8">
                <form role="form" action="" method="POST" enctype="multipart/form-data">
                  
                <div class="form-group">
                    <label>ADI</label>
                    <input class="form-control" name="yazi_ad" value="">  
                </div>

                <div class="form-group">
                    <label>TÜRÜ</label>
                    <input class="form-control" name="yazi_tur" value="">  
                </div>
                
                <div class="form-group">
                    <label>İÇERİK</label>
                    <textarea class="ckeditor" name="yazi_icerik" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label>BENİM PUANIM</label>
                    <input class="form-control" name="yazi_benim" value="">  
                </div>
                
                <div class="form-group">
                    <label>İMDB PUANI</label>
                    <input class="form-control" name="yazi_imdb" value="">  
                </div>

                <div class="form-group">
                  <label for="">YAZI TÜRÜ</label>
                    <select name="yazidurum" id="">
                      <option value="1">FİLM</option>
                      <option value="2">DİZİ</option>
                    </select> 
                </div>
              
                <div class="form-group">
                    <label>YAZI RESİM</label>
                    <br>
                    <input type="file" name="resim">    
                </div>
  
                <div class="form-group" >
                  <input type="submit" name="kaydet" class="btn btn-success btn-icon-split" value="KAYDET" >
                </div>

                </form>
              </div>
              
              </div> 
            </div>
          </div>
        </div>
      </div>
    </div>


            <?php


            }

           





    }


    








?>