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
                            <h2>Menú de Compañías</h2>
                        </div>
                        <nav>
                            <ul>

                                        <li><a href="creacion_companias.php">Creación de Compañías</a></li>
                                        <li><a href="edicion_companias.php">Edición de Compañías</a></li>
                                        <li><a href="act_desact_companias.php" class="active">Act/Desact de Compañías</a></li>

                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-8">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Activación/Desactivación de Compañías</h2>
                        <div class="form-group row">
                            <label for="rol" class="col-4">Buscar:</label>
                            <div class="col-8 searchbox">
                                <input type="search" class="form-control" name="buscarId" id="buscarId">
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscarAct()"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group row">
                                <label for="compania" class="col-4">Compañía:</label>
                                <div class="col-8">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="compania" id="compania">
                                </div>
                            </div>
                        </form>

                        <!-- Área de botones -->
                        <div class="form-group row">
                            <div class="offset-4 col-4">
                                <button type="submit" id="button_default" class="btn btn-light" disabled>Act/Desact</button>
                                <button type="submit" id="button_activar" class="btn btn-primary" onclick="activar()">Activar</button>
                                <button type="submit" id="button_desactivar" class="btn btn-danger" onclick="desactivar()">Desactivar</button>
                            </div>
                            <div class="col-4 text-right">
                                <button type="button" class="btn btn-light" onclick="MostrarDefault()">Cancelar</button>
                            </div>
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