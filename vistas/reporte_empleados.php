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
                                    <ul>
                                            <li><a href="reporte_usuarios.php">Usuarios</a></li>
                                            <li><a href="reporte_roles.php">Roles</a></li>
                                            <li><a href="reporte-empleados.php" class="active">Empleados</a></li>
                                            <li><a href="reporte_cargos.php">Cargos</a></li>
                                            <li><a href="reporte_companias.php">Compañías</a></li>
                                            <li><a href="reporte_sedes.php">Sedes</a></li>
                                            <li><a href="reporte_eps.php">EPS</a></li>
                                            <li><a href="reporte_arl.php">ARL</a></li>
                                            <li><a href="reporte_incidentes.php">Incidentes</a></li>
                                            <li><a href="reporte_sucesos.php">Sucesos</a></li>
                                        </ul>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="menu_reportes.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-8 pl-0">
                    <div class="box-reporte container mt-5">
                        <h2 class="text-center title-formularios">Reporte de Empleados</h2>
                        <div class="overflow-auto">
                        <table class="tabla-md table-striped table-bordered table-condensed table-hover" id="tbllistado">
                                <thead>
                                    <th>Id.</th>
                                    <th>Tipo Identificación</th>
                                    <th>Nro. Identificación</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Departamento</th>
                                    <th>Ciudad</th>
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Celular</th>
                                    <th>email</th>
                                    <th>Compañía</th>
                                    <th>Sede</th>
                                    <th>Cargo</th>
                                    <th>EPS</th>
                                    <th>ARL</th>
                                    <th>Nombre Contacto</th>
                                    <th>Teléfono Contacto</th>
                                    <th>Parentesco Contacto</th>
                                    <th>Comentarios</th>
                                    <th>Cóndición</th>
                                </thead>
                                
                            </table>
                        </div>
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

    <script src="scripts/reporte_empleados.js"></script>

<?php
}
ob_end_flush();
?>