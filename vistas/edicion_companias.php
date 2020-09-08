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
                <div class="col-12 col-md-4">
                    <div class="menu-box menu-box-modulos">
                        <div class="title-menu">
                            <h2>Menú de Compañías</h2>
                        </div>
                        <nav>
                            <ul>

                                <li><a href="creacion_companias.php">Creación de Compañías</a></li>
                                <li><a href="edicion_companias.php" class="active">Edición de Compañías</a></li>
                                <li><a href="act_desact_companias.php">Act/Desact de Compañías</a></li>

                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Edición de Compañías</h2>

                        <!-- Búsqueda de compañía -->
                        <div class="form-group row grupoBusqueda mt-3">
                            <label for="rol" class="col-12 col-md-3 mt-2">Buscar:</label>
                            <div class="col-12 col-md-9 searchbox">
                                <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true"></select>
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" title="Cargar formularioEditActDesact mt-5Información" alt="Cargar Información"></i>Cargar</button>
                            </div>
                        </div>

                        <!-- Formulario -->
                        <form name="formulario" id="formulario" class="formularioEditActDesact mt-3" method="POST">
                            <div class="form-group row">
                                <label for="compania" class="col-12 col-md-4 mt-md-2">Compañía:</label>
                                <div class="col-12 col-md-8">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="compania" id="compania">
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div class="form-group row">
                                <label for="telefono_compania" class="col-12 col-md-4 mt-md-2">Teléfono:</label>
                                <div class="col-12 col-md-8">
                                    <input type="text" class="form-control" name="telefono_compania" id="telefono_compania">
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="form-group row">
                                <label for="direccion_compania" class="col-12 col-md-4 mt-md-2">Dirección:</label>
                                <div class="col-12 col-md-8">
                                    <textarea name="direccion_compania" id="direccion_compania" maxlength="256" class="form-control"></textarea>
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="form-group row">
                                <div class="col-6 offset-md-4 col-md-4 guardar">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                                <div class="col-6 col-md-4 cancelar text-right">
                                    <button type="button" class="btn btn-light" onclick="cancelar()">Cancelar</button>
                                </div>
                            </div>

                        </form>

                        <!-- Boton regresar en vista mobile -->
                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="companias.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
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

    <script src="scripts/gestion_companias.js"></script>

<?php
}
ob_end_flush();
?>