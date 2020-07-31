<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Departamentos
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }
   
    public function select()
    {
        $sql = "SELECT * FROM departamentos";
        return ejecutarConsulta($sql);
    }

}
