<?php

require_once "../modelos/Sucesos.php";

$suceso = new Sucesos();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";

switch ($_GET["op"])
{
    case 'guardaryeditar' :
        if (empty($id))
        {
            $rspta = $suceso -> insertar($nombre);
            echo $rspta ? "Suceso registrado correctamente" : "Suceso no se pudo registrar";
        } else
        {
            $rspta = $suceso -> editar($id, $nombre);
            echo $rspta ? "Suceso actualizado correctamente" : "Suceso no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta = $suceso -> desactivar($id);
        echo $rspta ? "Suceso Desactivado" : "Suceso no se pudo Desactivar";
    break;

    case 'activar':
        $rspta = $suceso -> activar($id);
        echo $rspta ? "Suceso Activado" : "Suceso no se pudo Activar";
    break;

    case 'mostrar':
        $rspta = $suceso -> mostrar($id);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $suceso -> listar();
        // Declaración de Array que contendrá todos los datos
        $data = Array();

        while ($reg = $rspta -> fetch_object())
        {
            $data[] = array(
                "0" => $reg -> id,
                "1" => $reg -> nombre, 
                "2" => $reg -> condicion
            );
        }
        $results = array (
            "sEcho" => 1, // Información para la tabla
            "iTotalRecords" => count($data), // Envío del total de registros a la tabla
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

    break;
    case "selectSuceso":
        $rspta = $suceso->select();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->id . '>' . $reg->nombre . '</option>';
        }
        break;
}

?>