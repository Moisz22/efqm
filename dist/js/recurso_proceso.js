let label_recurso_proceso = 'Recurso'
let modal_recurso_proceso = '#modal-default-recurso-proceso'
let url_recurso_proceso = '../controllers/RecursoProcesoController.php'
let capitalize_label_recurso_proceso = label_recurso_proceso.charAt(0).toUpperCase() + label_recurso_proceso.slice(1)

function obtenerTablaRecursoProceso() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_recurso_proceso, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_recursos").html(res);
    })
}

function agregarRecursoProceso()
{
    let id_actividad_recurso_proceso = document.getElementById("id_actividad_recurso_proceso");
    let id_recurso = document.getElementById("id_recurso");
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_actividad_recurso_proceso', id_actividad_recurso_proceso.value);
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('id_recurso', id_recurso.value);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([id_actividad_recurso_proceso, id_recurso]);
    if(validacion==true)
    {
        fetch(url_recurso_proceso, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_recurso_proceso} creado correctamente!`);
                $(modal_recurso_proceso).modal("hide");
                obtenerTablaRecursoProceso();
            }
            else
                $.notification.show('error',`Error al crear el ${capitalize_label_recurso_proceso}!`);
        })
    }
}

function getDataRecursoProceso(id)
{
    let form_registro = new FormData;
    form_registro.append('id_recurso_proceso', id);
    form_registro.append('action', 'find');

    fetch(url_recurso_proceso, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_recurso_proceso_update").val(res[0].id_recurso_proceso);
            $("#id_actividad_recurso_proceso").val(res[0].id_actividad);
            $("#id_recurso").val(res[0].id_recurso);
            document.getElementById('leyendaAgregarRecursoProceso').style.display = 'none';
            document.getElementById('leyendaEditarRecursoProceso').style.display = 'block';
            document.getElementById('buttonGuardarRecursoProceso').style.display = 'none';
            document.getElementById('buttonActualizarRecursoProceso').style.display = 'block';
            $(modal_recurso_proceso).modal("show");
    })
}

function actualizarRecursoProceso()
{
    let id_actividad_recurso_proceso = document.getElementById("id_actividad_recurso_proceso");
    let id_recurso = document.getElementById("id_recurso");
    let id_recurso_proceso_update = $("#id_recurso_proceso_update").val();
    let form_registro = new FormData;
    form_registro.append('id_recurso_proceso', id_recurso_proceso_update);
    form_registro.append('id_actividad_recurso_proceso', id_actividad_recurso_proceso.value)
    form_registro.append('id_recurso', id_recurso.value);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([id_actividad_recurso_proceso, id_recurso]);
    if(validacion==true)
    {
        fetch(url_recurso_proceso, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_recurso_proceso} actualizada correctamente!`);
                $(modal_recurso_proceso).modal("hide");
                obtenerTablaRecursoProceso();
            }
            else
                $.notification.show('error',`Error al actualizar la ${label_recurso_proceso}!`);
        })
    }
}

function eliminarRecursoProceso(id_recurso_proceso)
{
    let conf = confirm(`Desea eliminar este ${label_recurso_proceso}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_recurso_proceso', id_recurso_proceso);
        form_registro.append('action', 'eliminar');

        fetch(url_recurso_proceso, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_recurso_proceso} eliminada correctamente!`);
                $(modal_recurso_proceso).modal("hide");
                obtenerTablaRecursoProceso();
            }
            else
                $.notification.show('error',`Error al eliminarel ${label_recurso_proceso}!`);
        })
    }
}
$(modal_recurso_proceso).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregarRecursoProceso').style.display = 'block';
    document.getElementById('leyendaEditarRecursoProceso').style.display = 'none';
    document.getElementById('buttonGuardarRecursoProceso').style.display = 'block';
    document.getElementById('buttonActualizarRecursoProceso').style.display = 'none';
    $("#id_actividad_recurso_proceso").val('');
    $("#id_recurso").val('');

    quitarErrorValidacion()
});

$(document).ready(function() {
    obtenerTablaRecursoProceso();
} );