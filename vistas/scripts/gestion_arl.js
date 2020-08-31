var condicionActual;

// Función que se ejecuta al inicio
function init() {
    cargarARL();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    limpiar();
}

// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#nombre_arl").val("");
    $('#telefono').val("");
    $('#direccion').val("");
    $('#email').val("");
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
        url: "../ajax/arl.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            if (datos == "ARL registrada correctamente" || datos == "ARL actualizada correctamente") {
                cargarARL();
                limpiar();
            }
        }
    })
}

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id) {
    $.post("../ajax/arl.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id").val(data.id);
        $('#nombre_arl').val(data.nombre_arl);
        $('#telefono').val(data.telefono);
        $('#direccion').val(data.direccion);
        $('#email').val(data.email);
    })
}

// Función para mostrar los datos en el formulario de activación o desactivación de ARL
function mostrarAct(id) {
    $.post("../ajax/arl.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);
        $("#id").val(data.id);
        $('#nombre_arl').val(data.nombre_arl);
        $('#condicion').val(data.condicion);
        data.condicion == 1 ? MostrarDesactivar() : MostrarActivar();
    })
}

// Función para buscar en el formulario de edición de ARL
function buscar() {
    id_Buscar = $("#buscarId").val();
    mostrar(id_Buscar);
    $('#buscarId').val("");
}

// Función para buscar en el formulario de Activación o desactivación de ARL
function buscarAct() {
    idBuscar = $("#buscarId").val();
    mostrarAct(idBuscar);
}

// Función para activar ARL
function activar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de activar esta ARL?", function(result) {
        $.post("../ajax/arl.php?op=activar", {
            id: id
        }, function(e) {
            bootbox.alert(e);
        })
    })
    MostrarDefault();

}

// Función para desactivar ARL
function desactivar() {
    let id = $('#id').val();
    console.log(id);
    bootbox.confirm("¿Estas seguro de desactivar esta ARL?", function(result) {
        if (result) {
            $.post("../ajax/arl.php?op=desactivar", {
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

function cargarARL() {
    // Carga de opciones en el select ARL
    $.post("../ajax/arl.php?op=selectARL", function(r) {
        $('#buscarId').html(r);
        $('#buscarId').selectpicker('refresh');
    })
}

init();