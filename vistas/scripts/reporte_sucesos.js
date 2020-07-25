var tabla;

// Función que se ejecuta al inicio
function init() {
    listar();
}

// Función para listar los registros en la tabla
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, // Activación del procesamiento del datatables
        "aServerSide": true, // Paginación y filtrado realizado por el servidor
        dom: 'Bfrtip', // Se definen los elementos de contcargo de la tabla
        buttons: [
            'pdf'
        ],
        "ajax": {
            url: '../ajax/sucesos.php?op=listar',
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