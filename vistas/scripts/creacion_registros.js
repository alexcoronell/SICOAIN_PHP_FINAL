var fechaActual = new Date();
var dia = fechaActual.getDate();
var mes = fechaActual.getMonth() + 1;
var anio = fechaActual.getFullYear();
if (dia < 10) {
    dia = "0" + dia;
}
if (mes < 10) {
    mes = "0" + mes;
}
var hoy = anio + "-" + mes + "-" + dia;


// Función que se ejecuta al inicio
function init() {

    limpiar();

    $("#formulario").on("submit", function(e) {
        guardar(e);
    });

    // Carga de opciones en el select Empleado
    $.post("../ajax/empleados.php?op=selectEmpleado", function(r) {
        $('#fo_empleado').html(r);
        $('#fo_empleado').selectpicker('refresh');
    })

    $('#fo_empleado').on('changed.bs.select', function(e) {
        let EmpleadoSeleccionado = $('select[name="fo_empleado"] option:selected').text();
        mostrarNombres(EmpleadoSeleccionado);
    })

    // Carga de opciones en el select Empleado
    $.post("../ajax/sucesos.php?op=selectSuceso", function(r) {
        $('#fo_suceso').html(r);
        $('#fo_suceso').selectpicker('refresh');
    })

}
/************************************************FIN DE LA FUNCION INIT **********************************************/



// Función para limpiar el formulario
function limpiar() {
    $("#id_registro").val("");
    $("#fo_empleado").val("");
    $('#fo_empleado').selectpicker('refresh');
    $("#nombresApellidos").val("");
    $("#fo_suceso").val("");
    $('#fo_suceso').selectpicker('refresh');
    $("#fecha_registro").val(hoy);
    $("#fecha_incidente").val("");
    $("#evidencia_digital").val("");
    $("#descripcion").val("");
    $("#motivo_anulacion").val("");
    $("#buscarId").val("");
}



// Función para cancelar el formulario
function cancelarFormulario() {
    limpiar();
}


// Función para guardar o editar
function guardar(e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    $("btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../ajax/registros.php?op=guardar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            //bootbox.alert(datos);
            if (datos == "Registro guardado correctamente") {
                let generar = confirm(datos + "\n¿Desea generar e imprimir este Registro?");
                if (confirm) {
                    generarReporte();
                    limpiar();
                }
            } else {
                bootbox.alert(datos);
            }
        }
    })
}

function mostrarNombres(numero_identificacion) {
    $.post("../ajax/empleados.php?op=consultaNombreApellido", {
        numero_identificacion: numero_identificacion
    }, function(data, status) {
        data = JSON.parse(data);

        let nombreCompleto = data.nombres + " " + data.apellidos;
        $("#nombresApellidos").val(nombreCompleto);
    })
}

function generarReporte() {
    window.open('reporte_registro_individual.php', '_blank');
}

init();