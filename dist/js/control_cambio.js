let label_control_cambio = 'control de cambios'
let modal_control_cambio = '#modal-default-control-cambio'
let url_control_cambio = '../controllers/ControlCambioController.php'
let capitalize_label_control_cambio = label_control_cambio.charAt(0).toUpperCase() + label_control_cambio.slice(1)

function obtenerTablaControlCambio() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_control_cambio, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_control_cambio").html(res);
    })
}

/* function llenarComboControlCambio() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'llenarComboControlCambio');

    fetch(url_control_cambio, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        cargaComboVersion.map( e=> e.innerHTML = res)
    })
} */
 function agregarControlCambio()
{
    let id_version = document.getElementById('id_control_cambio_version')
    let de_control_cambio = document.getElementById("de_control_cambio");
    let id_proceso = $("#id_proceso");
    
    let validacion = validarCampos([de_control_cambio, id_version]);
    
    if(validacion==true)
    {
        let form_registro = new FormData;
        form_registro.append('id_proceso', id_proceso.val());
        form_registro.append('id_version', id_version.value);
        form_registro.append('de_control_cambio', de_control_cambio.value);
        form_registro.append('action', 'guardar');

        fetch(url_control_cambio, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_control_cambio} creado correctamente!`);
                $(modal_control_cambio).modal("hide");
                obtenerTablaControlCambio();
            }
            else
                $.notification.show('error',`Error al crear el ${res}!`);
        })
        } 
}

function getDataControlCambio(id)
{
    let form_registro = new FormData;
    form_registro.append('id_control_cambio', id);
    form_registro.append('action', 'find');

    fetch(url_control_cambio, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
        $("#id_control_cambio_update").val(res[0].id_control_cambio);
        $("#id_control_cambio_version").val(res[0].id_version);
        $("#de_control_cambio").val(res[0].descripcion_control_cambio);
        document.getElementById('leyendaAgregarControlCambio').style.display = 'none';
        document.getElementById('leyendaEditarControlCambio').style.display = 'block';
        document.getElementById('buttonGuardarControlCambio').style.display = 'none';
        document.getElementById('buttonActualizarControlCambio').style.display = 'block';
        $(modal_control_cambio).modal("show");
    })
}


function actualizarControlCambio()
{
    let id_control_cambio = $("#id_control_cambio_update").val();
    let id_version = document.getElementById('id_control_cambio_version')
    let de_control_cambio = document.getElementById("de_control_cambio");
    let form_registro = new FormData;
    form_registro.append('id_control_cambio', id_control_cambio);
    form_registro.append('de_control_cambio', de_control_cambio.value);
    form_registro.append('id_version', id_version.value);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([id_version, de_control_cambio]);
    if(validacion==true)
    {
        fetch(url_control_cambio, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_control_cambio} actualizado correctamente!`);
                $(modal_control_cambio).modal("hide");
                obtenerTablaControlCambio();
            }
            else
                $.notification.show('error',`Error al actualizar el ${res}!`);
        })
    }
}

function eliminarControlCambio(id_control_cambio)
{
    let conf = confirm(`Desea eliminar este ${label_control_cambio}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_control_cambio', id_control_cambio);
        form_registro.append('action', 'eliminar');

        fetch(url_control_cambio, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_control_cambio} eliminado correctamente!`);
                $(modal_actividad).modal("hide");
                obtenerTablaControlCambio();
            }
            else
                $.notification.show('error',`Error al eliminar el ${capitalize_label_control_cambio}!`);
        })
    }
} 

$(modal_control_cambio).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregarControlCambio').style.display = 'block';
    document.getElementById('leyendaEditarControlCambio').style.display = 'none';
    document.getElementById('buttonGuardarControlCambio').style.display = 'block';
    document.getElementById('buttonActualizarControlCambio').style.display = 'none';
    /* $("#de_actividad").val('');
    $("#orden_actividad").val(''); */

    let elementos = [...document.querySelectorAll('.campo_vacio')]
    elementos.map( e => e.classList.remove('campo_vacio') )

}); 

$(document).ready(function() {
    obtenerTablaControlCambio();
    /* llenarComboControlCambio(); */
} );