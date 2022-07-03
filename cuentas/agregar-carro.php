<?php

session_start();
include "../DB.php";

$codigo_producto = $_POST['producto_id'];

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array($codigo_producto);
} else {
    $carrito = $_SESSION['carrito'];
    array_push($carrito, $codigo_producto);
    $_SESSION['carrito'] = $carrito;
}

header('Location: ../carrito.php');

?>