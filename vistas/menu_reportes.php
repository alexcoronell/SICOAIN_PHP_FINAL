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

        <div class="main-content container">
            <div class="row">
                <div class="col-4">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú de Reportes</h2>
                        </div>
                        <h1 class="display-4 text-center">SICOAIN</h1>
                        <nav>
                            <ul>
                                <li>Reportes
                                    <ul>
                                        <li><a href="reporte_usuarios.php">Usuarios</a></li>
                                        <li><a href="reporte_empleados.php">Empleados</a></li>
                                        <li><a href="reporte_cargos.php">Cargos</a></li>
                                        <li><a href="reporte_companias.php">Compañías</a></li>
                                        <li><a href="reporte_sedes.php">Sedes</a></li>
                                        <li><a href="reporte_eps.php">EPS</a></li>
                                        <li><a href="reporte_arl.php">ARL</a></li>
                                        <li><a href="reporte_incidentes.php">Incidentes</a></li>
                                        <li><a href="reporte_sucesos.php">Sucesos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>

            </div>
        </div>
        </div>

<?php
    } else {
        require 'noacceso.php';
    }

    require 'footer.php';
}
ob_end_flush();

?>