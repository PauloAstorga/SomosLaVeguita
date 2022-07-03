<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita - Modificar Perfil</title>
    <?php include "resources/php/head-links.php"; ?>
</head>
<body style="background-color: rgb(184,214,74);">
    <?php session_start(); ?>
    <?php include "DB.php"; ?>
    <?php include "resources/php/header.php"; ?>

    <div class="solucion_contenido">

        <div class="me-0"> 

            <div class="me-0"><p class="text-center fs-1 text-uppercase fw-bold text-white">Modificar su Perfil</p></div>

        </div>

        <div class="me-4 ms-4 text-start" style="background-color: rgb(111,132,55);border-radius: 20px;">
            <br>
            <div class="ms-5 me-5"> 
                <?php
                $persona = $_SESSION['ActiveUser'];
                ?>
                <form id="modificar_usuario" name="modificar_usuario" action="cuentas/guardar-cambios.php" method="POST">

                    <div class="form-group">
                        <label for="rut"> <p class=" mt-2 text-white" >RUT </p></label>
                        <input type="text" class="form-control" id="rut" name="rut" value="<?php echo $persona['rut']; ?>" disabled/>
                        <input type="hidden" id="rut2" name="rut2" value="<?php echo $persona['rut']; ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="nombre"><p class=" mt-2 text-white" >Nombre</p></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $persona['nombre'] ?>" required/>
                    </div>

                    <div class="form-group">
                        <label for="apellidos"><p class=" mt-2 text-white" >Apellidos</p></label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $persona['apellido']; ?>" required/>
                    </div>

                    <div class="form-group">
                        <label for="comuna"><p class=" mt-2 text-white" >Comuna </p></label>
                        <select class="form-control" id="comuna" name="comuna">
                            <option value="">Seleccione Comuna...</option>
                            <?php

                            $consulta = "SELECT * FROM comuna";
                            $resultado = mysqli_query($conexion, $consulta);

                            while ($fila = mysqli_fetch_row($resultado)) {
                                ?>
                                    <option value="<?php echo $fila[0] ?>"><?php echo $fila[1] ?></option>
                                <?php
                            }
                            $resultado->free_result();
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php
                        
                        $consulta = "SELECT * FROM direccion WHERE id = ?";

                        $resultado = mysqli_prepare($conexion, $consulta);

                        $stm = mysqli_stmt_bind_param($resultado, "i", $persona['direccion']);
                        $stm = mysqli_stmt_execute($resultado);

                        if (!$stm) {
                            echo "Error con datos de Direccion; ".mysqli_error($conexion);
                        }

                        $stm = mysqli_stmt_bind_result($resultado, $dir_id, $dir_nombre, $dir_comuna);
                        $nombre_direccion = NULL;
                        while (mysqli_stmt_fetch($resultado)) {
                            $nombre_direccion = $dir_nombre;
                        }
                        $resultado->free_result();
                        ?>
                        <label for="direccion"><p class=" mt-2 text-white" >Dirección</p></label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $nombre_direccion; ?>" required/>
                    </div>

                    <div class="form-group">
                        <label for="correo"><p class=" mt-2 text-white" >Correo Electrónico</p></label>
                        <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $persona['correo']; ?>" required/>
                    </div>

                    <div class="form-group">
                        <label for="telefono"><p class=" mt-2 text-white" >N° Telefónico </p></label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $persona['telefono']; ?>" required/>
                    </div>

                    <div class="form-group">
                        <label for="password"><p class=" mt-2 text-white" >Contraseña Antigua </p></label>
                        <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="*********" required/>
                    </div>

                    <div class="form-group">
                        <label for="password"><p class=" mt-2 text-white" >Nueva Contraseña </p></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="**********" required/>
                    </div>

                    <div class="form-group">
                        <label for="password"><p class=" mt-2 text-white" >Repita la Nueva Contraseña </p> </label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="**********" required/>
                    </div>

                    <a href="#" class="col-2 mt-2 text-white btn btn-success" onclick="guardarCambios()">Guardar Cambios</a>
                </form>

                <div class="input-group mb-3 mt-2">
                    <form action="mi-cuenta.php">
                        <button  type="submit" class="btn btn-danger">Cancelar</button>
                    </form>
                </div>

            </div>
          
        </div>

    </div>

    <?php include "resources/php/footer.php"; ?>
</body>
</html>