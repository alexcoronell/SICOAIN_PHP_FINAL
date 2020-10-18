<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Arl 
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($nombre_arl, $telefono, $direccion, $email) 
    {
        $sql = "INSERT INTO arl (nombre_arl, telefono, direccion, email, condicion)
        VALUES ('$nombre_arl', '$telefono', '$direccion', '$email', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id, $nombre_arl, $telefono, $direccion, $email)
    {
        $sql = "UPDATE arl SET nombre_arl = '$nombre_arl', telefono = '$telefono', direccion = '$direccion', email = '$email'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar ARL
    public function desactivar($id)
    {
        $sql = "UPDATE arl SET condicion = '0'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para activar ARL
    public function activar($id)
    {
        $sql = "UPDATE arl SET condicion = '1'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id) 
    {
        $sql = "SELECT * FROM arl
        WHERE id = '$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM arl";
        return ejecutarConsulta($sql);
    }

    // Metodo para listar las ARL activas (Condición = 1)
    public function select()
    {
        $sql = "SELECT * FROM arl WHERE condicion = 1";
        return ejecutarConsulta($sql);
    }
}

?>