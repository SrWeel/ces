<?php
header('Access-Control-Allow-Origin: *'); 
    $dirname = "".trim($_POST['value1']); 
    $ran = $_POST['value2']."_".rand();  
    // If uploading file
    if ($_FILES) {
        print_r($_FILES);

    	list($w, $h) = getimagesize($_FILES["file"]["tmp_name"]);
      /* calculate new image size with ratio */
      $width = 900;
      $height = 900;
      $ratio = max($width/$w, $height/$h);
      $h = ceil($height / $ratio);
      $x = ($w - $width / $ratio) / 2;
      $w = ceil($width / $ratio);
      /* new file name */
      $path = trim($dirname)."/".$ran.".jpg";
      /* read binary data from image file */
      $imgString = file_get_contents($_FILES['file']['tmp_name']);
      /* create image from string */
      $image = imagecreatefromstring($imgString);
      $tmp = imagecreatetruecolor($width, $height);
      imagecopyresampled($tmp, $image,
        0, 0,
        $x, 0,
        $width, $height,
        $w, $h);
      /* Save image */
      switch ($_FILES['file']['type']) {
        case 'image/jpeg':
          imagejpeg($tmp, $path, 60);
          break;
        case 'image/png':
          imagepng($tmp, $path, 0);
          break;
        case 'image/gif':
          imagegif($tmp, $path);
          break;
        default:
          exit;
          break;
      }
      return $path;
      echo $path;
      /* cleanup memory */
      imagedestroy($image);
      imagedestroy($tmp);
    }
    else {
        $baseURI = "http://".$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];
    	$nomeCart = $_GET['nome'];
        $images = scandir($dirname."/".$nomeCart);
        $ignore = Array(".", "..");
        if ($images) { ?>
            <? foreach($images as $curimg){ 
                if (!in_array($curimg, $ignore)) { ?>
    <div id="<? echo $curimg ?>" style="margin:2px; border-radius:4px; border:#F90 solid 1px;background-image:url(http://www.mimanchitu.it/public/friends/<? echo $nomeCart."/".$curimg ?>);background-size:130% auto"><img src="http://www.mimanchitu.it/images/spacer.gif" width="100%" height="80px" /></div>
    <? }
            };
        }
        else {echo "Non hai immagini!";}
}

?>