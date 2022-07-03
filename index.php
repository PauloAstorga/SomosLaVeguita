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

<?php include "resources/php/header.php"; ?>


<body style="background-color: rgb(184,214,74);">
    

     <!-- Slider  -->
    <div class="solucion_contenido">
        <div id="carouselExampleInterval" class="carousel slide solucion_carrusel" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="4000">
              <img src="resources/images/img1.png" class="d-block w-100 solucion_imagen" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
              <img src="resources/images/img2.png" class="d-block w-100 solucion_imagen" alt="...">
            </div>
            <div class="carousel-item">
              <img src="resources/images/img3.png" class="d-block w-100 solucion_imagen" alt="...">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
    </div>

 <!-- Contenedor verduras -->
        <div >
            <div id="contenedor_formulario" >
            
                    <div class="container col-12" >
                        <div class="row">
                         <div class="listado col-6">
                           <h3 id="list"   class=" text-uppercase fw-bold text-white" >Productos destacados</h3>
                         </div>
                         <div  class="listado col-6">
                         <a data-toggle="collapse" href="#collapseExample"  role="button" aria-expanded="false" aria-controls="collapseExample" href="#" class="  text-uppercase fw-bold btn text-white"> Ver Detalles de los productos </a>
                         </div>
                         <br>
                         
                        <?php

                        include "DB.php";

                        $consulta = "SELECT * FROM Producto ORDER BY RAND() LIMIT 8";

                        $query_result = mysqli_query($conexion, $consulta);

                        while ($fila = mysqli_fetch_row($query_result)) {?>

                          <div class="col-sm-6 mt-2" style="text-align:center ;" >

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title text-center"><img id="img_obs" src="<?php echo "".$fila[4] ?>" width="150px" height="150px"></h5>
                              <p class="card-text" style="text-align:center ;" ><label id="manzana"> <?php echo "".$fila[1] ?> </label><br>Producto Estrella<br> CLP <?php echo $fila[3] ?> </p>
                              <p class="collapse" id="collapseExample" >
                          <?php echo "".$fila[2] ?>
                          </p>
                              <p class="card-text text-right" >
                                <form action="cuentas/agregar-carro.php" method="POST">
                                  <input type="hidden" name="producto_id" id="producto_id" value="<?php echo "".$fila[0] ?>">
                                  <button type="submit" class="btn text-white" style="background-color: rgb(184,214,74);">Añadir al Carrito</button>
                                </form>
                            </p>
                            </div>
                          </div>
                          </div>

                        <?php
                        }
                        ?>
                        
                       
                       
                        </div>
                      </div>
                    </div>
                 </div>

    
</body>

<?php include "resources/php/footer.php"; ?>

</html>