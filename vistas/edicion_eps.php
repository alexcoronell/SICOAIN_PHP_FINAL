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
                <div class="col-12 col-md-4">
                    <div class="menu-box menu-box-modulos">
                        <div class="title-menu">
                            <h2>Menú de EPS</h2>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="creacion_eps.php">Creación de EPS</a></li>
                                <li><a href="edicion_eps.php" class="active">Edición de EPS</a></li>
                                <li><a href="act_desact_eps.php">Act/Desact de EPS</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Edición de EPS</h2>
                        <!-- Busqueda -->
                        <div class="form-group row grupoBusqueda mt-3">
                            <label for="rol" class="col-12 col-md-3 mt-md-2">Buscar:</label>
                            <div class="col-12 col-md-9 searchbox">
                                <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true" required></select>
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" title="Cargar Información" alt="Cargar Información"></i>Cargar</button>
                            </div>
                        </div>

                        <!-- Formulario -->
                        <form name="formulario" class="formularioEditActDesact mt-3" id="formulario" method="POST">
                            <div class="form-group row">
                                <label for="nombre_eps" class="col-12 col-md-4">Nombre:</label>
                                <div class="col-12 col-md-8">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="nombre_eps" id="nombre_eps" maxlength="30" required>
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div class="form-group row">
                                <label for="telefono" class="col-12 col-md-4">Teléfono:</label>
                                <div class="col-12 col-md-8">
                                    <input type="text" class="form-control" name="telefono" id="telefono" required>
                                </div>
                            </div>

                            <!-- email -->
                            <div class="form-group row">
                                <label for="email" class="col-12 col-md-4">email:</label>
                                <div class="col-12 col-md-8">
                                    <input type="email" class="form-control" name="email" id="email" required>
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="form-group row">
                                <label for="direccion" class="col-12 col-md-4">Dirección:</label>
                                <div class="col-12 col-md-8">
                                    <textarea name="direccion" id="direccion" maxlength="256" class="form-control" required></textarea>
                                </div>
                            </div>

                            <!-- Botones de formulario -->
                            <div class="form-group row">
                                <div class="col-6 offset-md-4 col-md-4 guardar">
                                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                </div>
                                <div class="col-6 col-md-4 cancelar text-right">
                                    <button type="button" class="btn btn-light" id="btnCancelar" onclick="cancelar()">Cancelar</button>
                                </div>
                            </div>

                        </form>

                        <!-- Boton regresar en vista mobile -->
                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="eps.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
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

    <script src="scripts/gestion_eps.js"></script>

<?php
}
ob_end_flush();
?>