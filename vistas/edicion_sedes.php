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
                <div class="col-4">
                    <div class="menu-box">
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
                <div class="col-8">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Edición de Sedes</h2>
                        <!-- Busqueda -->
                        <div class="form-group row">
                            <label for="buscarId" class="col-4">Buscar:</label>
                            <div class="col-8 searchbox">
                                <input type="search" class="form-control" name="buscarId" id="buscarId" placeholder="Buscar...">
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>

                        <!-- Formulario -->
                        <form name="formulario" id="formulario" method="POST" autocomplete="off">

                            <!-- Compañía -->
                            <div class="form-group row">
                                <label for="fo_compania" class="col-4">Compañía:</label>
                                <div class="col-8">
                                    <input type="hidden" name="id" id="id">
                                    <select name="fo_compania" id="fo_compania" class="form-control selectpicker" title="Seleccione..."></select>
                                </div>
                            </div>

                            <!-- Nombre -->
                            <div class="form-group row">
                                <label for="nombre" class="col-4">Nombre:*</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="nombre" id="nombre">
                                </div>
                            </div>

                            <!-- Teléfono -->
                            <div class="form-group row">
                                <label for="telefono" class="col-4">Teléfono:*</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="telefono" id="telefono">
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div class="form-group row">
                                <label for="direccion" class="col-4">Dirección:</label>
                                <div class="col-8">
                                    <textarea name="direccion" id="direccion" maxlength="256" class="form-control"></textarea>
                                </div>
                            </div>

                            <!-- Notas -->
                            <div class="form-group row">
                                <label for="notas" class="col-4">Notas:</label>
                                <div class="col-8">
                                    <textarea name="notas" id="notas" maxlength="256" class="form-control"></textarea>
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