// Función que se ejecuta al inicio
function init() {
    limpiar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })
}

// Función para limpiar el formulario
function limpiar() {
    $("#id_cargo").val("");
    $("#cargo").val("");
    $('#descripcion').val("");
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
        url: "../ajax/cargo.php?op=guardaryeditar",
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
function mostrar(id_cargo) {
    $.post("../ajax/cargo.php?op=mostrar", {
        id_cargo: id_cargo
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id_cargo").val(data.id_cargo);
        $('#cargo').val(data.cargo);
        $('#descripcion').val(data.descripcion);
    })
}

// Función para mostrar los datos en el formulario de activación o desactivación de Cargos
function mostrarAct(id_cargo) {
    $.post("../ajax/cargo.php?op=mostrar", {
        id_cargo: id_cargo
    }, function(data, status) {
        data = JSON.parse(data);
        $("#id_cargo").val(data.id_cargo);
        $('#cargo').val(data.cargo);
        $('#condicion').val(data.condicion);
        data.condicion == 1 ? MostrarDesactivar() : MostrarActivar();
    })
}

// Función para buscar en el formulario de edición de Cargos
function buscar() {
    id_cargoBuscar = $("#buscarcargo").val();
    mostrar(id_cargoBuscar);
    $('#buscarcargo').val("");
}

// Función para buscar en el formulario de Activación o desactivación de Cargos
function buscarAct() {
    id_cargoBuscar = $("#buscarcargo").val();
    mostrarAct(id_cargoBuscar);
}

// Función para activar Cargos
function activar() {
    let id_cargo = $('#id_cargo').val();
    bootbox.confirm("¿Estas seguro de activar este cargo?", function(result) {
        $.post("../ajax/cargo.php?op=activar", {
            id_cargo: id_cargo
        }, function(e) {
            bootbox.alert(e);
        })
    })
    $('#button_activar').hide();
    $('#button_desactivar').hide();
    $('#button_default').show();
    limpiar();
    $("#buscarcargo").val("");
}

// Función para desactivar Cargos
function desactivar() {
    let id_cargo = $('#id_cargo').val();
    bootbox.confirm("¿Estas seguro de desactivar este cargo?", function(result) {
        if (result) {
            $.post("../ajax/cargo.php?op=desactivar", {
                id_cargo: id_cargo
            }, function(e) {
                bootbox.alert(e);
            })
        }
    })
    $('#button_activar').hide();
    $('#button_desactivar').hide();
    $('#button_default').show();
    limpiar();
    $("#buscarcargo").val("");
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