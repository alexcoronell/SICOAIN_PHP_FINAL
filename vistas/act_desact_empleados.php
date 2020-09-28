<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {
    require 'header.php';

    if (($_SESSION['superusuario'] == 1) || (($_SESSION['administrador'] == 1)) || (($_SESSION['analista'] == 1))) {

?>

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="menu-box menu-box-modulos">
                        <div class="title-menu">
                            <h2>Menú de Empleados</h2>
                        </div>
                        <nav>
                            <ul>
                                <li>Administración de Empleados
                                    <ul>
                                        <li><a href="creacion_empleados.php">Creación de Empleados</a></li>
                                        <li><a href="edicion_empleados.php">Edición de Empleados</a></li>
                                        <li><a href="act_desact_empleados.php" class="active">Act/Desact. de Empleados</a></li>
                                    </ul>
                                </li>
                                <li>Administración de Cargos
                                    <ul>
                                        <li><a href="creacion_cargos.php">Creación de Cargos</a></li>
                                        <li><a href="edicion_cargos.php">Edición de Cargos</a></li>
                                        <li><a href="act_desact_cargos.php">Act/Desact. de Cargos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8 p-0">
                    <div class="box-formulario container mt-1 p-0 ml-0">
                        <h2 class="text-center title-formularios">Activación/Desactivación de Empleados</h2>
                        <!-- Búsqueda -->
                        <div class="form-group row grupoBusqueda mt-5">
                            <label for="rol" class="col-2 col-lg-4 mt-2">Buscar:</label>
                            <div class="col-10 col-lg-8 searchbox">
                                <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true" required></select>
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscarAct()"><i class="fa fa-search min992" aria-hidden="true"></i>Cargar</button>
                            </div>
                        </div>

                        <div class="formularioEditActDesact mt-2">
                            <!-- Formulario -->
                            <form name="formulario" id="formulario" method="POST">
                                <input type="hidden" name="id" id="id">

                                <!-- Tipo de Identificación -->
                                <div class="form-group row">
                                    <label for="fo_tipo_identificacion" class="col-12 col-md-4 mt-2">Tipo identificación:*</label>
                                    <div class="col-12 col-md-8">
                                        <select name="fo_tipo_identificacion" id="fo_tipo_identificacion" class="form-control selectpicker" title="Seleccione..." data-live-search="true" disabled></select>
                                    </div>
                                </div>

                                <!-- Número de Identificación -->
                                <div class="form-group row">
                                    <label for="numero_identificacion" class="col-12 col-md-4 mt-2">Nro. identificación:*</label>
                                    <div class="col-12 col-md-8">
                                        <input type="text" class="form-control pl-3" name="numero_identificacion" id="numero_identificacion" disabled>
                                    </div>
                                </div>

                                <!-- Nombres -->
                                <div class="form-group row">
                                    <label for="nombres" class="col-12 col-md-4 mt-2">Nombres: *</label>
                                    <div class="col-12 col-md-8">
                                        <input type="text" class="form-control pl-3" name="nombres" id="nombres" disabled>
                                    </div>
                                </div>

                                <!-- Apellidos -->
                                <div class="form-group row">
                                    <label for="apellidos" class="col-12 col-md-4 mt-2">Apellidos: *</label>
                                    <div class="col-12 col-md-8">
                                        <input type="text" class="form-control pl-3" name="apellidos" id="apellidos" disabled>
                                    </div>
                                </div>
                            </form>
                            <div class="col-12">
                                <!-- Área de botones -->
                                <div class="form-group row">
                                    <div class="col-6 offset-md-4 col-md-4">
                                        <button type="submit" id="button_default" class="btn btn-light" disabled>Act/Desact</button>
                                        <button type="submit" id="button_activar" class="btn btn-primary" onclick="activar()">Activar</button>
                                        <button type="submit" id="button_desactivar" class="btn btn-danger" onclick="desactivar()">Desactivar</button>
                                    </div>
                                    <div class="col-6 col-md-4 text-right">
                                        <button type="button" class="btn btn-light" onclick="MostrarDefault()">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="empleados.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
                        </div>
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

    <script src="scripts/gestion_empleados.js"></script>

<?php
}
ob_end_flush();
?>