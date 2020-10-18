var condicionActual;
var pagina = $('#pagina').text();

// Función que se ejecuta al inicio
function init() {
    limpiar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    cargarTipoIdentificacion();

    cargarDepartamentos();

    cargarCiudades();

    cargarCompanias();

    cargarSedes();

    cargarCargos();

    cargarEPS();

    cargarARL();

    cargarCedulasEmpleados();

    cargarCedulasActivacion();

    cargarInformacionEmpleado();

    // Filtrado de ciudades por departamento
    $('#fo_departamento').on('changed.bs.select', function(e) {
        let fo_departamento = $('select[name="fo_departamento"] option:selected').val();
        console.log(fo_departamento);
        console.log("Antes de la función filtrar");
        filtrarCiudades(fo_departamento);
        console.log("Después de la función filtrar");
    })
}
/************************************************FIN DE LA FUNCION INIT **********************************************/


// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#fo_tipo_identificacion").val("");
    $('#fo_tipo_identificacion').selectpicker('refresh');
    $("#numero_identificacion").val("");
    $('#numero_identificacion').selectpicker('refresh');
    $("#nombres").val("");
    $("#apellidos").val("");
    $("#fo_departamento").val("");
    $('#fo_departamento').selectpicker('refresh');
    $("#fo_ciudad").val("");
    $('#fo_ciudad').selectpicker('refresh');
    $("#direccion").val("");
    $("#telefono_fijo").val("");
    $("#telefono_celular").val("");
    $("#email").val("");
    $("#fo_compania").val("");
    $('#fo_compania').selectpicker('refresh');
    $("#fo_sede").val("");
    $('#fo_sede').selectpicker('refresh');
    $("#fo_cargo").val("");
    $('#fo_cargo').selectpicker('refresh');
    $("#fo_eps").val("");
    $('#fo_eps').selectpicker('refresh');
    $("#fo_arl").val("");
    $('#fo_arl').selectpicker('refresh');
    $("#nombre_contacto_emergencia").val("");
    $("#telefono_contacto_emergencia").val("");
    $('#parentesco_contacto_emergencia').val("");
    $('#comentarios').val("");
    $("#buscarId").val("");

    if (pagina == "Edición de Empleados") {
        $("#fo_tipo_identificacion").prop('disabled', true);
        $("#nombres").prop('disabled', true);
        $("#apellidos").prop('disabled', true);
        $("#fo_departamento").prop('disabled', true);
        $("#fo_ciudad").prop('disabled', true);
        $("#direccion").prop('disabled', true);
        $("#telefono_fijo").prop('disabled', true);
        $("#telefono_celular").prop('disabled', true);
        $("#email").prop('disabled', true);
        $("#fo_compania").prop('disabled', true);
        $("#fo_sede").prop('disabled', true);
        $("#fo_cargo").prop('disabled', true);
        $("#fo_eps").prop('disabled', true);
        $("#fo_arl").prop('disabled', true);
        $("#nombre_contacto_emergencia").prop('disabled', true);
        $("#telefono_contacto_emergencia").prop('disabled', true);
        $("#parentesco_contacto_emergencia").prop('disabled', true);
        $("#comentarios").prop('disabled', true);
    }
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
        url: "../ajax/empleados.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            if (datos == "Empleado registrado correctamente") {
                bootbox.confirm(datos + " ¿Desea generar e imprimir este Registro?", function(result) {
                    if (result) {
                        generarReporteUltimoEmpleado();
                        limpiar()
                    } else {
                        bootbox.alert(datos);
                        limpiar();
                    }
                })
            } else if (datos == "Empleado actualizado correctamente") {
                bootbox.confirm(datos + " ¿Desea generar e imprimir este Registro?", function(result) {
                    if (result) {
                        generarReporteEmpleado()
                        limpiar();
                    } else {
                        bootbox.alert(datos);
                        limpiar();
                    }
                })
            } else {
                bootbox.alert(datos);
            }
        }
    })
}


// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(numero_identificacion) {
    $.post("../ajax/empleados.php?op=mostrar", {
        numero_identificacion: numero_identificacion
    }, function(data, status) {

        data = JSON.parse(data);
        $("#id").val(data.id);
        $("#fo_tipo_identificacion").val(data.fo_tipo_identificacion);
        $("#fo_tipo_identificacion").selectpicker('refresh');
        $("#nombres").val(data.nombres);
        $("#apellidos").val(data.apellidos);
        $("#fo_departamento").val(data.fo_departamento);
        $("#fo_departamento").selectpicker('refresh');
        $("#fo_ciudad").val(data.fo_ciudad);
        $("#fo_ciudad").selectpicker('refresh');
        $("#direccion").val(data.direccion);
        $("#telefono_fijo").val(data.telefono_fijo);
        $("#telefono_celular").val(data.telefono_celular);
        $("#email").val(data.email);
        $("#fo_compania").val(data.fo_compania);
        $("#fo_compania").selectpicker('refresh');
        $("#fo_sede").val(data.fo_sede);
        $("#fo_sede").selectpicker('refresh');
        $("#fo_cargo").val(data.fo_cargo);
        $("#fo_cargo").selectpicker('refresh');
        $("#fo_eps").val(data.fo_eps);
        $("#fo_eps").selectpicker('refresh');
        $("#fo_arl").val(data.fo_arl);
        $("#fo_arl").selectpicker('refresh');
        $("#nombre_contacto_emergencia").val(data.nombre_contacto_emergencia);
        $("#telefono_contacto_emergencia").val(data.telefono_contacto_emergencia);
        $("#parentesco_contacto_emergencia").val(data.parentesco_contacto_emergencia);
        $("#comentarios").val(data.comentarios);
    })
}

// Función para mostrar los datos en el formulario de activación o desactivación de Empleados
function mostrarAct(numero_identificacion) {
    $.post("../ajax/empleados.php?op=mostrar", {
        numero_identificacion: numero_identificacion
    }, function(data, status) {
        data = JSON.parse(data);
        $("#id").val(data.id);
        $("#fo_tipo_identificacion").val(data.fo_tipo_identificacion);
        $("#fo_tipo_identificacion").selectpicker('refresh');
        $("#numero_identificacion").val(data.numero_identificacion);
        $("#nombres").val(data.nombres);
        $("#apellidos").val(data.apellidos);
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

// Función para buscar en el formulario de Activación o desactivación de Compañías
function buscarAct() {
    let numero_identificacion = $('select[name="buscarId"] option:selected').text();
    mostrarAct(numero_identificacion);
}


// Función para activar Usuarios
function activar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de activar este Usuario?", function(result) {
        if (result) {
            $.post("../ajax/empleados.php?op=activar", {
                id: id
            }, function(e) {
                bootbox.alert(e);
            })
        } else {
            bootbox.alert("Empleado no activado");
        }
    })
    MostrarDefault();
}

