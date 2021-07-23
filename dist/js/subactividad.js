let label_subactividad = 'subactividad'
let modal_subactividad = '#modal-default-subactividad'
let url_subactividad = '../controllers/SubactividadController.php'
let capitalize_label_subactividad = label_subactividad.charAt(0).toUpperCase() + label_subactividad.slice(1)

function obtenerTablaSubactividad(id_actividad) 
{
    let form_registro = new FormData;
    form_registro.append('id_actividad', id_actividad);
    form_registro.append('action', 'obtenerTablaSubactividad');

    fetch(url_subactividad, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $('.record_subactividad_'+id_actividad).html(res);
    })
}
function obtenerAcordeon() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'obtenerAcordeon');

    fetch(url_subactividad, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_subactividades").html(res);
    })
}

function agregarSubactividad()
{
    let id_actividad_subactividad = document.getElementById("id_actividad_subactividad");
    let orden_subactividad = document.getElementById("orden_subactividad");
    let id_responsable_subactividad = document.getElementById("id_responsable_subactividad");
    let descripcion_subactividad = document.getElementById("descripcion_subactividad");
    let form_registro = new FormData;
    form_registro.append('id_actividad_subactividad', id_actividad_subactividad.value);
    form_registro.append('orden_subactividad', orden_subactividad.value);
    form_registro.append('id_responsable_subactividad', id_responsable_subactividad.value);
    form_registro.append('descripcion_subactividad', descripcion_subactividad.value);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([id_actividad_subactividad, orden_subactividad, id_responsable_subactividad, descripcion_subactividad]);
    if(validacion==true)
    {
        fetch(url_subactividad, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_subactividad} creada correctamente!`);
                $(modal_subactividad).modal("hide");
                obtenerTablaSubactividad(id_actividad_subactividad.value);
            }
            else
                $.notification.show('error',`Error al crear la ${res}!`);
        })
    }
}

function getDataSubactividad(id)
{
    let form_registro = new FormData;
    form_registro.append('id_subactividad', id);
    form_registro.append('action', 'find');

    fetch(url_subactividad, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_subactividad_update").val(res[0].id_subactividad);
            $("#orden_subactividad").val(res[0].orden_subactividad);
            $("#id_actividad_subactividad").val(res[0].id_actividad);
            $("#id_responsable_subactividad").val(res[0].id_responsable);
            $("#descripcion_subactividad").val(res[0].descripcion_subactividad);
            document.getElementById('leyendaAgregarSubactividad').style.display = 'none';
            document.getElementById('leyendaEditarSubactividad').style.display = 'block';
            document.getElementById('buttonGuardarSubactividad').style.display = 'none';
            document.getElementById('buttonActualizarSubactividad').style.display = 'block';
            $(modal_subactividad).modal("show");
    })
}

function actualizarSubactividad()
{
    let id_actividad_subactividad = document.getElementById("id_actividad_subactividad");
    let orden_subactividad = document.getElementById("orden_subactividad");
    let id_responsable_subactividad = document.getElementById("id_responsable_subactividad");
    let descripcion_subactividad = document.getElementById("descripcion_subactividad");
    let id_subactividad_update = $("#id_subactividad_update").val();
    let form_registro = new FormData;
    form_registro.append('id_subactividad', id_subactividad_update);
    form_registro.append('id_actividad_subactividad', id_actividad_subactividad.value);
    form_registro.append('orden_subactividad', orden_subactividad.value);
    form_registro.append('id_responsable_subactividad', id_responsable_subactividad.value);
    form_registro.append('descripcion_subactividad', descripcion_subactividad.value);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([id_actividad_subactividad, orden_subactividad, id_responsable_subactividad, descripcion_subactividad]);
    if(validacion==true)
    {
        fetch(url_subactividad, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_subactividad} actualizada correctamente!`);
                $(modal_subactividad).modal("hide");
                obtenerTablaSubactividad(id_actividad_subactividad.value);
            }
            else
                $.notification.show('error',`Error al actualizar la ${label_subactividad}!`);
        })
    }
}

function eliminarSubactividad(id_actividad, id_subactividad)
{
    let conf = confirm(`Desea eliminar esta ${label_subactividad}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_subactividad', id_subactividad);
        form_registro.append('action', 'eliminar');

        fetch(url_subactividad, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_subactividad} eliminada correctamente!`);
                $(modal_subactividad).modal("hide");
                obtenerTablaSubactividad(id_actividad);
            }
            else
                $.notification.show('error',`Error al eliminar la ${label_subactividad}!`);
        })
    }
}
$(modal_subactividad).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregarSubactividad').style.display = 'block';
    document.getElementById('leyendaEditarSubactividad').style.display = 'none';
    document.getElementById('buttonGuardarSubactividad').style.display = 'block';
    document.getElementById('buttonActualizarSubactividad').style.display = 'none';
    $("#id_actividad_subactividad").val('');
    $("#orden_subactividad").val('');
    $("#id_responsable_subactividad").val('');
    $("#descripcion_subactividad").val('');

    quitarErrorValidacion()
});

$(document).ready(function() {
    obtenerAcordeon();
} );