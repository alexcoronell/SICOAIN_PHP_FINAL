<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Sedes 
{
    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($fo_compania, $nombre, $telefono, $direccion, $notas) 
    {
        $sql = "INSERT INTO sede (fo_compania, nombre, telefono, direccion, notas, condicion)
        VALUES ('$fo_compania', '$nombre', '$telefono', '$direccion', '$notas', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id, $fo_compania, $nombre, $telefono, $direccion, $notas)
    {
        $sql = "UPDATE sede SET fo_compania = '$fo_compania', nombre = '$nombre', telefono = '$telefono', direccion = '$direccion', notas = '$notas'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar Usuarios
    public function desactivar($id)
    {
        $sql = "UPDATE sede SET condicion = '0'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para activar Usuarios
    public function activar($id)
    {
        $sql = "UPDATE sede SET condicion = '1'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id) 
    {
        $sql = "SELECT * FROM sede
        WHERE id = '$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT
        s.id, s.fo_compania, c.compania, s.nombre, s.telefono, s.direccion, s.notas, s.condicion
        FROM sede s
        INNER JOIN compania c
        ON s.fo_compania = c.id";
        return ejecutarConsulta($sql);
    }
}

?>