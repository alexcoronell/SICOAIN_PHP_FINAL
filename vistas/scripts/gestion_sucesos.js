// Función que se ejecuta al inicio
function init() {

    cargarSucesos();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    limpiar();
}

// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#nombre").val("");
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
        url: "../ajax/sucesos.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            if (datos == "Suceso registrado correctamente" || datos == "Suceso actualizado correctamente") {
                cargarSucesos();
                $('.grupoBusqueda').show();
                $('.formularioEditActDesact').hide();
                limpiar();
            }
        }
    })
}

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id) {
    $.post("../ajax/sucesos.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id").val(data.id);
        $('#nombre').val(data.nombre);
        $('#condicion').val(data.condicion);
        $('.grupoBusqueda').hide();
        $('.formularioEditActDesact').show();
    })
}

// Función para mostrar los datos en el formulario de activación o desactivación de Suceso
function mostrarAct(id) {
    $.post("../ajax/sucesos.php?op=mostrar", {
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

// Función para buscar en el formulario de edición de EPS
function buscar() {
    id_Buscar = $("#buscarId").val();
    mostrar(id_Buscar);
    $('#buscarId').val("");
}

// Función para buscar en el formulario de Activación o desactivación de Suceso
function buscarAct() {
    idBuscar = $("#buscarId").val();
    mostrarAct(idBuscar);
}

// Función para activar EPS
function activar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de activar este suceso?", function(result) {
        $.post("../ajax/sucesos.php?op=activar", {
            id: id
        }, function(e) {
            bootbox.alert(e);
        })
    })
    MostrarDefault();

}

// Función para desactivar EPS
function desactivar() {
    let id = $('#id').val();
    console.log(id);
    bootbox.confirm("¿Estas seguro de desactivar este suceso?", function(result) {
        if (result) {
            $.post("../ajax/sucesos.php?op=desactivar", {
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
    $('.grupoBusqueda').show();
    $('.formularioEditActDesact').hide();
    limpiar();
}

function cargarSucesos() {
    // Carga de opciones en el select Empleado
    $.post("../ajax/sucesos.php?op=selectSuceso", function(r) {
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