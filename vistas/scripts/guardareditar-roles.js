// Función que se ejecuta al inicio
function init() {
    limpiar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
}

// Función para limpiar el formulario
function limpiar() {
    $("#id_rol").val("");
    $("#rol").val("");
    $('#descripcion').val("");
    $('#superusuario').prop("checked", false);
    $('#administrador').prop("checked", false);
    $('#analista_asistente').prop("checked", false);
    $('#consultas').prop("checked", false);
}


// Función para cancelar el formulario
function cancelarFormulario() {
    limpiar();
}

function guardaryeditar(e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    $("btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/roles.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
        }
    })
    limpiar();
}

function mostrar(id_rol) {
    //e.preventDefault();
    $.post("../ajax/roles.php?op=mostrar", {
        id_rol: id_rol
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id_rol").val(data.id_rol);
        $('#rol').val(data.rol);
        $('#descripcion').val(data.descripcion);
        data.superusuario == 1 ? $('#superusuario').prop("checked", true) : $('#superusuario').prop("checked", false);
        data.administrador == 1 ? $('#administrador').prop("checked", true) : $('#administrador').prop("checked", false);
        data.analista_asistente == 1 ? $('#analista_asistente').prop("checked", true) : $('#analista_asistente').prop("checked", false);
        data.consultas == 1 ? $('#consultas').prop("checked", true) : $('#consultas').prop("checked", false);
    })
}

function buscar() {
    id_rolBuscar = $("#buscarrol").val();
    mostrar(id_rolBuscar);
    $('#buscarrol').val("");
}

init();