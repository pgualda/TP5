<?php include_once "../../util/Estructura/header.php"; ?>
<?php include_once "../../configuracion.php"; ?> 

<?php
$objQr=new ctrlqr();
$arreglo=$objQr->listar(); 
$directorio="../../images/def/";
?>
<div class="container mt-2 pb-1">
    <h1 class="h2">Imagenes procesadas</h1>
        <div class="row mb-3">
            <?php
            foreach ($arreglo as $archivo)
            {
                if (strlen($archivo)>2 && strpos($archivo, "jpg")>=0 )
                {
                    echo "<div class='col-lg-2 col-md-3 col-sm-4  mb-3'>";
                    // hace un a href que contiene adentro la imagen y la envia a un form mostrarimagen como parametro
                    // href="accion/autosPersona.php?NroDni='.$objPersona->getnrodni().'"
//                    echo "<a href='../accion/mostrarimgen.php?archivo=45'>";        //.$pepe."'>";
                    echo "<a href='../accion/mostrasrimagen.php?archivo=".$directorio.$archivo."'>";
                    echo "<img alt='".$archivo."' class='card-img-top rounded' src='".$directorio.$archivo."'  width='100%' height='100%'>";
                    echo "</a>";
                    echo "</div>";
                }
            }
            ?>
        </div>
    <a class="btn btn-secondary" href="javascript: history.go(-1)">Volver</a>
</div>

<?php include_once "../../util/Estructura/footer.php"; ?>
