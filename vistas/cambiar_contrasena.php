<?php

// Se activa almacenamiento de la sesión
ob_start();
session_start();

if (!isset($_SESSION['nombre'])) {
    header("location: login.html");
} else {
    require 'header.php';

    if (($_SESSION['superusuario'] == 1) || ($_SESSION['administrador'] == 1) || ($_SESSION['analista'] == 1) || ($_SESSION['asistente'] == 1) || ($_SESSION['consultas'] == 1)) {

?>

        <div class="main-content container-fluid">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="menu-box menu-box-modulos">
                        <div class="title-menu">
                            <h2>Menú de Usuarios</h2>
                        </div>
                        <nav>
                        <ul>
                            <li><a href="usuarios.php">Usuarios</a></li>
                            <li><a href="empleados.php">Empleados y Cargos</a></li>
                            <li><a href="companias.php">Compañías</a></li>
                            <li><a href="sedes.php">Sedes</a></li>
                            <li><a href="eps.php">EPS</a></li>
                            <li><a href="arl.php">ARL</a></li>
                            <li><a href="menu_incidentes.php">Administración de Incidentes</a></li>
                            <li><a href="menu_reportes.php">Reportes</a></li>
                            <li><a href="cambiarcontrasena.php">Cambiar Contraseña</a></li>
                        </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="../ajax/usuarios.php?op=salir">Cerrar Sessión<i class="fa fa-sign-out ml-1" aria-hidden="true"></i></a></button>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8 col-xl-9 px-0 pr-xl-5">
                    <div class="box-formulario container mt-1 ml-1">
                        <h2 class="text-center title-formularios">Cambiar Contraseña</h2>

                        <!-- Formulario -->
                        <form name="formulario" class="cambiodecontrasena mt-3" id="formulario" method="POST">

                            <!-- Nombre -->
                            <div class="form-group row">
                                <label for="nombre" class="col-lg-4 mt-md-2">Nombres:</label>
                                <div class="col-lg-8">
                                    <input type="hidden" value="<?php echo $_SESSION['id']; ?>" name="id" id="id">
                                    <input type="text" value="<?php echo $_SESSION['nombre']; ?>" class="form-control" name="nombre" id="nombre" maxlength="30" disabled>
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="form-group row">
                                <label for="contrasena" class="col-lg-4">Nueva Contraseña:</label>
                                <div class="col-lg-8">
                                    <input type="password" class="form-control" name="contrasena" id="contrasena" autocomplete="off">
                                </div>
                            </div>

                            <!-- Botones de formulario -->
                            <div class="form-group row">
                                <div class="offset-lg-4 col-6 col-lg-4 guardar">
                                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                </div>
                                <div class="col-6 col-lg-4 cancelar text-right">
                                    <button type="button" class="btn btn-light" id="btnCancelar" onclick="cancelar()">Cancelar</button>
                                </div>
                        </form>

                        <div class="boton-mobile-regresar col-12 row mb-2">
                            <button class="btn btn-light px-5"><a href="usuarios.php"><i class="fa fa-arrow-left pr-2" aria-hidden="true"></i>Regresar</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="posicionador-bottom"></div>
        </div>

    <?php
    } else {
        require 'noacceso.php';
    }

    require 'footer.php';

    ?>

    <script src="scripts/cambiar_contrasena.js"></script>

<?php
}
ob_end_flush();
?>