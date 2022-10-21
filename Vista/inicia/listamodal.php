<?php include_once "../../util/Estructura/header.php"; ?>
<?php include_once "../../configuracion.php"; ?> 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="../../util/bootstrap-5.2.0-dist/js/bootstrap.bundle.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 

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
//              $archivo=$arreglo[1]; // para hacer pruebas de un solo elemento
              if (strlen($archivo)>2 && strpos($archivo, "jpg")>=0 )
              {
                $qrcode_text=$objQr->decode($directorio.$archivo);
                echo "<div class='col-lg-2 col-md-3 col-sm-4  mb-3'>";
                echo "<button type='button' id='btnmodal' class='' data-toggle='modal' data-target='#exampleModal' data-nom='".$directorio.$archivo."' data-txtqr='".$qrcode_text."'>";
                echo "<img alt='".$archivo."' class='card-img-top rounded' src='".$directorio.$archivo."'  width='100%' height='100%'>";
                echo "</button>";  
                echo "</div>";
               }
            }
            ?> 
        </div>
    <a class="btn btn-secondary" href="javascript: history.go(-1)">Volver</a>
</div>


<script >
	$(document).on("click", "#btnmodal",function () {
        /* toma datos del	boton	*/
        var nombre =$(this).data('nom');
        var txtqr=$(this).data('txtqr')
        /* llena los div del form modal - imagen*/
        var contenido="<img src='"+nombre+"' class='card-img-top rounded'>"
        document.getElementById('imagenqr').innerHTML=contenido;
        /* llena los div del form modal - text*/
        if (txtqr.substring(0, 4)=="http") {
           var contenido="<p class='bg-success' style='color: white;'>QR=<a class='link-dark' href='"+txtqr+"' target='_blank' rel='noopener noreferrer'>"+txtqr+"</a></p>";
        } else {
           var contenido="<p>QR="+txtqr+"</p>"; 
        }
        document.getElementById('txtqr').innerHTML=contenido;
	})
</script>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos de la imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
           <div class="col-lg-12">
               <div id="imagenqr"></div>
               <div id="txtqr"></div>
           </div>
        </div>
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<?php include_once "../../util/Estructura/footer.php"; ?>

