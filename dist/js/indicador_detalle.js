let label_indicador_detalle = 'detalle'
let modal_indicador_detalle = '#modal-default-indicador-detalle'
let url_indicador_detalle = '../controllers/IndicadorDetalleController.php'
let capitalize_label_indicador_detalle = label_indicador_detalle.charAt(0).toUpperCase() + label_indicador_detalle.slice(1)

function obtenerTablaIndicadorDetalle() 
{
    let id_indicador = $("#id_indicador").val();
    let form_registro = new FormData;
    form_registro.append('id_indicador', id_indicador);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_indicador_detalle, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_indicador_detalles").html(res);
    })
}

function agregarIndicadorDetalle()
{
    let anio_detalle = document.getElementById("anio_detalle");
    let resultado_detalle = document.getElementById("resultado_detalle");
    let meta_detalle = document.getElementById("meta_detalle");
    let id_indicador = $("#id_indicador").val();
    let flag_codefe = '';
    flag_codefe = (document.getElementById('flag_codefe').checked) ? 1 : 0;
    let form_registro = new FormData;
    form_registro.append('anio_detalle', anio_detalle.value);
    form_registro.append('id_indicador', id_indicador);
    form_registro.append('resultado_detalle', resultado_detalle.value);
    form_registro.append('meta_detalle', meta_detalle.value);
    form_registro.append('flag_codefe', flag_codefe);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([anio_detalle, resultado_detalle, meta_detalle]);
    if(validacion==true)
    {
        fetch(url_indicador_detalle, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_indicador_detalle} creada correctamente!`);
                $(modal_indicador_detalle).modal("hide");
                obtenerTablaIndicadorDetalle();
            }
            else
                $.notification.show('error',`Error al crear la ${res}!`);
        })
    }
}

function getDataIndicadorDetalle(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_indicador_detalle', id);
    form_registro.append('action', 'find');

    fetch(url_indicador_detalle, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_detalle_update").val(res[0].id_indicador_detalle);
            $("#anio_detalle").val(res[0].anio_detalle);
            $("#resultado_detalle").val(res[0].resultado_detalle);
            $("#meta_detalle").val(res[0].meta_detalle);
            validacion = (res[0].flag_codefe==1) ? true : false;
            $("#flag_codefe").prop('checked', validacion); 
            document.getElementById('leyendaAgregarIndicadorDetalle').style.display = 'none';
            document.getElementById('leyendaEditarIndicadorDetalle').style.display = 'block';
            document.getElementById('buttonGuardarIndicadorDetalle').style.display = 'none';
            document.getElementById('buttonActualizarIndicadorDetalle').style.display = 'block';
            $(modal_indicador_detalle).modal("show");
    })
}

function actualizarIndicadorDetalle()
{
    let anio_detalle = document.getElementById("anio_detalle");
    let resultado_detalle = document.getElementById("resultado_detalle");
    let meta_detalle = document.getElementById("meta_detalle");
    let flag_codefe = '';
    flag_codefe = (document.getElementById('flag_codefe').checked) ? 1 : 0;
    let id_detalle_update = $("#id_detalle_update").val();
    let form_registro = new FormData;
    form_registro.append('id_detalle_update', id_detalle_update);
    form_registro.append('anio_detalle', anio_detalle.value);
    form_registro.append('id_indicador', id_indicador);
    form_registro.append('resultado_detalle', resultado_detalle.value);
    form_registro.append('meta_detalle', meta_detalle.value);
    form_registro.append('flag_codefe', flag_codefe);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([anio_detalle, resultado_detalle, meta_detalle]);
if(validacion==true)
    {
        fetch(url_indicador_detalle, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_indicador_detalle} actualizada correctamente!`);
                $(modal_indicador_detalle).modal("hide");
                obtenerTablaIndicadorDetalle();
            }
            else
                $.notification.show('error',`Error al actualizar la ${label_indicador_detalle}!`);
        })
    }
}

function eliminarIndicadorDetalle(id_indicador_detalle)
{
    let conf = confirm(`Desea eliminar esta ${label_indicador_detalle}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_indicador_detalle', id_indicador_detalle);
        form_registro.append('action', 'eliminar');

        fetch(url_indicador_detalle, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_indicador_detalle} eliminado correctamente!`);
                $(modal_indicador_detalle).modal("hide");
                obtenerTablaIndicadorDetalle();
            }
            else
                $.notification.show('error',`Error al eliminar el ${label_indicador_detalle}!`);
        })
    }
}
$(modal_indicador_detalle).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregarIndicadorDetalle').style.display = 'block';
    document.getElementById('leyendaEditarIndicadorDetalle').style.display = 'none';
    document.getElementById('buttonGuardarIndicadorDetalle').style.display = 'block';
    document.getElementById('buttonActualizarIndicadorDetalle').style.display = 'none';
    $("#anio_detalle").val('');
    $("#resultado_detalle").val('');
    $("#meta_detalle").val('');
    $("#flag_codefe").prop('checked', false);
    quitarErrorValidacion()
});

$(document).ready(function() {
    obtenerTablaIndicadorDetalle();
} );