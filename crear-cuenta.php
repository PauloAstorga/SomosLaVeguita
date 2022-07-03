<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Somos La Veguita - Login</title>
    <?php include "resources/php/head-links.php"; ?>
</head>
<body style="background-color: rgb(184,214,74);">
    
<?php session_start() ?>

<?php include "resources/php/header.php"; ?>

    <div class="solucion_contenido">

        <div class="me-0"> 

            <div class="me-0"><p class="text-center  text-uppercase  fs-2 fw-bold text-white">Crear Cuenta</p></div>

        </div>

        <div class="me-4 ms-4 text-start" style="background-color: rgb(111,132,55);border-radius: 20px;">
            <br>
            <div class="ms-5 me-5"> 

                <form action="cuentas/crear-cuenta.php" method="POST">
                    <div class="form-group">
                        <label for="nombre"><p class=" mt-2 text-white" >Nombre</p></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required/>
                    </div>

                    <div class="form-group">
                        <label for="apellidos"><p class=" mt-2 text-white" >Apellidos</p></label>
                        <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required/>
                    </div>

                    <div class="form-group">
                        <label for="comuna"><p class=" mt-2 text-white" >Comuna</p></label>
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
                        <label for="direccion"><p class=" mt-2 text-white" >Dirección</p></label>
                        <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion 7676" required/>
                    </div>

                    <div class="form-group">
                        <label for="rut"><p class=" mt-2 text-white" >RUT</p></label>
                        <input type="text" class="form-control" id="rut" name="rut" placeholder="Sin puntos y con guión" required/>
                    </div>

                    <div class="form-group">
                        <label for="correo"><p class=" mt-2 text-white" >Correo Electrónico</p></label>
                        <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@dominio.com" required/>
                    </div>

                    <div class="form-group">
                        <label for="telefono"><p class=" mt-2 text-white" >N° Telefónico </p></label>
                        <input type="text" class="form-control" id="telefono" name="telefono" placeholder="(9) 9999 9999" required/>
                    </div>

                    <div class="form-group">
                        <label for="password"><p class=" mt-2 text-white" >Contraseña </p></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="*********" required/>
                    </div>

                    <div class="form-group">
                        <label for="password"><p class=" mt-2 text-white" >Repita la Contraseña </p></label>
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="**********" required/>
                    </div>

                    <div class="form-group">
                        <label for="tipo"><p class=" mt-2 text-white" >Tipo de Cuenta </p> </label>
                        <select id="tipo" name="tipo" class="form-control">
                            <option value="">Seleccione Tipo de Cuenta...</option>
                            <option value="Cliente" >Cliente</option>
                            <option value="Locatario">Locatario</option>
                        </select>
                    </div>
                    <button type="submit"  class="col-2 btn text-white" style="background-color: rgb(184,214,74);">Registrarse</button>

                    
                </form>

                <div class="mb-4 mt-2">
                
                <form action="index.php" method="POST"> <div class="input-group mb-4 col-md-2 mt-2">
                <button type="submit" class="btn btn-danger">Cancelar</button>
                </form>
                
                
                    
                </div>

            </div>
          
        </div>

    </div>

<?php include "resources/php/footer.php"; ?>

</body>
</html>