<?php include_once "../../util/Estructura/header.php"; ?>
<?php include_once "../../configuracion.php"; ?> 
<?php
$datosArchivo = data_submitted();
$objQr=new ctrlqr();
$qrfile=$datosArchivo['archivo'];
?>

<div class="container mt-2 pb-1">

<div class="col-md-6 ">
            <?php
                $qrcode_text=$objQr->decode($qrfile);

                 echo "<img class=' rounded mx-auto' src='".$qrfile."' alt='img' style='width: 720px;'></br>";
                 if ( $qrcode_text != NULL ) {
                    if (strncasecmp("http", $qrcode_text , 4) == 0) {
//                        echo "<p class='bg-success' style='color: white;'>Contenido del qr:<a class='link-dark' href='".$qrcode_text."' target='_blank' rel='noopener noreferrer'>".$qrcode_text."</a></p>";
//                    } else {
//                        echo "<p class='bg-success' style='color: white;'>Contenido del qr:".$qrcode_text."</p>"; 
//                    }
//                 } else {
//                    echo "<p class='bg-warning' style='color: white;'>No se pudieron leer codigos qr</p>";
//                 }

                 echo "<p class='bg-success alert alert-primary d-flex align-items-center' role='alert' style='color: white;'>Contenido del QR:<a class='link-dark' href='".$qrcode_text."' target='_blank' rel='noopener noreferrer'>".$qrcode_text."</a></p>";
                } else {
                    echo "<p class='bg-success alert alert-primary d-flex align-items-center' role='alert' style='color: white;'>Contenido del QR:"." ".$qrcode_text."</p>"; 
                }
             } else {
                echo "<p class='bg-warning alert alert-primary d-flex align-items-center' role='alert'' style='color: white;'>No se pudieron leer codigos QR</p>";
             }


            ?>
            <a class="btn btn-secondary" href="javascript: history.go(-1)">Volver</a>
    </div>
</div>

<?php include_once "../../util/Estructura/footer.php"; ?>

