<?php

session_start();

include "../DB.php";

$persona = $_SESSION['ActiveUser'];

$codigo_producto = $_POST['producto_id'];

$query = "call Eliminar_ProductosPuestos_Prod(?)";

$resultado = mysqli_prepare($conexion, $query);

$st = mysqli_stmt_bind_param($resultado, "i", $codigo_producto);
$st = mysqli_stmt_execute($resultado);

if (!$st) {
    echo "my".mysqli_error($conexion);
}

$resultado->free_result();

$del = "call Eliminar_Productos(?)";

$resultado = mysqli_prepare($conexion, $del);

$stm = mysqli_stmt_bind_param($resultado, "i", $codigo_producto);
$stm = mysqli_stmt_execute($resultado);

if (!$stm) {
    echo "".mysqli_error($conexion);
}

header('Location: ../mis-productos.php');

?>