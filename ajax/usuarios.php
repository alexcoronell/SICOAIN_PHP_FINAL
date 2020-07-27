<?php

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

switch ($_GET["op"])
{
    case 'guardaryeditar' :
        if (empty($id))
        {
            $rspta = $usuarios -> insertar($usuario, $nombre, $superusuario, $administrador, $analista, $asistente, $consultas,  $contrasena);
            echo $rspta ? "Usuario registrado correctamente" : "Usuario no se pudo registrar";
        } else
        {
            $rspta = $usuarios -> editar($id, $usuario, $nombre, $superusuario, $administrador, $analista, $asistente, $consultas,  $contrasena);
            echo $rspta ? "Usuario actualizado correctamente" : "Usuario no se pudo actualizar";
        }
    break;

    case 'desactivar':
        $rspta = $usuarios -> desactivar($id);
        echo $rspta ? "Usuario Desactivado" : "Usuario no se pudo Desactivar";
    break;

    case 'activar':
        $rspta = $usuarios -> activar($id);
        echo $rspta ? "Usuario Activado" : "Usuario no se pudo Activar";
    break;

    case 'mostrar':
        $rspta = $usuarios -> mostrar($id);
        // Codificación del resultado usando Json
        echo json_encode($rspta);
    break;

    case 'listar':
        $rspta = $usuarios -> listar();
        // Declaración de Array que contendrá todos los datos
        $data = Array();

        while ($reg = $rspta -> fetch_object())
        {
            $data[] = array(
                "0" => $reg -> id,
                "1" => $reg -> usuario,
                "2" => $reg -> nombre, 
                "3" => $reg -> superusuario,
                "4" => $reg -> administrador,
                "5" => $reg -> analista,
                "6" => $reg -> asistente,
                "7" => $reg -> consultas, 
                "8" => $reg -> contrasena, 
                "9" => $reg -> condicion
            );
        }
        $results = array (
            "sEcho" => 1, // Información para la tabla
            "iTotalRecords" => count($data), // Envío del total de registros a la tabla
            "iTotalDisplayRecords" => count($data), // Total de registros a visualizar
            "aaData" => $data);
        echo json_encode($results);

    break;

    case 'verificar':
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        $rspta = $usuarios -> verificar($usuario, $contrasena);

        $fetch = $rspta -> fetch_object();

        if (isset($fetch))
        {
            //Declaración de variables de sesión
            $_SESSION['id']=$fetch -> id;
            $_SESSION['nombre']=$fetch -> nombre;
            $_SESSION['superusuario']=$fetch -> superusuario;
            $_SESSION['administrador']=$fetch -> administrador;
            $_SESSION['analista']=$fetch -> analista;
            $_SESSION['consultas']=$fetch -> consultas;
        }
        echo json_encode($fetch);
    break;
}
