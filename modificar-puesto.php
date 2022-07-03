<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita - Modificar Puesto</title>
    <?php include "resources/php/head-links.php"; ?>
</head>
<body style="background-color: rgb(184,214,74);">
<?php session_start(); ?>
<?php include "resources/php/header.php"; ?>

<div class="solucion_contenido">

    <div class="me-0"> 

        <div class="me-0"><p class="text-center  text-uppercase  fs-2 fw-bold text-white">Modificar Puesto</p></div>

    </div>

    <div class="me-4 ms-4 text-start" style="background-color: rgb(111,132,55);border-radius: 20px;">
        <br>
        <div class="ms-5 me-5"> 

            <?php

            include "DB.php";

            $codigo_puesto = $_POST['puesto_id'];

            $consulta = "SELECT pu.id, pu.patente, pu.nombre, pu.foto, di.nombre, pu.id_vendedor FROM puesto pu, direccion di WHERE pu.id_direccion = di.id AND pu.id = ?"; 

            $resultado = mysqli_prepare($conexion,$consulta);

            $query = mysqli_stmt_bind_param($resultado, "i", $codigo_puesto);
            $query = mysqli_stmt_execute($resultado);

            $query = mysqli_stmt_bind_result($resultado,$id, $patente, $nombre, $foto, $id_direccion, $id_vendedor);

            $producto = NULL;

            while (mysqli_stmt_fetch($resultado)) {

                $puesto = array(
                    'id' => $id,
                    'patente' => $patente,
                    'nombre' => $nombre,
                    'foto' => $foto,
                    'id_direccion' => $id_direccion,
                    'id_vendedor' => $id_vendedor
                );
            }
            ?>

            <form action="puestos/modificar-puesto.php" method="POST">
                <input type="hidden" id="puesto_id" name="puesto_id" value="<?php echo $puesto['id']; ?>">
                <div class="form-group">
                    <label for="nombre"> <p class="text-white"> Nombre </p></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $puesto['nombre']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="patente"> <p class="text-white mt-2"> Patente</p></label>
                    <input type="number" class="form-control" id="patente" name="patente" value="<?php echo $puesto['patente']; ?>" required/>
                </div>

                <div class="form-group">
                        <label for="comuna"><p class="text-white mt-2"> Comuna</p></label>
                        <select class="form-control" id="comuna" name="comuna">
                            <option value="">Seleccione Comuna...</option>
                            <?php

                            include "DB.php";

                            $consulta = "SELECT * FROM comuna";
                            $resultado = mysqli_query($conexion, $consulta);

                            while ($fila = mysqli_fetch_row($resultado)) {
                                ?>
                                    <option value="<?php echo $fila[0] ?>"><?php echo $fila[1] ?></option>
                                <?php
                            }

                            ?>
                        </select>
                </div>

                <div class="form-group">
                    <label for="direccion"><p class="text-white mt-2">Direccion</p></label>
                    <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $puesto['id_direccion']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="rut"><p class="text-white mt-2">Foto </p> </label>
                    <input type="text" class="form-control" id="foto" name="foto" value="<?php echo $puesto['foto']; ?>" required/>
                </div>

                <button type="submit" class="btn btn-success col-2 mt-2" >Guardar Cambios</button>
            </form>

            <div class="input-group mb-3">
                <form action="mis-puestos.php" method="POST">
                    <button type="submit" class="btn btn-danger mt-2 ">Cancelar</button> 
                </form>
            </div>

        </div>
    
    </div>

</div>

<?php include "resources/php/footer.php"; ?>

</body>
</html>