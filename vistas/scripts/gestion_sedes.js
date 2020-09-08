// Función que se ejecuta al inicio
function init() {

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    // Carga de opciones en el select Compañías
    $.post("../ajax/companias.php?op=selectCompania", function(r) {
        $('#fo_compania').html(r);
        $('#fo_compania').selectpicker('refresh');
    })

    cargaSedes();

    limpiar();
}

// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#fo_compania").val("");
    $('#fo_compania').selectpicker('refresh');
    $('#nombre').val("");
    $('#telefono').val("");
    $('#direccion').val("");
    $('#notas').val("");
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
        url: "../ajax/sedes.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            if (datos == "Sede registrada correctamente" || datos == "Sede actualizada correctamente") {
                cargaSedes();
                limpiar();
            }
        }
    })
}

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id) {
    $.post("../ajax/sedes.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id").val(data.id);
        $('#fo_compania').val(data.fo_compania);
        $('#fo_compania').selectpicker('refresh');
        $('#nombre').val(data.nombre);
        $('#telefono').val(data.telefono);
        $('#direccion').val(data.direccion);
        $('#notas').val(data.notas);
        $('.grupoBusqueda').hide();
        $('.formularioEditActDesact').show();
    })
}

// Función para mostrar los datos en el formulario de activación o desactivación de Compañías
function mostrarAct(id) {
    $.post("../ajax/sedes.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);
        $("#id").val(data.id);
        $('#nombre').val(data.nombre);
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
    bootbox.confirm("¿Estas seguro de activar esta sede?", function(result) {
        $.post("../ajax/sedes.php?op=activar", {
            id: id
        }, function(e) {
            bootbox.alert(e);
        })
    })
    MostrarDefault();
}

// Función para desactivar Compañías
function desactivar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de desactivar esta Sede?", function(result) {
        if (result) {
            $.post("../ajax/sedes.php?op=desactivar", {
                id: id
            }, function(e) {
                bootbox.alert(e);
            })
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

function cargaSedes() {
    // Carga las sedes registrados en el sistema
    $.post("../ajax/sedes.php?op=selectSede", function(r) {
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