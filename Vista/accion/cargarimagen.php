<?php 
use Libern\QRCodeReader\QRCodeReader;
use Gumlet\ImageResize;
require '../../vendor/autoload.php';
include_once "../../util/Estructura/header.php";
include_once "../../configuracion.php";
$datosqr = data_submitted();
$objQr = new ctrlqr();
?> 

<div class="container mt-2 pb-1">

<div class="col-md-6 ">
            <?php
            $msjerror=$objQr->upload();

            if (strncasecmp("ERROR:", $msjerror , 5) == 0) {
                // es un mensaje que no pudo cargar el archivo
                echo "<p class='bg-danger' style='color: white;'>".$msjerror."</p><br/>";
            } else {
                // estamos chelo, tenemos un archivo oka que puede tener o no un qr
                // para saberlo disparamos el metodo decode en la instancia de objQr
                $qrokfile=$msjerror;
                $qrcode_text=$objQr->decode($qrokfile);

                 echo "<img class=' rounded mx-auto' src='".$qrokfile."' alt='img' style='width: 300px;'></br>";
//                 echo "</br><p class='bg-success' style='color: white;'>Imagen cargada correctamente</p>";
                 echo "<p class='bg-success alert alert-primary d-flex align-items-center' role='alert' style='color: white;'>Imagen cargada correctamente</p>"; 

                 if ( $qrcode_text != NULL ) {
                    if (strncasecmp("http", $qrcode_text , 4) == 0) {
                        echo "<p class='bg-success alert alert-primary d-flex align-items-center' role='alert' style='color: white;'>Contenido del QR:<a class='link-dark' href='".$qrcode_text."' target='_blank' rel='noopener noreferrer'>".$qrcode_text."</a></p>";
                    } else {
                        echo "<p class='bg-success alert alert-primary d-flex align-items-center' role='alert' style='color: white;'>Contenido del QR:"." ".$qrcode_text."</p>"; 
                    }
                 } else {
                    echo "<p class='bg-warning alert alert-primary d-flex align-items-center' role='alert'' style='color: white;'>No se pudieron leer codigos QR</p>";
                 }

            } // upload oka
            ?>
            <a class="btn btn-secondary" href="javascript: history.go(-1)">Volver</a>
    </div>
</div>

<?php include_once "../../util/Estructura/footer.php"; ?>

</body>

<script src="../../util/js/verif.js"></script>

</html>