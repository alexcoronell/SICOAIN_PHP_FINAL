<?php

require_once "../modelos/Cargo.php";

$cargos = new Cargo();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$cargo = isset($_POST["cargo"]) ? limpiarCadena($_POST["cargo"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";

switch ($_GET["op"])
{
    case 'guardaryeditar' :
        if (empty($id))
        {
            $rspta = $cargos -> insertar($cargo, $descripcion);
            echo $rspta ? "Cargo registrado correctamente" : "Cargo no se pudo registrar";
        } else
        {
            $rspta = $cargos -> editar($id, $cargo, $descripcion);
            echo $rspta ? "Cargo actualizado correctamente" : "Cargo no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta = $cargos -> desactivar($id);
        echo $rspta ? "Cargo Desactivado" : "Cargo no se pudo Desactivar";
    break;

    case 'activar':
        $rspta = $cargos -> activar($id);
        echo $rspta ? "Cargo Activado" : "Cargo no se pudo Activar";
    break;

    case 'mostrar':
        $rspta = $cargos -> mostrar($id);
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
                "0" => $reg -> id,
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

    case "selectCargo":
        $rspta = $cargos -> select();

        while ($reg = $rspta -> fetch_object())
        {
            echo '<option value=' . $reg -> id . '>' . $reg -> cargo . '</option>';
        }
    break;

}

?>