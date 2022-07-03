<?php

include "../DB.php";
include "../resources/php/validaciones.php";

session_start();

/*Recepción de datos via POST Request*/

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$rut = $_POST['rut'];
$tipo = $_POST['tipo']; /*Recibe String del Tipo; EJ: 'Locatario' o 'Cliente'*/
$comuna = $_POST['comuna']; /*Recibe ID de Comuna*/
$direccion = $_POST['direccion'];

$tipos = array("Cliente","Locatario");

$pwd = md5($_POST['password']);
$pwd2 = md5($_POST['password2']);

/*Comprobación de campos según restricciones de la BD*/

$datos_invalidos = validar_crear_cuenta($nombre, $apellidos, $correo, $telefono, $rut, $tipo, $tipos, $direccion, $comuna, $pwd, $pwd2);

if ($datos_invalidos){ /*No coinciden*/

    header("Location: ../crear-cuenta.php?error=true");
    die();
    
} else {
    
    /*Query para retrieve de datos recien ingresados*/
    $query_direccion = "SELECT * FROM direccion ORDER BY id DESC LIMIT 1";
    $query_persona = "SELECT * FROM persona ORDER BY id DESC LIMIT 1";

    /*Ingresar Direccion*/
    $ingresar_direccion = "call Ingresar_Direccion (?,?)";
    $resultado = mysqli_prepare($conexion, $ingresar_direccion);

    $stmt = mysqli_stmt_bind_param($resultado, "si", $direccion, $comuna);
    $stmt = mysqli_stmt_execute($resultado);

    $resultado -> free_result();

    $resultado = mysqli_query($conexion, $query_direccion);
    
    $id_direccion = NULL;

    while ($fila = mysqli_fetch_row($resultado)) {
        $id_direccion = $fila[0];
    }

    /*Ingresar Persona*/
    $ingresar_persona = "call Ingresar_Persona(?,?,?,?,?,?,?)";
    $resultado = mysqli_prepare($conexion, $ingresar_persona);

    $query = mysqli_stmt_bind_param($resultado, "ssssssi",$rut, $nombre, $apellidos, $correo, $telefono, $pwd, $id_direccion);
    $query = mysqli_stmt_execute($resultado);

    if (!$query) {
        echo "Error con ingresar persona. ".mysqli_error($conexion);
        header('Location: ../crear-cuenta.php?error=true');
    }

    $resultado -> free_result();

    $resultado = mysqli_query($conexion, $query_persona);
    
    $id_persona = NULL;

    while ($fila = mysqli_fetch_row($resultado)) {
        $id_persona = $fila[0];
    }

    /*Ingresar Locatario o Cliente*/
    $ingresar_user = $tipo=="Locatario"?"call Ingresar_Locatario (?)":"call Ingresar_Cliente (?)";

    $resultado = mysqli_prepare($conexion, $ingresar_user);
    
    $query_ingreso = mysqli_stmt_bind_param($resultado, "i", $id_persona);
    $query_ingreso = mysqli_stmt_execute($resultado);

    $resultado->free_result();

    header('Location: ../login.php?creada=true');

}

?>