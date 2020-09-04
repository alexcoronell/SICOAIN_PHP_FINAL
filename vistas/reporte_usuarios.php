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
                <div class="col-12 col-md-4">
                    <div class="menu-box menu-box-modulos">
                        <div class="title-menu">
                            <h2>Menú de Reportes</h2>
                        </div>
                        <nav>
                            <ul>

                                <li><a href="reporte_usuarios.php" class="active">Usuarios</a></li>
                                <li><a href="reporte_empleados.php">Empleados</a></li>
                                <li><a href="reporte_cargos.php">Cargos</a></li>
                                <li><a href="reporte_companias.php">Compañías</a></li>
                                <li><a href="reporte_sedes.php">Sedes</a></li>
                                <li><a href="reporte_eps.php">EPS</a></li>
                                <li><a href="reporte_arl.php">ARL</a></li>
                                <li><a href="reporte_registros.php">Incidentes</a></li>
                                <li><a href="reporte_sucesos.php">Sucesos</a></li>

                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>


                <div class="col-12 col-md-8">
                    <div class="box-reporte-md container mt-1 ml-n2">
                        <h2 class="text-center title-formularios">Reporte de Usuarios</h2>
                        <div class="overflow-auto table-box">
                            <table class="tabla-md table-striped table-bordered table-condensed table-hover" id="tbllistado">
                                <thead>
                                    <th>Id</th>
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Superusuario</th>
                                    <th>Administrador</th>
                                    <th>Analista</th>
                                    <th>Asistente</th>
                                    <th>Consultas</th>
                                    <th>Condicion</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="boton-mobile-regresar boton-mobile-regresar-reportes col-12 px-0 pt-4 w-100 text-center">
            <button class="btn btn-light px-5"><a href="menu_reportes.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
        </div>
        <div class="posicionador-bottom soloMobile"></div>
    <?php

    } else {
        require 'noacceso.php';
    }

    require 'footer.php';

    ?>

    <script src="scripts/reporte_usuarios.js"></script>

<?php
}
ob_end_flush();
?>