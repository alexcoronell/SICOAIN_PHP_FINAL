// Función que se ejecuta al inicio
function init() {

    cargarCompanias();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    limpiar();
}

// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#compania").val("");
    $('#telefono_compania').val("");
    $('#direccion_compania').val("");
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
        url: "../ajax/companias.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            if (datos == "Compañía registrada correctamente" || datos == "Compañía actualizada correctamente") {
                limpiar();
                $('.grupoBusqueda').show();
                $('.formularioEditActDesact').hide();
                cargarCompanias();
            }
        }
    })
}

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id) {
    $.post("../ajax/companias.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id").val(data.id);
        $('#compania').val(data.compania);
        $('#telefono_compania').val(data.telefono_compania);
        $('#direccion_compania').val(data.direccion_compania);
        $('.grupoBusqueda').hide();
        $('.formularioEditActDesact').show();
    })
}

// Función para mostrar los datos en el formulario de activación o desactivación de Compañías
function mostrarAct(id) {
    $.post("../ajax/companias.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);
        $("#id").val(data.id);
        $('#compania').val(data.compania);
        $('#condicion').val(data.condicion);
        $('.grupoBusqueda').hide();
        $('.formularioEditActDesact').show();
        data.condicion == 1 ? MostrarDesactivar() : MostrarActivar();
    })
}

// Función para buscar en el formulario de edición de Compañías
function buscar() {
    id_Buscar = $("#buscarId").val();
    mostrar(id_Buscar);
    $('#buscarId').val("");
}

// Función para buscar en el formulario de Activación o desactivación de Compañías
function buscarAct() {
    id_Buscar = $("#buscarId").val();
    mostrarAct(id_Buscar);
}

// Función para activar Compañías
function activar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de activar esta compañía?", function(result) {
        if (result) {
            $.post("../ajax/companias.php?op=activar", {
                id: id
            }, function(e) {
                bootbox.alert(e);
            })
        } else {
            bootbox.alert("Compañía no activada")
        }
    })
    MostrarDefault();
}

// Función para desactivar Compañías
function desactivar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de desactivar esta compañía?", function(result) {
        if (result) {
            $.post("../ajax/companias.php?op=desactivar", {
                id: id
            }, function(e) {
                bootbox.alert(e);
            })
        } else {
            bootbox.alert("Compañía no desactivada")
        }
    })
    MostrarDefault();
}

function MostrarDefault() {
    $('#button_default').show();
    $('#button_activar').hide();
    $('#button_desactivar').hide();
    $('.grupoBusqueda').show();
    $('.formularioEditActDesact').hide();
    cargarCompanias()
    limpiar();
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

function cargarCompanias() {
    // Carga las compañías registrados en el sistema
    $.post("../ajax/companias.php?op=selectCompaniaAll", function(r) {
        $('#buscarId').html(r);
        $('#buscarId').selectpicker('refresh');
    })
}

function cancelar() {
    $('.grupoBusqueda').show();
    $('.formularioEditActDesact').hide();
    limpiar()
}

init();