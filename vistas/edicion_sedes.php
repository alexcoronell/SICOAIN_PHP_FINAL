<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {
    require 'header.php';

    if (($_SESSION['superusuario'] == 1) || (($_SESSION['administrador'] == 1))) {

?>

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="menu-box menu-box-modulos">
                        <div class="title-menu">
                            <h2>Menú de Sedes</h2>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="creacion_sedes.php">Creación de Sedes</a></li>
                                <li><a href="edicion_sedes.php" class="active">Edición de Sedes</a></li>
                                <li><a href="act_desact_sedes.php">Act/Desact. de Sedes</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8 col-xl-9">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Edición de Sedes</h2>
                        <!-- Busqueda -->
                        <div class="form-group row grupoBusqueda mt-3">
                            <label for="buscarId" class="col-2 col-lg-4 mt-2">Buscar<span class="min1200"> Sede</span>:</label>
                            <div class="col-10 col-lg-8 searchbox">
                                <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true" required></select>
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-arrow-circle-o-up min992" aria-hidden="true" title="Cargar Información" alt="Cargar Información"></i>Cargar</button>
                            </div>

                        </div>

                        <!-- Formulario -->
                        <form name="formulario" id="formulario" class="formularioEditActDesact mt-3" method="POST" autocomplete="off">

                            <!-- Compañía -->
                            <div class="form-group row">
                                <label for="fo_compania" class="col-12 col-lg-4 mt-md-2">Compañía:</label>
                                <div class="col-12 col-lg-8">
                                    <input type="hidden" name="id" id="id">
                                    <select name="fo_compania" id="fo_compania" class="form-control selectpicker" title="Seleccione..."></select>
                                </div>
                            </div>

                            <!-- Nombre -->
                            <div class="form-group row">
                                <label for="nombre" class="col-12 col-lg-4 mt-md-2">Nombre:*</label>
                                <div class="col-12 col-lg-8">
                                    <input type="text" class="form-control" name="nombre" id="nombre">
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div class="form-group row">
                                <label for="telefono" class="col-12 col-lg-4 mt-md-2">Teléfono:*</label>
                                <div class="col-12 col-lg-8">
                                    <input type="text" class="form-control" name="telefono" id="telefono">
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="form-group row">
                                <label for="direccion" class="col-12 col-lg-4 mt-md-2">Dirección:</label>
                                <div class="col-12 col-lg-8">
                                    <textarea name="direccion" id="direccion" maxlength="256" class="form-control"></textarea>
                                </div>
                            </div>

                            <!-- Notas -->
                            <div class="form-group row">
                                <label for="notas" class="col-12 col-lg-4 mt-md-2">Notas:</label>
                                <div class="col-12 col-lg-8">
                                    <textarea name="notas" id="notas" maxlength="256" class="form-control"></textarea>
                                </div>
                            </div>


                            <!-- Botones de formulario -->
                            <div class="form-group row">
                                <div class="col-6 offset-lg-4 col-lg-4 guardar">
                                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                </div>
                                <div class="col-6 col-lg-4 cancelar text-right">
                                    <button type="button" class="btn btn-light" id="btnCancelar" onclick="cancelar()">Cancelar</button>
                                </div>
                            </div>

                        </form>

                        <!-- Boton regresar en vista mobile -->
                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="sedes.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
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

    <script src="scripts/gestion_sedes.js"></script>

<?php
}
ob_end_flush();
?>