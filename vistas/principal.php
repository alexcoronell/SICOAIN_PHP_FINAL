<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {
    require 'header.php';

?>

        <div class="main-content container">
            <div class="row">
                <div class="col-5">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú Principal</h2>
                        </div>
                        <h1 class="display-4 text-center">SICOAIN</h1>
                        <nav>
                            <ul>
                                <li>Administración General
                                    <ul>
                                        <li><a href="usuarios.php">Usuarios</a></li>
                                        <li><a href="empleados.php">Empleados y Cargos</a></li>
                                        <li><a href="companias.php">Compañías</a></li>
                                        <li><a href="sedes.php">Sedes</a></li>
                                        <li><a href="eps.php">EPS</a></li>
                                        <li><a href="arl.php">ARL</a></li>
                                    </ul>
                                </li>
                                <li><a href="menu_incidentes.php">Administración de Incidentes</a></li>
                                <li><a href="menu_reportes.php">Reportes</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="../ajax/usuarios.php?op=salir">Cerrar Sessión</a></button>
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

    require 'footer.php';

    ?>

<?php
}
ob_end_flush();
?>