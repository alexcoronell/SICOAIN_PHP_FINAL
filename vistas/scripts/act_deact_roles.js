// Función que se ejecuta al inicio
function init() {
    limpiar();

    $("#formulario").on("submit", function(e, a) {
        console.log(a)
        a == 1 ? activar(e) : desactivar(e)
    })
}

// Función para limpiar el formulario
function limpiar() {
    $("#id_rol").val("");
    $("#rol").val("");
    $('#condicion').val("");
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
    $.post("../ajax/roles.php?op=mostrar", {
        id_rol: id_rol
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id_rol").val(data.id_rol);
        $('#rol').val(data.rol);
        $('#condicion').val(data.condicion);
    })
}

function buscarAct() {
    id_rolBuscar = $("#buscarrol").val();
    console.log(id_rolBuscar);
    mostrar(id_rolBuscar);
    if ($('#condicion').val == 1) {
        console.log("Funciono si");
        $('#button_default').hide();
        $('#button_activar').hide();
        $('#button_desactivar').show();
    } else {
        console.log("Funciono no");
        $('#button_default').hide();
        $('#button_desactivar').hide();
        $('#button_activar').show();
    }
    $('#buscarrol').val("");
}


function desactivar(id_rol, e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    bootbox.confirm("¿Estas seguro de desactivar este rol?", function(result) {
        if (result) {
            $.post("../ajax/roles.php?op=desactivar", {
                id_rol: id_rol
            }, function(e) {
                bootbox.alert(e);
            })
        }
    })
}

function activar(id_rol, e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    bootbox.confirm("¿Estas seguro de activar este rol?", function(result) {
        if (result) {
            $.post("../ajax/roles.php?op=activar", {
                id_rol: id_rol
            }, function(e) {
                bootbox.alert(e);
            })
        }
    })
}

init();