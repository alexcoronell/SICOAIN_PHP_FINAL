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
                            <h2>Menú de Empleados</h2>
                        </div>
                        <nav>
                            <ul>
                                <li>Administración de Empleados
                                    <ul>
                                        <li><a href="creacion_empleados.php" class="active">Creación de Empleados</a></li>
                                        <li><a href="edicion_empleados.php">Edición de Empleados</a></li>
                                        <li><a href="act_desact_empleados.php">Act/Desact. de Empleados</a></li>
                                    </ul>
                                </li>
                                <li>Administración de Cargos
                                    <ul>
                                        <li><a href="creacion_cargos.php">Creación de Cargos</a></li>
                                        <li><a href="edicion_cargos.php">Edición de Cargos</a></li>
                                        <li><a href="act_desact_cargos.php">Act/Desact. de Cargos</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.php">Regresar</a></button>
                    </div>
                </div>
                <div class="col-8 ml-n2 pr-3">
                    <div class="box-formulario-empleados container mt-1 p-0">
                        <h2 class="text-center title-formularios">Creación de Empleados</h2>
                        <form name="formulario" id="formulario" method="POST">
                            <input type="hidden" name="id" id="id">
                            <div class="row">
                                <div class="col-6 empleados-col-1">

                                    <!-- Tipo de Identificación -->
                                    <div class="form-group row">
                                        <label for="fo_tipo_identificacion" class="col-4">Tipo identificación:*</label>
                                        <div class="col-8">
                                            <select name="fo_tipo_identificacion" id="fo_tipo_identificacion" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                        </div>
                                    </div>

                                    <!-- Número de Identificación -->
                                    <div class="form-group row">
                                        <label for="numero_identificacion" class="col-4">Nro. identificación:*</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="numero_identificacion" id="numero_identificacion" required>
                                        </div>
                                    </div>

                                    <!-- Nombres -->
                                    <div class="form-group row">
                                        <label for="nombres" class="col-4">Nombres: *</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="nombres" id="nombres" required>
                                        </div>
                                    </div>

                                    <!-- Apellidos -->
                                    <div class="form-group row">
                                        <label for="apellidos" class="col-4">Apellidos: *</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="apellidos" id="apellidos" required>
                                        </div>
                                    </div>

                                    <!-- Departamento -->
                                    <div class="form-group row">
                                        <label for="fo_departamento" class="col-4">Departamento: *</label>
                                        <div class="col-8">
                                            <select name="fo_departamento" id="fo_departamento" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                        </div>
                                    </div>

                                    <!-- Ciudad -->
                                    <div class="form-group row">
                                        <label for="fo_ciudad" class="col-4">Ciudad: *</label>
                                        <div class="col-8">
                                            <select name="fo_ciudad" id="fo_ciudad" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                        </div>
                                    </div>

                                    <!-- Dirección -->
                                    <div class="form-group row">
                                        <label for="direccion" class="col-4">Direccion: *</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="256" required>
                                        </div>
                                    </div>

                                    <!-- Teléfono fijo -->
                                    <div class="form-group row">
                                        <label for="telefono_fijo" class="col-4">Teléfono: *</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="telefono_fijo" id="telefono_fijo" required>
                                        </div>
                                    </div>

                                    <!-- Teléfono Celular -->
                                    <div class="form-group row">
                                        <label for="telefono_celular" class="col-4">Teléfono Celular: *</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="telefono_celular" id="telefono_celular" required>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="form-group row">
                                        <label for="email" class="col-4">email: *</label>
                                        <div class="col-8">
                                            <input type="email" class="form-control" name="email" id="email" required>
                                        </div>
                                    </div>
                                </div>




                                <!-- Inicia segunda columna -->

                                <div class="col-6 pl-1">


                                    <!-- Compañía -->
                                    <div class="form-group row">
                                        <label for="fo_compania" class="col-4">Compañía: *</label>
                                        <div class="col-8">
                                            <select name="fo_compania" id="fo_compania" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>

                                            </select>
                                        </div>
                                    </div>

                                    <!-- Sede -->
                                    <div class="form-group row">
                                        <label for="fo_sede" class="col-4">Sede: *</label>
                                        <div class="col-8">
                                            <select name="fo_sede" id="fo_sede" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                        </div>
                                    </div>

                                    <!-- Cargo -->
                                    <div class="form-group row">
                                        <label for="fo_cargo" class="col-4">Cargo: *</label>
                                        <div class="col-8">
                                            <select name="fo_cargo" id="fo_cargo" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                        </div>
                                    </div>

                                    <!-- EPS -->
                                    <div class="form-group row">
                                        <label for="fo_eps" class="col-4">EPS: *</label>
                                        <div class="col-8">
                                            <select name="fo_eps" id="fo_eps" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                        </div>
                                    </div>

                                    <!-- ARL -->
                                    <div class="form-group row">
                                        <label for="fo_arl" class="col-4">ARL: *</label>
                                        <div class="col-8">
                                            <select name="fo_arl" id="fo_arl" class="form-control selectpicker" title="Seleccione..." data-live-search="true" required></select>
                                        </div>
                                    </div>

                                    <p class="text-center mb-0 mt-1">Contacto de Emergencia: *</p>

                                    <!-- Nombre Contacto de Emergencia -->
                                    <div class="form-group row">
                                        <label for="nombre_contacto_emergencia" class="col-4">Nombre: *</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="nombre_contacto_emergencia" id="nombre_contacto_emergencia" required>
                                        </div>
                                    </div>

                                    <!-- Teléfono Contacto de Emergencia -->
                                    <div class="form-group row">
                                        <label for="telefono_contacto_emergencia" class="col-4">Teléfono: *</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="telefono_contacto_emergencia" id="telefono_contacto_emergencia" required>
                                        </div>
                                    </div>

                                    <!-- Parentesco Contacto de Emergencia -->
                                    <div class="form-group row">
                                        <label for="parentesco_contacto_emergencia" class="col-4">Parentesco: *</label>
                                        <div class="col-8">
                                            <input type="text" class="form-control" name="parentesco_contacto_emergencia" id="parentesco_contacto_emergencia" required>
                                        </div>
                                    </div>


                                    <!-- Comentarios -->
                                    <div class="form-group row">
                                        <label for="comentarios" class="col-4">Comentarios: *</label>
                                        <div class="col-8">
                                            <textarea name="comentarios" id="comentarios" maxlength="256" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div> <!-- Fin segunda columna -->

                                <!-- Botones de formulario -->
                                <div class="col-12">
                                    <div class="form-group row">
                                        <div class="offset-4 col-4">
                                            <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                                        </div>
                                        <div class="col-4">
                                            <button type="button" class="btn btn-light" id="btnCancelar" onclick="limpiar()">Limpiar</button>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="posicionador-bottom"></div>

    <?php

    } else {
        require 'noacceso.php';
    }

    require 'footer.php';

    ?>

    <script src="scripts/gestion_empleados.js"></script>

<?php
}
ob_end_flush();
?>