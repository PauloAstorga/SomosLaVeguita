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
    <!--<div class="d-flex" id="content-wrapper">
         Sidebar 
        <div id="sidebar-container" style="background-color:rgb(111,132,55); margin-top: 4%;";>
            <div class="menu">
                <p  class="d-block text-light p-3 border-0" style="font-size: 24px;"> Locales</p>
                <input class=" ml-4 w-75" type="text" placeholder="Buscar"
                aria-label="Search"> <i class="fas fa-search" aria-hidden="true"></i>   

                <p  class="d-block text-light p-3 border-0"  style="font-size: 24px;"> Categoria</p>
                <input class=" ml-3 w-75" type="text" placeholder="Buscar"
                aria-label="Search"> <i class="fas fa-search" aria-hidden="true"></i>  
            </div>
            
        </div>
         Fin sidebar -->

    
   
 <!-- Contenedor verduras -->
        <div >
            <div class=" w-100" id="contenedor_formulario" >
            
                    <div class="container col-12" >
                        <div class="row">
                         <div class="listado col-12">
                           <h3 id="list"  class=" text-uppercase fw-bold text-white">Locales</h3>
                         </div>
                         <br>
                         <?php
                        
                        include "DB.php";

                        $consulta = "SELECT * FROM puesto";
                        $query_result = mysqli_query($conexion, $consulta);

                        while ($fila = mysqli_fetch_row($query_result)) {
                        ?>
                          <div class="col-sm-6 mt-2" style="text-align:center ;" >
                            <div class="card">
                              <div class="card-body">
                                <h5 class="card-title text-center"><img id="img_obs" src="<?php echo "".$fila[3] ?>" width="200px" height="150px"></h5>
                                <p class="card-text" style="text-align:center ;" ><label id="local1"> LOCAL </label><br>"<?php echo "".$fila[2] ?>"</p>
                                <?php
                                $query = "SELECT * FROM direccion WHERE id = ?";
                                $prepare = mysqli_prepare($conexion, $query);
                                $stmt = mysqli_stmt_bind_param($prepare,"i",$fila[4]);
                                $stmt = mysqli_stmt_execute($prepare);

                                $nombre_direccion = NULL;
                                $stmt = mysqli_stmt_bind_result($prepare, $id, $nombre,$id_comuna);
                                while (mysqli_stmt_fetch($prepare)) {
                                  $nombre_direccion = $nombre;
                                }
                                echo $nombre_direccion;
                                ?>
                                <p class="card-text text-right" >
                                <a href="paginalocal.php?local=<?php echo "".$fila[0] ?>" class="btn text-white" style="background-color: rgb(184,214,74);">Visitar</a>
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
              </div>

    
</body>

<?php include "resources/php/footer.php"; ?>

</html>