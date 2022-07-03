<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita - Login</title>
    <?php include "resources/php/head-links.php"; ?>
</head>
<body style="background-color: rgb(184,214,74);">
    
<?php session_start() ?>

<?php if (isset($_SESSION['ActiveUser'])) {
    $persona = $_SESSION['ActiveUser'];
    if ($persona['correo']!=NULL){
        header('Location: index.php');
    }
} ?>

<?php include "resources/php/header.php"; ?>

    <div class="solucion_contenido">

        <div class="me-0"> 

            <div class="me-0"><p class="text-center fs-2 text-uppercase fw-bold text-white">Ingresar a su Cuenta</p></div>

        </div>

        <div class="col-10 text-start" style="background-color: rgb(111,132,55);border-radius: 20px; margin:auto;">
            
            <div class="ms-5 col-10"> 

                <form action="cuentas/verifica-login.php" method="POST">
                    <div class="form-group">
                        <label for="correo"><p class=" mt-2 text-white" >Correo Electrónico o RUT </p></label>
                        <input type="text" class="form-control" id="correo" name="correo" placeholder="correo@dominio.com" required/>
                    </div>

                    <div class="form-group">
                        <label for="password"><p class=" mt-2 text-white" >Contraseña </p></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="***********" required/>
                    </div>

                    <div class="d-flex flex-row justify-content-center">
                        <button type="submit" class="btn btn-success col-md-2 mt-2 text-white " style="background-color: rgb(184,214,74);">Ingresar</button>

                        <a class="btn btn-primary col-md-3 mt-2" href="recuperar-contrasena.php">¿Olvidó su Contraseña?</a>

                        <a class="btn btn-secondary col-md-2 mt-2" href="crear-cuenta.php">Cree una cuenta</a>
                    </div>
                </form>

                <form action="index.php" method="POST"> <div class="input-group mb-4 col-md-2 mt-2">
                    <button type="submit" class="btn btn-danger">Salir</button>
                </form>

            </div>
          
        </div>

    </div>

<?php include "resources/php/footer.php"; ?>



</body>
</html>