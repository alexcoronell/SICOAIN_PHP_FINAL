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
$evidencia_actual = isset($_POST["evidencia_actual"]) ? limpiarCadena($_POST["evidencia_actual"]) : "";
$evidencia_digital = isset($_POST["evidencia_digital"]) ? limpiarCadena($_POST["evidencia_digital"]) : "";
$usuario_creador = isset($_POST["usuario_creador"]) ? limpiarCadena($_POST["usuario_creador"]) : "";
$usuario_modificador = isset($_POST["usuario_modificador"]) ? limpiarCadena($_POST["usuario_modificador"]) : "";
$motivo_anulacion = isset($_POST["motivo_anulacion"]) ? limpiarCadena($_POST["motivo_anulacion"]) : "";

switch ($_GET["op"]) {
    case 'guardar':
        if (!file_exists($_FILES['evidencia_digital']['tmp_name']) || !is_uploaded_file($_FILES['evidencia_digital']['tmp_name'])) {
            $evidencia_digital = $evidencia_actual;
        } else {
            $ext = explode('.', $_FILES['evidencia_digital']['name']);
            if ($_FILES['evidencia_digital']['type'] == 'image/jpg' || $_FILES['evidencia_digital']['type'] == 'image/jpeg' || $_FILES['evidencia_digital']['type'] == 'image/png' || $_FILES['evidencia_digital']['type'] == 'image/bmp' || $_FILES['evidencia_digital']['type'] == 'application/pdf') {
                $evidencia_digital = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES['evidencia_digital']['tmp_name'], '../archivos/evidencias/' . $evidencia_digital);
            }
        }
        $rspta = $registro->insertar($fo_empleado, $fo_suceso, $fecha_registro, $fecha_incidente, $descripcion, $evidencia_digital);
        echo $rspta ? "Registro guardado correctamente" : "Registro no se pudo guardar";
        break;

    case 'editar':
        if (!file_exists($_FILES['evidencia_digital']['tmp_name']) || !is_uploaded_file($_FILES['evidencia_digital']['tmp_name'])) {
            $evidencia_digital = $evidencia_actual;
        } else {
            $ext = explode('.', $_FILES['evidencia_digital']['name']);
            if ($_FILES['evidencia_digital']['type'] == 'image/jpg' || $_FILES['evidencia_digital']['type'] == 'image/jpeg' || $_FILES['evidencia_digital']['type'] == 'image/png' || $_FILES['evidencia_digital']['type'] == 'image/bmp' || $_FILES['evidencia_digital']['type'] == 'application/pdf') {
                $evidencia_digital = round(microtime(true)) . '.' . end($ext);
                move_uploaded_file($_FILES['evidencia_digital']['tmp_name'], '../archivos/evidencias/' . $evidencia_digital);
            }
        }
        $rspta = $registro->editar($id_registro, $fo_empleado, $fo_suceso, $fecha_incidente, $descripcion, $evidencia_digital);
        echo $rspta ? "Registro actualizado correctamente" : "Registro no se pudo actualizar";
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
                "1" => $reg->numero_identificacion,
                "2" => $reg->nombres,
                "3" => $reg->apellidos,
                "4" => $reg->nombre,
                "5" => $reg->fecha_registro,
                "6" => $reg->fecha_incidente,
                "7" => $reg->descripcion,
                "8" => ($reg->evidencia_digital) ? '<a href="../archivos/evidencias/'.$reg->evidencia_digital.'" class="enlaceEvidencia" target="_blank"><i class="fa fa-link" aria-hidden="true"></i> Ver Evidencia</a>' : '<span class="sinEvidencia">Sin Evidencia</span>',
                "9" => $reg->motivo_anulacion,
                "10" => ($reg -> condicion) ? '<span class="registroActivado">Activado</span>' : '<span class="registroDesactivado">Anulado</span>'
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

        case "selectRegistro":
            $rspta = $registro -> select();
    
            while ($reg = $rspta -> fetch_object())
            {
                echo '<option value=' . $reg -> id_registro . '>' . $reg -> id_registro . '</option>';
            }
        break;
}
