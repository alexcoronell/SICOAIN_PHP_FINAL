<?php

require_once "../modelos/Evidencias_Digitales.php";

$evidencia = new Evidencia();

$id_evidencia_digital = isset($_POST["id_evidencia_digital"]) ? limpiarCadena($_POST["id_evidencia_digital"]) : "";
$fo_registro = isset($_POST["fo_registro"]) ? limpiarCadena($_POST["fo_registro"]) : "";
$archivo = isset($_POST["archivo"]) ? limpiarCadena($_POST["archivo"]) : "";

switch ($_GET["op"])
{
    case 'guardar' :
            $rspta = $evidencia -> insertar($fo_registro, $archivo);
            echo $rspta ? "Archivo cargado correctamente" : "Archivo no se pudo cargar";
    break;

    case 'eliminar':
        $rspta = $evidencia -> eliminar($id_evidencia_digital);
        echo $rspta ? "Archivo Eliminado" : "Archivo no se pudo eliminar";
    break;

    case 'mostrar':
        $rspta = $evidencia -> mostrar($id_evidencia_digital);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $evidencia -> listar();
        // Declaración de Array que contendrá todos los datos
        $data = Array();

        while ($reg = $rspta -> fetch_object())
        {
            $data[] = array(
                "0" => $reg -> id_evidencia_digital,
                "1" => $reg -> fo_registro, 
                "2" => $reg -> archivo
            );
        }
        $results = array (
            "sEcho" => 1, // Información para la tabla
            "iTotalRecords" => count($data), // Envío del total de registros a la tabla
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

    break;

    case 'listar_por_registro':
        $rspta = $evidencia -> listar_por_registro($fo_registro);
        // Declaración de Array que contendrá todos los datos
        $data = Array();

        while ($reg = $rspta -> fetch_object())
        {
            $data[] = array(
                "0" => $reg -> id_evidencia_digital,
                "1" => $reg -> fo_registro, 
                "2" => $reg -> archivo
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