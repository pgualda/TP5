<?php
use Libern\QRCodeReader\QRCodeReader;
use Gumlet\ImageResize;
require '../../vendor/autoload.php';

class ctrlqr
{
    public function listar()
    {
        $directorio = "../../images/def/";
        $archivos = scandir($directorio, 1);
        return $archivos;
    }

    public function decode($file)
    {
        $QRCodeReader = new QRCodeReader();
        $qrcode_text = $QRCodeReader->decode($file);
        return $qrcode_text; 
    }

    /* function upload 
       param $datos ?? es necesario? no viene en $_FILES?
       return ERROR con sus descripciones o el nombres del archivo
       donde sea que fuere que es necesario volver a leer el qr, se llama al metodo decode
    */
    public function upload() {

         $dir = "../../images/archivo/";
         $pesaMenosDe2Mb = true;
         $esArchivoAdmitido = false;
         $cargaok= false;
         $msjerror= "";
         if ($_FILES['miFile']["error"] <= 0) {
            $nombreArchivo = $_FILES['miFile']['name'];
            $tipoDeArchivo = $_FILES['miFile']['type'];
            $tamanioArchivo = $_FILES['miFile']["size"];
            if (($tamanioArchivo / 1024) > 2048) {
               $pesaMenosDe2Mb = false;
            }
            if ($tipoDeArchivo == "image/jpeg") { 
               $esArchivoAdmitido = true;
            }
            if ($pesaMenosDe2Mb && $esArchivoAdmitido) {
                if (!copy($_FILES['miFile']['tmp_name'], $dir . $_FILES['miFile']['name'])) {
                    $msjerror="ERROR: no se pudo cargar la imagen";
                } else {
                    $cargaok=true;
                }
            } else {
                $msjerror="ERROR: El archivo no cumple con los requisitos";
            }
        } else {
            $msjerror="ERROR: no se pudo cargar el archivo. No se pudo acceder al archivo Temporal";
        }

        if ($cargaok) {
            $image = new ImageResize($dir.$nombreArchivo);
            $image->resizeToBestFit(640, 640);
            $image->save($dir."scale.jpg");
            $qrcode_text=$this->decode($dir."scale.jpg"); // aca llama al decoder
            $msjerror="QR:".$qrcode_text;
            if ( $qrcode_text != NULL ) {
                $fondofile = '../../images/fondoverde640.jpg';
                $marcofile = '../../images/fondoverde.jpg';
            } else {
                $fondofile = '../../images/fondorojo640.jpg';
                $marcofile = '../../images/fondorojo.jpg';
            }
            $fondo = new ImageResize($fondofile);
            $marco = new ImageResize($marcofile);

            // agregar fondo en 640 x 640
            $banner = $dir.'scale.jpg';
            $fondo->addFilter(function ($imageDesc) use ($banner) {
                $pega = imagecreatefromjpeg($banner);
                // aca centramos
                $x=(640-imagesx($pega))/2;
                $y=(640-imagesy($pega))/2;
                imagecopy($imageDesc, $pega, $x,$y,0,0,imagesx($pega),imagesy($pega));
                imagedestroy($pega);
            });   

            $fondo->save($dir."confondo640.jpg");

            // agrega marco en 720 x 720
            $banner = $dir.'confondo640.jpg';
            $marco->addFilter(function ($imageDesc) use ($banner) {
                $pega = imagecreatefromjpeg($banner);
                // aca centramos
                $x=(720-imagesx($pega))/2;
                $y=(720-imagesy($pega))/2;
                imagecopy($imageDesc, $pega, $x,$y,0,0,640,640);
                imagedestroy($pega);
            });
            
            // determina fecha y hora para incrustarla y nombrar el archivo
            $Object = new DateTime();  
            $Object->setTimezone(new DateTimeZone('America/Argentina/Buenos_Aires'));
            $DateAndTime = $Object->format("Y-m-d-h-i-s-a");  

            $marco->save($dir."final.jpg");
 
            // ahora le escribimos el qr
            $image = imagecreatefromjpeg($dir."final.jpg");
         
            // Asignar el color para el texto
            $color = imagecolorallocate($image, 0, 0, 0);
            // Asignar la ruta de la fuente
            $font_path = '../../util/fonts/arial.ttf';
            /// imagettftext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text )
            imagettftext($image, 20, 0, 12, 707, $color, $font_path, $qrcode_text); // Colocar el texto 1 en la imagen
            imagettftext($image, 20, 0, 12, 27, $color, $font_path, $DateAndTime.".jpg"); // Colocar el texto 1 en la imagen
         
            imagejpeg($image,$dir."final.jpg"); // Enviar el contenido a un archivo en images/archivo
          
            $archivo = "../../images/def/" . $DateAndTime . ".jpg";
            imagejpeg($image,$archivo); // Enviar el contenido a un archivo en images/archivo
            // si llego hasta aca el archivo esta oka y vuelve el nombre en $msjerror
            $msjerror=$archivo;
        }    
        return $msjerror;
    } // upload oka

} // cerramos la clase
?>
