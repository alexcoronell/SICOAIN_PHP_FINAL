<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Usuarios 
{
    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($usuario, $nombre, $superusuario, $administrador, $analista, $asistente, $consultas,  $contrasena) 
    {
        $sql = "INSERT INTO usuarios (usuario, nombre, superusuario, administrador, analista, asistente, consultas, contrasena, condicion)
        VALUES ('$usuario', '$nombre', '$superusuario', '$administrador', '$analista', '$asistente', '$consultas', '$contrasena', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id, $usuario, $nombre, $superusuario, $administrador, $analista, $asistente, $consultas,  $contrasena)
    {
        $sql = "UPDATE usuarios SET usuario = '$usuario', nombre = '$nombre', superusuario = '$superusuario', administrador = '$administrador', analista = '$analista', asistente = '$asistente', consultas = '$consultas', contrasena = '$contrasena'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar Usuarios
    public function desactivar($id)
    {
        $sql = "UPDATE usuarios SET condicion = '0'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para activar Usuarios
    public function activar($id)
    {
        $sql = "UPDATE usuarios SET condicion = '1'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id) 
    {
        $sql = "SELECT * FROM usuarios
        WHERE id = '$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT * FROM usuarios";
        return ejecutarConsulta($sql);
    }

    // Función para verificar el acceso al sistema
    public function verificar($usuario, $contrasena)
    {
        $sql = "SELECT id, nombre, superusuario, administrador, analista, asistente, consultas
        FROM usuarios
        WHERE usuario = '$usuario' AND contrasena = '$contrasena' AND condicion = '1'";
        return ejecutarConsulta($sql);
    }
}

?>