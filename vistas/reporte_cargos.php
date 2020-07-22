<?php

require 'header.php';

?>

    <div class="container-fluid main-box">
        <div class="title-page">
            <h1>SICOAIN - Sistema de Control de Accidentes e Incidentes - Reportes</h1>
        </div>
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
                                        <li><a href="reporte-usuarios.html">Usuarios</a></li>
                                        <li><a href="reporte-roles.html">Roles</a></li>
                                        <li><a href="reporte-empleados.html">Empleados</a></li>
                                        <li><a href="reporte_cargos.php" class="active">Cargos</a></li>
                                        <li><a href="reporte-companias.html">Compañías</a></li>
                                        <li><a href="reporte-sedes.html">Sedes</a></li>
                                        <li><a href="reporte-eps.html">EPS</a></li>
                                        <li><a href="reporte-arl.html">ARL</a></li>
                                        <li><a href="reporte-incidentes.html">Incidentes</a></li>
                                        <li><a href="reporte-sucesos.html">Sucesos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="menu-reportes.html">Regresar</a></button>
                    </div>
                </div>
                <div class="col-8">
                    <div class="box-reporte-md container mt-5">
                        <h2 class="text-center title-formularios">Reporte de Cargos</h2>
                        <table class="tabla-md table-striped table-bordered table-condensed table-hover" id="tbllistado">
                        <thead>
                            <th>Id</th>
                            <th>Cargo</th>
                            <th>Descripción</th>
                            <th>Condicion</th>
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

require 'footer.php';

?>

<script src="scripts/reporte_cargos.js"></script>