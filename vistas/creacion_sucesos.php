<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {
    require 'header.php';
    if (($_SESSION['superusuario'] == 1) || (($_SESSION['administrador'] == 1)) || (($_SESSION['analista'] == 1)) || (($_SESSION['asistente'] == 1))) {

?>

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="menu-box menu-box-modulos">
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
                                        <li><a href="creacion_sucesos.php" class="active">Creación de Sucesos</a></li>
                                        <li><a href="edicion_sucesos.php">Edición de Sucesos</a></li>
                                        <li><a href="act_desact_sucesos.php">Act/Desact. de Sucesos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8 col-xl-9 px-0 px-md-1 pr-xl-5">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Creación de Sucesos</h2>
                        <form name="formulario" id="formulario" method="POST">

                            <!-- Nombre -->
                            <div class="form-group row mt-3">
                                <label for="suceso" class="col-12 col-lg-4 mt-lg-2">Nombre Suceso:</label>
                                <div class="col-12 col-lg-8">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="nombre" id="nombre">
                                </div>
                            </div>


                            <!-- Botones de formulario -->
                            <div class="form-group row">
                                <div class="col-6 offset-lg-4 col-lg-4 guardar">
                                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                </div>
                                <div class="col-6 col-lg-4 cancelar text-right">
                                    <button type="button" class="btn btn-light" id="btnCancelar" onclick="limpiar()">Cancelar</button>
                                </div>
                            </div>

                        </form>

                        <!-- Boton regresar en vista mobile -->
                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="menu_incidentes.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
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

    <script src="scripts/gestion_sucesos.js"></script>

<?php
}
ob_end_flush();
?>