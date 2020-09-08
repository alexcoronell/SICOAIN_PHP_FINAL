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
                <div class="col-12 col-md-4">
                    <div class="menu-box menu-box-modulos">
                        <div class="title-menu">
                            <h2>Menú de Incidentes y Sucesos</h2>
                        </div>
                        <h1 class="display-4 text-center">SICOAIN</h1>
                        <nav>
                            <ul>
                                <li>Administración de Incidentes
                                    <ul>
                                        <li><a href="creacion_registros.php">Creación de Registro</a></li>
                                        <li><a href="edicion_registros.php">Edición de Registro</a></li>
                                        <li><a href="anulacion_registros.php" class="active">Anulación de Registro</a></li>
                                    </ul>
                                </li>
                                <li>Administración de Sucesos
                                    <ul>
                                        <li><a href="creacion_sucesos.php">Creación de Sucesos</a></li>
                                        <li><a href="edicion_sucesos.php">Edición de Sucesos</a></li>
                                        <li><a href="eliminacion_sucesos.php">Eliminación de Sucesos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>

                <div class="col-12 col-md-8 ml-n2 pl-0 pr-0 pr-md-3">
                    <div class="box-formulario formulario-registros container mt-1 p-0 row w-100">
                        <h2 class="text-center title-formularios">Anulación de Registros</h2>

                        <div class="col-12 container row anulacion-box">
                            <!-- Búsqueda -->
                            <div class="form-group row mb-0 mt-2 col-12 col-md-6">
                                <label for="rol" class="col-12 col-md-3">Buscar:</label>
                                <div class="col-12 col-md-9 searchbox">
                                    <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true" required></select>
                                    <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" title="Cargar Información" alt="Cargar Información"></i>Cargar</button>
                                </div>
                            </div>
                            <!-- Inicia Formulario -->
                            <form name="formulario" id="formulario" method="POST">

                                <!-- Empleado -->
                                <div class="form-group row col-12 col-md-6 mt-3">
                                    <label for="fo_empleado" class="col-12 col-md-4">Número Identificación Empleado: </label>
                                    <!-- Id Registro -->
                                    <input type="hidden" name="id_registro" id="id_registro">
                                    <div class="col-12 col-md-8">
                                        <select name="fo_empleado" id="fo_empleado" class="form-control selectpicker text-left ml-md-2" title="Seleccione..." data-live-search="true" disabled></select>
                                    </div>
                                    <div class="col-12 offset-md-4 col-md-8 nombresApellidos-box">
                                        <input type="text" class="form-control pl-2 ml-md-2" name="nombresApellidos" id="nombresApellidos" disabled>
                                    </div>
                                </div>
                                <!-- Fecha de Registo e Incidente -->
                                <div class="form-group row col-12 col-md-6">
                                    <label for="fecha_registro" class="col-12 col-md-4">Fecha de Registro:</label>
                                    <div class="col-12 col-md-8">
                                        <input type="date" class="form-control ml-md-2" name="fecha_registro" id="fecha_registro" disabled>
                                        <input type="date" class="form-control ml-md-2" name="fecha_incidente" id="fecha_incidente" disabled>
                                    </div>
                                </div>

                                <!-- Descripción, impresión y generación de PDF -->
                                <div class="form-group row col-12">
                                    <div class="col-12 col-md-2">
                                        <label for="descripcion">Modivo Anulación:*</label>

                                    </div>
                                    <div class="col-12 col-md-10">
                                        <textarea name="motivo_anulacion" id="motivo_anulacion" maxlength="512" rows="2" class="form-control"></textarea>
                                    </div>
                                </div>

                                <!-- Botones -->
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="col-6 offset-md-4 col-md-4 text.text-md-right guardar">
                                            <button type="submit" class="btn btn-primary anular" id="btnGuardar">Anular</button>
                                        </div>
                                        <div class="col-6 col-md-4 cancelar text-right text-md-left">
                                            <button type="button" class="btn btn-light" id="btnCancelar" onclick="limpiar()">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Boton regresar en vista mobile -->
                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="menu_incidentes.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="posicionador-bottom"></div>
    <?php
    } else {
        require 'noacceso.php';
    }

    require 'footer.php';

    ?>

    <script src="scripts/anulacion_registros.js"></script>

<?php
}
ob_end_flush();
?>