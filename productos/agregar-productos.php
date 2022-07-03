<?php

session_start();

include "../DB.php";

$persona = $_SESSION['ActiveUser'];

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
$precio = $_POST['precio'];
$foto = $_POST['foto'];
$stock = $_POST['stock'];
$puesto = $_POST['puesto'];

/*Ingresar producto*/

$query = "call Ingresar_Producto(?,?,?,?,?,?)";

$resultado = mysqli_prepare($conexion, $query);

$stm = mysqli_stmt_bind_param($resultado,"ssdsii", $nombre, $descripcion, $precio, $foto, $categoria, $stock);
$stm = mysqli_stmt_execute($resultado);

if (!$stm) {
    echo "Error al insertar==".mysqli_error($conexion);
}

$resultado->free_result();

$obtener_ultimo_producto = "SELECT * FROM producto ORDER BY id DESC LIMIT 1";

$id_producto_ingresado = NULL;

$resultado = mysqli_query($conexion, $obtener_ultimo_producto);

while ($fila = mysqli_fetch_row($resultado)) {
    $id_producto_ingresado = $fila[0];
}

$resultado ->free_result();

/*Ingresar Producto para Puesto*/

$consulta = "call Ingresar_ProductosPuestos(?,?)";

$resultado = mysqli_prepare($conexion, $consulta);

$ins = mysqli_stmt_bind_param($resultado, "ii", $puesto, $id_producto_ingresado);
$ins = mysqli_stmt_execute($resultado);

if ($ins) {
    echo mysqli_error($conexion);
}

header('Location: ../mis-productos.php?crear=true');

?>