<?php

require_once "../modelos/Arl.php";

$arl = new Arl();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$nombre_arl = isset($_POST["nombre_arl"]) ? limpiarCadena($_POST["nombre_arl"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";

switch ($_GET["op"])
{
    case 'guardaryeditar' :
        if (empty($id))
        {
            $rspta = $arl -> insertar($nombre_arl, $telefono, $direccion, $email);
            echo $rspta ? "ARL registrada correctamente" : "ARL no se pudo registrar";
        } else
        {
            $rspta = $arl -> editar($id, $nombre_arl, $telefono, $direccion, $email);
            echo $rspta ? "ARL actualizada correctamente" : "ARL no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta = $arl -> desactivar($id);
        echo $rspta ? "ARL Desactivada" : "ARL no se pudo Desactivar";
    break;

    case 'activar':
        $rspta = $arl -> activar($id);
        echo $rspta ? "ARL Activada" : "ARL no se pudo Activar";
    break;

    case 'mostrar':
        $rspta = $arl -> mostrar($id);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $arl -> listar();
        // Declaración de Array que contendrá todos los datos
        $data = Array();

        while ($reg = $rspta -> fetch_object())
        {
            $data[] = array(
                "0" => $reg -> id,
                "1" => $reg -> nombre_arl, 
                "2" => $reg -> telefono,
                "3" => $reg -> direccion, 
                "4" => $reg -> email, 
                "5" => ($reg -> condicion) ? '<span class="registroActivado">Activado</span>' : '<span class="registroDesactivado">Desactivado</span>'
            );
        }
        $results = array (
            "sEcho" => 1, // Información para la tabla
            "iTotalRecords" => count($data), // Envío del total de registros a la tabla
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

    break;

    case "selectARL":
        $rspta = $arl -> select();

        while ($reg = $rspta -> fetch_object())
        {
            echo '<option value=' . $reg -> id . '>' . $reg -> nombre_arl . '</option>';
        }
    break;

    case "selectARLAll":
        $rspta = $arl -> listar();

        while ($reg = $rspta -> fetch_object())
        {
            echo '<option value=' . $reg -> id . '>' . $reg -> nombre_arl . '</option>';
        }
    break;

}

?>