<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita</title>
    <?php include "resources/php/head-links.php"; ?>

</head>

<?php session_start(); ?>

<?php
if (isset($_SESSION['ActiveUser'])) {
    $persona = $_SESSION['ActiveUser'];
    if ($persona['id']!=35) {
        header('Location: mi-cuenta.php');
    }
} else {
    header('Location: login.php');
}
?>

<?php include "resources/php/header.php"; ?>


<body style="background-color: rgb(184,214,74);">

    <div class="solucion_contenido">

        <div class="me-0"> 

            <div class="me-0"><p class="text-center fs-1 text-uppercase fw-bold text-white">Gestión De Usuarios</p></div>

        </div>
        
        <div class="me-4 ms-4 text-start" style="background-color: rgb(111,132,55);border-radius: 20px;">

            <br>

            <div class="ms-4"> 

                <div class="ms-4 me-4">

                    <table class="table">

                        <thead>

                            <tr>
                                <th class="text-white" scope="col">ID</th>
                                <th class="text-white" scope="col">Nombre</th>
                                <th class="text-white" scope="col">Apellido</th>
                                <th class="text-white" scope="col">Correo</th>
                                <th class="text-white" scope="col">Rut</th>
                                <th class="text-white" scope="col">Acciones</th>
                            </tr>

                        </thead>
                        
                        <tbody>

                                <?php

                                include "DB.php";

                                $consulta = "SELECT id,nombre, apellido, correo, rut FROM persona";
                                
                                $resultado = mysqli_query($conexion, $consulta);

                                while ($fila = mysqli_fetch_row($resultado)) {
                                ?>
                                <tr>
                                    <td class="text-white" id="id" name="id"><?php echo $fila[0]; ?></td>
                                    <td class="text-white" id="nombre" name="nombre"><?php echo $fila[1] ?></td>
                                    <td class="text-white" id="apellido" name="apellido"><?php echo $fila[2]?></td>
                                    <td class="text-white" id="correo" name="correo"><?php echo $fila[3]; ?></td>
                                    <td class="text-white" id="rut" name="rut"><?php echo $fila[4]; ?></td>
                                    <td class="text-white" id="acciones" name="acciones">
                                        <form id="eliminar_usuario<?php echo $fila[0]; ?>" name="eliminar_usuario<?php echo $fila[0]; ?>" action="cuentas/eliminar-usuario.php" method="POST">
                                            <p>
                                                <input type="hidden" id="codigo" name="codigo" value="<?php echo $fila[0]; ?>"/>
                                                <a href="#" class="btn btn-danger" onclick="eliminarUsuario(<?php echo $fila[0]; ?>)">Eliminar</a>
                                            </p>
                                        </form>
                                        
                                    </td>
                                </tr>
                                
                                <?php
                                }
                                ?>

                        </tbody>

                    </table>
                    
                </div>
            
            </div>
        
        </div>

    </div>
    
</body>

<?php include "resources/php/footer.php"; ?>
 
 </html>