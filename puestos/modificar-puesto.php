<?php

session_start();

include "../DB.php";
include "../resources/php/ayudas.php";

$persona = $_SESSION['ActiveUser'];

$puesto_id = $_POST['puesto_id'];

$nombre = $_POST['nombre'];
$patente = $_POST['patente'];
$comuna = $_POST['comuna'];
$direccion = $_POST['direccion'];
$foto = $_POST['foto'];

$ingreso_direccion = ingresar_direccion($direccion, $comuna);

$address = obtener_ultima_direccion();

$actualizar = "call Actualizar_Puesto(?,?,?,?,?)";

$resultado = mysqli_prepare($conexion, $actualizar);

$stm = mysqli_stmt_bind_param($resultado, "iissi", $puesto_id, $patente, $nombre, $foto, $address['id']);
$stm = mysqli_stmt_execute($resultado);

if (!$stm) {
    echo mysqli_error($conexion);
}

header('Location: ../mis-puestos.php?modificado=true');

?>