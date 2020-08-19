<?php
session_start();
require_once "../modelos/Registros.php";

$registro = new Registros();

$id_registro = isset($_POST["id_registro"]) ? limpiarCadena($_POST["id_registro"]) : "";
$fo_suceso = isset($_POST["fo_suceso"]) ? limpiarCadena($_POST["fo_suceso"]) : "";
$fo_empleado = isset($_POST["fo_empleado"]) ? limpiarCadena($_POST["fo_empleado"]) : "";
$fecha_registro = isset($_POST["fecha_registro"]) ? limpiarCadena($_POST["fecha_registro"]) : "";
$fecha_incidente = isset($_POST["fecha_incidente"]) ? limpiarCadena($_POST["fecha_incidente"]) : "";
$descripcion = isset($_POST["descripcion"]) ? limpiarCadena($_POST["descripcion"]) : "";
$evidencia_digital = isset($_POST["evidencia_digital"]) ? limpiarCadena($_POST["evidencia_digital"]) : "";
$fo_usuario_creador = isset($_POST["fo_usuario_creador"]) ? limpiarCadena($_POST["fo_usuario_creador"]) : "";
$fo_usuario_modificador = isset($_POST["fo_usuario_modificador"]) ? limpiarCadena($_POST["fo_usuario_modificador"]) : "";
$motivo_anulacion = isset($_POST["motivo_anulacion"]) ? limpiarCadena($_POST["motivo_anulacion"]) : "";

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (!file_exists($_FILES['evidencia_digital']['tmp_name']) || !is_uploaded_file($_FILES['evidencia_digital']['tmp_name']))
        {
            $evidencia_digital = "";
        }
        else
        {
            $ext = explode('.', $_FILES['evidencia_digital']['name']);
            if ($_FILES['evidencia_digital']['type'] == 'image/jpg' || $_FILES['evidencia_digital']['type'] == 'image/jpeg' || $_FILES['evidencia_digital']['type'] == 'image/png' || $_FILES['evidencia_digital']['type'] == 'image/bmp' || $_FILES['evidencia_digital']['type'] == 'application/pdf')
            {
                $evidencia_digital = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES['evidencia_digital']['tmp_name'], '../archivos/evidencias' . $evidencia_digital);
            }
        } 
        if (empty($id_registro)) {
            $rspta = $registro->insertar($fo_suceso, $fo_empleado, $fecha_registro, $fecha_incidente, $evidencia_digital, $descripcion, $fo_usuario_creador);
            echo $rspta ? "Registro guardado correctamente" : "Registro no se pudo guardar";
        } 
        else
        {
            $rspta = $registro->editar($id_registro, $fo_suceso, $fo_empleado, $fecha_registro, $fecha_incidente, $descripcion, $evidencia_digital, $fo_usuario_creador, $fo_usuario_modificador);
            echo $rspta ? "Registro actualizado correctamente" : "Registro no se pudo actualizar";
        }
        break;

    case 'anular':
        $rspta = $registro->anular($id_registro, $motivo_anulacion);
        echo $rspta ? "Registro anulado" : "Registro no se pudo anular";
        break;

    case 'mostrar':
        $rspta = $registro->mostrar($id_registro);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $registro->listar();
        // Declaración de Array que contendrá todos los datos
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->id_registro,
                "1" => $reg->fo_suceso,
                "2" => $reg->fo_empleado,
                "3" => $reg->fecha_registro,
                "4" => $reg->fecha_incidente,
                "5" => $reg->descripcion,
                "6" => $reg->evidencia_digital,
                "7" => $reg->fo_usuario_creador,
                "8" => $reg->fo_usuario_modificador,
                "9" => $reg->motivo_anulacion,
                "10" => $reg->condidion
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
    }
