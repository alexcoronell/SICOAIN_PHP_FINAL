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
                            <h2>Menú de EPS</h2>
                        </div>
                        <nav>
                            <ul>
                                <li><a href="creacion_eps.php" class="active">Creación de EPS</a></li>
                                <li><a href="edicion_eps.php">Edición de EPS</a></li>
                                <li><a href="act_desact_eps.php">Act/Desact de EPS</a></li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-8">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Creación de EPS</h2>
                        <form name="formulario" id="formulario" method="POST">

                            <!-- Id - Nombre -->
                            <div class="form-group row">
                                <label for="nombre_eps" class="col-4">Nombre:*</label>
                                <div class="col-8">
                                    <input type="hidden" name="id" id="id">
                                    <input type="text" class="form-control" name="nombre_eps" id="nombre_eps" maxlength="30" required>
                                </div>
                            </div>


                            <!-- Teléfono -->
                            <div class="form-group row">
                                <label for="telefono" class="col-4">Teléfono:</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="telefono" id="telefono" maxlength="12">
                                </div>
                            </div>


                            <!-- Dirección -->
                            <div class="form-group row">
                                <label for="direccion" class="col-4">Dirección:</label>
                                <div class="col-8">
                                    <textarea name="direccion" id="direccion" maxlength="256" class="form-control"></textarea>
                                </div>
                            </div>


                            <!-- Email -->
                            <div class="form-group row">
                                <label for="email" class="col-4">email:</label>
                                <div class="col-8">
                                    <input type="email" class="form-control" name="email" id="email" maxlength="50">
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

    <script src="scripts/gestion_eps.js"></script>

<?php
}
ob_end_flush();
?>