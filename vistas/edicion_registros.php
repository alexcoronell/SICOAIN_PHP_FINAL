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
            <div class="row pr-md-5">
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
                                        <li><a href="creacion_registros.php">Creación de Registro</a></li>
                                        <li><a href="edicion_registros.php" class="active">Edición de Registro</a></li>
                                        <li><a href="anulacion_registros.php">Anulación de Registro</a></li>
                                    </ul>
                                </li>
                                <li>Administración de Sucesos
                                    <ul>
                                        <li><a href="creacion_sucesos.php">Creación de Sucesos</a></li>
                                        <li><a href="edicion_sucesos.php">Edición de Sucesos</a></li>
                                        <li><a href="act_desact_sucesos.php">Act/Desact. de Sucesos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8 col-xl-9 pr-0 pr-md-3">
                    <div class="box-formulario formulario-registros container mt-1 p-0 row w-100 ml-n2">
                        <h2 class="text-center title-formularios col-lg-12">Edición de Registros</h2>


                        <div class="col-12 col-lg-6">
                            <div class="col-12 px-0">
                                <!-- Busqueda -->
                                <div class="form-group row grupoBusqueda mt-3">
                                    <label for="buscarId" class="col-2 col-xl-3 mt-2">Buscar:</label>
                                    <div class="col-10 col-xl-9 searchbox">
                                        <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true" required></select>
                                        <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-arrow-circle-o-up min1200" aria-hidden="true" title="Cargar Información" alt="Cargar Información"></i>Cargar</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Inicia Formulario -->
                            <form name="formulario" id="formulario" method="POST">
                                <!-- Id Registro -->
                                <div class="form-group row mt-0">
                                    <label for="id_registro" class="col-12 col-xl-3"></label>
                                    <div class="col-12 col-xl-9">
                                        <input type="hidden" name="id_registro" id="id_registro">
                                    </div>
                                </div>

                                <!-- Empleado -->
                                <div class="form-group row">
                                    <label for="fo_empleado" class="col-12 col-xl-3">Número Identificación Empleado: </label>
                                    <div class="col-12 col-xl-9">
                                        <select name="fo_empleado" id="fo_empleado" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                    </div>
                                    <div class="col-12 offset-xl-3 col-xl-9 nombresApellidos-box">
                                        <input type="text" class="form-control" name="nombresApellidos" id="nombresApellidos" disabled>
                                    </div>
                                </div>

                                <!-- Suceso -->
                                <div class="form-group row">
                                    <label for="fo_suceso" class="col-12 col-xl-3">Suceso: </label>
                                    <div class="col-12 col-xl-9">
                                        <select name="fo_suceso" id="fo_suceso" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                    </div>
                                </div>

                                <!-- Fecha de Registo e Incidente -->
                                <div class="form-group row">
                                    <label for="fecha_registro" class="col-12 col-xl-3">Fecha de Registro:</label>
                                    <div class="col-12 col-xl-9">
                                        <input type="date" class="form-control" name="fecha_registro" id="fecha_registro" disabled>
                                    </div>
                                </div>

                                <!-- Fecha de Registo e Incidente -->
                                <div class="form-group row">
                                    <label for="fecha_incidente" class="col-12 col-xl-3">Fecha de Incidente:</label>
                                    <div class="col-12 col-xl-9">
                                        <input type="date" class="form-control" name="fecha_incidente" id="fecha_incidente">
                                    </div>
                                </div>
                        </div>


                        <div class="col-12 col-lg-6">

                            <!-- Descripción, impresión y generación de PDF  -->
                            <div class="form-group row mt-xl-3">
                                <div class="col-12 col-xl-3">
                                    <label for="descripcion">Descripción:*</label>
                                </div>
                                <div class="col-12 col-xl-9">
                                    <textarea name="descripcion" id="descripcion" maxlength="512" rows="6" class="form-control"></textarea>
                                </div>
                            </div>

                            <!-- Evidencia Digital -->
                            <div class="form-group row">
                                <label for="evidencia_digital" class="col-12 col-xl-3">Evidencia digital:</label>
                                <div class="col-12 col-xl-9">
                                    <input type="text" class="form-control" name="evidencia_actual" id="evidencia_actual">
                                    <input type="file" class="form-control inputFile py-1" name="evidencia_digital" id="evidencia_digital">
                                    <span class="mensaje_tipo_archivos">Solo Archivos: (jpg, jpeg, bmp, png, pdf)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-6 offset-xl-4 col-xl-4 text-md-right guardar">
                                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                </div>
                                <div class="col-6 col-xl-4 cancelar text-right text-md-left">
                                    <button type="button" class="btn btn-light" id="btnCancelar" onclick="limpiar()">Cancelar</button>
                                </div>
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
        </div>
        <div class="posicionador-bottom"></div>
    <?php
    } else {
        require 'noacceso.php';
    }

    require 'footer.php';

    ?>

    <script src="scripts/edicion_registros.js"></script>

<?php
}
ob_end_flush();
?>