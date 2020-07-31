<?php

require_once "../modelos/Tipo_identificacion.php";

$identificacion = new TipoIdentificacion();


switch ($_GET["op"])
{

    case "selectIdentificacion":
        $rspta = $identificacion -> select();

        while ($reg = $rspta -> fetch_object())
        {
            echo '<option value=' . $reg -> id_tipo_identificacion . '>' . $reg -> tipo_identificacion . '</option>';
        }
    break;

}

?>