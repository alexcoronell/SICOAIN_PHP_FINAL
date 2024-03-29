<?php
session_start();
require_once "../modelos/Usuarios.php";

$usuarios = new Usuarios();

$id = isset($_POST["id"]) ? limpiarCadena($_POST["id"]) : "";
$usuario = isset($_POST["usuario"]) ? limpiarCadena($_POST["usuario"]) : "";
$nombre = isset($_POST["nombre"]) ? limpiarCadena($_POST["nombre"]) : "";
$superusuario = isset($_POST["superusuario"]) ? limpiarCadena($_POST["superusuario"]) : "";
$administrador = isset($_POST["administrador"]) ? limpiarCadena($_POST["administrador"]) : "";
$analista = isset($_POST["analista"]) ? limpiarCadena($_POST["analista"]) : "";
$asistente = isset($_POST["asistente"]) ? limpiarCadena($_POST["asistente"]) : "";
$consultas = isset($_POST["consultas"]) ? limpiarCadena($_POST["consultas"]) : "";
$contrasena = isset($_POST["contrasena"]) ? limpiarCadena($_POST["contrasena"]) : "";

$contrasenaHash = hash("SHA256", $contrasena);

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($id)) {
            $rspta = $usuarios->insertar($usuario, $nombre, $superusuario, $administrador, $analista, $asistente, $consultas,  $contrasenaHash);
            echo $rspta ? "Usuario registrado correctamente" : "Usuario no se pudo registrar";
        } else {
            $rspta = $usuarios->editar($id, $usuario, $nombre, $superusuario, $administrador, $analista, $asistente, $consultas);
            echo $rspta ? "Usuario actualizado correctamente" : "Usuario no se pudo actualizar";
        }
        break;

    case 'desactivar':
        $rspta = $usuarios->desactivar($id);
        echo $rspta ? "Usuario Desactivado" : "Usuario no se pudo Desactivar";
        break;

    case 'activar':
        $rspta = $usuarios->activar($id);
        echo $rspta ? "Usuario Activado" : "Usuario no se pudo Activar";
        break;

    case 'actualizarcontrasena':
        $rspta = $usuarios->actualizarContrasena($id, $contrasenaHash);
        echo $rspta ? "Contraseña Actualizada Correctamente" : "Contraseña no se pudo actualizar";
    break;

    case 'mostrar':
        $rspta = $usuarios->mostrar($id);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
        break;

    case 'listar':
        $rspta = $usuarios->listar();
        // Declaración de Array que contendrá todos los datos
        $data = array();

        while ($reg = $rspta->fetch_object()) {
            $data[] = array(
                "0" => $reg->id,
                "1" => $reg->usuario,
                "2" => $reg->nombre,
                "3" => ($reg->superusuario) ? '<i class="fa fa-check-circle-o permisoAsignado" aria-hidden="true"></i><span class="permisoAsignado">Asignado</span>' : '<span></span>',
                "4" => ($reg->administrador) ? '<i class="fa fa-check-circle-o permisoAsignado" aria-hidden="true"></i><span class="permisoAsignado">Asignado</span>' : '<span></span>',
                "5" => ($reg->analista) ? '<i class="fa fa-check-circle-o permisoAsignado" aria-hidden="true"></i><span class="permisoAsignado">Asignado</span>' : '<span></span>',
                "6" => ($reg->asistente) ? '<i class="fa fa-check-circle-o permisoAsignado" aria-hidden="true"></i><span class="permisoAsignado">Asignado</span>' : '<span></span>',
                "7" => ($reg->consultas) ? '<i class="fa fa-check-circle-o permisoAsignado" aria-hidden="true"></i><span class="permisoAsignado">Asignado</span>' : '<span></span>',
                "8" => ($reg -> condicion) ? '<span class="registroActivado">Activado</span>' : '<span class="registroDesactivado">Desactivado</span>'
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

    case 'verificar':
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        $rspta = $usuarios->verificar($usuario, $contrasenaHash);

        $fetch = $rspta->fetch_object();

        if (isset($fetch)) {
            //Declaración de variables de sesión
            $_SESSION['id'] = $fetch->id;
            $_SESSION['nombre'] = $fetch->nombre;
            $_SESSION['superusuario'] = $fetch->superusuario;
            $_SESSION['administrador'] = $fetch->administrador;
            $_SESSION['analista'] = $fetch->analista;
            $_SESSION['asistente'] = $fetch->asistente;
            $_SESSION['consultas'] = $fetch->consultas;
        }
        echo json_encode($fetch);
        break;

    case 'salir':
        // Se limpian las variables de sessión
        session_unset();

        // Se destruye la sesión
        session_destroy();

        // Se redirecciona al login
        header("location: ../index.php");
        break;

    case "selectUsuario":
        $rspta = $usuarios->mostrarUsuarios();
    
        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->id . '>' . $reg->usuario . '</option>';
        }
        break;
}
