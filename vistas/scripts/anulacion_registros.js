// Función que se ejecuta al inicio
function init() {

    cargarRegistros();

    $("#formulario").on("submit", function(e) {
        anular(e);
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

    limpiar();

}
/************************************************FIN DE LA FUNCION INIT **********************************************/



// Función para limpiar el formulario
function limpiar() {
    $("#id_registro").val("");
    $("#fo_empleado").val("");
    $('#fo_empleado').selectpicker('refresh');
    $("#nombresApellidos").val("");
    $("#fecha_registro").val("");
    $("#fecha_incidente").val("");
    $("#motivo_anulacion").val("");
    $("#buscarId").val("");
}



// Función para cancelar el formulario
function cancelarFormulario() {
    limpiar();
}


function anular(e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    $("btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    bootbox.confirm("¿Estas seguro de Anular este Registro?", function(result) {
        if (result) {
            console.log(formData);
            $.ajax({
                url: "../ajax/registros.php?op=anular",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,

                success: function(datos) {
                    //bootbox.alert(datos);
                    if (datos == "Registro anulado") {
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
    })
}

function mostrar(id_registro) {
    $.post("../ajax/registros.php?op=mostrar", {
        id_registro: id_registro
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id_registro").val(data.id_registro);
        $("#fo_empleado").val(data.fo_empleado);
        $("#fo_empleado").selectpicker('refresh');
        let EmpleadoSeleccionado = $('select[name="fo_empleado"] option:selected').text();
        mostrarNombres(EmpleadoSeleccionado);
        $("#fecha_registro").val(data.fecha_registro);
        $("#fecha_incidente").val(data.fecha_incidente);
        $("#buscarId").val("");
    })
}



// Función para buscar en el formulario de edición de Registros
function buscar() {
    id_Buscar = $("#buscarId").val();
    mostrar(id_Buscar);
    $('#buscarId').val("");
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

function cargarRegistros() {
    // Carga de opciones en el select Registro
    $.post("../ajax/registros.php?op=selectRegistro", function(r) {
        $('#buscarId').html(r);
        $('#buscarId').selectpicker('refresh');
    })
}

function generarReporte() {
    let id_registro = $("#id_registro").val();
    window.open('reporte_registro_individual_anulado.php?id_registro=' + id_registro, '_blank');
}

init();