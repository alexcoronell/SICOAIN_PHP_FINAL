var tabla;

// Función que se ejecuta al inicio
function init() {
    listar();
}

// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#rol").val("");
    $('#descripcion').val("");
    $('#superusuario').prop("checked", false);
    $('#administrador').prop("checked", false);
    $('#analista_asistente').prop("checked", false);
    $('#consultas').prop("checked", false);
}

// Función para mostrar el formulario
function mostrarFormulario() {
    limpiar();
}

// Función para cancelar el formulario
function cancelarFormulario() {
    limpiar();
}

// Función para listar los registros en la tabla
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, // Activación del procesamiento del datatables
        "aServerSide": true, // Paginación y filtrado realizado por el servidor
        dom: 'Bfrtip', // Se definen los elementos de control de la tabla
        buttons: [
            'pdf'
        ],
        "ajax": {
            url: '../ajax/roles.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, // Paginación
        "order": [
            [0, "desc"]
        ] // Ordenación (Columna, Orden)
    }).DataTable();
}

init();