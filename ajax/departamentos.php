<?php

require_once "../modelos/Departamentos.php";

$departamentoS = new Departamentos();


switch ($_GET["op"])
{

    case "selectDepartamento":
        $rspta = $departamentoS -> select();

        while ($reg = $rspta -> fetch_object())
        {
            echo '<option id="departamento" value=' . $reg -> id_departamento . '>' . $reg -> departamento . '</option>';
        }
    break;

}

?>