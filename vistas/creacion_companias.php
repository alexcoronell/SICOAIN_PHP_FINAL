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

        <div class="main-content container">
            <div class="row">
                <div class="col-5">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú de Compañías</h2>
                        </div>
                        <h1 class="display-4 text-center">SICOAIN</h1>
                        <nav>
                            <ul>
                                <li>Administración de Compañías
                                    <ul>
                                        <li><a href="creacion_companias.php" class="active">Creación de Compañías</a></li>
                                        <li><a href="edicion_companias.php">Edición de Compañías</a></li>
                                        <li><a href="act_desact_companias.php">Act/Desact de Compañías</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-7">
                    <div class="box-formulario container mt-5">
                        <h2 class="text-center title-formularios">Creación de Compañías</h2>
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group row">
                                <label for="buscarId" class="col-4 deshabilitado">Buscar:</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="buscarId" id="buscarId" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="compania" class="col-4">Compañía: *</label>
                                <div class="col-8">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="compania" id="compania">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="compania_telefono" class="col-4">Teléfono:*</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="telefono_compania" id="telefono_compania">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="compania_direccion" class="col-4">Dirección: *</label>
                                <div class="col-8">
                                    <textarea name="direccion_compania" id="direccion_compania" maxlength="256" class="form-control"></textarea>
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

    <script src="scripts/gestion_companias.js"></script>

<?php
}
ob_end_flush();
?>