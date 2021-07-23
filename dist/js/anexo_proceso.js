let label_anexo_proceso = 'Anexo'
let modal_anexo_proceso = '#modal-default-anexo-proceso'
let url_anexo_proceso = '../controllers/AnexoProcesoController.php'
let capitalize_label_anexo_proceso = label_anexo_proceso.charAt(0).toUpperCase() + label_anexo_proceso.slice(1)

function obtenerTablaAnexoProceso() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_anexo_proceso, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_anexo_proceso").html(res);
    })
}

function agregarAnexoProceso()
{
    let tipo_documento_anexo = document.getElementById("tipo_documento_anexo");
    let descripcion_anexo_proceso = document.getElementById("descripcion_anexo_proceso");
    let id_actividad_anexo_proceso = document.getElementById("id_actividad_anexo_proceso");
    let anexo = document.getElementById("anexo");
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('tipo_documento_anexo', tipo_documento_anexo.value);
    form_registro.append('descripcion_anexo_proceso', descripcion_anexo_proceso.value);
    form_registro.append('id_actividad_anexo_proceso', id_actividad_anexo_proceso.value);
    form_registro.append('anexo_proceso', anexo.files[0]);
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([tipo_documento_anexo, descripcion_anexo_proceso, id_actividad_anexo_proceso, anexo]);
    if(validacion==true)
    {
        fetch(url_anexo_proceso, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_anexo_proceso} subido correctamente!`);
                tipo_documento_anexo.value = '';
                descripcion_anexo_proceso.value = '';
                id_actividad_anexo_proceso.value = '';
                anexo.value = '';
                obtenerTablaAnexoProceso();
            }
            else
                $.notification.show('error',`Error al subir el ${capitalize_label_anexo_proceso}!`);
        })
    }
}

function getDataAnexoProceso(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_anexo_proceso', id);
    form_registro.append('action', 'find');

    fetch(url_anexo_proceso, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_anexo_proceso_update").val(res[0].id_anexo_proceso);
            $("#tipo_documento_anexo_update").val(res[0].id_tipo_documento);
            $("#id_actividad_anexo_update").val(res[0].id_actividad);
            $("#descripcion_anexo_proceso_update").val(res[0].descripcion_anexo_proceso);
            $(modal_anexo_proceso).modal("show");
    })
}

function actualizarAnexoProceso()
{
    let tipo_documento_anexo_update = document.getElementById("tipo_documento_anexo_update");
    let id_actividad_anexo_update = document.getElementById("id_actividad_anexo_update");
    let descripcion_anexo_proceso_update = document.getElementById("descripcion_anexo_proceso_update");
    let id_anexo_proceso_update = $("#id_anexo_proceso_update").val();
    let form_registro = new FormData;
    form_registro.append('id_anexo_proceso_update', id_anexo_proceso_update);
    form_registro.append('tipo_documento_anexo_update', tipo_documento_anexo_update.value)
    form_registro.append('id_actividad_anexo_update', id_actividad_anexo_update.value);
    form_registro.append('descripcion_anexo_proceso_update', descripcion_anexo_proceso_update.value);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([tipo_documento_anexo_update, id_actividad_anexo_update, descripcion_anexo_proceso_update]);
    if(validacion==true)
    {
        fetch(url_anexo_proceso, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_anexo_proceso} subido correctamente!`);
                $(modal_anexo_proceso).modal("hide");
                obtenerTablaAnexoProceso();
            }
            else
                $.notification.show('error',`Error al cargar el ${label_anexo_proceso}!`);
        })
    }
}

function eliminarAnexoProceso(id_anexo_proceso)
{
    let conf = confirm(`Desea eliminar este ${label_anexo_proceso}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_anexo_proceso', id_anexo_proceso);
        form_registro.append('action', 'eliminar');

        fetch(url_anexo_proceso, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_anexo_proceso} eliminado correctamente!`);
                $(modal_anexo_proceso).modal("hide");
                obtenerTablaAnexoProceso();
            }
            else
                $.notification.show('error',`Error al eliminar el ${label_anexo_proceso}!`);
        })
    }
}
$(modal_anexo_proceso).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregarAnexoProceso').style.display = 'block';
    document.getElementById('leyendaEditarAnexoProceso').style.display = 'none';
    document.getElementById('buttonGuardarAnexoProceso').style.display = 'block';
    document.getElementById('buttonActualizarAnexoProceso').style.display = 'none';
    $("#id_anexo_proceso_update").val('');
    $("#id_actividad_anexo_proceso").val('');
    $("#descripcion_anexo_proceso").val('');

    quitarErrorValidacion()
});

$(document).ready(function() {
    obtenerTablaAnexoProceso();
} );