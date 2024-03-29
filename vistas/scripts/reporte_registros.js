var tabla;

// Función que se ejecuta al inicio
function init() {
    listar();
}

// Función para listar los registros en la tabla
function listar() {
    tabla = $('#tbllistado').dataTable({
        language: {
            url: '../public/DataTables/Spanish.json',
            buttons: {
                copyTitle: 'Copiado al portapapeles',
                copyKeys: 'Use your keyboard or menu to select the copy command',
                copySuccess: {
                    1: "Copiada una fila al portapapeles",
                    _: "Copiadas %d filas al portapapeles"
                }
            }
        },
        "aProcessing": true, // Activación del procesamiento del datatables
        "aServerSide": true, // Paginación y filtrado realizado por el servidor
        dom: 'Bfrtip', // Se definen los elementos de contcargo de la tabla
        buttons: ['colvis', 'copy', 'excel', {
            extend: 'pdf',
            orientation: 'landscape',
            pageSize: 'LETTER',
            download: 'open',
            title: 'Reporte de Incidentes',
            exportOptions: {
                columns: ':visible'
            },
            alignment: 'center'
        }, ],
        "ajax": {
            url: '../ajax/registros.php?op=listar',
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
        "iDisplayLength": 8, // Paginación
        "order": [
            [0, "desc"]
        ] // Ordenación (Columna, Orden)
    }).DataTable();
}

init();