<?php

require 'header.php';

?>
<div class="container-fluid main-box">
    <div class="title-page">
        <h1>SICOAIN - Sistema de Control de Accidentes e Incidentes - Administración de Incidentes</h1>
    </div>
    <div class="main-content container">
        <div class="row">
            <div class="col-4">
                <div class="menu-box">
                    <div class="title-menu">
                        <h2>Menú de Incidentes y Sucesos</h2>
                    </div>
                    <h1 class="display-4 text-center">SICOAIN</h1>
                    <nav>
                        <ul>
                            <li>Administración de Incidentes
                                <ul>
                                    <li><a href="creacion_registro.php">Creación de Registro</a></li>
                                    <li><a href="edicion_registro.php">Edición de Registro</a></li>
                                    <li><a href="anulacion_registro">Anulación de Registro</a></li>
                                </ul>
                            </li>
                            <li>Administración de Sucesos
                                <ul>
                                    <li><a href="creacion_sucesos.php">Creación de Sucesos</a></li>
                                    <li><a href="edicion_sucesos.php">Edición de Sucesos</a></li>
                                    <li><a href="act_desact_sucesos.php" class="active">Act/Desact. de Sucesos</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <button class="btn btn-light salir-menu"><a href="principal.html">Regresar</a></button>
                </div>
            </div>
            <div class="col-8">
                <div class="box-formulario container mt-5">
                    <h2 class="text-center title-formularios">Act/Desact. de Sucesos</h2>
                    <!-- Busqueda -->
                    <div class="form-group row">
                        <label for="rol" class="col-4">Buscar Suceso:</label>
                        <div class="col-8 searchbox">
                            <input type="search" class="form-control" name="buscarId" id="buscarId" placeholder="Nro. de Rol">
                            <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscarAct()"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>

                    <!-- Formulario -->
                    <form name="formulario" id="formulario" method="POST">

                        <div class="form-group row">
                            <label for="suceso" class="col-4">Nombre Suceso:</label>
                            <div class="col-8">
                                <input type="hidden" name="id" id="id">
                                <input type="text" class="form-control" name="nombre" id="nombre" disabled>
                            </div>
                        </div>
                    </form>

                    <!-- Área de botones -->
                    <div class="form-group row">
                            <div class="offset-4 col-4">
                                <button type="submit" id="button_default" class="btn btn-light" disabled>Act/Desact</button>
                                <button type="submit" id="button_activar" class="btn btn-primary" onclick="activar()">Activar</button>
                                <button type="submit" id="button_desactivar" class="btn btn-danger" onclick="desactivar()">Desactivar</button>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-light" onclick="MostrarDefault()">Cancelar</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

require 'footer.php';

?>

<script src="scripts/gestion_sucesos.js"></script>