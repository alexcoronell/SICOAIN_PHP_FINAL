<?php

require_once "../modelos/Ciudades.php";

$ciudadS = new Ciudades();


switch ($_GET["op"]) {
    case "selectAll":
        $rspta = $ciudadS->selectAll();

        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->id_ciudad . '>' . $reg->ciudad . '</option>';
        }
        break;

    case "selectCiudad":
        $rspta = $ciudadS->select($fo_departamento);

        while ($reg = $rspta->fetch_object()) {
            echo '<option value=' . $reg->id_ciudad . '>' . $reg->ciudad . ' Coño </option>';
        }
        break;
}
