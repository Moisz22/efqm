let label_salida = 'salida'
let modal_salida = '#modal-default-salida'
let url_salida = '../controllers/SalidaController.php'
let capitalize_label_salida = label_salida.charAt(0).toUpperCase() + label_salida.slice(1)

function obtenerTablaSalida() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_salida, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_salidas").html(res);
    })
}

function agregarSalida()
{
    let descripcion_salida = document.getElementById('descripcion_salida')
    let id_proceso = document.getElementById('id_proceso')
    let id_actividad = document.getElementById('id_actividad_salida')
    let form_registro = new FormData;
    form_registro.append('id_actividad', id_actividad.value);
    form_registro.append('id_proceso', id_proceso.value);
    form_registro.append('descripcion_salida', descripcion_salida.value);
    form_registro.append('action', 'guardar');

    let validacion = validarCampos([descripcion_salida, id_actividad])

    if(validacion == true){

        fetch(url_salida, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_salida} creada correctamente!`);
                $(modal_salida).modal("hide");
                obtenerTablaSalida();
            }
            else
                $.notification.show('error',`Error al crear la ${res}!`);
        })

    }

}

function getDataSalida(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_salida', id);
    form_registro.append('action', 'find');

    fetch(url_salida, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_salida_update").val(res[0].id_salida);
            $("#id_actividad_salida").val(res[0].id_actividad);
            $("#descripcion_salida").val(res[0].descripcion_salida);
            document.getElementById('leyendaAgregarSalida').style.display = 'none';
            document.getElementById('leyendaEditarSalida').style.display = 'block';
            document.getElementById('buttonGuardarSalida').style.display = 'none';
            document.getElementById('buttonActualizarSalida').style.display = 'block';
            $(modal_salida).modal("show");
    })
}

function actualizarSalida()
{
    let id_salida = document.getElementById('id_salida_update')
    let id_actividad_salida = document.getElementById('id_actividad_salida')
    let descripcion_salida = document.getElementById('descripcion_salida')
    let form_registro = new FormData;
    form_registro.append('id_salida', id_salida.value);
    form_registro.append('id_actividad_salida', id_actividad_salida.value);
    form_registro.append('descripcion_salida', descripcion_salida.value);
    form_registro.append('action', 'actualizar');

    let validacion = validarCampos([id_salida,id_actividad_salida,descripcion_salida])

    if(validacion == true){

        fetch(url_salida, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_salida} actualizada correctamente!`);
                $(modal_salida).modal("hide");
                obtenerTablaSalida();
            }
            else
                $.notification.show('error',`Error al actualizar el ${label_salida}!`);
        })

    }
}

function eliminarSalida(id_salida)
{
    let conf = confirm(`Desea eliminar esta ${label_salida}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_salida', id_salida);
        form_registro.append('action', 'eliminar');

        fetch(url_salida, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_salida} eliminada correctamente!`);
                $(modal_salida).modal("hide");
                obtenerTablaSalida();
            }
            else
                $.notification.show('error',`Error al eliminar la ${label_salida}!`);
        })
    }
}
$(modal_salida).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregarSalida').style.display = 'block';
    document.getElementById('leyendaEditarSalida').style.display = 'none';
    document.getElementById('buttonGuardarSalida').style.display = 'block';
    document.getElementById('buttonActualizarSalida').style.display = 'none';
    $("#id_salida_update").val('');
    $("#id_actividad_salida").val('');
    $("#descripcion_salida").val('');
    quitarErrorValidacion()
});

$(document).ready(function() {
    obtenerTablaSalida();
} );