<?php

require 'header.php';

?>

        <div class="main-content container">
            <div class="row">
                <div class="col-5">
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
                <div class="col-7">
                    <div class="box-formulario container mt-5">
                        <h2 class="text-center title-formularios">Edición de Cargos</h2>
                        <div class="form-group row">
                                <label for="rol" class="col-4">Buscar cargo:</label>
                                <div class="col-8 searchbox">
                                <input type="search" class="form-control" name="buscarId" id="buscarId">
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-search" aria-hidden="true"></i></button>
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

require 'footer.php';

?>

<script src="scripts/gestion_cargos.js"></script>