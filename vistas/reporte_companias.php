<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {
    require 'header.php';

    if (($_SESSION['superusuario'] == 1) || (($_SESSION['administrador'] == 1)) || (($_SESSION['analista'] == 1)) || (($_SESSION['asistente'] == 1)) || (($_SESSION['consultas'] == 1))) {

?>

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú de Reportes</h2>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="reporte_usuarios.php">Usuarios</a></li>
                                <li><a href="reporte_empleados.php">Empleados</a></li>
                                <li><a href="reporte_cargos.php">Cargos</a></li>
                                <li><a href="reporte_companias.php" class="active">Compañías</a></li>
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
                <div class="col-8">
                    <div class="box-reporte-md container mt-1 ml-n2">
                        <h2 class="text-center title-formularios">Reporte de Compañías</h2>
                        <table class="dataTable tabla-md table-striped table-bordered table-condensed table-hover" id="tbllistado">
                            <thead>
                                <th>Id</th>
                                <th>Compañía</th>
                                <th>Teléfono</th>
                                <th>Dirección</th>
                                <th>Condición</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <button type="button" class="btn btn-light mt-2">Generar PDF</button>
                        <button type="button" class="btn btn-light float-right mt-2">Imprimir</button>
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

    ?>

    <script src="scripts/reporte_companias.js"></script>

<?php
}
ob_end_flush();
?>