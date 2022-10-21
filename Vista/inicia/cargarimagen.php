<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP5</title>
</head>
<body>
<?php include_once "../../util/Estructura/header.php"; ?>

<div class="container mt-2 pb-1">

<p>Esta opción permite cargar un archivo de imagen, si la imagen tiene formato correcto
será retamañada a <mark>640x640</mark> manteniendo su aspecto. Luego se integrara a una imagen de <mark>720x720</mark> centrada.</p>
<p>Si la imagen contiene un código qr válido el marco de la imagen generada será verde, sino contiene
    un código qr válido o no pudo ser leido, el marco será rojo.</p>
<p>Si se detecta un codigo qr valido se incustrara el valor en la imagen.</p>

<!-- Utilizamos metodo post para poder cargar archivos al servidor -->
<form id="cargar" name="cargar" method="post" action="../accion/cargarimagen.php" class="row gx-3 align-items-center needs-validation" enctype="multipart/form-data" novalidate>

<div class="col-6">
    <label for="formFile" class="form-label">Cargar imagen</label>
    <input class="form-control" type="file" name="miFile" id="miFile">
</div>
<div class="row m-2">
</div>
<div class="col-3 align-content-md-end">
     <button class="btn btn-primary" type="submit">Enviar</button>
     <button class="btn btn-primary" type="reset">Borrar</button>
</div>


</form>


</div>

<?php include_once "../../util/Estructura/footer.php"; ?>

</body>

<script src="../../util/js/verif.js"></script>

</html>