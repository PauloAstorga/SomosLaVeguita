<?php

session_start();

include "../DB.php";

$persona = $_SESSION['ActiveUser'];

$codigo_puesto = $_POST['puesto_id'];

$consulta = "call Eliminar_PuestoId(?)";

$resultado = mysqli_prepare($conexion,$consulta);

$stm = mysqli_stmt_bind_param($resultado, "i", $codigo_puesto);
$stm = mysqli_stmt_execute($resultado);

if (!$stm) {
    echo "".mysqli_error($conexion);
}

header('Location: ../mis-puestos.php?eliminado=true');

?>