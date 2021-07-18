let label_subactividad = 'subactividad'
let modal_subactividad = '#modal-default-subactividad'
let url_subactividad = '../controllers/SubactividadController.php'
let capitalize_label_subactividad = label_subactividad.charAt(0).toUpperCase() + label_subactividad.slice(1)

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
/*
function agregarSubactividad()
{
    let orden_subactividad = $("#orden_subactividad").val();
    let de_subactividad = $("#de_subactividad").val();
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('orden_subactividad', orden_subactividad);
    form_registro.append('de_subactividad', de_subactividad);
    form_registro.append('action', 'guardar');

    fetch(url_subactividad, {
        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success',`${capitalize_label_subactividad} creada correctamente!`);
            $(modal_subactividad).modal("hide");
            obtenerTablaSubactividad();
        }
        else
            $.notification.show('error',`Error al crear la ${res}!`);
    })
}

function getDataSubactividad(id)
{
    let validacion = '';
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
            $("#de_subactividad").val(res[0].descripcion_subactividad);
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $(modal_subactividad).modal("show");
    })
}

function actualizarSubactividad()
{
    let id_subactividad = $("#id_subactividad_update").val();
    let orden = $("#orden_subactividad").val();
    let descripcion = $("#de_subactividad").val();
    let form_registro = new FormData;
    form_registro.append('orden', orden);
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_subactividad', id_subactividad);
    form_registro.append('action', 'actualizar');

    fetch(url_subactividad, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success',`${capitalize_label_subactividad} actualizada correctamente!`);
            $(modal_subactividad).modal("hide");
            obtenerTablaSubactividad();
        }
        else
            $.notification.show('error',`Error al actualizar el ${label_subactividad}!`);
    })
}

function eliminarSubactividad(id_subactividad)
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
                obtenerTablaSubactividad();
            }
            else
                $.notification.show('error',`Error al eliminar la ${label_subactividad}!`);
        })
    }
}
$(modal_subactividad).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_subactividad").val('');
    $("#orden_subactividad").val('');
});
*/
$(document).ready(function() {
    obtenerAcordeon();
} );