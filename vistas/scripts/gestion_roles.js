var condicionActual;

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
    $('#condicion').val("");
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

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id_rol) {
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

// Función para mostrar los datos en el formulario de activación o desactivación de roles
function mostrarAct(id_rol) {
    $.post("../ajax/roles.php?op=mostrar", {
        id_rol: id_rol
    }, function(data, status) {
        data = JSON.parse(data);
        $("#id_rol").val(data.id_rol);
        $('#rol').val(data.rol);
        $('#condicion').val(data.condicion);
        data.condicion == 1 ? MostrarDesactivar() : MostrarActivar();
    })
}

// Función para buscar en el formulario de edición de roles
function buscar() {
    id_rolBuscar = $("#buscarrol").val();
    mostrar(id_rolBuscar);
    $('#buscarrol').val("");
}

// Función para buscar en el formulario de Activación o desactivación de roles
function buscarAct() {
    id_rolBuscar = $("#buscarrol").val();
    mostrarAct(id_rolBuscar);
}

// Función para activar roles
function activar() {
    let id_rol = $('#id_rol').val();
    bootbox.confirm("¿Estas seguro de activar este rol?", function(result) {
        $.post("../ajax/roles.php?op=activar", {
            id_rol: id_rol
        }, function(e) {
            bootbox.alert(e);
        })
    })
    $('#button_activar').hide();
    $('#button_desactivar').hide();
    $('#button_default').show();
    limpiar();
    $("#buscarrol").val("");
}

// Función para desactivar roles
function desactivar() {
    let id_rol = $('#id_rol').val();
    console.log(id_rol);
    bootbox.confirm("¿Estas seguro de desactivar este rol?", function(result) {
        if (result) {
            $.post("../ajax/roles.php?op=desactivar", {
                id_rol: id_rol
            }, function(e) {
                bootbox.alert(e);
            })
        }
    })
    $('#button_activar').hide();
    $('#button_desactivar').hide();
    $('#button_default').show();
    limpiar();
    $("#buscarrol").val("");
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

init();