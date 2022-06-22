<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Somos La Veguita</title>
	<?php include "head.php"; ?>
</head>
<body style="background-color: rgb(184,214,74);">

<?php include "header.php"; ?>

<div id="container">

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
                         <div class="listado col-12">
                           <h3 id="list">Productos destacados</h3>
                         </div>
                         <br>
                         
                        <?php

						foreach ($productos as $item) {?>

                          <div class="col-sm-3" style="text-align:center ;" >

                          <div class="card">
                            <div class="card-body">
                              <h5 class="card-title text-center"><img id="img_obs" src="<?php echo $item->foto ?>" width="100px" height="100px"></h5>
                              <p class="card-text" style="text-align:center ;" ><label id="manzana"> <?php echo $item->nombre ?> </label><br>Producto Estrella<br> CLP <?php echo $item->precio ?> </p>
                              <p class="collapse" id="collapseExample" >
                          <?php echo $item->descripcion ?>
                          </p>
                              <p class="card-text text-right" >
                              <a data-toggle="modal" data-target="#exampleModal3"  href="#" class="btn" style="background-color: rgb(184,214,74);">Añadir al Carrito</a>
                              <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" href="#" class="btn bt-success">Más >></a>
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


<?php include "footer.php"; ?>

</body>
</html>
