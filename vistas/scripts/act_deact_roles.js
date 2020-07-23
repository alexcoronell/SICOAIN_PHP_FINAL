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
    $("#id").val("");
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

function mostrar(id) {
    $.post("../ajax/roles.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id").val(data.id);
        $('#rol').val(data.rol);
        $('#condicion').val(data.condicion);
    })
}

function buscarAct() {
    id_Buscar = $("#buscarId").val();
    console.log(id_Buscar);
    mostrar(id_Buscar);
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
    $('#buscarId').val("");
}


function desactivar(id, e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    bootbox.confirm("¿Estas seguro de desactivar este rol?", function(result) {
        if (result) {
            $.post("../ajax/roles.php?op=desactivar", {
                id: id
            }, function(e) {
                bootbox.alert(e);
            })
        }
    })
}

function activar(id, e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    bootbox.confirm("¿Estas seguro de activar este rol?", function(result) {
        if (result) {
            $.post("../ajax/roles.php?op=activar", {
                id: id
            }, function(e) {
                bootbox.alert(e);
            })
        }
    })
}

init();