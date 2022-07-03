<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita - Mis Productos</title>
    <?php include "resources/php/head-links.php"; ?>
</head>
<body style="background-color: rgb(184,214,74);">
    
<?php include "resources/php/header.php"; ?>

<?php session_start(); ?>

<div class="solucion_contenido">

        <div class="me-0"> 

            <div class="me-0"><p class="text-center fs-2 text-uppercase fw-bold text-white">Mis Productos</p></div>

        </div>

        <div class="me-4 ms-4 text-start " style="background-color: rgb(111,132,55);border-radius: 20px;">
            <br>
            <div class="me-4 ms-4"> 

                <div class="card" style="background-color: rgb(111,132,55); border:none; ">
                    <form class="card-title " method="POST" action="#">
                        <div class="form-group">
                            <label for="buscar">  <p class="text-white">Buscar Producto</p></label>
                            <input type="text" class="form-control me-3" id="buscar-txt" name="buscar-txt" placeholder="Nombre del Producto">
                            <button type="submit" class="btn btn-primary mt-2" id="buscar" name="buscar" placeholder="Buscar">Buscar</button>
                        </div>
                    </form>
                    <form class="card-title" method="POST" action="ingresar-productos.php">
                        <div class="form-group">
                            <button type="submit" class="btn btn-danger">Agregar</button>
                        </div>
                    </form>
                </div>

                <div class="card-body ">
                    <table class="table text-white">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>Descripcion</td>
                                <td>Precio</td>
                                <td>Foto</td>
                                <td>Stock</td>
                                <td>Puesto</td>
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php


                            $persona = $_SESSION['ActiveUser'];

                            include "DB.php";

                            $mis_productos = "SELECT p.id,p.nombre, p.descripcion, p.precio, p.foto, p.stock, pu.nombre
                                            FROM producto p, productos_puestos pp, puesto pu, vendedor v, persona per
                                            WHERE per.id = v.id_persona
                                            AND v.id = pu.id_vendedor
                                            AND pu.id = pp.id_puesto
                                            AND pp.id_producto = p.id
                                            AND per.id = ?";
                            
                            $resultado = mysqli_prepare($conexion, $mis_productos);

                            $sentencia = mysqli_stmt_bind_param($resultado, "i", $persona['id']);
                            $sentencia = mysqli_stmt_execute($resultado);

                            $sentencia = mysqli_stmt_bind_result($resultado,$producto_id,$nombre, $descripcion, $precio, $foto, $stock, $puesto_nombre);
                            while (mysqli_stmt_fetch($resultado)){
                            ?>
                            <tr>
                            <td><?php echo $nombre; ?></td>
                            <td><?php echo $descripcion ?></td>
                            <td><?php echo $precio ?></td>
                            <td><img width="100px" height="100px" src="<?php echo $foto ?>" alt="imagen producto"></td>
                            <td><?php echo $stock ?></td>
                            <td><?php echo $puesto_nombre ?></td>
                            <td>
                                    <form id="modificar" name="modificar" action="modificar-producto.php" method="POST">
                                        <input type="hidden" name="producto_id" id="producto_id" value="<?php echo $producto_id; ?>">
                                        <button href="#" class="btn btn-warning mt-2">Modificar</button>
                                    </form>
                                
                                
                                    <form id="eliminar_producto<?php echo $producto_id; ?>" name="eliminar_producto<?php echo $producto_id; ?>" action="productos/eliminar-productos.php" method="POST">
                                        <input type="hidden" name="producto_id" id="producto_id" value="<?php echo $producto_id; ?>">
                                        <a href="#" class="btn btn-danger mt-2" onclick="eliminarProducto(<?php echo $producto_id; ?>)">Eliminar</a>
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