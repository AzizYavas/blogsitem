                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a href="yazidetay.php?yazid=<?php echo $sonucdizifilm["id"]; ?>">  
                                <img class="img-fluid" src="assets/img/<?php echo $resimdizifilm[3]; ?>" alt="" />
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


            $path = getcwd();
             $oldpic = $path.'/images/test.jpg'; //your image path
             $array = explode("/",$oldpic);
             $count = count($array);
             $name = $array[$count-1];

             $src = $oldpic;
             $dest = $path."/images/thumbnail/".$name; // resized image

             //Genrating the image from there extension
             $size = getimagesize($src);
             switch($size["mime"]){

                        case "image/jpeg":
                          $source_image = imagecreatefromjpeg($src); //jpeg file
                        break;

                        case "image/gif":
                          $source_image = imagecreatefromgif($src); //gif file
                        break;

                        case "image/png":
                          $source_image = imagecreatefrompng($src); //png file
                        break;

                        default:
                          $source_image=false;
                        break;
             }
             
             $width = imagesx($source_image);
             $height = imagesy($source_image);
             $newwidth=300;
             $newheight= 300;
             $virtual_image = imagecreatetruecolor($newwidth, $newheight);
             imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
             imagejpeg($virtual_image,$dest,100);

             ?>