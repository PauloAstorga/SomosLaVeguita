<?php

session_start();

include "../DB.php";

$persona = $_SESSION['ActiveUser'];
$carro = $_SESSION['carrito'];

$codigo = $_POST['codigo_producto'];

$carro = \array_filter($carro, static function ($element) {
    $codigo = $_POST['codigo_producto'];
    return $element !== $codigo;
});

$_SESSION['carrito'] = $carro;
header('Location: ../carrito.php');

?>