// Función que se ejecuta al inicio
function init() {

    cargarUsuarios()

    $("#formulario").on("submit", function (e) {
        guardaryeditar(e);
    });

    limpiar();
}

// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#usuario").val("");
    $("#nombre").val("");
    $('#contrasena').val("");
    $("#buscarId").val("");
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
            if (datos == "Contraseña Actualizada Correctamente") {
                limpiar();
                $('.grupoBusqueda').show();
                $('.formularioEditActDesact').hide();
                cargarUsuarios();
            }
        }
    })
}

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id) {
    $.post("../ajax/usuarios.php?op=mostrar", {
        id: id
    }, function (data, status) {
        data = JSON.parse(data);

        $("#id").val(data.id);
        $('#usuario').val(data.usuario);
        $('#nombre').val(data.nombre);
        $('#contrasena').val(data.contrasena);
        $('.grupoBusqueda').hide();
        $('.formularioEditActDesact').show();
    })
}

// Función para buscar en el formulario de edición de EPS
function buscar() {
    let id = $("#buscarId").val();
    mostrar(id);
    $('#buscarId').val("");
}


function cargarUsuarios() {
    // Carga los usuarios registrados en el sistema
    $.post("../ajax/usuarios.php?op=selectUsuario", function (r) {
        $('#buscarId').html(r);
        $('#buscarId').selectpicker('refresh');
    })
}

function cancelar() {
    $('.grupoBusqueda').show();
    $('.formularioEditActDesact').hide();
    $('#buscarId').selectpicker('refresh')
    limpiar()
}

init();