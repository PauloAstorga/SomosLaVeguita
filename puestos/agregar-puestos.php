<?php

include "../DB.php";
include "../resources/php/validaciones.php";

session_start();

$persona = $_SESSION['ActiveUser'];

$nombre = $_POST['nombre'];
$patente = $_POST['patente'];
$foto = $_POST['foto'];
$comuna = $_POST['comuna'];
$direccion = $_POST['direccion'];

$datos_invalidos = validar_crear_puesto($nombre, $patente, $direccion, $comuna, $foto);

if ($datos_invalidos) {
    echo "Datos invalidos";
} else {
    
    include "../resources/php/ayudas.php";

    $ingreso_direccion = ingresar_direccion($direccion, $comuna);

    $address = obtener_ultima_direccion();

    if ($ingreso_direccion) {

        $codigo_vendedor = NULL;

        $consulta = "SELECT id FROM vendedor WHERE id_persona = ?";
        $resultado = mysqli_prepare($conexion, $consulta);

        $stm = mysqli_stmt_bind_param($resultado, "i", $persona['id']);
        $stm = mysqli_stmt_execute($resultado);

        $stm = mysqli_stmt_bind_result($resultado, $id_vendedor);
        while (mysqli_stmt_fetch($resultado)) {
            $codigo_vendedor = $id_vendedor;
        }

        $consulta = "call Ingresar_Puesto(?,?,?,?,?)";

        $resultado = mysqli_prepare($conexion,$consulta);
        
        $query = mysqli_stmt_bind_param($resultado, "issii", $patente, $nombre, $foto, $address['id'], $codigo_vendedor);
        $query = mysqli_stmt_execute($resultado);

        if (!$query) {
            echo "".mysqli_error($conexion);
        }

        header('Location: ../mis-puestos.php?puesto=agregado');

    } else {
        header("Location: ../ingresar-puesto.php?error=true");
    }

}

?>