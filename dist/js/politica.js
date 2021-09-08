let label_politica = 'politica'
let modal_politica = '#modal-default-politica'
let url_politica = '../controllers/PoliticaController.php'
let capitalize_label_politica = label_politica.charAt(0).toUpperCase() + label_politica.slice(1)

function obtenerTablaPolitica() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_politica, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_politicas").html(res);
    })
}

function agregarPolitica()
{
    let descripcion_politica = document.getElementById("descripcion_politica");
    let orden_politica = document.getElementById("orden_politica");
    let id_actividad_politica = document.getElementById("id_actividad_politica");
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_actividad_politica', id_actividad_politica.value);
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('descripcion_politica', descripcion_politica.value);
    form_registro.append('orden_politica', orden_politica.value);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([orden_politica, id_actividad_politica, descripcion_politica]);
    if(validacion==true)
    {
        fetch(url_politica, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_politica} creada correctamente!`);
                $(modal_politica).modal("hide");
                obtenerTablaPolitica();
            }
            else
                $.notification.show('error',`Error al crear la ${res}!`);
        })
    }
}

function getDataPolitica(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_politica', id);
    form_registro.append('action', 'find');

    fetch(url_politica, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_politica_update").val(res[0].id_politica);
            $("#orden_politica").val(res[0].orden_politica);
            $("#id_actividad_politica").val(res[0].id_actividad);
            $("#descripcion_politica").val(res[0].descripcion_politica);
            document.getElementById('leyendaAgregarPolitica').style.display = 'none';
            document.getElementById('leyendaEditarPolitica').style.display = 'block';
            document.getElementById('buttonGuardarPolitica').style.display = 'none';
            document.getElementById('buttonActualizarPolitica').style.display = 'block';
            $(modal_politica).modal("show");
    })
}

function actualizarPolitica()
{
    let descripcion_politica = document.getElementById("descripcion_politica");
    let orden_politica = document.getElementById("orden_politica");
    let id_actividad_politica = document.getElementById("id_actividad_politica");
    let id_politica_update = $("#id_politica_update").val();
    let form_registro = new FormData;
    form_registro.append('id_politica', id_politica_update);
    form_registro.append('id_actividad_politica', id_actividad_politica.value)
    form_registro.append('descripcion_politica', descripcion_politica.value);
    form_registro.append('orden_politica', orden_politica.value);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([orden_politica, id_actividad_politica, descripcion_politica]);
    if(validacion==true)
    {
        fetch(url_politica, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_politica} actualizada correctamente!`);
                $(modal_politica).modal("hide");
                obtenerTablaPolitica();
            }
            else
                $.notification.show('error',`Error al actualizar la ${label_politica}!`);
        })
    }
}

function eliminarPolitica(id_politica)
{
    let conf = confirm(`Desea eliminar esta ${label_politica}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_politica', id_politica);
        form_registro.append('action', 'eliminar');

        fetch(url_politica, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_politica} eliminada correctamente!`);
                $(modal_politica).modal("hide");
                obtenerTablaPolitica();
            }
            else
                $.notification.show('error',`Error al eliminar la ${label_politica}!`);
        })
    }
}
$(modal_politica).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregarPolitica').style.display = 'block';
    document.getElementById('leyendaEditarPolitica').style.display = 'none';
    document.getElementById('buttonGuardarPolitica').style.display = 'block';
    document.getElementById('buttonActualizarPolitica').style.display = 'none';
    $("#orden_politica").val('');
    $("#id_politica_update").val('');
    $("#id_actividad_politica").val('');
    $("#descripcion_politica").val('');

    quitarErrorValidacion()
});

$(document).ready(function() {
    obtenerTablaPolitica();
} );