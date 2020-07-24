<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Eps 
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($nombre, $telefono, $direccion, $email) 
    {
        $sql = "INSERT INTO eps (nombre, telefono, direccion, email, condicion)
        VALUES ('$nombre', '$telefono', '$direccion', '$email', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id, $nombre, $telefono, $direccion, $email)
    {
        $sql = "UPDATE eps SET nombre = '$nombre', telefono = '$telefono', direccion = '$direccion', email = '$email'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar EPS
    public function desactivar($id)
    {
        $sql = "UPDATE eps SET condicion = '0'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para activar EPS
    public function activar($id)
    {
        $sql = "UPDATE eps SET condicion = '1'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id) 
    {
        $sql = "SELECT * FROM eps
        WHERE id = '$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM eps";
        return ejecutarConsulta($sql);
    }
}

?>