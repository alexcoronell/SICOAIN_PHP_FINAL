<?php

require 'header.php';

?>

    <div class="container-fluid main-box">
        <div class="title-page">
            <h1>SICOAIN - Sistema de Control de Accidentes e Incidentes - Administración de Roles</h1>
        </div>
        <div class="main-content container">
            <div class="row">
                <div class="col">
                    <div class="menu-box">
                        <div class="title-menu">
                            <h2>Menú de Roles</h2>
                        </div>
                        <h1 class="display-4 text-center">SICOAIN</h1>
                        <nav>
                            <ul>
                                <li>Administración de Roles
                                <ul>
                                        <li><a href="creacion_roles.php">Creación de Roles</a></li>
                                        <li><a href="edicion_roles.php">Edición de Roles</a></li>
                                        <li><a href="act_desact_roles.php">Act/Desact. de Roles</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                        <button class="btn btn-light salir-menu"><a href="principal.html">Regresar</a></button>
                    </div>
                </div>
                <div class="col"></div>
                <div class="col calendar">
                    <img src="img/calendar.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <?php

require 'footer.php';

?>