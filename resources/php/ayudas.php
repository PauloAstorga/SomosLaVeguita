<?php

/**
 * Ingresar Direccion
 * 
 * @param string $nombre Nombre de la dirección
 * @param int $id_comuna ID de la comuna
 * 
 * @return bool Retorna verdadero si se ingresa, falso en caso contrario
 */
function ingresar_direccion($nombre, $id_comuna) {
    try {
        include "../DB.php";

        $query = "call Ingresar_Direccion(?,?)";

        $resultado = mysqli_prepare($conexion, $query);

        $statement = mysqli_stmt_bind_param($resultado, "si", $nombre, $id_comuna);
        $statement = mysqli_stmt_execute($resultado);

        return true;
    } catch (\Throwable $th) {
        //throw $th;
        throw $th;
        return false;
    }

}

function obtener_ultima_direccion() {
    try {

        include "../DB.php";

        $query = "SELECT * FROM direccion ORDER BY id DESC LIMIT 1";

        $resultado = mysqli_query($conexion, $query);

        $direccion = NULL;

        while ($fila = mysqli_fetch_row($resultado)) {
            $direccion = array(
                'id' => $fila[0],
                'nombre' => $fila[1],
                'id_comuna' => $fila[2]
            );
        }

        return $direccion;

    } catch (\Throwable $th) {
        throw $th;
        return NULL;
    }
}

?>