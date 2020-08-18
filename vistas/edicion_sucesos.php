<?php

require 'header.php';

?>

<div class="main-content container-fluid">
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
                                <li><a href="creacion_registros.php">Creación de Registros</a></li>
                                <li><a href="edicion_registros.php">Edición de Registros</a></li>
                                <li><a href="anulacion_registros.php">Anulación de Registros</a></li>
                            </ul>
                        </li>
                        <li>Administración de Sucesos
                            <ul>
                                <li><a href="creacion_sucesos.php">Creación de Sucesos</a></li>
                                <li><a href="edicion_sucesos.php" class="active">Edición de Sucesos</a></li>
                                <li><a href="act_desact_sucesos.php">Act/Desact. de Sucesos</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
            </div>
        </div>
        <div class="col-8">
        <div class="box-formulario container mt-1 ml-1">
                <h2 class="text-center title-formularios">Edición de Sucesos</h2>
                <!-- Busqueda -->
                <div class="form-group row">
                    <label for="rol" class="col-4">Buscar Suceso:</label>
                    <div class="col-8 searchbox">
                        <input type="search" class="form-control" name="buscarId" id="buscarId" placeholder="Nro. de Rol">
                        <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                </div>

                <!-- Formulario -->
                <form name="formulario" id="formulario" method="POST">

                    <div class="form-group row">
                        <label for="nombre" class="col-4">Nombre Suceso:</label>
                        <div class="col-8">
                            <input type="hidden" name="id" id="id">
                            <input type="text" class="form-control" name="nombre" id="nombre">
                        </div>
                    </div>

                    <!-- Botones de formulario -->
                    <div class="form-group row">
                        <div class="offset-4 col-4">
                            <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                        </div>
                        <div class="col-4">
                            <button type="button" class="btn btn-light" id="btnCancelar" onclick="limpiar()">Cancelar</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php

require 'footer.php';

?>

<script src="scripts/gestion_sucesos.js"></script>