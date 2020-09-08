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
                            <h2>Menú de ARL</h2>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="creacion_arl.php">Creación de ARL</a></li>
                                <li><a href="edicion_arl.php">Edición de ARL</a></li>
                                <li><a href="act_desact_arl.php" class="active">Act/Desact de ARL</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Activación / Desactivación de ARL</h2>
                        <div class="form-group row grupoBusqueda mt-3">
                            <label for="rol" class="col-12 col-md-3 mt-md-2">Buscar:</label>
                            <div class="col-12 col-md-9 searchbox">
                                <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true" required></select>
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscarAct()"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" title="Cargar Información" alt="Cargar Información"></i>Cargar</button>
                            </div>
                        </div>

                        <div class="formularioEditActDesact mt-3">
                            <!-- Formulario -->
                            <form name="formulario" id="formulario" method="POST">

                                <!-- Nombre -->
                                <div class="form-group row">
                                    <label for="nombre_arl" class="col-12 col-md-4 mt-md-2">Nombre:</label>
                                    <div class="col-12 col-md-8">
                                        <input type="hidden" name="id" id="id">
                                        <input type="text" class="form-control" name="nombre_arl" id="nombre_arl" disabled>
                                    </div>
                                </div>
                            </form>
                            <!-- Área de botones -->
                            <div class="form-group row">
                                <div class="col-6 offset-md-4 col-md-4 guardar">
                                    <button type="submit" id="button_default" class="btn btn-light" disabled>Act/Desact</button>
                                    <button type="submit" id="button_activar" class="btn btn-primary" onclick="activar()">Activar</button>
                                    <button type="submit" id="button_desactivar" class="btn btn-danger" onclick="desactivar()">Desactivar</button>
                                </div>
                                <div class="col-6 col-md-4 cancelar text-right">
                                    <button type="button" class="btn btn-light" onclick="MostrarDefault()">Cancelar</button>
                                </div>
                            </div>
                        </div>

                        <!-- Boton regresar en vista mobile -->
                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="arl.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
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

    <script src="scripts/gestion_arl.js"></script>

<?php
}
ob_end_flush();
?>