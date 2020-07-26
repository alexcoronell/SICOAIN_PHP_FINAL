<?php

require 'header.php';

?>
<div class="container-fluid main-box">
    <div class="title-page">
        <h1>SICOAIN - Sistema de Control de Accidentes e Incidentes - Login</h1>
    </div>
    <div class="login-box">
        <div class="title-login">
            <h2>Ingrese su usuario</h2>
        </div>
        <form action="" autocomplete="off">
            <div class="form-inputs">
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Contraseña">
                <button type="submit" id="acceder" class="btn btn-primary"><a href="principal.html">Acceder</a></button>
                <button type="button" id="salir" class="btn btn-light">Salir</button>
            </div>
        </form>
    </div>
</div>

<?php

require 'footer.php';

?>