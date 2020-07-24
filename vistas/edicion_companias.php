<?php

require 'header.php';

?>
    <div class="container-fluid main-box">
        <div class="title-page">
            <h1>SICOAIN - Sistema de Control de Accidentes e Incidentes - Administración de Compañías</h1>
        </div>
        <div class="main-content container">
            <div class="row">
                <div class="col-4">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú de Compañías</h2>
                        </div>
                        <h1 class="display-4 text-center">SICOAIN</h1>
                        <nav>
                            <ul>
                                <li>Administración de Compañías
                                <ul>
                                        <li><a href="creacion_companias.php">Creación de Compañías</a></li>
                                        <li><a href="edicion_companias.php" class="active">Edición de Compañías</a></li>
                                        <li><a href="act_desact_companias.php">Act/Desact de Compañías</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.html">Regresar</a></button>
                    </div>
                </div>
                <div class="col-8">
                    <div class="box-formulario container mt-5">
                        <h2 class="text-center title-formularios">Edición de Compañías</h2>
                        <div class="form-group row">
                                <label for="rol" class="col-4">Buscar Compañía:</label>
                                <div class="col-8 searchbox">
                                <input type="search" class="form-control" name="buscarId" id="buscarId">
                                <button type="button" class="btnBusqueda" id="btnBusqueda" onclick="buscar()"><i class="fa fa-search" aria-hidden="true"></i></button>
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


                            <div class="form-group row">
                                <label for="telefono_compania" class="col-4">Teléfono:</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="telefono_compania" id="telefono_compania">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="direccion_compania" class="col-4">Dirección:</label>
                                <div class="col-8">
                                    <textarea name="direccion_compania" id="direccion_compania" maxlength="256" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-4 col-4">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                                <div class="col-4">
                                    <button type="button" class="btn btn-light">Cancelar</button>
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

<script src="scripts/gestion_companias.js"></script>