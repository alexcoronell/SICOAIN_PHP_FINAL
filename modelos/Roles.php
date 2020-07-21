<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Roles 
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($rol, $descripcion, $superusuario, $administrador, $analista_asistente, $consultas) 
    {
        $sql = "INSERT INTO roles (rol, descripcion, superusuario, administrador, analista_asistente, consultas, condicion)
        VALUES ('$rol', '$descripcion', '$superusuario', '$administrador', '$analista_asistente', '$consultas', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id_rol, $rol, $descripcion, $superusuario, $administrador, $analista_asistente, $consultas)
    {
        $sql = "UPDATE roles SET rol = '$rol', descripcion = '$descripcion', superusuario = '$superusuario', administrador = '$administrador', analista_asistente = '$analista_asistente', consultas = '$consultas'
        WHERE id_rol = '$id_rol'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar roles
    public function desactivar($id_rol)
    {
        $sql = "UPDATE roles SET condicion = '0'
        WHERE id_rol = '$id_rol'";
        return ejecutarConsulta($sql);
    }

    // Método para activar roles
    public function activar($id_rol)
    {
        $sql = "UPDATE roles SET condicion = '1'
        WHERE id_rol = '$id_rol'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id_rol) 
    {
        $sql = "SELECT * FROM roles
        WHERE id_rol = '$id_rol'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM roles";
        return ejecutarConsulta($sql);
    }
}

?>