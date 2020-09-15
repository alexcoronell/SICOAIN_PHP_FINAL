<?php

require_once "../modelos/Ciudades.php";

$ciudadS = new Ciudades();

$dptorecibido = $_GET["dpto"];

$rspta = $ciudadS->select($dptorecibido);
while ($reg = $rspta->fetch_object()) {
    echo '<option value=' . $reg->id_ciudad . '>' . $reg->ciudad . '</option>';
}