// Función para desactivar Usuarios
function desactivar() {
    let id = $('#id').val();
    console.log(id);
    bootbox.confirm("¿Estas seguro de desactivar est Usuario?", function(result) {
        if (result) {
            $.post("../ajax/empleados.php?op=desactivar", {
                id: id
            }, function(e) {
                bootbox.alert(e);
            })
        } else {
            bootbox.alert("Empleado no desactivado");
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
    cargarCedulasActivacion();
    limpiar();
}

function habilitarFormulario() {
    $("#fo_tipo_identificacion").prop('disabled', false);
    $("#nombres").prop('disabled', false);
    $("#apellidos").prop('disabled', false);
    $("#fo_departamento").prop('disabled', false);
    $("#fo_ciudad").prop('disabled', false);
    $("#direccion").prop('disabled', false);
    $("#telefono_fijo").prop('disabled', false);
    $("#telefono_celular").prop('disabled', false);
    $("#email").prop('disabled', false);
    $("#fo_compania").prop('disabled', false);
    $("#fo_sede").prop('disabled', false);
    $("#fo_cargo").prop('disabled', false);
    $("#fo_eps").prop('disabled', false);
    $("#fo_arl").prop('disabled', false);
    $("#nombre_contacto_emergencia").prop('disabled', false);
    $("#telefono_contacto_emergencia").prop('disabled', false);
    $("#parentesco_contacto_emergencia").prop('disabled', false);
    $("#comentarios").prop('disabled', false);
}

// Carga de opciones en el select Tipo de Identificación
function cargarTipoIdentificacion() {
    $.post("../ajax/tipo_identificacion.php?op=selectIdentificacion", function(r) {
        $('#fo_tipo_identificacion').html(r);
        $('#fo_tipo_identificacion').selectpicker('refresh');
    })
}

// Carga de opciones en el select Departamentos
function cargarDepartamentos() {
    $.post("../ajax/departamentos.php?op=selectDepartamento", function(r) {
        $('#fo_departamento').html(r);
        $('#fo_departamento').selectpicker('refresh');
    })
}

// Carga de opciones en el select Ciudad (Todas las ciudades)
function cargarCiudades() {
    $.post("../ajax/ciudades.php?op=selectAll", function(r) {
        $('#fo_ciudad').html(r);
        $('#fo_ciudad').selectpicker('refresh');
    })
}


function filtrarCiudades(fo_departamento) {
    let urlConsulta = "../ajax/ciudadesFiltro.php?dpto=" + fo_departamento;
    console.log(urlConsulta);
    $.get(urlConsulta, function(r) {
        $('#fo_ciudad').html(r);
        $('#fo_ciudad').selectpicker('refresh');
    });
}


// Carga de opciones en el select Compañías
function cargarCompanias() {
    $.post("../ajax/companias.php?op=selectCompania", function(r) {
        $('#fo_compania').html(r);
        $('#fo_compania').selectpicker('refresh');
    })
}

// Carga de opciones en el select Sedes
function cargarSedes() {
    $.post("../ajax/sedes.php?op=selectSede", function(r) {
        $('#fo_sede').html(r);
        $('#fo_sede').selectpicker('refresh');
    })
}

// Carga de opciones en el select Cargos
function cargarCargos() {
    $.post("../ajax/cargo.php?op=selectCargo", function(r) {
        $('#fo_cargo').html(r);
        $('#fo_cargo').selectpicker('refresh');
    })
}

// Carga de opciones en el select EPS
function cargarEPS() {
    $.post("../ajax/eps.php?op=selectEPS", function(r) {
        $('#fo_eps').html(r);
        $('#fo_eps').selectpicker('refresh');
    })
}

// Carga de opciones en el select ARL
function cargarARL() {
    $.post("../ajax/arl.php?op=selectARL", function(r) {
        $('#fo_arl').html(r);
        $('#fo_arl').selectpicker('refresh');
    })
}

// Carga los números de cédula de Empleados en la página Edición de empleados
function cargarCedulasEmpleados() {
    $.post("../ajax/empleados.php?op=selectNumeroIdentificacion", function(r) {
        $('#numero_identificacion').html(r);
        $('#numero_identificacion').selectpicker('refresh');
    })
}

// Carga los números de cédula de Empleados en la página Act/Desact de empleados
function cargarCedulasActivacion() {
    $.post("../ajax/empleados.php?op=selectNumeroIdentificacion", function(r) {
        $('#buscarId').html(r);
        $('#buscarId').selectpicker('refresh');
    })
}

function cargarInformacionEmpleado() {
    // Carga la información del empleado
    $('#numero_identificacion').on('changed.bs.select', function(e) {
        let numero_identificacion = $('select[name="numero_identificacion"] option:selected').text();
        habilitarFormulario();
        mostrar(numero_identificacion);
    })
}

function generarReporteUltimoEmpleado() {
    window.open('reporte_empleado_individual_ultimo.php', '_blank');
}

function generarReporteEmpleado() {
    let id = $("#id").val();
    window.open('reporte_empleado_individual.php?id=' + id, '_blank');
}

init();