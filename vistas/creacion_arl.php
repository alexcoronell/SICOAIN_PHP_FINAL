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
                                <li><a href="creacion_arl.php" class="active">Creación de ARL</a></li>
                                <li><a href="edicion_arl.php">Edición de ARL</a></li>
                                <li><a href="act_desact_arl.php">Act/Desact de ARL</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Creación de ARL</h2>
                        <form name="formulario" id="formulario" method="POST">


                            <!-- Nombre -->
                            <div class="form-group row">
                                <label for="nombre_arl" class="col-12 col-md-4">Nombre:*</label>
                                <div class="col-12 col-md-8">
                                    <input type="text" class="form-control" name="nombre_arl" id="nombre_arl" maxlength="30">
                                </div>
                            </div>


                            <!-- Teléfono -->
                            <div class="form-group row">
                                <label for="telefono" class="col-12 col-md-4">Teléfono:</label>
                                <div class="col-12 col-md-8">
                                    <input type="text" class="form-control" name="telefono" id="telefono">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-12 col-md-4">email:</label>
                                <div class="col-12 col-md-8">
                                    <input type="email" class="form-control" name="email" id="email">
                                </div>
                            </div>


                            <!-- Dirección -->
                            <div class="form-group row">
                                <label for="direccion" class="col-12 col-md-4">Dirección:</label>
                                <div class="col-12 col-md-8">
                                    <textarea name="direccion" id="direccion" maxlength="256" class="form-control"></textarea>
                                </div>
                            </div>

                            <!-- Botones de formulario -->
                            <div class="form-group row">
                                <div class="col-6 offset-md-4 col-md-4 guardar">
                                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                </div>
                                <div class="col-6 col-md-4 cancelar text-right text-md-left">
                                    <button type="button" class="btn btn-light" id="btnCancelar" onclick="limpiar()">Cancelar</button>
                                </div>
                            </div>

                        </form>
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