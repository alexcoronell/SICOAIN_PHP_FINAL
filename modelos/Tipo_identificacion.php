<?php

//Conexión a la base de datos
require "../config/conexion.php";

class TipoIdentificacion
{

    // Se implementa el constructor

    public function __construct()
    {
        
    }
   
    public function select()
    {
        $sql = "SELECT * FROM tipo_identificacion";
        return ejecutarConsulta($sql);
    }

}
