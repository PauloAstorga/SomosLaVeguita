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

if (!isset($_SESSION['carrito'])) {
    header('Location: index.php');
}
$carro = $_SESSION['carrito'];

if ($carro==NULL){
    header('Location: index.php');
}

?>

<?php include "resources/php/header.php"; ?>

<body style="background-color: rgb(184,214,74);">

    <div class="solucion_contenido">

        <div class="me-0"> 

            <div class="me-0"><p class=" fs-1 text-uppercase fw-bold text-white text-center">Carrito</p></div>
  
        </div>
        
        <div class="me-4 ms-4 text-start " style="background-color: rgb(111,132,55);border-radius: 20px;">

            <br>

            <div class="ms-4"> 

                <div class="ms-4 me-4">

                    <table class="table">

                        <thead>

                            <tr>
                                <th class="text-white" scope="col">Producto</th>
                                <th class="text-white" scope="col">Precio</th>
                                <th class="text-white" scope="col">Cantidad</th>
                                <th class="text-white" scope="col">Subtotal</th>
                                <th class="text-white" scope="col">Acciones</th>
                            </tr>

                        </thead>
                        
                        <tbody>
                            <?php

                            include "DB.php";

                            

                            $cod = NULL;
                            $suma = 0;

                            foreach($carro AS $item) {
                                $cod = $item;
                                $consulta = "SELECT * FROM producto WHERE id=?";
                                $resultado = mysqli_prepare($conexion,$consulta);

                                $stm = mysqli_stmt_bind_param($resultado, "i", $cod);
                                $stm = mysqli_stmt_execute($resultado);
                                $stm = mysqli_stmt_bind_result($resultado, $id, $nombre, $descripcion, $precio, $foto, $id_categoria, $stock);
                                
                                while (mysqli_stmt_fetch($resultado)) {
                                    ?>
                                    <tr>
                                        <td class="text-white"><?php echo $nombre; ?></td>
                                        <td class="text-white"><?php echo "CLP ".$precio; ?></td>
                                        <td class="text-white"><?php echo 1; ?></td>
                                        <td class="text-white"><?php echo "CLP ".$precio*1; ?></td>
                                        <td class="text-white">
                                            <form action="cuentas/eliminar-carro.php" method="POST">
                                                <input type="hidden" value="<?php echo $id; ?>" id="codigo_producto" name="codigo_producto">
                                                <button class="btn btn-danger" type="submit">Eliminar</button>
                                            </form>
                                        </td>
                                        <?php $suma = $suma + $precio; ?>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                            
                            ?>

                        </tbody>

                    </table>

                </div>

                <div class="me-4 ms-4" style="background-color: rgb(184,214,74); width: 200px;border-radius: 20px;">
                    
                    <div class="me-0"> 

                        <div class="me-0">
                            <br>
                            <p class=" text-white text-center fs-6">Subtotal: <?php echo "CLP ".$suma*1; ?></p>
                        </div>
                        <label for=""></label>
              
                    </div>

                    <div class="me-0"> 

                        <div class="me-0"><p class="text-white text-center fs-6">Envio: <?php echo "CLP "; $envio = 5000; echo $envio; ?></p></div>

                    </div>

                    <div class="me-0"> 

                        <div class="me-0"><p class=" text-white text-center fs-6">Total: <?php echo "CLP " ;echo intval($envio)+intval($suma); ?></p></div>
                        <label  for=""></label>

                    </div>

                </div>

                <br>

                <div class="d-flex flex-column ms-4 input-group mb-3">
                    <div class="mb-3">
                        <form action="cuentas/carrito-eliminar.php" method="POST">
                            <button type="submit" class="btn btn-warning">Eliminar Carrito</button>
                        </form>
                    </div>
                    <?php $action = isset($_SESSION['ActiveUser'])&&isset($_SESSION['carrito'])?"https://www.paypal.com/cgi-bin/webscr":"login.php";  ?>
                    <form target="_blank" action="<?php echo $action; ?>" method="post" target="_top">
                        <button type="submit" class="btn btn-success text-white">Finalizar Compra</button>
                  </form>

                </div>

            </div>
          
        </div>

    </div>

</body>


<?php include "resources/php/footer.php"; ?>
 
 </html>