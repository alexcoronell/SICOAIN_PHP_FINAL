<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Compania
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($compania, $telefono_compania, $direccion_compania) 
    {
        $sql = "INSERT INTO compania (compania, telefono_compania, direccion_compania, condicion)
        VALUES ('$compania', '$telefono_compania', '$direccion_compania', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id_compania, $compania, $telefono_compania, $direccion_compania)
    {
        $sql = "UPDATE compania SET compania = '$compania', telefono_compania = '$telefono_compania', direccion_compania = '$direccion_compania'
        WHERE id_compania = '$id_compania'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar Compañías
    public function desactivar($id_compania)
    {
        $sql = "UPDATE compania SET condicion = '0'
        WHERE id_compania = '$id_compania'";
        return ejecutarConsulta($sql);
    }

    // Método para activar Compañías
    public function activar($id_compania)
    {
        $sql = "UPDATE compania SET condicion = '1'
        WHERE id_compania = '$id_compania'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id_compania) 
    {
        $sql = "SELECT * FROM compania
        WHERE id_compania = '$id_compania'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM compania";
        return ejecutarConsulta($sql);
    }
}

?>