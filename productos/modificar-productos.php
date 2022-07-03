<?php

session_start();

include "../DB.php";

$persona = $_SESSION['ActiveUser'];

$codigo_producto = $_POST['producto_id'];

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$precio = $_POST['precio'];
$foto = $_POST['foto'];
$stock = $_POST['stock'];

$consulta = "call Actualizar_Producto(?,?,?,?,?,?,?)";

$resultado = mysqli_prepare($conexion, $consulta);

$stm = mysqli_stmt_bind_param($resultado, "issdsii", $codigo_producto, $nombre, $descripcion, $precio, $foto, $categoria, $stock);
$stm = mysqli_stmt_execute($resultado);

if (!$stm) {
    echo mysqli_error($conexion);
}

header('Location: ../mis-productos.php?modificado=true');

?>