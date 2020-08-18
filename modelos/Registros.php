<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Registros 
{
    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($fo_suceso, $fo_empleado, $fecha_registro, $fecha_incidente, $descripcion, $evidencia_digital, $fo_usuario_creador) 
    {
        $sql = "INSERT INTO registros (fo_suceso, fo_empleado, fecha_registro, fecha_incidente, descripcion, evidencia_digital, fo_usuario_creador, condicion)
        VALUES ('$fo_suceso', '$fo_empleado', '$fecha_registro', '$fecha_incidente', '$descripcion', '$evidencia_digital', '$fo_usuario_creador', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id_registro, $fo_suceso, $fo_empleado, $fecha_registro, $fecha_incidente, $descripcion, $evidencia_digital, $fo_usuario_creador, $fo_usuario_modificador)
    {
        $sql = "UPDATE registros SET 
        fo_suceso = '$fo_suceso', 
        fo_empleado = '$fo_empleado', 
        fecha_registro = '$fecha_registro', 
        fecha_incidente = '$fecha_incidente', 
        descripcion = '$descripcion', 
        evidencia_digital = '$evidencia_digital', 
        fo_usuario_creador = '$fo_usuario_creador', 
        fo_usuario_modificador = '$fo_usuario_modificador'
        WHERE id_registro = '$id_registro'";
        return ejecutarConsulta($sql);
    }

    // Método para anular Registros
    public function anular($id_registro, $motivo_anulacion)
    {
        $sql = "UPDATE registros SET 
        motivo_anulacion = '$motivo_anulacion', 
        condicion = '0'
        WHERE id_registro = '$id_registro'";
        return ejecutarConsulta($sql);
    }


    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id_registro) 
    {
        $sql = "SELECT * FROM registros
        WHERE id_registro = '$id_registro'
        AND condicion = 1";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM registros";
        return ejecutarConsulta($sql);
    }
}

?>