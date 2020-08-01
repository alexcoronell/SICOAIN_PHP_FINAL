<?php

//Conexión a la base de datos
require "../config/conexion.php";

class Empleados 
{
    // Se implementa el constructor

    public function __construct()
    {
        
    }

    // Método para insertar registros
    public function insertar($fo_tipo_identificacion, $numero_identificacion, $nombres, $apellidos, $fo_departamento, $fo_ciudad, $direccion, $telefono_fijo, $telefono_celular, $email, $fo_compania, $fo_cargo, $fo_sede, $fo_eps, $fo_arl,  $nombre_contacto_emergencia, $telefono_contacto_emergencia, $parentesco_contacto_emergencia, $comentarios) 
    {
        $sql = "INSERT INTO empleado (fo_tipo_identificacion, numero_identificacion, nombres, apellidos, fo_departamento, fo_ciudad, direccion, telefono_fijo, telefono_celular, email, fo_compania, fo_cargo, fo_sede, fo_eps, fo_arl,  nombre_contacto_emergencia, telefono_contacto_emergencia, parentesco_contacto_emergencia, comentarios, condicion)
        VALUES ('$fo_tipo_identificacion', '$numero_identificacion', '$nombres', '$apellidos', '$fo_departamento', '$fo_ciudad', '$direccion', '$telefono_fijo', '$telefono_celular', '$email', '$fo_compania', '$fo_cargo', '$fo_sede', '$fo_eps', '$fo_arl', '$nombre_contacto_emergencia', '$telefono_contacto_emergencia', '$parentesco_contacto_emergencia', '$comentarios', '1')";
        return ejecutarConsulta($sql);
    }

    // Método para editar registros
    public function editar($id, $fo_tipo_identificacion, $numero_identificacion, $nombres, $apellidos, $fo_departamento, $fo_ciudad, $direccion, $telefono_fijo, $telefono_celular, $email, $fo_compania, $fo_cargo, $fo_sede, $fo_eps, $fo_arl,  $nombre_contacto_emergencia, $telefono_contacto_emergencia, $parentesco_contacto_emergencia, $comentarios)
    {
        $sql = "UPDATE empleado SET 
        fo_tipo_identificacion = '$fo_tipo_identificacion',
        numero_identificacion = '$numero_identificacion', 
        nombres = '$nombres', 
        apellidos = '$apellidos',
        fo_departamento = '$fo_departamento', 
        fo_ciudad = '$fo_ciudad', 
        direccion = '$direccion', 
        telefono_fijo = '$telefono_fijo', 
        telefono_celular = '$telefono_celular', 
        email = '$email', 
        fo_compania = '$fo_compania', 
        fo_cargo = '$fo_cargo', 
        fo_sede = '$fo_sede', 
        fo_eps = '$fo_eps', 
        fo_arl = '$fo_arl', 
        nombre_contacto_emergencia = '$nombre_contacto_emergencia', 
        telefono_contacto_emergencia = '$telefono_contacto_emergencia', 
        parentesco_contacto_emergencia = '$parentesco_contacto_emergencia', 
        comentarios = '$comentarios'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para desactivar Usuarios
    public function desactivar($id)
    {
        $sql = "UPDATE empleado SET condicion = '0'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para activar Usuarios
    public function activar($id)
    {
        $sql = "UPDATE empleado SET condicion = '1'
        WHERE id = '$id'";
        return ejecutarConsulta($sql);
    }

    // Método para mostrar los datos de un registro a modificar
    public function mostrar($id) 
    {
        $sql = "SELECT * 
        FROM empleado 
        WHERE id = '$id'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listar()
    {
        $sql = "SELECT em.id, ti.tipo_identificacion, em.numero_identificacion, em.nombres, em.apellidos, com.compania, sede.nombre, cargo.cargo, dep.departamento, ciudad.ciudad, em.direccion, eps.nombre_eps, arl.nombre_arl, em.telefono_fijo, em.telefono_celular, em.email, em.nombre_contacto_emergencia, em.telefono_contacto_emergencia, em.parentesco_contacto_emergencia, em.comentarios, em.condicion 
        FROM empleado em 
        INNER JOIN tipo_identificacion ti ON em.fo_tipo_identificacion = ti.id_tipo_identificacion
        INNER JOIN compania com ON em.fo_compania = com.id
        INNER JOIN sede sede ON em.fo_sede = sede.id
        INNER JOIN cargo cargo ON em.fo_cargo = cargo.id
        INNER JOIN departamentos dep ON em.fo_departamento = dep.id_departamento
        INNER JOIN ciudad ciudad ON em.fo_ciudad = ciudad.id_ciudad
        INNER JOIN eps eps ON em.fo_eps = eps.id
        INNER JOIN arl arl ON em.fo_arl = arl.id";
        return ejecutarConsulta($sql);
    }


}

?>
