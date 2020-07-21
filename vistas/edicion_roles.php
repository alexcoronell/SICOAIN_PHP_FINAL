<?php

require 'header.php';

?>

<div class="container-fluid main-box">
    <div class="title-page">
        <h1>SICOAIN - Sistema de Control de Accidentes e Incidentes - Administración de Roles</h1>
    </div>
    <div class="main-content container">
        <div class="row">
            <div class="col-4">
                <div class="menu-box">
                    <div class="title-menu">
                        <h2>Administración de Roles</h2>
                    </div>
                    <h1 class="display-4 text-center">SICOAIN</h1>
                    <nav>
                        <ul>
                            <li>Administración de Usuarios
                                <ul>
                                    <li><a href="creacion_roles.php">Creación de Roles</a></li>
                                    <li><a href="edicion_roles.php" class="active">Edición de Roles</a></li>
                                    <li><a href="eliminacion_roles.html">Eliminación de Roles</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <button class="btn btn-light salir-menu"><a href="principal.html">Regresar</a></button>
                </div>
            </div>
            <div class="col-8">
                <div class="box-formulario container mt-5">
                    <h2 class="text-center title-formularios">Edición de Roles</h2>
                    <!-- Busqueda -->
                    <div class="form-group row">
                        <label for="rol" class="col-4">Buscar Rol: *</label>
                        <div class="col-8 searchbox">
                            <input type="search" class="form-control" name="buscarrol" id="buscarrol" placeholder="Nro. de Rol">
                            <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                    </div>
                    <form name="formulario" id="formulario" method="POST">
                        <!-- Nombre de rol -->
                        <div class="form-group row">
                            <label for="rol" class="col-4">Nombre Rol: *</label>
                            <div class="col-8">
                                <input type="hidden" name="id_rol" id="id_rol">
                                <input type="text" class="form-control" name="rol" id="rol" maxlength="30">
                            </div>
                        </div>

                        <!-- Descripción -->
                        <div class="form-group row">
                            <label for="descripcion" class="col-4">Descripción: *</label>
                            <div class="col-8">
                                <textarea name="descripcion" id="descripcion" maxlength="256" class="form-control"></textarea>
                            </div>
                        </div>

                        <!-- Asignaciones de roles -->
                        <div class="form-group row">
                            <label class="col-4">Roles:</label>
                            <div class="col-8">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="superusuario" value="1" name="superusuario">
                                    <label class="form-check-label" for="superusuario">Superusuario</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="administrador" value="1" name="administrador">
                                    <label class="form-check-label" for="administrador">Administrador</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="analista_asistente" value="1" name="analista_asistente">
                                    <label class="form-check-label" for="analista_asistente">Analista / Asistente</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="consultas" value="1" name="consultas">
                                    <label class="form-check-label" for="consultas">Consultas</label>
                                </div>
                            </div>
                        </div>

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

<script src="scripts/guardareditar-roles.js"></script>