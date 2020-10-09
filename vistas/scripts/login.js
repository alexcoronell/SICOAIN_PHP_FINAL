function init() {
    limpiar();
    $('#limpiar').click(function() {
        limpiar();
    })
}

$('#formularioAcceso').on('submit', function(e) {
    e.preventDefault();
    usuario = $('#usuario').val();
    contrasena = $('#contrasena').val();

    $.post('../ajax/usuarios.php?op=verificar', {
        usuario: usuario,
        contrasena: contrasena
    }, function(data) {
        if (data != "null") {
            $(location).attr('href', 'principal.php');
        } else {
            bootbox.alert("Usuario y/o Contraseña incorrectos");
        }
    });
})


// Función Limpiar
function limpiar() {
    $('#usuario').val("");
    $('#contrasena').val("");
}

init();