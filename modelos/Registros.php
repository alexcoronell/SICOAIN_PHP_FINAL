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
    public function insertar($fo_empleado, $fo_suceso, $fecha_registro, $fecha_incidente, $evidencia_digital, $descripcion, $usuario_creador) 
    {
        $sql = "INSERT INTO 
        registros (fo_empleado, fo_suceso, fecha_registro, fecha_incidente, descripcion, evidencia_digital, usuario_creador, condicion)

        VALUES ('$fo_empleado', '$fo_suceso', '$fecha_registro', '$fecha_incidente', '$descripcion','$evidencia_digital',  '$usuario_creador', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id_registro, $fo_empleado, $fo_suceso, $fecha_registro, $fecha_incidente, $evidencia_digital, $descripcion, $usuario_creador, $usuario_modificador)
    {
        $sql = "UPDATE registros SET
        fo_empleado = '$fo_empleado',  
        fo_suceso = '$fo_suceso', 
        fecha_registro = '$fecha_registro', 
        fecha_incidente = '$fecha_incidente',
        evidencia_digital = '$evidencia_digital',  
        descripcion = '$descripcion', 
        usuario_creador = '$usuario_creador', 
        usuario_modificador = '$usuario_modificador'
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
        $sql = "SELECT r.id_registro, em.numero_identificacion, em.nombres, em.apellidos, s.nombre, r.fecha_registro, r.fecha_incidente, r.descripcion, r.evidencia_digital, r.usuario_creador, r.usuario_modificador, r.motivo_anulacion, r.condicion
        FROM registros r
        INNER JOIN empleado em ON r.fo_empleado = em.id
        INNER JOIN suceso s ON r.fo_suceso = s.id";
        return ejecutarConsulta($sql); 
    }
}

?>