<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita</title>
    <?php include "resources/php/head-links.php"; ?>

</head>

<?php session_start() ?>

<?php include "resources/php/header.php"; ?>

<body style="background-color: rgb(184,214,74);">
    
<div class="solucion_contenido">

<div class="me-0"> 

    <div class="me-0"><p class="text-center fs-2 text-uppercase fw-bold text-white">Recuperar Contraseña</p></div>

</div>

<div class="col-10 text-start" style="background-color: rgb(111,132,55);border-radius: 20px; margin:auto;">
    
    <div class="ms-5 col-10"> 

        <form action="#" method="POST">
            <div class="form-group">
                <label for="correo"><p class=" mt-2 text-white" >Correo Electrónico o RUT </p></label>
                <input type="text" class="form-control" id="correo" name="correo" placeholder="correo@dominio.com" required/>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success col-md-2 mt-2 text-white mx-auto" style="background-color: rgb(184,214,74);">Recuperar Contraseña</button>
            </div>
        </form>

        <form action="login.php" method="POST"> <div class="input-group mb-4 col-md-2 mt-2">
            <button type="submit" class="btn btn-danger">Volver</button>
        </form>

    </div>
  
</div>

</div>

</body>

<?php include "resources/php/footer.php"; ?>
 
</html>