<?php

require_once "../modelos/Cargo.php";

$cargos = new Cargo();

$id_cargo = isset($_POST["id_cargo"]) ? limpiarCadena($_POST["id_cargo"]) : "";
$cargo = isset($_POST["cargo"]) ? limpiarCadena($_POST["cargo"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

switch ($_GET["op"])
{
    case 'guardaryeditar' :
        if (empty($id_cargo))
        {
            $rspta = $cargos -> insertar($cargo, $descripcion);
            echo $rspta ? "Cargo registrado correctamente" : "Cargo no se pudo registrar";
        } else
        {
            $rspta = $cargos -> editar($id_cargo, $cargo, $descripcion);
            echo $rspta ? "Cargo actualizado correctamente" : "Cargo no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta = $cargos -> desactivar($id_cargo);
        echo $rspta ? "Cargo Desactivado" : "Cargo no se pudo Desactivar";
    break;

    case 'activar':
        $rspta = $cargos -> activar($id_cargo);
        echo $rspta ? "Cargo Activado" : "Cargo no se pudo Activar";
    break;

    case 'mostrar':
        $rspta = $cargos -> mostrar($id_cargo);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $cargos -> listar();
        // Declaración de Array que contendrá todos los datos
        $data = Array();

        while ($reg = $rspta -> fetch_object())
        {
            $data[] = array(
                "0" => $reg -> id_cargo,
                "1" => $reg -> cargo, 
                "2" => $reg -> descripcion, 
                "3" => $reg -> condicion
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