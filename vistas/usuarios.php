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
        <div class="container-fluid main-box">
            <div class="title-page">
                <h1>SICOAIN - Sistema de Control de Accidentes e Incidentes - Administración de Usuarios</h1>
            </div>
            <div class="main-content container">
                <div class="row">
                    <div class="col">
                        <div class="menu-box">
                            <div class="title-menu">
                                <h2>Menú de Usuarios</h2>
                            </div>
                            <h1 class="display-4 text-center">SICOAIN</h1>
                            <nav>
                                <ul>
                                    <li>Administración de Usuarios
                                        <ul>
                                            <li><a href="creacion_usuarios.php">Creación de Usuarios</a></li>
                                            <li><a href="edicion_usuarios.php">Edición de Usuarios</a></li>
                                            <li><a href="act_desact_usuarios.php">Act/Desact. de Usuarios</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                            <button class="btn btn-light salir-menu"><a href="principal.html">php</a></button>
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