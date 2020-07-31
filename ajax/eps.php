<?php

require_once "../modelos/Eps.php";

$eps = new Eps();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$nombre_eps = isset($_POST["nombre_eps"]) ? limpiarCadena($_POST["nombre_eps"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";

switch ($_GET["op"])
{
    case 'guardaryeditar' :
        if (empty($id))
        {
            $rspta = $eps -> insertar($nombre_eps, $telefono, $direccion, $email);
            echo $rspta ? "EPS registrada correctamente" : "EPS no se pudo registrar";
        } else
        {
            $rspta = $eps -> editar($id, $nombre_eps, $telefono, $direccion, $email);
            echo $rspta ? "EPS actualizada correctamente" : "EPS no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta = $eps -> desactivar($id);
        echo $rspta ? "EPS Desactivada" : "EPS no se pudo Desactivar";
    break;

    case 'activar':
        $rspta = $eps -> activar($id);
        echo $rspta ? "EPS Activada" : "EPS no se pudo Activar";
    break;

    case 'mostrar':
        $rspta = $eps -> mostrar($id);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $eps -> listar();
        // Declaración de Array que contendrá todos los datos
        $data = Array();

        while ($reg = $rspta -> fetch_object())
        {
            $data[] = array(
                "0" => $reg -> id,
                "1" => $reg -> nombre_eps, 
                "2" => $reg -> telefono,
                "3" => $reg -> direccion, 
                "4" => $reg -> email, 
                "5" => $reg -> condicion
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