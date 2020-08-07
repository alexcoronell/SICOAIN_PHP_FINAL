<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {
    require 'header.php';

    if ($_SESSION['superusuario'] == 1) {

?>

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú de Usuarios</h2>
                        </div>
                        <nav>
                            <ul>

                                <li><a href="creacion_usuarios.php">Creación de Usuarios</a></li>
                                <li><a href="edicion_usuarios.php">Edición de Usuarios</a></li>
                                <li><a href="act_desact_usuarios.php">Act/Desact. de Usuarios</a></li>

                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-8 pt-5 pl-0 ml-0">
                    <h1 class="textoMainColor positionFixed display-4">Administración de Usuarios</h1>
                </div>

            </div>
        </div>
        <div class="mainBackground2"></div>

    <?php
    } else {
        require 'noacceso.php';
    }

    require 'footer.php';

    ?>

<?php
}
ob_end_flush();
?>