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
                <div class="col-4">
                    <div class="menu-box">
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
                                        <li><a href="edicion_cargos.php" class="active">Edición de Cargos</a></li>
                                        <li><a href="act_desact_cargos.php">Act/Desact. de Cargos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-8">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Edición de Cargos</h2>
                        <div class="form-group row">
                            <label for="rol" class="col-4">Buscar cargo:</label>
                            <div class="col-8 searchbox">
                            <select name="buscarId" id="buscarId" class="form-control selectpicker selectSearch" title="Seleccione..." data-live-search="true" required></select>
                            <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-arrow-circle-o-up" aria-hidden="true" title="Cargar Información" alt="Cargar Información"></i></button>
                        </div>
                        </div>
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group row">
                                <label for="cargo" class="col-4">Nombre Cargo:</label>
                                <div class="col-8">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="cargo" id="cargo" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descripcion" class="col-4">Descripción:</label>
                                <div class="col-8">
                                    <textarea name="descripcion" id="descripcion" cols="30" rows="4" class="form-control" require_once></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-4 col-4">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-light" onclick="limpiar()">Cancelar</button>
                                </div>
                            </div>

                        </form>

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