<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita - Locales</title>
    <?php include "resources/php/head-links.php"; ?>
    
</head>

<?php session_start() ?>

<?php include "resources/php/header.php"; ?>

<body style="background-color: rgb(184,214,74);">
    <div class="d-flex" id="content-wrapper">
        <!-- Sidebar -->
        <div id="sidebar-container" style="background-color:rgb(111,132,55); margin-top: 4%;";>
            <div class="logo">
                <h4 class="text-light font-weight-bold mb-0">Categoria</h4>
            </div>
            <div class="menu">
              <?php
              include "DB.php";

              $consulta = "SELECT * FROM categoria";
              $s = mysqli_query($conexion, $consulta);

              while ($fila = mysqli_fetch_row($s)) {
              ?>

                <a href="#" class="d-block text-light p-3 border-0"><?php echo $fila[1] ?></a>

              <?php
              }
              $s->free_result();
              ?>
            </div>
            
        </div>
         
        <!-- Fin sidebar -->

    
   
 <!-- Contenedor verduras -->
        <div >
            <div class=" w-100" id="contenedor_formulario" >
            
                    <div class="container col-12" >
                        <div class="row">
                         <div class="listado col-12" >
                          
                        <?php


                        $id_local = $_GET['local'];

                        if (!isset($id_local)) {
                          header("Location: locales.php");
                        }

                        $consulta = "SELECT * FROM puesto WHERE id = ?";

                        $resultado = mysqli_prepare($conexion, $consulta);

                        $stmt = mysqli_stmt_bind_param($resultado, "i", $id_local);
                        $stmt = mysqli_stmt_execute($resultado);

                        $stmt = mysqli_stmt_bind_result($resultado, $id, $patente, $nombre, $foto, $dir_id, $vendedor_id);

                        $id_direccion = NULL;

                        while (mysqli_stmt_fetch($resultado)){
                          ?>
                            <h3 class="text-uppercase fw-bold text-white" id="list"><img src="<?php echo "".$foto ?>" alt="local" width="50px" height="50px">Local "<?php echo "".$nombre ?>"</h3>
                          <?php
                          $id_direccion = $dir_id;
                        }

                        $resultado->free_result();

                        $query = "SELECT * FROM direccion WHERE id = ?";

                        $resultado = mysqli_prepare($conexion, $query);

                        $stm = mysqli_stmt_bind_param($resultado, "i", $id_direccion);
                        $stm = mysqli_stmt_execute($resultado);

                        $stm = mysqli_stmt_bind_result($resultado, $id, $nombre, $id_comuna);
                        $nombre_direccion = NULL;
                        while (mysqli_stmt_fetch($resultado)) {
                          $nombre_direccion = $nombre;
                        }
                        $resultado -> free_result();
                        ?>
                        </h3>
                        <p class="text-uppercase fw-bold text-white">Ubicado en <?php echo "".$nombre_direccion; ?></p>
                           
                         </div>
                         <br>

                        <?php

                        $tiene_productos = false;

                        $query = "SELECT * FROM productos_puestos WHERE id_puesto = ?";
                        $resultado = mysqli_prepare($conexion, $query);

                        $prepare = mysqli_stmt_bind_param($resultado, "i", $id_local);
                        $prepare = mysqli_stmt_execute($resultado);

                        $prepare = mysqli_stmt_bind_result($resultado, $id_puesto, $id_producto);
                        $productos_id = array();

                        

                        while (mysqli_stmt_fetch($resultado)) {
                          array_push($productos_id, $id_producto);
                          $tiene_productos = true;
                        }

                        $resultado -> free_result();

                        if (!$tiene_productos) {
                          ?>
                            <div>
                              <h3 class="text-white text-center">
                                No hay productos para este local aún
                              </h3>
                            </div>
                          <?php
                        } else {
                          $query_productos = "SELECT * FROM producto WHERE id IN (".implode(',', array_map('intval',$productos_id)).")";
                          $resultado = mysqli_query($conexion, $query_productos);

                          while ($fila = mysqli_fetch_row($resultado)) {
                            ?>

                            <div class="col-sm-6 mt-2" style="text-align:center ;" >
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title text-center"><img id="img_obs" src="<?php echo $fila[4] ?>" width="100px" height="100px"></h5>
                                <p class="card-text" style="text-align:center ;" ><label id="producto1"> <?php echo $fila[1] ?> </label><br> <?php echo $fila[2] ?><br> CLP <?php echo $fila[3] ?></p>
                                <p class="card-text text-right" >
                                <form action="cuentas/agregar-carro.php" method="POST">
                                    <input type="hidden" name="producto_id" id="producto_id" value="<?php echo "".$fila[0] ?>">
                                    <button type="submit" class="btn text-white" style="background-color: rgb(184,214,74);">Añadir al Carrito</button>
                                  </form> 
                              </div>
                            </div>
                          </div>

                            <?php
                          }
                        }
                        ?>

                        </div>
                      </div>
                    </div>
                 </div>
              </div>

    
</body>

<?php include "resources/php/footer.php"; ?>

</html>