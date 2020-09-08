// Función que se ejecuta al inicio
function init() {

    cargarCargos()

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    limpiar();
}

// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#cargo").val("");
    $('#descripcion').val("");
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
        url: "../ajax/cargo.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            if (datos == "Cargo registrado correctamente" || datos == "Cargo actualizado correctamente") {
                $('.grupoBusqueda').show();
                $('.formularioEditActDesact').hide();
                cargarCargos();
                limpiar();
            }
        }
    })

}

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id) {
    $.post("../ajax/cargo.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id").val(data.id);
        $('#cargo').val(data.cargo);
        $('#descripcion').val(data.descripcion);
        $('.grupoBusqueda').hide();
        $('.formularioEditActDesact').show();
    })
}

// Función para mostrar los datos en el formulario de activación o desactivación de Cargos
function mostrarAct(id) {
    $.post("../ajax/cargo.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);
        $("#id").val(data.id);
        $('#cargo').val(data.cargo);
        $('#condicion').val(data.condicion);
        $('.grupoBusqueda').hide();
        $('.formularioEditActDesact').show();
        data.condicion == 1 ? MostrarDesactivar() : MostrarActivar();
    })
}

// Función para buscar en el formulario de edición de Cargos
function buscar() {
    id_Buscar = $("#buscarId").val();
    mostrar(id_Buscar);
    $('#buscarId').val("");
}

// Función para buscar en el formulario de Activación o desactivación de Cargos
function buscarAct() {
    id_Buscar = $("#buscarId").val();
    mostrarAct(id_Buscar);
}

// Función para activar Cargos
function activar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de activar este cargo?", function(result) {
        $.post("../ajax/cargo.php?op=activar", {
            id: id
        }, function(e) {
            bootbox.alert(e);
            cargarCargos();
        })
    })
    MostrarDefault();
    $("#buscarId").val("");
}

// Función para desactivar Cargos
function desactivar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de desactivar este cargo?", function(result) {
        if (result) {
            $.post("../ajax/cargo.php?op=desactivar", {
                id: id
            }, function(e) {
                bootbox.alert(e);
                cargarCargos();
            })
        }
    })
    $("#buscarId").val("");
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
    $('.grupoBusqueda').show();
    $('.formularioEditActDesact').hide();
    cargarCargos();
    limpiar();
}

function cargarCargos() {
    // Carga los cargos registrados en el sistema
    $.post("../ajax/cargo.php?op=selectCargo", function(r) {
        $('#buscarId').html(r);
        $('#buscarId').selectpicker('refresh');
    })
}

function cancelar() {
    $('.grupoBusqueda').show();
    $('.formularioEditActDesact').hide();
    limpiar()
    cargarCargos();
}

init();