<?php

require_once "../modelos/Roles.php";

$roles = new Roles();

$id_rol = isset($_POST["id_rol"]) ? limpiarCadena($_POST["id_rol"]) : "";
$rol = isset($_POST["rol"]) ? limpiarCadena($_POST["rol"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
$superusuario = isset($_POST["superusuario"]) ? limpiarCadena($_POST["superusuario"]) : "";
$administrador = isset($_POST["administrador"]) ? limpiarCadena($_POST["administrador"]) : "";
$analista_asistente = isset($_POST["analista_asistente"]) ? limpiarCadena($_POST["analista_asistente"]) : "";
$consultas = isset($_POST["consultas"]) ? limpiarCadena($_POST["consultas"]) : "";

switch ($_GET["op"])
{
    case 'guardaryeditar' :
        if (empty($id_rol))
        {
            $rspta = $roles -> insertar($rol, $descripcion, $superusuario, $administrador, $analista_asistente, $consultas);
            echo $rspta ? "Rol registrado correctamente" : "Rol no se pudo registrar";
        } else
        {
            $rspta = $roles -> editar($id_rol, $rol, $descripcion, $superusuario, $administrador, $analista_asistente, $consultas);
            echo $rspta ? "Rol actualizado correctamente" : "Rol no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta = $roles -> desactivar($id_rol);
        echo $rspta ? "Rol Desactivado" : "Rol no se pudo Desactivar";
    break;

    case 'activar':
        $rspta = $roles -> activar($id_rol);
        echo $rspta ? "Rol Activado" : "Rol no se pudo Activar";
    break;

    case 'mostrar':
        $rspta = $roles -> mostrar($id_rol);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $roles -> listar();
        // Declaración de Array que contendrá todos los datos
        $data = Array();

        while ($reg = $rspta -> fetch_object())
        {
            $data[] = array(
                "0" => $reg -> id_rol,
                "1" => $reg -> rol, 
                "2" => $reg -> descripcion,
                "3" => $reg -> superusuario, 
                "4" => $reg -> administrador, 
                "5" => $reg -> analista_asistente, 
                "6" => $reg -> consultas, 
                "7" => $reg -> condicion
            );
        }
        $results = array (
            "sEcho" => 1, // Información para la tabla
            "iTotalRecords" => count($data), // Envío del total de registros a la tabla
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

    break;

}

?>