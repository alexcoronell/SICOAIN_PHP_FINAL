<?php

require 'header.php';

?>
    <div class="container-fluid main-box">
        <div class="title-page">
            <h1>SICOAIN - Sistema de Control de Accidentes e Incidentes - Administración de Cargos</h1>
        </div>
        <div class="main-content container">
            <div class="row">
                <div class="col-4">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú de Empleados</h2>
                        </div>
                        <h1 class="display-4 text-center">SICOAIN</h1>
                        <nav>
                            <ul>
                                <li>Administración de Empleados
                                    <ul>
                                        <li><a href="creacion_empleados.php">Creación de Empleados</a></li>
                                        <li><a href="edicion_empleados.php">Edición de Empleados</a></li>
                                        <li><a href="eliminacion_empleados.php">Eliminación de Empleados</a></li>
                                    </ul>
                                </li>
                                <li>Administración de Cargos
                                    <ul>
                                        <li><a href="creacion_cargos.php" class="active">Creación de Cargos</a></li>
                                        <li><a href="edicion_cargos.php">Edición de Cargos</a></li>
                                        <li><a href="act_desact_cargos.php">Act/Desact. de Cargos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.html">Regresar</a></button>
                    </div>
                </div>
                <div class="col-8">
                    <div class="box-formulario container mt-5">
                        <h2 class="text-center title-formularios">Creación de Cargos</h2>
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group row">
                                <label for="buscarcargo" class="col-4 deshabilitado">Buscar cargo:</label>
                                <div class="col-8">
                                    <input type="search" class="form-control" name="buscarcargo" id="buscarcargo" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cargo" class="col-4">Nombre Cargo:*</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" maxlength="30" name="cargo" id="cargo" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descripcion" class="col-4">Descripción:</label>
                                <div class="col-8">
                                    <textarea name="descripcion" id="descripcion" maxlength="256" class="form-control" required></textarea>
                                </div>
                            </div>

                            <!-- Botones de formulario -->
                            <div class="form-group row">
                                <div class="offset-4 col-4">
                                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
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

require 'footer.php';

?>

<script src="scripts/gestion_cargos.js"></script>