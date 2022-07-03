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

<?php include "resources/php/redirect-no-login.php"; ?>

<body style="background-color: rgb(184,214,74);">
    
    <div class="solucion_contenido">

        <div class="me-0"> 

            <div class="me-0"><p class="text-center fs-1 text-uppercase fw-bold text-white">Mi cuenta</p></div>

        </div>

        <div class="me-4 ms-4 text-start" style="background-color: rgb(111,132,55);border-radius: 20px;">
            <br>
            <div class="ms-4"> 

                <?php
                include "DB.php";

                $persona = $_SESSION['ActiveUser'];
                ?>
                <p class="fs-6 text-white">Hola <label for=""> <?php echo $persona['nombre']." ".$persona['apellido']; ?></label> </p> <!--AQUI VA EL NOMBRE DEL USUARIO-->
                <p><a class="link-light" href="index.php">Inicio</a></p>
                <p ><a class="link-light"  href="modificar-usuario.php"> Modificar mi Cuenta</a></p>

                <?php
                if (isset($_SESSION['ActiveUser'])) {

                    $persona = $_SESSION['ActiveUser'];

                    include "resources/php/obtener-tipo-persona.php";

                    $es_locatario = obtener_tipo_persona($persona['id']);

                    if ($es_locatario!=NULL){
                    ?>

                    <p><a class="link-light" href="mis-productos.php"> Mis Productos</a></p>
                    <p><a class="link-light" href="mis-puestos.php">Mis Puestos</a></p>

                    <?php
                    }
                }
                ?>

                <div class="input-group mb-3">
                    <form action="cuentas/cerrar-sesion.php" method="POST">
                        <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
                    </form>
                </div>

            </div>
          
        </div>

    </div>

</body>

<?php include "resources/php/footer.php"; ?>
 
</html>