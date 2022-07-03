<?php

include "../DB.php";

session_start();

$username = $_POST['correo'];
$pass = md5($_POST['password']);

$verifica_login = "call Verifica_Login(?,?)";
$resultado = mysqli_prepare($conexion, $verifica_login);

$stmt = mysqli_stmt_bind_param($resultado, "ss", $username, $pass);
$stmt = mysqli_stmt_execute($resultado);

$stmt = mysqli_stmt_bind_result($resultado, $id, $rut,$nombre, $apellido,$correo,$telefono,$direccion);
while (mysqli_stmt_fetch($resultado)) {
    $_SESSION['ActiveUser'] = array(
        'id' => $id,
        'nombre' => $nombre,
        'apellido' => $apellido,
        'rut' => $rut,
        'correo' => $correo,
        'telefono' => $telefono,
        'direccion' => $direccion
    );
}

if (isset($_SESSION['ActiveUser'])){
    $persona = $_SESSION['ActiveUser'];
    if ($persona['correo']!=NULL) {
        header('Location: ../index.php');
    } else {
        header('Location: ../login.php');
    }
} else {
    header('Location: ../login.php');
}

?>