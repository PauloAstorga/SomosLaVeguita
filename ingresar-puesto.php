<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita - Agregar Producto</title>
    <?php include "resources/php/head-links.php"; ?>
</head>
<body style="background-color: rgb(184,214,74);">
    
<?php include "resources/php/header.php"; ?>

<div class="solucion_contenido">

    <div class="me-0"> 

        <div class="me-0"><p class="text-center  text-uppercase  fs-2 fw-bold text-white">Ingresar Puesto</p></div>

    </div>

    <div class="me-4 ms-4 text-start" style="background-color: rgb(111,132,55);border-radius: 20px;">
        <br>
        <div class="me-5 ms-5"> 

            <form action="puestos/agregar-puestos.php" method="POST" >
                <div class="form-group">
                    <label for="nombre"> <p class="text-white">Nombre </p></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required/>
                </div>

                <div class="form-group">
                    <label for="apellidos"><p class="text-white mt-2">Patente</p></label>
                    <input type="number" class="form-control" id="patente" name="patente" placeholder="Patente" required/>
                </div>

                <div class="form-group">
                    <label for="precio"><p class="text-white mt-2">Foto</p></label>
                    <input type="text" class="form-control" id="foto" name="foto" placeholder="EJ: (URL) https://google.com/imagen.png" required/>
                </div>

                <div class="form-group">
                        <label for="comuna"><p class="text-white mt-2">Comuna </p></label>
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
                    <label for="correo"><p class="text-white mt-2"> Direccion </p></label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="EJ: Progreso 5384" required/>
                </div>

                

                <button type="submit" class="btn btn-success mt-2" style="background-color: rgb(184,214,74);">Agregar Puesto</button>
            </form>

            <div class="input-group mb-3">
                <form action="mis-puestos.php" method="POST">
                    <button type="submit" class="btn btn-danger mt-2">Cancelar</button>
                </form>
            </div>

        </div>
    
    </div>

</div>

<?php include "resources/php/footer.php"; ?>

</body>
</html>