<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Cargo 
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($cargo, $descripcion) 
    {
        $sql = "INSERT INTO cargo (cargo, descripcion, condicion)
        VALUES ('$cargo', '$descripcion', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id_cargo, $cargo, $descripcion)
    {
        $sql = "UPDATE cargo SET cargo = '$cargo', descripcion = '$descripcion'
        WHERE id_cargo = '$id_cargo'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar roles
    public function desactivar($id_cargo)
    {
        $sql = "UPDATE cargo SET condicion = '0'
        WHERE id_cargo = '$id_cargo'";
        return ejecutarConsulta($sql);
    }

    // Método para activar roles
    public function activar($id_cargo)
    {
        $sql = "UPDATE cargo SET condicion = '1'
        WHERE id_cargo = '$id_cargo'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id_cargo) 
    {
        $sql = "SELECT * FROM cargo
        WHERE id_cargo = '$id_cargo'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM cargo";
        return ejecutarConsulta($sql);
    }
}

?>