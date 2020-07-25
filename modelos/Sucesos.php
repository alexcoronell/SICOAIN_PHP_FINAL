<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Sucesos 
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($nombre) 
    {
        $sql = "INSERT INTO suceso (nombre, condicion)
        VALUES ('$nombre', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id, $nombre)
    {
        $sql = "UPDATE suceso SET nombre = '$nombre'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar EPS
    public function desactivar($id)
    {
        $sql = "UPDATE suceso SET condicion = '0'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para activar EPS
    public function activar($id)
    {
        $sql = "UPDATE suceso SET condicion = '1'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id) 
    {
        $sql = "SELECT * FROM suceso
        WHERE id = '$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM suceso";
        return ejecutarConsulta($sql);
    }
}

?>