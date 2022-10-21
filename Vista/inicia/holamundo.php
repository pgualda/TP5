<?php 
use Libern\QRCodeReader\QRCodeReader;
use Gumlet\ImageResize;

require '../../vendor/autoload.php';

echo "prueba librerias imageresize y qrcodereader</br>";
echo "imagen compelta</br>";
echo "<img src='../../images/1926.jpg' width='200px'></br></br>";

$image = new ImageResize("../../images/1926.jpg");
$fondo = new ImageResize("../../images/fondo.jpg");
//$image->scale(85);
$image->resizeToBestFit(640, 640);
//$image->save("../../images/1921.jpg");
//echo "<img src='../../images/1921.jpg' width='200px'></br>";
$image->save("../../images/scale.jpg");
echo "to best 640 x 640</br>";
echo "<img src='../../images/scale.jpg' width='200px'></br></br>";

//$image->crop(640,640, TRUE);
//$image->crop(340,640);
//$image->save("../../images/1922.jpg");
//echo "crop 640 x 640</br>";
//echo "<img src='../../images/1922.jpg' width='200px'></br></br>";


// sobre el fondo negro metemos el banner
$banner = '../../images/scale.jpg';
$fondo->addFilter(function ($imageDesc) use ($banner) {
    $pega = imagecreatefromjpeg($banner);
    // aca centramos
    $x=(640-imagesx($pega))/2;
    $y=(640-imagesy($pega))/2;
    imagecopy($imageDesc, $pega, $x,$y,0,0,640,640);
    imagedestroy($pega);
});

$fondo->save("../../images/confondo.jpg");
echo "final con banner</br>";
echo "<img src='../../images/confondo.jpg' width='200px'></br></br>";

$QRCodeReader = new QRCodeReader();
$qrcode_text = $QRCodeReader->decode("../../images/scale.jpg");
echo "contenido:".$qrcode_text;

if ( $qrcode_text != NULL ) {

   // ahora le ponemos q leyo
   $banner = '../../images/qroka.jpg'; } else {

   $banner = '../../images/qrmal.jpg';

}

$fondo->addFilter(function ($imageDesc) use ($banner) {
   $pega = imagecreatefromjpeg($banner);
   imagecopy($imageDesc, $pega, 0, 640, 0, 0, 320, 50);
   imagedestroy($pega);
});

$banner = '../../images/verif.jpg';
$fondo->addFilter(function ($imageDesc) use ($banner) {
    $pega = imagecreatefromjpeg($banner);
    imagecopy($imageDesc, $pega, 320, 640, 0, 0, 320, 50);
    imagedestroy($pega);
 });
 

$fondo->save("../../images/final.jpg");
echo "final con qr y qroka</br>";
echo "<img src='../../images/final.jpg' width='200px'></br></br>";

//$QRCodeReader = new Libern\QRCodeReader\QRCodeReader();
//$qrcode_text = $QRCodeReader->decode(base64_encode("image_stream"));
//echo $qrcode_text;
?>

