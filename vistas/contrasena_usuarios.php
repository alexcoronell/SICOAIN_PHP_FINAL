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
                                <li><a href="edicion_usuarios.php">Edición de Usuarios</a></li>
                                <li><a href="contrasena_usuarios.php" class="active">Contraseña de Usuarios</a></li>
                                <li><a href="act_desact_usuarios.php">Act/Desact. de Usuarios</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8 col-xl-9 px-0 pr-xl-5">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Contraseña de Usuarios</h2>
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
                                    <input type="text" class="form-control" name="usuario" id="usuario" autocomplete="off" disabled>
                                </div>
                            </div>

                            <!-- Nombre -->
                            <div class="form-group row">
                                <label for="nombre" class="col-lg-4 mt-md-2">Nombres:</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="nombre" id="nombre" maxlength="30" disabled>
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="form-group row">
                                <label for="contrasena" class="col-lg-4 mt-md-2">Contraseña: *</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" name="contrasena" id="contrasena" autocomplete="off">
                                </div>
                            </div>
                        </form>

                         <!-- Botones de formulario -->
                         <div class="form-group row">
                                <div class="offset-lg-4 col-6 col-lg-4 guardar">
                                    <button type="submit" class="btn btn-primary" id="btnContrasena" onclick="actualizarContrasena()">Guardar</button>
                                </div>
                                <div class="col-6 col-lg-4 cancelar text-right">
                                    <button type="button" class="btn btn-light" id="btnCancelar" onclick="cancelar()">Cancelar</button>
                                </div>
                            </div>


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