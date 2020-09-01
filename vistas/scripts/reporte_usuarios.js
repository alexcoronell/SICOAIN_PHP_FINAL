var tabla;

// Función que se ejecuta al inicio
function init() {
    listar();
}

// Función para listar los registros en la tabla
function listar() {
    tabla = $('#tbllistado').dataTable({
        language: {
            url: '../public/DataTables/Spanish.json'
        },
        "aProcessing": true, // Activación del procesamiento del datatables
        "aServerSide": true, // Paginación y filtrado realizado por el servidor
        dom: 'Bfrtip', // Se definen los elementos de contcargo de la tabla
        buttons: [
            'copy', 'excel', {
                extend: 'pdf',
                orientation: 'portrait',
                pageSize: 'LETTER',
                download: 'open',
                title: 'Reporte de Usuarios',
                exportOptions: {
                    columns: ':visible'
                },
                alignment: 'center'
            },
            'colvis'
        ],
        "ajax": {
            url: '../ajax/usuarios.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        keys: true,
        select: true,
        colReorder: true,
        rowReorder: true,
        "bDestroy": true,
        "iDisplayLength": 10, // Paginación
        "order": [
            [0, "desc"]
        ] // Ordenación (Columna, Orden)
    }).DataTable();
}

init();