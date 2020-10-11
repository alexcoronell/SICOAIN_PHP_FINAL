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
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="menu-box menu-box-modulos">
                        <div class="title-menu">
                            <h2>Menú de Usuarios</h2>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="creacion_usuarios.php">Creación de Usuarios</a></li>
                                <li><a href="edicion_usuarios.php" class="active">Edición de Usuarios</a></li>
                                <li><a href="contrasena_usuarios.php">Contraseña de Usuarios</a></li>
                                <li><a href="act_desact_usuarios.php">Act/Desact. de Usuarios</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8 col-xl-9 px-0 pr-xl-5">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Edición de Usuarios</h2>
                        <!-- Busqueda -->
                        <div class="form-group row grupoBusqueda mt-3">
                            <label for="buscarId" class="col-2 col-lg-4 mt-2">Buscar<span class="soloDesktop"> Usuario</span>:</label>
                            <div class="col-10 col-lg-8 searchbox">
                                <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true" required></select>
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-arrow-circle-o-up min992" aria-hidden="true" title="Cargar Información" alt="Cargar Información"></i>Cargar</button>
                            </div>
                        </div>

                        <!-- Formulario -->
                        <form name="formulario" class="formularioEditActDesact mt-3" id="formulario" method="POST">

                            <!-- Usuario -->
                            <div class="form-group row">
                                <label for="usuario" class="col-lg-4 mt-md-2">Usuario:</label>
                                <div class="col-lg-8">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="usuario" id="usuario" autocomplete="off">
                                </div>
                            </div>

                            <!-- Nombre -->
                            <div class="form-group row">
                                <label for="nombre" class="col-lg-4 mt-md-2">Nombres:</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="30" required>
                                </div>
                            </div>

                            <!-- Asignaciones de roles -->
                            <div class="form-group row">
                                <label class="col-4 mt-md-2">Roles: *</label>
                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="superusuario" value="1" name="superusuario" id="superusuario" title="Acceso total">
                                        <label class="form-check-label" for="superusuario" title="Acceso total">Superusuario</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="administrador" value="1" name="administrador" id="administrador" title="Gestion de empleados, cargos, compañías, sedes, EPS, ARL y Gestión de Incidentes y Sucesos">
                                        <label class="form-check-label" for="administrador" title="Gestion de empleados, cargos, compañías, sedes, EPS, ARL y Gestión de Incidentes y Sucesos">Administrador</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="analista" value="1" name="analista" id="analista" title="Gestion de empleados, EPS, ARL y Gestión de Incidentes y Sucesos">
                                        <label class="form-check-label" for="analista" title="Gestion de empleados, cargos, EPS, ARL y Gestión de Incidentes y Sucesos">Analista</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="asistente" value="1" name="asistente" id="asistente" title="Gestión de Incidentes y Sucesos">
                                        <label class="form-check-label" for="asistente" title="Gestión de Incidentes y Sucesos">Asistente</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="consultas" value="1" name="consultas" id="consultas" title="Acceso a reportes">
                                        <label class="form-check-label" for="consultas" title="Acceso a reportes">Consultas</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de formulario -->
                            <div class="form-group row">
                                <div class="offset-lg-4 col-6 col-lg-4 guardar">
                                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                </div>
                                <div class="col-6 col-lg-4 cancelar text-right">
                                    <button type="button" class="btn btn-light" id="btnCancelar" onclick="cancelar()">Cancelar</button>
                                </div>
                            </div>

                        </form>
                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="usuarios.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="posicionador-bottom"></div>
        </div>

    <?php
    } else {
        require 'noacceso.php';
    }

    require 'footer.php';

    ?>

    <script src="scripts/gestion_usuarios.js"></script>

<?php
}
ob_end_flush();
?>