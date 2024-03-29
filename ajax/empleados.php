<?php
session_start();
require_once "../modelos/Empleados.php";

$empleado = new Empleados();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$fo_tipo_identificacion = isset($_POST["fo_tipo_identificacion"]) ? limpiarCadena($_POST["fo_tipo_identificacion"]) : "";
$numero_identificacion = isset($_POST["numero_identificacion"]) ? limpiarCadena($_POST["numero_identificacion"]) : "";
$nombres = isset($_POST["nombres"]) ? limpiarCadena($_POST["nombres"]) : "";
$apellidos = isset($_POST["apellidos"]) ? limpiarCadena($_POST["apellidos"]) : "";
$fo_departamento = isset($_POST["fo_departamento"]) ? limpiarCadena($_POST["fo_departamento"]) : "";
$fo_ciudad = isset($_POST["fo_ciudad"]) ? limpiarCadena($_POST["fo_ciudad"]) : "";
$direccion = isset($_POST["direccion"]) ? limpiarCadena($_POST["direccion"]) : "";
$telefono_fijo = isset($_POST["telefono_fijo"]) ? limpiarCadena($_POST["telefono_fijo"]) : "";
$telefono_celular = isset($_POST["telefono_celular"]) ? limpiarCadena($_POST["telefono_celular"]) : "";
$email = isset($_POST["email"]) ? limpiarCadena($_POST["email"]) : "";
$fo_compania = isset($_POST["fo_compania"]) ? limpiarCadena($_POST["fo_compania"]) : "";
$fo_sede = isset($_POST["fo_sede"]) ? limpiarCadena($_POST["fo_sede"]) : "";
$fo_cargo = isset($_POST["fo_cargo"]) ? limpiarCadena($_POST["fo_cargo"]) : "";
$fo_eps = isset($_POST["fo_eps"]) ? limpiarCadena($_POST["fo_eps"]) : "";
$fo_arl = isset($_POST["fo_arl"]) ? limpiarCadena($_POST["fo_arl"]) : "";
$nombre_contacto_emergencia = isset($_POST["nombre_contacto_emergencia"]) ? limpiarCadena($_POST["nombre_contacto_emergencia"]) : "";
$telefono_contacto_emergencia = isset($_POST["telefono_contacto_emergencia"]) ? limpiarCadena($_POST["telefono_contacto_emergencia"]) : "";
$parentesco_contacto_emergencia = isset($_POST["parentesco_contacto_emergencia"]) ? limpiarCadena($_POST["parentesco_contacto_emergencia"]) : "";
$comentarios = isset($_POST["comentarios"]) ? limpiarCadena($_POST["comentarios"]) : "";


switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($id)) {
            $rspta = $empleado->insertar($fo_tipo_identificacion, $numero_identificacion, $nombres, $apellidos, $fo_departamento, $fo_ciudad, $direccion, $telefono_fijo, $telefono_celular, $email, $fo_compania, $fo_sede, $fo_cargo, $fo_eps, $fo_arl, $nombre_contacto_emergencia, $telefono_contacto_emergencia, $parentesco_contacto_emergencia, $comentarios);
            echo $rspta ? "Empleado registrado correctamente" : "Empleado no se pudo registrar";
        } else {
            $rspta = $empleado->editar($id, $fo_tipo_identificacion, $numero_identificacion, $nombres, $apellidos, $fo_departamento, $fo_ciudad, $direccion, $telefono_fijo, $telefono_celular, $email, $fo_compania, $fo_sede, $fo_cargo, $fo_eps, $fo_arl, $nombre_contacto_emergencia, $telefono_contacto_emergencia, $parentesco_contacto_emergencia, $comentarios);
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
        $rspta = $empleado->mostrar($numero_identificacion);
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
                "1" => '<a href="reporte_empleado_individual.php?id=' . $reg->id . '" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>',
                "2" => $reg->tipo_identificacion,
                "3" => $reg->numero_identificacion,
                "4" => $reg->nombres,
                "5" => $reg->apellidos,
                "6" => $reg->departamento,
                "7" => $reg->ciudad,
                "8" => $reg->direccion,
                "9" => $reg->telefono_fijo,
                "10" => $reg->telefono_celular,
                "11" => $reg->email,
                "12" => $reg->compania,
                "13" => $reg->nombre,
                "14" => $reg->cargo,
                "15" => $reg->nombre_eps,
                "16" => $reg->nombre_arl,
                "17" => $reg->nombre_contacto_emergencia,
                "18" => $reg->telefono_contacto_emergencia,
                "19" => $reg->parentesco_contacto_emergencia,
                "20" => $reg->comentarios,
                "21" => ($reg->condicion) ? '<span class="registroActivado">Activado</span>' : '<span class="registroDesactivado">Desactivado</span>'
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
    case "selectEmpleado":
        $rspta = $empleado->select();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->id . '>' . $reg->numero_identificacion . '</option>';
        }
        break;

    case "consultaNombreApellido":
        $rspta = $empleado->consultaNA($numero_identificacion);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
        break;


    case "selectNumeroIdentificacion":
        $rspta = $empleado->mostrarCedulas();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->numero_identificacion . '>' . $reg->numero_identificacion . '</option>';
        }
        break;
}
