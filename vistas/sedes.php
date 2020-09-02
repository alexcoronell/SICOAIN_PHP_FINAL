<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {
    require 'header.php';

    if (($_SESSION['superusuario'] == 1) || (($_SESSION['administrador'] == 1))) {

?>
        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú de Sedes</h2>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="creacion_sedes.php">Creación de Sedes</a></li>
                                <li><a href="edicion_sedes.php">Edición de Sedes</a></li>
                                <li><a href="act_desact_sedes.php">Act/Desact. de Sedes</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
                    </div>
                </div>
                <div class="col-8 pt-5 pl-0 ml-0 titleBig">
                    <h1 class="textoMainColor positionFixed display-4">Administración de Sedes</h1>
                </div>
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