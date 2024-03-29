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

    const usuarioModificador = $('#usuario_modificador').val();

    limpiar();

    $("#formulario").on("submit", function(e) {
        editar(e);
    });

    cargarRegistros();

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

    // Validación de la Evidencia Digital
    $('#evidencia_digital').change(function() {
        let fileName = this.files[0].name;
        let fileSize = this.files[0].size;

        if (fileSize > 3000000) {
            bootbox.alert("El archivo no debe superar los 3Mb");
            $("#evidencia_digital").val("");
        } else {
            let extension = fileName.split('.').pop();
            extension = extension.toLowerCase();
            if (extension != 'pdf' && extension != 'jpg' && extension != 'jpeg' && extension != 'png' && extension != 'bmp') {
                bootbox.alert("Tipo de Archivo Inválido");
                $("#evidencia_digital").val("");
            }
        }
    })



}
/************************************************FIN DE LA FUNCION INIT **********************************************/



// Función para limpiar el formulario
function limpiar() {
    deshabilitarFormulario();
    $("#id_registro").val("");
    $("#fo_empleado").val("");
    $('#fo_empleado').selectpicker('refresh');
    $("#nombresApellidos").val("");
    $("#fo_suceso").val("");
    $('#fo_suceso').selectpicker('refresh');
    $("#fecha_registro").val("");
    $("#fecha_incidente").val("");
    $("#usuario_creador").val("");
    $("#evidencia_actual").val("");
    $("#evidencia_digital").val("");
    $("#descripcion").val("");
    $("#motivo_anulacion").val("");
    $("#buscarId").val("");
    $('#buscarId').selectpicker('refresh');
}

// Función para buscar en el formulario de edición de Registros
function buscar() {
    id_Buscar = $("#buscarId").val();
    mostrar(id_Buscar);
    $('#buscarId').val("");
}

// Función para cancelar el formulario
function cancelarFormulario() {
    limpiar();
}


// Función para guardar o editar
function editar(e) {
    e.preventDefault(); // Evita que se ejecute la acción predeterminada del evento
    $("btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);
    $.ajax({
        url: "../ajax/registros.php?op=editar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            if (datos == "Registro actualizado correctamente") {
                bootbox.confirm(datos + " ¿Desea generar e imprimir este Registro?", function(result) {
                    if (result) {
                        generarReporte();
                        limpiar();
                    } else {
                        bootbox.alert(datos);
                    }
                })
            } else {
                bootbox.alert(datos);
            }
        }

    })
}

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id_registro) {
    $.post("../ajax/registros.php?op=mostrar", {
        id_registro: id_registro
    }, function(data, status) {
        data = JSON.parse(data);

        habilitarFormulario();
        $("#id_registro").val(data.id_registro);
        $("#fo_empleado").val(data.fo_empleado);
        $('#fo_empleado').selectpicker('refresh');
        let EmpleadoSeleccionado = $('select[name="fo_empleado"] option:selected').text();
        mostrarNombres(EmpleadoSeleccionado);
        $("#fo_suceso").val(data.fo_suceso);
        $('#fo_suceso').selectpicker('refresh');
        $("#fecha_registro").val(data.fecha_registro);
        $("#fecha_incidente").val(data.fecha_incidente);
        $("#evidencia_actual").val(data.evidencia_digital);
        $("#usuario_creador").val(data.usuario_creador);
        $("#descripcion").val(data.descripcion);
        $("#buscarId").val("");
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

function habilitarFormulario() {
    $('#fo_empleado').prop('disabled', false);
    $('#fo_suceso').prop('disabled', false);
    $('#fecha_incidente').prop('disabled', false);
    $('#descripcion').prop('disabled', false);
    $('#evidencia_actual').prop('disabled', false);
    $('#evidencia_digital').prop('disabled', false);
}

function deshabilitarFormulario() {
    $('#fo_empleado').prop('disabled', true);
    $('#fo_suceso').prop('disabled', true);
    $('#fecha_incidente').prop('disabled', true);
    $('#descripcion').prop('disabled', true);
    $('#evidencia_actual').prop('disabled', true);
    $('#evidencia_digital').prop('disabled', true);
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
    window.open('reporte_registro_individual.php?id_registro=' + id_registro, '_blank');
}

init();