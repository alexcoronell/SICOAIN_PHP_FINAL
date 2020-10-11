// Función que se ejecuta al inicio
function init() {

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });
}


// Función para guardar o editar
function guardaryeditar(e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    $("btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/usuarios.php?op=actualizarcontrasena",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function (datos) {
            bootbox.alert(datos);
        }
    })
}

init();