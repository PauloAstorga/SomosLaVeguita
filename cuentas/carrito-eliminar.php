<?php

session_start();

if (isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = NULL;
}

header('Location: ../carrito.php');

?>