<?php

require_once "global.php";

$conexion = new mysqli(DB_HOST, DB_USENAME, DB_PASSWORD, DB_NAME);

mysqli_query( $conexion, 'SET NAMES "'.DB_ENCODE.'"' );

// Si existe un error en la conexión se mostrará

if (mysqli_connect_error()) {
    printf("Falló la conexión a la base de datos: %s\n", mysqli_connect_error());
    exit();
}

if (!function_exists('ejecutarConsulta')) {
    function ejecutarConsulta($sql) {
        global $conexion;
        $query = $conexion -> query($sql);
        return $query;
    }
}

function ejecutarConsultaSimpleFila($sql) {
    global $conexion;
    $query = $conexion -> query($sql);
    $row = $query -> fetch_assoc();
    return $row;
}

function ejecutarConsulta_retornarID($sql) {
    global $conexion;
    $query = $conexion -> query($sql);
    return $conexion -> insert_id;
}

function limpiarCadena($str) {
    global $conexion;
    $str = mysqli_real_escape_string($conexion, trim($str));
    return htmlspecialchars($str);
}
?>