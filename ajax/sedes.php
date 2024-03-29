<?php
session_start();
require_once "../modelos/Sedes.php";

$sede = new Sedes();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$fo_compania = isset($_POST["fo_compania"]) ? limpiarCadena($_POST["fo_compania"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$telefono = isset($_POST["telefono"]) ? limpiarCadena($_POST["telefono"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$notas = isset($_POST["notas"]) ? limpiarCadena($_POST["notas"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar' :
        if (empty($id))
        {
            $rspta = $sede -> insertar($fo_compania, $nombre, $telefono, $direccion, $notas);
            echo $rspta ? "Sede registrada correctamente" : "Compañía no se pudo registrar";
        } else
        {
            $rspta = $sede -> editar($id, $fo_compania, $nombre, $telefono, $direccion, $notas);
            echo $rspta ? "Sede actualizada correctamente" : "Compañía no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta = $sede->desactivar($id);
        echo $rspta ? "Sede Desactivada" : "Sede no se pudo Desactivar";
        break;

    case 'activar':
        $rspta = $sede->activar($id);
        echo $rspta ? "Sede Activada" : "Sede no se pudo Activar";
        break;

    case 'mostrar':
        $rspta = $sede->mostrar($id);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $sede->listar();
        // Declaración de Array que contendrá todos los datos
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->id,
                "1" => $reg->compania,
                "2" => $reg->nombre,
                "3" => $reg->telefono,
                "4" => $reg->direccion,
                "5" => $reg->notas,
                "6" => ($reg -> condicion) ? '<span class="registroActivado">Activado</span>' : '<span class="registroDesactivado">Desactivado</span>'
            );
        }
        $results = array(
            "sEcho" => 1, // Información para la tabla
            "iTotalRecords" => count($data), // Envío del total de registros a la tabla
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data
        );
        echo json_encode($results);

        break;

        case "selectSede":
            $rspta = $sede -> select();
    
            while ($reg = $rspta -> fetch_object())
            {
                echo '<option value=' . $reg -> id . '>' . $reg -> nombre . '</option>';
            }
        break;

        case "selectSedeAll":
            $rspta = $sede -> listar();
    
            while ($reg = $rspta -> fetch_object())
            {
                echo '<option value=' . $reg -> id . '>' . $reg -> nombre . '</option>';
            }
        break;


}
