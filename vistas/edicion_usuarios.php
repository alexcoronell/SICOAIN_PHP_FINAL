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
            <div class="col-4">
                <div class="menu-box">
                    <div class="title-menu">
                        <h2>Menú de Usuarios</h2>
                    </div>
                    <nav>
                        <ul>
                                    <li><a href="creacion_usuarios.php">Creación de Usuarios</a></li>
                                    <li><a href="edicion_usuarios.php" class="active">Edición de Usuarios</a></li>
                                    <li><a href="act_desact_usuarios.php">Act/Desact. de Usuarios</a></li>
                        </ul>
                    </nav>
                    <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                </div>
            </div>
            <div class="col-8">
                <div class="box-formulario container mt-1 ml-1">
                    <h2 class="text-center title-formularios">Edición de Usuarios</h2>
                    <!-- Busqueda -->
                    <div class="form-group row">
                        <label for="buscarId" class="col-4">Buscar:</label>
                        <div class="col-8 searchbox">
                            <input type="search" class="form-control" name="buscarId" id="buscarId" placeholder="Buscar...">
                            <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>

                    <!-- Formulario -->
                    <form name="formulario" id="formulario" method="POST">

                        <!-- Usuario -->
                        <div class="form-group row">
                            <label for="usuario" class="col-4">usuario:</label>
                            <div class="col-8">
                                <input type="hidden" name="id" id="id">
                                <input type="text" class="form-control" name="usuario" id="usuario" autocomplete="off">
                            </div>
                        </div>

                        <!-- Nombre -->
                        <div class="form-group row">
                            <label for="nombre" class="col-4">Nombres:</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="30" required>
                            </div>
                        </div>

                        <!-- Asignaciones de roles -->
                        <div class="form-group row">
                            <label class="col-4">Roles: *</label>
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
                                    <label class="form-check-label" for="analista_asistente" title="Gestion de empleados, EPS, ARL y Gestión de Incidentes y Sucesos">Analista</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="asistente" value="1" name="asistente" id="asistente" title="Gestión de Incidentes y Sucesos">
                                    <label class="form-check-label" for="analista_asistente" title="Gestión de Incidentes y Sucesos">Asistente</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consultas" value="1" name="consultas" id="consultas" title="Acceso a reportes">
                                    <label class="form-check-label" for="consultas" title="Acceso a reportes">Consultas</label>
                                </div>
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group row">
                            <label for="contrasena" class="col-4">Contraseña: *</label>
                            <div class="col-8">
                                <input type="password" class="form-control" name="contrasena" id="contrasena" autocomplete="off">
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