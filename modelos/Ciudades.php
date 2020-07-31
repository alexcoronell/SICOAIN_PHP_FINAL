<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Ciudades
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }
   
    public function selectAll()
    {
        $sql = "SELECT * FROM ciudad";
        return ejecutarConsulta($sql);
    }

    public function select($idDepartamento)
    {
        $sql = "SELECT * FROM ciudad
        WHERE Departamento = '$idDepartamento'
        ";
        return ejecutarConsulta($sql);
    }

}
