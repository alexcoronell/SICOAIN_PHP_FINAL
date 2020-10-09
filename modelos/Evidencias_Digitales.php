<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Evidencia 
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar evidencias
    public function insertar($fo_registro, $archivo) 
    {
        $sql = "INSERT INTO evidencias_digitales (fo_registro, archivo)
        VALUES ('$fo_registro', '$archivo')";
        return ejecutarConsulta($sql);
    }

    // Método para eliminar evidencias
    public function eliminar($id_evidencia_digital)
    {
        $sql = "DELETE from evidencias_digitales
        WHERE id_evidencia_digital = '$id_evidencia_digital'";
        return ejecutarConsulta($sql);
    }

    // Listar todas las evidencias
    public function mostrar($id_evidencia_digital)
    {
        $sql = "SELECT * FROM evidencias_digitales
        WHERE id_evidencia_digital = '$id_evidencia_digital'";
        return ejecutarConsulta($sql);
    }

    // Listar todas las evidencias
    public function listar()
    {
        $sql = "SELECT * FROM evidencias_digitales";
        return ejecutarConsulta($sql);
    }

    // Listar evidencias por registro
    public function listar_por_registro($fo_registro)
    {
        $sql = "SELECT * FROM evidencias_digitales
        WHERE fo_registro = '$fo_registro'";
        return ejecutarConsulta($sql);
    }
}

?>