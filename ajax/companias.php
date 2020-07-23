<?php

require_once "../modelos/Companias.php";

$companias = new Compania();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$compania = isset($_POST["compania"]) ? limpiarCadena($_POST["compania"]) : "";
$telefono_compania = isset($_POST["telefono_compania"]) ? limpiarCadena($_POST["telefono_compania"]) : "";
$direccion_compania = isset($_POST["direccion_compania"]) ? limpiarCadena($_POST["direccion_compania"]) : "";

switch ($_GET["op"])
{
    case 'guardaryeditar' :
        if (empty($id))
        {
            $rspta = $companias -> insertar($compania, $telefono_compania, $direccion_compania);
            echo $rspta ? "Compañía registrada correctamente" : "Compañía no se pudo registrar";
        } else
        {
            $rspta = $companias -> editar($id, $compania, $telefono_compania, $direccion_compania);
            echo $rspta ? "Compañía actualizada correctamente" : "Compañía no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta = $companias -> desactivar($id);
        echo $rspta ? "Compañía Desactivada" : "Compañía no se pudo Desactivar";
    break;

    case 'activar':
        $rspta = $companias -> activar($id);
        echo $rspta ? "Compañía Activada" : "Compañía no se pudo Activar";
    break;

    case 'mostrar':
        $rspta = $companias -> mostrar($id);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $companias -> listar();
        // Declaración de Array que contendrá todos los datos
        $data = Array();

        while ($reg = $rspta -> fetch_object())
        {
            $data[] = array(
                "0" => $reg -> id,
                "1" => $reg -> compania, 
                "2" => $reg -> telefono_compania,
                "3" => $reg -> direccion_compania,
                "4" => $reg -> condicion
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