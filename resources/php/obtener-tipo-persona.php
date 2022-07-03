<?php

/**
 * Obtiene el tipo de usuario (Cliente/Locatario)
 */
function obtener_tipo_persona( $id_persona ) {
    try {

        include "DB.php";

        $es_locatario = false;

        $consulta = "SELECT * FROM vendedor WHERE id_persona = ?";

        $resultado = mysqli_prepare($conexion, $consulta);

        $statement = mysqli_stmt_bind_param($resultado, "i", $id_persona);
        $statement = mysqli_stmt_execute($resultado);

        $statement = mysqli_stmt_bind_result($resultado,$id_vendedor, $id_vendedorpersona);

        while (mysqli_stmt_fetch($resultado)) {
            $es_locatario = true;
        }

        return $es_locatario;


    } catch (\Throwable $th) {
        //throw $th;
        return false;
    }
}

?>