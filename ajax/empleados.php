<?php
session_start();
require_once "../modelos/Empleados.php";

$empleado = new Empleados();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$fo_tipo_identificacion = isset($_POST["fo_tipo_identificacion"]) ? limpiarCadena($_POST["fo_tipo_identificacion"]) : "";
$numero_identificacion = isset($_POST["numero_identificacion"]) ? limpiarCadena($_POST["numero_identificacion"]) : "";
$nombres = isset($_POST["nombres"]) ? limpiarCadena($_POST["nombres"]) : "";
$apellidos = isset($_POST["apellidos"]) ? limpiarCadena($_POST["apellidos"]) : "";
$fo_compañia = isset($_POST["fo_compañia"]) ? limpiarCadena($_POST["fo_compañia"]) : "";
$fo_cargo = isset($_POST["fo_cargo"]) ? limpiarCadena($_POST["fo_cargo"]) : "";
$fo_sede = isset($_POST["fo_sede"]) ? limpiarCadena($_POST["fo_sede"]) : "";
$fo_departamento = isset($_POST["fo_departamento"]) ? limpiarCadena($_POST["fo_departamento"]) : "";
$fo_ciudad = isset($_POST["fo_ciudad"]) ? limpiarCadena($_POST["fo_ciudad"]) : "";
$fo_eps = isset($_POST["fo_eps"]) ? limpiarCadena($_POST["fo_eps"]) : "";
$fo_arl = isset($_POST["fo_arl"]) ? limpiarCadena($_POST["fo_arl"]) : "";
$telefono_fijo = isset($_POST["telefono_fijo"]) ? limpiarCadena($_POST["telefono_fijo"]) : "";
$telefono_celular = isset($_POST["telefono_celular"]) ? limpiarCadena($_POST["telefono_celular"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$nombre_contacto_emergencia = isset($_POST["nombre_contacto_emergencia"]) ? limpiarCadena($_POST["nombre_contacto_emergencia"]) : "";
$telefono_contacto_emergencia = isset($_POST["telefono_contacto_emergencia"]) ? limpiarCadena($_POST["telefono_contacto_emergencia"]) : "";
$parentesco_contacto_emergencia = isset($_POST["parentesco_contacto_emergencia"]) ? limpiarCadena($_POST["parentesco_contacto_emergencia"]) : "";
$comentarios = isset($_POST["comentarios"]) ? limpiarCadena($_POST["comentarios"]) : "";


switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($id)) {
            $rspta = $empleado->insertar($fo_tipo_identificacion, $numero_identificacion, $nombres, $apellidos, $fo_compañia, $fo_cargo, $fo_sede,  $fo_departamento, $fo_ciudad, $fo_eps, $fo_arl, $telefono_fijo, $telefono_celular, $email, $nombre_contacto_emergencia, $telefono_contacto_emergencia, $parentesco_contacto_emergencia, $comentarios);
            echo $rspta ? "Empleado registrado correctamente" : "Empleado no se pudo registrar";
        } else {
            $rspta = $empleado->editar($id, $fo_tipo_identificacion, $numero_identificacion, $nombres, $apellidos, $fo_compañia, $fo_cargo, $fo_sede,  $fo_departamento, $fo_ciudad, $fo_eps, $fo_arl, $telefono_fijo, $telefono_celular, $email, $nombre_contacto_emergencia, $telefono_contacto_emergencia, $parentesco_contacto_emergencia, $comentarios);
            echo $rspta ? "Empleado actualizado correctamente" : "Empleado no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $empleado->desactivar($id);
        echo $rspta ? "Empleado Desactivado" : "Empleado no se pudo Desactivar";
        break;

    case 'activar':
        $rspta = $empleado->activar($id);
        echo $rspta ? "Empleado Activado" : "Empleado no se pudo Activar";
        break;

    case 'mostrar':
        $rspta = $empleado->mostrar($id);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $empleado->listar();
        // Declaración de Array que contendrá todos los datos
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->id,
                "1" => $reg->tipo_identificacion,
                "2" => $reg->numero_identificacion,
                "3" => $reg->nombres,
                "4" => $reg->apellidos,
                "5" => $reg->compania,
                "6" => $reg->cargo,
                "7" => $reg->nombre,
                "8" => $reg->departamento,
                "9" => $reg->ciudad,
                "10" => $reg->nombre_eps,
                "11" => $reg->nombre_arl,
                "12" => $reg->telefono_fijo,
                "13" => $reg->telefono_celular,
                "14" => $reg->email,
                "15" => $reg->nombre_contacto_emergencia,
                "16" => $reg->telefono_contacto_emergencia,
                "17" => $reg->parentesco_contacto_emergencia,
                "18" => $reg->comentarios,
                "19" => $reg->condicion
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