<?php

session_start();

include "../DB.php";
include "../resources/php/validaciones.php";

$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

$comuna = $_POST['comuna'];
$direccion = $_POST['direccion'];
$old_direccion = NULL;

$old_pass = md5($_POST['oldpassword']);
$old_pass_compare = NULL;
$new_pass = md5($_POST['password']);
$new_pass_compare = md5($_POST['password2']);

$persona = $_SESSION['ActiveUser'];

$consulta = "SELECT contrasena,id_direccion FROM persona WHERE id = ?";

$resultado = mysqli_prepare($conexion, $consulta);

$sentencia = mysqli_stmt_bind_param($resultado, "i", $persona['id']);
$sentencia = mysqli_stmt_execute($resultado);

if (!$sentencia) {
    echo "Error con datos. ".mysqli_error($conexion);
    header("Location: modificar-usuario.php?error=true");
}

$sentencia = mysqli_stmt_bind_result($resultado,$pwd,$dir);

while (mysqli_stmt_fetch($resultado)) {
    $old_pass_compare = $pwd;
    $old_direccion = $dir;
}

$resultado->free_result();

$datos_invalidos = validar_guardar_cambios($nombre, $apellidos, $correo, $telefono, $comuna, $direccion, $old_pass, $old_pass_compare, $new_pass, $new_pass_compare);

if ($datos_invalidos) {
    header('Location: ../modificar-usuario.php');
} else {

    if ($old_direccion!=$direccion) {
        $ingresar_direccion = "call Ingresar_Direccion(?,?)";
    
        $resultado = mysqli_prepare($conexion, $ingresar_direccion);

        $query = mysqli_stmt_bind_param($resultado, "si",$direccion, $comuna);
        $query = mysqli_stmt_execute($resultado);

        $resultado->free_result();
    }

    $actualizar_usuario = "call Actualizar_Usuario(?,?,?,?,?,?,?)";

    $resultado = mysqli_prepare($conexion, $actualizar_usuario);

    $statement = mysqli_stmt_bind_param($resultado, "issssss",$persona['id'], $nombre, $apellidos, $correo, $new_pass, $telefono, $persona['direccion']);
    $statement = mysqli_stmt_execute($resultado);

    if (!$statement) {
        echo "Error al actualizar usuario. ".mysqli_error($conexion);
        header("Location: modificar-usuario.php?error=true");
    }

    $_SESSION['ActiveUser'] = array(
        'id' => $persona['id'],
        'nombre' => $nombre,
        'apellido' => $apellidos,
        'rut' => $persona['rut'],
        'correo' => $correo,
        'telefono' => $telefono,
        'direccion' => $direccion
    );

    header('Location: ../mi-cuenta.php?cambio=true');

}

?>