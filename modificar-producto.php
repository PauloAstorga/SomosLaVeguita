<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita - Modificar Producto</title>
    <?php include "resources/php/head-links.php"; ?>
</head>
<body style="background-color: rgb(184,214,74);">
<?php session_start(); ?>
<?php include "resources/php/header.php"; ?>

<div class="solucion_contenido">

    <div class="me-0"> 

        <div class="me-0"><p  class="text-center fs-2 text-uppercase fw-bold text-white">Modificar Producto</p></div>

    </div>

    <div class="me-5 ms-5 text-start" style="background-color: rgb(111,132,55);border-radius: 20px;">
        <br>
        <div class=" me-4 ms-4 "> 

            <?php

            include "DB.php";

            $codigo_producto = $_POST['producto_id'];

            $consulta = "SELECT * FROM producto WHERE id =?";

            $resultado = mysqli_prepare($conexion,$consulta);

            $query = mysqli_stmt_bind_param($resultado, "i", $codigo_producto);
            $query = mysqli_stmt_execute($resultado);

            $query = mysqli_stmt_bind_result($resultado,$id, $nombre, $descripcion, $precio, $foto, $id_categoria, $stock);

            $producto = NULL;

            while (mysqli_stmt_fetch($resultado)) {

                $producto = array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'precio' => $precio,
                    'foto' => $foto,
                    'id_categoria' => $id_categoria,
                    'stock' => $stock
                );
            }
            ?>

            <form action="productos/modificar-productos.php" method="POST">
                <input type="hidden" id="producto_id" name="producto_id" value="<?php echo $codigo_producto; ?>">
                <div class="form-group">
                    <label for="nombre"><p class="text-white ">Nombre</p></label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $producto['nombre']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="apellidos"><p class="text-white mt-2" >Descripción</p></label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $producto['descripcion']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="categoria"><p class="text-white mt-2" >Categoría</p></label>
                    <select class="form-control" id="categoria" name="categoria">
                        <option value="">Seleccione Categoría...</option>
                        <?php

                        include "DB.php";

                        $consulta = "SELECT * FROM categoria";
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
                    <label for="precio"><p class="text-white mt-2" >Precio</p></label>
                    <input type="number" class="form-control" id="precio" name="precio" value="<?php echo $producto['precio']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="rut"><p class="text-white mt-2" >Foto</p></label>
                    <input type="text" class="form-control" id="foto" name="foto" value="<?php echo $producto['foto']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="correo"><p class="text-white mt-2" >Stock </p></label>
                    <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $producto['stock']; ?>" required/>
                </div>

                <div class="form-group">
                    <label for="puesto"><p class="text-white mt-2" >Puesto </p></label>
                    <select class="form-control" id="puesto" name="puesto">
                        <option value="">Seleccione un Puesto...</option>
                        <?php

                            $persona = $_SESSION['ActiveUser'];

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
                                <option value="<?php echo $puesto_id ?>"><?php echo $puesto_nombre ?></option>
                            <?php
                        }

                        ?>
                    </select>
                </div>

                <button type="submit"  class="btn btn-success mt-2 col-3" style="background-color: rgb(184,214,74)">Guardar Cambios</button>
            </form>

            <div class="input-group mb-3">
                <form action="mis-productos.php" method="POST">
                    <button type="submit" class="btn btn-danger mt-2" >Cancelar</button>
                </form>
            </div>

        </div>
    
    </div>

</div>

<?php include "resources/php/footer.php"; ?>

</body>
</html>