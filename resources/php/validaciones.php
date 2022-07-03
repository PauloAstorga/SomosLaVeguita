<?php

/**
 * Funcion que guarda y valida los cambios realizados a un usuario.
 * 
 * @param string $nombre Nombre del usuario
 * @param string $apellido Apellido del usuario
 * @param string $correo Correo del usuario
 * @param string $telefono Número Telefónico del usuario
 * @param int $comuna ID de la comuna a la que pertenece el usuario
 * @param string $direccion Nombre de la dirección del usuario
 * @param string $old_pass Contraseña antigua ingresada por el usuario
 * @param string $old_pass_compare Contraseña antigua del usuario en la base de datos
 * @param string $new_pass Contraseña nueva ingresada por el usuario
 * @param string $new_pass_compare Contraseña nueva repetida ingresada por el usuario
 * 
 * @author Paulo <pauloastorga.docs@gmail.com>
 * 
 * @throws Exception Excepción de conversión de datos
 * 
 * @return bool Valor que indica si los datos son validos para ser guardados
 */
function validar_guardar_cambios($nombre, $apellido, $correo, $telefono, $comuna, $direccion, $old_pass, $old_pass_compare, $new_pass, $new_pass_compare) {
    try {
        
        return strlen($nombre)>30 OR strlen($nombre)<3 OR
        strlen($apellido)>30 OR strlen($apellido)<3 OR
        strlen($correo)>80 OR strlen($correo)<3 OR
        strlen($telefono)>12 OR strlen($telefono)<8 OR
        strlen($direccion)>100 OR strlen($direccion)<5 OR 
        $comuna <= 0 OR  
        $old_pass!=$old_pass_compare OR
        $new_pass!=$new_pass_compare;

    } catch (\Throwable $th) {
        //throw $th;
        echo "errror";
        return false;
    }
}

/**
 * Funcion que guarda y valida los datos al crear a un usuario.
 * 
 * @param string $nombre Nombre del usuario
 * @param string $apellido Apellido del usuario
 * @param string $correo Correo del usuario
 * @param string $telefono Número Telefónico del usuario
 * @param string $rut RUT del usuario
 * @param string $tipo Tipo de Cuenta del usuario
 * @param array $tipos Array contenedor de los tipos de cuentas posibles
 * @param string $direccion Nombre de la dirección del usuario
 * @param int $comuna ID de la comuna a la que pertenece el usuario
 * @param string $pwd Contraseña ingresada por el usuario
 * @param string $pwd2 Contraseña repetida ingresada por el usuario
 * 
 * @author Paulo <pauloastorga.docs@gmail.com>
 * 
 * @throws Exception Excepción de conversión de datos
 * 
 * @return bool Valor que indica si los datos son validos para ser guardados
 */
function validar_crear_cuenta($nombre, $apellidos, $correo, $telefono, $rut, $tipo, $tipos, $direccion, $comuna, $pwd, $pwd2) {
    try {
        
        return strlen($nombre)>30 OR strlen($nombre)<3 OR
        strlen($apellidos)>30 OR strlen($apellidos)<3 OR
        strlen($correo)>80 OR strlen($correo)<3 OR
        strlen($telefono)>12 OR strlen($telefono)<8 OR
        strlen($rut)>12 OR strlen($rut)<8 OR
        ( !in_array($tipo,$tipos) ) OR
        strlen($direccion)>100 OR strlen($direccion)<5 OR 
        $comuna <= 0 OR  
        $pwd!=$pwd2;
    
    } catch (\Throwable $th) {
        //throw $th;
        return false;
    }
}

/**
 * 
 */
function validar_crear_puesto($nombre, $patente, $direccion, $comuna, $foto) {
    try {
        return strlen($nombre)>60 OR strlen($nombre)<3 OR
        $patente<=0 OR $comuna<=0 OR
        strlen($direccion)>100 OR strlen($direccion)<5 OR
        strlen($foto)>1000 OR strlen($foto)<3;
    } catch (\Throwable $th) {
        //throw $th;
        return false;
    }
}
?>