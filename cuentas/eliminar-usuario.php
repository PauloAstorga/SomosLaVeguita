<?php

session_start();

include "../DB.php";

$codigo_persona = $_POST['codigo'];

$query = "SELECT * FROM cliente WHERE id_persona = ?";

$resultado = mysqli_prepare($conexion, $query);

$stmt = mysqli_stmt_bind_param($resultado, "i", $codigo_persona);
$stmt = mysqli_stmt_execute($resultado);

$valor = NULL;

$stmt = mysqli_stmt_bind_result($resultado, $id_cliente, $id_cliente_persona);

while (mysqli_stmt_fetch($resultado)) {
    $valor=$id_cliente_persona;
}

$resultado->free_result();

if ($valor==NULL) { /*Es un Locatario*/

    $codigo_locatario = NULL;
    $codigos_puestos = array();

    /*Select para obtener Id del Locatario(ya se tiene el de persona)*/
    $query_locatario = "SELECT * FROM vendedor WHERE id_persona = ?";

    $resultado = mysqli_prepare($conexion, $query_locatario);
    
    $stm = mysqli_stmt_bind_param($resultado, "i", $codigo_persona);
    $stm = mysqli_stmt_execute($resultado);

    $stm = mysqli_stmt_bind_result($resultado, $id_vendedorid, $id_vendedorpersona);
    
    while (mysqli_stmt_fetch($resultado)) {
        $codigo_locatario = $id_vendedorid;
    }

    $resultado->free_result();

    /*Select para obtener Id del Puesto del Locatario*/

    $query_puesto = "SELECT id FROM puesto WHERE id_vendedor = ?";

    $resultado = mysqli_prepare($conexion, $query_puesto);

    $st = mysqli_stmt_bind_param($resultado, "i", $codigo_locatario);
    $st = mysqli_stmt_execute($resultado);

    if (!$st) {
        echo "Error al seleccionar puesto de locatario";
    }

    $st = mysqli_stmt_bind_result($resultado, $id_puesto);

    while (mysqli_stmt_fetch($resultado)) {
        array_push($codigos_puestos, $id_puesto);
    }

    $resultado->free_result();

    /*Teniendo ya el código del locatario y de todos sus puestos, se procede a eliminar todo*/

    $eliminar_productos_puesto = "call Eliminar_ProductosPuesto(?)";
    
    $eliminar_resena = "call Eliminar_Resena(?)";

    foreach ($codigos_puestos as $cod_puesto) {

        /*Eliminamos datos de productos-puestos*/
        $resultado = mysqli_prepare($conexion, $eliminar_productos_puesto);

        $query_result = mysqli_stmt_bind_param($resultado, "i", $cod_puesto);
        $query_result = mysqli_stmt_execute($resultado);

        if (!$query_result) {
            echo "Error al eliminar Productos_Puesto";
        }

        $resultado->free_result();

        /*Simultaneamente eliminamos datos de reseña*/
        $resultado = mysqli_prepare($conexion, $eliminar_resena);

        $query_res = mysqli_stmt_bind_param($resultado, "i", $cod_puesto);
        $query_res = mysqli_stmt_execute($resultado);

        if (!$query_res) {
            echo "Error al eliminar reseña";
        }

        $resultado->free_result();
    }

    $eliminar_puesto = "call Eliminar_Puesto(?)";

    $resultado = mysqli_prepare($conexion, $eliminar_puesto);

    $quer = mysqli_stmt_bind_param($resultado, "i", $codigo_locatario);
    $quer = mysqli_stmt_execute($resultado);

    if (!$quer) {
        echo "Error al eliminar puesto";
    }

    $resultado->free_result();

    $eliminar_vendedor = "call Eliminar_Locatario(?)";

    $resultado = mysqli_prepare($conexion, $eliminar_vendedor);

    $prt = mysqli_stmt_bind_param($resultado, "i", $codigo_persona);
    $prt = mysqli_stmt_execute($resultado);

    if (!$prt) {
        echo "Error al eliminar vendedor".mysqli_error($conexion);
    }

    $eliminar_persona = "call Eliminar_Usuario(?)";

    $resultado = mysqli_prepare($conexion, $eliminar_persona);

    $stmt = mysqli_stmt_bind_param($resultado, "i", $codigo_persona);
    $stmt = mysqli_stmt_execute($resultado);

    if (!$stmt) {
        echo "Error al eliminar persona";
    }

    $resultado->free_result();

} else { /*Es un Cliente*/

    $codigo_cliente = NULL;

    $consulta = "SELECT * FROM cliente WHERE id_persona = ?";

    $resultado = mysqli_prepare($conexion, $consulta);

    $stmt = mysqli_stmt_bind_param($resultado, "i", $codigo_persona);
    $stmt = mysqli_stmt_execute($resultado);

    if (!$stmt) {
        echo "Error con buscar cliente".mysqli_error($conexion);
    }

    $stmt = mysqli_stmt_bind_result($resultado, $id_clienteid, $id_clientepersona);

    while (mysqli_stmt_fetch($resultado)) {
        $codigo_cliente = $id_clienteid;
    }

    $resultado->free_result();

    $eliminar_resena_cliente = "call Eliminar_ResenaCliente(?)";

    $resultado = mysqli_prepare($conexion, $eliminar_resena_cliente);

    $sentencia = mysqli_stmt_bind_param($resultado, "i", $codigo_cliente);
    $sentencia = mysqli_stmt_execute($resultado);

    if (!$sentencia) {
        echo "Error al eliminar reseña de cliente".mysqli_error($conexion);
    }

    $resultado->free_result();

    $eliminar_pedido = "call Eliminar_Pedido(?)";

    $resultado = mysqli_prepare($conexion, $eliminar_pedido);

    $statement = mysqli_stmt_bind_param($resultado, "i", $codigo_cliente);
    $statement = mysqli_stmt_execute($resultado);

    if (!$statement) {
        echo "Error al eliminar pedido de cliente".mysqli_error($conexion);
    }

    $resultado->free_result();

    $eliminar_cliente = "call Eliminar_Cliente(?)";

    $resultado = mysqli_prepare($conexion, $eliminar_cliente);

    $sentencia2 = mysqli_stmt_bind_param($resultado, "i", $codigo_persona);
    $sentencia2 = mysqli_stmt_execute($resultado);

    if (!$sentencia2) {
        echo "Error al eliminar cliente".mysqli_error($conexion);
    }

    $resultado->free_result();

    $eliminar_persona = "call Eliminar_Usuario(?)";

    $resultado = mysqli_prepare($conexion, $eliminar_persona);

    $squery = mysqli_stmt_bind_param($resultado, "i", $codigo_persona);
    $squery = mysqli_stmt_execute($resultado);

    if (!$squery) {
        echo "Error al eliminar Usuario".mysqli_error($conexion);
    }

    $resultado->free_result();

}

header('Location: ../gestion-usuarios.php');

?>