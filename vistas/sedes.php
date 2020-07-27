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
        <div class="main-content container">
            <div class="row">
                <div class="col-5">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú de Sedes</h2>
                        </div>
                        <h1 class="display-4 text-center">SICOAIN</h1>
                        <nav>
                            <ul>
                                <li>Administración de Sedes
                                    <ul>
                                        <li><a href="creacion_sedes.php">Creación de Sedes</a></li>
                                        <li><a href="edicion_sedes.php">Edición de Sedes</a></li>
                                        <li><a href="act_desact_sedes.php">Act/Desact. de Sedes</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col calendar">
                    <img src="img/calendar.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

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