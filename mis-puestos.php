<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita - Mis Puestos</title>
    <?php include "resources/php/head-links.php"; ?>
</head>
<body style="background-color: rgb(184,214,74);">
    
<?php include "resources/php/header.php"; ?>

<?php session_start(); ?>

<div class="solucion_contenido">

        <div class="me-0"> 

            <div class="me-0"><p class="text-center  text-uppercase  fs-2 fw-bold text-white">Mis Puestos</p></div>

        </div>

        <div class="me-4 ms-4 text-start" style="background-color: rgb(111,132,55);border-radius: 20px;">
            <br>
            <div class="ms-4"> 

                <div class="card" style="background-color: rgb(111,132,55); border:none; ">
                    <form class="card-title" method="POST" action="#">
                        <div class="form-group">
                            <label for="buscar"> <p class="text-white">Buscar Puesto </p></label>
                            <input type="text" class="form-control" id="buscar-txt" name="buscar-txt" placeholder="Nombre del Puesto">
                            <button type="submit" class="btn btn-primary mt-2" id="buscar" name="buscar" placeholder="Buscar">Buscar</button>
                        </div>
                    </form>
                    <form class="card-title" method="POST" action="ingresar-puesto.php">
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Agregar</button>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <table class=" text-white table">
                        <thead>
                            <tr>
                                <td>Patente</td>
                                <td>Nombre</td>
                                <td>Foto</td>
                                <td>Direccion</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $persona = $_SESSION['ActiveUser'];

                            include "DB.php";

                            $mis_puestos = "SELECT pu.id,pu.patente, pu.nombre, pu.foto, dir.nombre
                                            FROM puesto pu, vendedor v, persona per, direccion dir
                                            WHERE per.id = v.id_persona
                                            AND v.id = pu.id_vendedor
                                            AND pu.id_direccion = dir.id
                                            AND per.id = ?";
                            
                            $resultado = mysqli_prepare($conexion, $mis_puestos);

                            $sentencia = mysqli_stmt_bind_param($resultado, "i", $persona['id']);
                            $sentencia = mysqli_stmt_execute($resultado);

                            $sentencia = mysqli_stmt_bind_result($resultado,$puesto_id,$puesto_patente, $puesto_nombre, $puesto_foto, $puesto_direccion);
                            while (mysqli_stmt_fetch($resultado)){
                            ?>
                            <tr>
                                <td><?php echo $puesto_patente; ?></td>
                                <td><?php echo $puesto_nombre ?></td>
                                <td><img heigh="100px" width="100px" src="<?php echo $puesto_foto ?>" alt="imagen puesto"></td>
                                <td><?php echo $puesto_direccion ?></td>
                                <td>
                                    
                                        <form id="form-1" action="modificar-puesto.php" method="POST">
                                            <input type="hidden" name="puesto_id" id="puesto_id" value="<?php echo $puesto_id; ?>">
                                            <button type="submit" class="btn btn-warning">Modificar</button>
                                        </form>

                                    
                                        <form id="eliminar_puesto<?php echo $puesto_id; ?>" name="eliminar_puesto<?php echo$puesto_id; ?>" action="puestos/eliminar-puesto.php" method="POST">
                                            <input type="hidden" name="puesto_id" id="puesto_id" value="<?php echo $puesto_id; ?>">
                                            <a href="#" class="btn btn-danger mt-2" onclick="eliminarPuesto(<?php echo $puesto_id; ?>)">Eliminar</a>
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

<?php include "resources/php/footer.php"; ?>

</body>
</html>