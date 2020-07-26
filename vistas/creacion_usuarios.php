<?php

require 'header.php';

?>
<div class="container-fluid main-box">
    <div class="title-page">
        <h1>SICOAIN - Sistema de Control de Accidentes e Incidentes - Menú Principal</h1>
    </div>
    <div class="main-content container">
        <div class="row">
            <div class="col-4">
                <div class="menu-box">
                    <div class="title-menu">
                        <h2>Menú Principal</h2>
                    </div>
                    <h1 class="display-4 text-center">SICOAIN</h1>
                    <nav>
                        <ul>
                            <li>Administración de Usuarios
                                <ul>
                                    <li><a href="creacion_usuarios.php" class="active">Creación de Usuarios</a></li>
                                    <li><a href="edicion_usuarios.php">Edición de Usuarios</a></li>
                                    <li><a href="act_desact_usuarios.php">Act/Desact. de Usuarios</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <button class="btn btn-light salir-menu"><a href="principal.html">Regresar</a></button>
                </div>
            </div>
            <div class="col-8">
                <div class="box-formulario container mt-5">
                    <h2 class="text-center title-formularios">Creación de Usuarios</h2>


                    <!-- Formulario -->
                    <form name="formulario" id="formulario" method="POST">

                        <!-- Usuario -->
                        <div class="form-group row">
                            <label for="usuario" class="col-4">usuario:</label>
                            <div class="col-8">
                                <input type="hidden" name="id" id="id">
                                <input type="text" class="form-control" name="usuario" id="usuario">
                            </div>
                        </div>

                        <!-- Nombre -->
                        <div class="form-group row">
                            <label for="nombre" class="col-4">Nombres:</label>
                            <div class="col-8">
                                <input type="text" class="form-control" name="nombre" id="nombre" maxlength="30" required>
                            </div>
                        </div>

                        <!-- Asignaciones de roles -->
                        <div class="form-group row">
                            <label class="col-4">Roles: *</label>
                            <div class="col-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="superusuario" value="1" name="superusuario" id="superusuario">
                                    <label class="form-check-label" for="superusuario">Superusuario</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="administrador" value="1" name="administrador" id="administrador">
                                    <label class="form-check-label" for="administrador">Administrador</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="analista" value="1" name="analista" id="analista">
                                    <label class="form-check-label" for="analista_asistente">Analista</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="asistente" value="1" name="asistente" id="asistente">
                                    <label class="form-check-label" for="analista_asistente">Asistente</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consultas" value="1" name="consultas" id="consultas">
                                    <label class="form-check-label" for="consultas">Consultas</label>
                                </div>
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group row">
                            <label for="contrasena" class="col-4">Contraseña: *</label>
                            <div class="col-8">
                                <input type="password" class="form-control" name="contrasena" id="contrasena" autocomplete="FALSE">
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

require 'footer.php';

?>

<script src="scripts/gestion_usuarios.js"></script>