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
            <div class="row pr-5">
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
                                        <li><a href="creacion_registros.php">Creación de Registro</a></li>
                                        <li><a href="edicion_registros.php" class="active">Edición de Registro</a></li>
                                        <li><a href="anulacion_registros.php">Anulación de Registro</a></li>
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
                <div class="col-8">
                    <div class="box-formulario mt-1 ml-1 w-100 pr-5">
                        <h2 class="text-center title-formularios">Edición de Registros</h2>

                        <!-- Búsqueda -->
                        <div class="form-group row">
                            <label for="rol" class="col-4">Buscar:</label>
                            <div class="col-8 searchbox">
                                <input type="search" class="form-control" name="buscarId" id="buscarId" placeholder="Nro. de Registro">
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>

                        <!-- Formulario -->
                        <form name="formulario" id="formulario" method="POST">

                            <!-- Id Registro -->
                            <div class="form-group row">
                                <label for="id_registro" class="col-4"></label>
                                <div class="col-8">
                                    <input type="hidden" name="id_registro" id="id_registro">
                                </div>
                            </div>

                            <!-- Empleado -->
                            <div class="form-group row">
                                <label for="fo_empleado" class="col-4">Número Identificación Empleado: </label>
                                <div class="col-8">
                                    <select name="fo_empleado" id="fo_empleado" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                </div>
                                <div class="offset-4 col-8">
                                    <input type="text" class="form-control" name="nombresApellidos" id="nombresApellidos" disabled>
                                </div>
                            </div>

                            <!-- Suceso -->
                            <div class="form-group row">
                                <label for="fo_suceso" class="col-4">Suceso: </label>
                                <div class="col-8">
                                    <select name="fo_suceso" id="fo_suceso" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                </div>
                            </div>

                            <!-- Fecha de Registo e Incidente -->
                            <div class="form-group row">
                                <label for="fecha_incidente" class="col-4">Fecha de Incidente:</label>
                                <div class="col-8">
                                    <input type="hidden" class="form-control oculto" name="fecha_registro" id="fecha_registro" disabled>
                                    <input type="date" class="form-control" name="fecha_incidente" id="fecha_incidente">
                                </div>
                            </div>

                            <!-- Evidencia Digital -->
                            <div class="form-group row">
                                <label for="evidencia_digital" class="col-4">Evidencia digital:</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="evidencia_actual" id="evidencia_actual">
                                    <input type="file" class="form-control" name="evidencia_digital" id="evidencia_digital">
                                </div>
                            </div>

                            <!-- Usuario Creador -->
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <input type="hidden" class="form-control" name="fo_usuario_creador" id="fo_usuario_creador" disabled>
                                </div>
                            </div>

                            <!-- Usuario Creador -->
                            <div class="form-group row">
                                <div class="offset-4 col-8">
                                    <input type="hidden" class="form-control" name="fo_usuario_creador" id="fo_usuario_creador" disabled>
                                </div>
                            </div>


                            <!-- Descripción, impresión y generación de PDF -->
                            <div class="form-group row">
                                <div class="col-4">
                                    <label for="descripcion">Descripción:*</label>
                                    <button class="btn btn-light generadores"><i class="fas fa-print" aria-hidden="true"></i> Imprimir</button>
                                    <button class="btn btn-light generadores"><i class="far fa-file-pdf"></i> Generar PDF</button>
                                </div>
                                <div class="col-8">
                                    <textarea name="descripcion" id="descripcion" maxlength="512" class="form-control"></textarea>
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