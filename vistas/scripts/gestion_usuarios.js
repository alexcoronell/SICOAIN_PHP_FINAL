var condicionActual;

// Función que se ejecuta al inicio
function init() {
    limpiar();

    $('#formulario').disableAutoFill();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });
}

// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#usuario").val("");
    $("#nombre").val("");
    $('#superusuario').prop("checked", false);
    $('#administrador').prop("checked", false);
    $('#analista').prop("checked", false);
    $('#asistente').prop("checked", false);
    $('#consultas').prop("checked", false);
    $('#contrasena').val("");
    $('#condicion').val("");
    $("#buscarId").val("");
}


// Función para cancelar el formulario
function cancelarFormulario() {
    limpiar();
}

// Función para guardar o editar
function guardaryeditar(e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    $("btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/usuarios.php?op=guardaryeditar",
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

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id) {
    $.post("../ajax/usuarios.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id").val(data.id);
        $('#usuario').val(data.usuario);
        $('#nombre').val(data.nombre);
        data.superusuario == 1 ? $('#superusuario').prop("checked", true) : $('#superusuario').prop("checked", false);
        data.administrador == 1 ? $('#administrador').prop("checked", true) : $('#administrador').prop("checked", false);
        data.analista == 1 ? $('#analista').prop("checked", true) : $('#analista').prop("checked", false);
        data.asistente == 1 ? $('#asistente').prop("checked", true) : $('#asistente').prop("checked", false);
        data.consultas == 1 ? $('#consultas').prop("checked", true) : $('#consultas').prop("checked", false);
        $('#contrasena').val(data.contrasena);
    })
}

// Función para mostrar los datos en el formulario de activación o desactivación de EPS
function mostrarAct(id) {
    $.post("../ajax/usuarios.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);
        $("#id").val(data.id);
        $('#usuario').val(data.usuario);
        $('#condicion').val(data.condicion);
        data.condicion == 1 ? MostrarDesactivar() : MostrarActivar();
    })
}

// Función para buscar en el formulario de edición de EPS
function buscar() {
    id_Buscar = $("#buscarId").val();
    mostrar(id_Buscar);
    $('#buscarId').val("");
}

// Función para buscar en el formulario de Activación o desactivación de EPS
function buscarAct() {
    idBuscar = $("#buscarId").val();
    mostrarAct(idBuscar);
}

// Función para activar Usuarios
function activar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de activar este Usuario?", function(result) {
        $.post("../ajax/usuarios.php?op=activar", {
            id: id
        }, function(e) {
            bootbox.alert(e);
        })
    })
    MostrarDefault();

}

// Función para desactivar Usuarios
function desactivar() {
    let id = $('#id').val();
    console.log(id);
    bootbox.confirm("¿Estas seguro de desactivar est Usuario?", function(result) {
        if (result) {
            $.post("../ajax/usuarios.php?op=desactivar", {
                id: id
            }, function(e) {
                bootbox.alert(e);
            })
        }
    })
    MostrarDefault();
}

// Función para mostrar boton de activar y ocultar los otros
function MostrarActivar() {
    $('#button_default').hide();
    $('#button_desactivar').hide();
    $('#button_activar').show();
}

// Función para mostrar boton de desactivar y ocultar los otros
function MostrarDesactivar() {
    $('#button_default').hide();
    $('#button_activar').hide();
    $('#button_desactivar').show();
}

function MostrarDefault() {
    $('#button_default').show();
    $('#button_activar').hide();
    $('#button_desactivar').hide();
    limpiar();
}

init();