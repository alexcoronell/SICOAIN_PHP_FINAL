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
                            <h2>Menú de Empleados</h2>
                        </div>
                        <nav>
                            <ul>
                                <li>Administración de Empleados
                                    <ul>
                                        <li><a href="creacion_empleados.php">Creación de Empleados</a></li>
                                        <li><a href="edicion_empleados.php">Edición de Empleados</a></li>
                                        <li><a href="act_desact_empleados.php">Act/Desact. de Empleados</a></li>
                                    </ul>
                                </li>
                                <li>Administración de Cargos
                                    <ul>
                                        <li><a href="creacion_cargos.php">Creación de Cargos</a></li>
                                        <li><a href="edicion_cargos.php">Edición de Cargos</a></li>
                                        <li><a href="act_desact_cargos.php" class="active">Act/Desact. de Cargos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Activación y Desactivación de Cargos</h2>

                         <!-- Búsqueda -->
                         <div class="form-group row">
                                <label for="rol" class="col-12 col-md-4">Buscar cargo:</label>
                                <div class="col-12 col-md-8 searchbox">
                                    <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true" required></select>
                                    <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscarAct()"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" title="Cargar Información" alt="Cargar Información"></i></button>
                                </div>
                            </div>


                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group row">
                                <label for="cargo" class="col-12 col-md-4">Nombre Cargo:</label>
                                <div class="col-12 col-md-8">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="cargo" id="cargo" disabled>
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
                            <div class="col-6 col-md-4 cancelar text-right text-md-left">
                                <button type="button" class="btn btn-light" onclick="MostrarDefault()">Cancelar</button>
                            </div>
                        </div>

                        <!-- Boton regresar en vista mobile -->
                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="empleados.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
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

    <script src="scripts/gestion_cargos.js"></script>

<?php
}
ob_end_flush();
?>