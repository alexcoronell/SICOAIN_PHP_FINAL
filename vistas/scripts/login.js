$('#formularioAcceso').on('submit', function(e) {
    e.preventDefault();
    usuario = $('#usuario').val();
    contrasena = $('#contrasena').val();

    $.post('../ajax/usuarios.php?op=verificar', {
        usuario: usuario,
        contrasena: contrasena
    }, function(data) {
        if (data != "null") {
            $(location).attr('href', 'menu_reportes.php');
        } else {
            bootbox.alert("Usuario y/o Contraseña incorrectos");
        }
    });
})