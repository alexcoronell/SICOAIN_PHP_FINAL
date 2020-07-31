var condicionActual;

// Función que se ejecuta al inicio
function init() {
    limpiar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    });

    // Carga de opciones en el select Tipo de Identificación
    $.post("../ajax/tipo_identificacion.php?op=selectIdentificacion", function(r) {
        $('#fo_tipo_identificacion').html(r);
        $('#fo_tipo_identificacion').selectpicker('refresh');
    })

    // Carga de opciones en el select Departamentos
    $.post("../ajax/departamentos.php?op=selectDepartamento", function(r) {
        $('#fo_departamento').html(r);
        $('#fo_departamento').selectpicker('refresh');
    })

    // Carga de opciones en el select Ciudad (Todas las ciudades)
    $.post("../ajax/ciudades.php?op=selectAll", function(r) {
        $('#fo_ciudad').html(r);
        $('#fo_ciudad').selectpicker('refresh');
    })

    // Carga de opciones filtradas por departamento en el select Ciudad
    $('#fo_departamento').change(function() {
        var NroDepartamento = $('#fo_departamento').val();
        console.log(NroDepartamento);
        /* $.post("../ajax/ciudades.php?op=selectCiudad", {
            NroDepartamento: NroDepartamento
        }, function(r) {
            $('#fo_ciudad').html(r);
            $('#fo_ciudad').selectpicker('refresh');
        }) */
    })

    // Carga de opciones en el select Compañías
    $.post("../ajax/companias.php?op=selectCompania", function(r) {
        $('#fo_compania').html(r);
        $('#fo_compania').selectpicker('refresh');
    })

    // Carga de opciones en el select Sedes
    $.post("../ajax/sedes.php?op=selectSede", function(r) {
        $('#fo_sede').html(r);
        $('#fo_sede').selectpicker('refresh');
    })

    // Carga de opciones en el select Cargos
    $.post("../ajax/cargo.php?op=selectCargo", function(r) {
        $('#fo_cargo').html(r);
        $('#fo_cargo').selectpicker('refresh');
    })

    // Carga de opciones en el select EPS
    $.post("../ajax/eps.php?op=selectEPS", function(r) {
        $('#fo_eps').html(r);
        $('#fo_eps').selectpicker('refresh');
    })

    // Carga de opciones en el select ARL
    $.post("../ajax/arl.php?op=selectARL", function(r) {
        $('#fo_arl').html(r);
        $('#fo_arl').selectpicker('refresh');
    })



}
/************************************************FIN DE LA FUNCION INIT **********************************************/



// Función para limpiar el formulario
function limpiar() {
    $("#id").val("");
    $("#fo_tipo_identificacion").val("");
    $('#fo_tipo_identificacion').selectpicker('refresh');
    $("#numero_identificacion").val("");
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
            bootbox.alert(datos);
        }
    })
    limpiar();
}

// Función para mostrar los datos en la tabla de reportes y en formulario de edición
function mostrar(id) {
    $.post("../ajax/empleados.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);

        $("#id").val(data.id);
        $('#usuario').val(data.usuario);
        $('#nombre').val(data.nombre);
        data.superusuario == 1 ? $('#superusuario').prop("checked", true) : $('#superusuario').prop("checked", false);
        data.administrador == 1 ? $('#administrador').prop("checked", true) : $('#administrador').prop("checked", false);
        data.analista == 1 ? $('#analista').prop("checked", true) : $('#analista').prop("checked", false);
        data.asistente == 1 ? $('#asistente').prop("checked", true) : $('#asistente').prop("checked", false);
        data.consultas == 1 ? $('#consultas').prop("checked", true) : $('#consultas').prop("checked", false);
        $('#contrasena').val(data.contrasena);
    })
}

// Función para mostrar los datos en el formulario de activación o desactivación de EPS
function mostrarAct(id) {
    $.post("../ajax/empleados.php?op=mostrar", {
        id: id
    }, function(data, status) {
        data = JSON.parse(data);
        $("#id").val(data.id);
        $('#usuario').val(data.usuario);
        $('#condicion').val(data.condicion);
        data.condicion == 1 ? MostrarDesactivar() : MostrarActivar();
    })
}

// Función para buscar en el formulario de edición de EPS
function buscar() {
    id_Buscar = $("#buscarId").val();
    mostrar(id_Buscar);
    $('#buscarId').val("");
}

// Función para buscar en el formulario de Activación o desactivación de EPS
function buscarCiudad() {
    console.log("Me ejecuto");
    $.post("../ajax/ciudades.php?op=selectCiudad", function(r) {
        $('#fo_ciudad').html(r);
        $('#fo_ciudad').selectpicker('refresh');
    })
}

// Función para activar Usuarios
function activar() {
    let id = $('#id').val();
    bootbox.confirm("¿Estas seguro de activar este Usuario?", function(result) {
        $.post("../ajax/empleados.php?op=activar", {
            id: id
        }, function(e) {
            bootbox.alert(e);
        })
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

init();