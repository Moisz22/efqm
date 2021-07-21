let label_actividad = 'actividad'
let modal_actividad = '#modal-default-actividad'
let url_actividad = '../controllers/ActividadController.php'
let capitalize_label_actividad = label_actividad.charAt(0).toUpperCase() + label_actividad.slice(1)
const cargaCombo = [...document.querySelectorAll('.cbx_actividad')]

function obtenerTablaActividad() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_actividad, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_actividades").html(res);
    })
}

function llenarComboActividad() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'llenarComboActividad');

    fetch(url_actividad, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        cargaCombo.map( e=> e.innerHTML = res)
    })
}
function agregarActividad()
{


    let orden_actividad = document.getElementById('orden_actividad')
    let de_actividad = document.getElementById('de_actividad')
    let id_proceso = $("#id_proceso")
    let bandera = true

    function validarCampos(elementos) {
        
        const span = document.createElement('span')
        span.textContent = 'la entrada no puede estar vacia'
        span.classList.add('help-block');

        [...elementos].map( e => {
    
            if(e.value.trim() == null || e.value.trim() == ''){
                //$("#spam_orden_actividad").css('display', 'block');
                bandera = false
                e.parentElement.classList.add('has-error')
                e.insertAdjacentElement('afterend', span)
            }
    
        })

        return bandera
    
    }

    validarCampos([orden_actividad, de_actividad])
    /* let orden_actividad = $("#orden_actividad").val();
    let de_actividad = $("#de_actividad").val();
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('orden_actividad', orden_actividad);
    form_registro.append('de_actividad', de_actividad);
    form_registro.append('action', 'guardar');

    fetch(url_actividad, {
        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success',`${capitalize_label_actividad} creada correctamente!`);
            $(modal_actividad).modal("hide");
            obtenerTablaActividad();
            llenarComboActividad();
            obtenerAcordeon();
        }
        else
            $.notification.show('error',`Error al crear la ${res}!`);
    }) */
}

function getDataActividad(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_actividad', id);
    form_registro.append('action', 'find');

    fetch(url_actividad, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_actividad_update").val(res[0].id_actividad);
            $("#orden_actividad").val(res[0].orden_actividad);
            $("#de_actividad").val(res[0].descripcion_actividad);
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $(modal_actividad).modal("show");
    })
}

function actualizarActividad()
{
    let id_actividad = $("#id_actividad_update").val();
    let orden = $("#orden_actividad").val();
    let descripcion = $("#de_actividad").val();
    let form_registro = new FormData;
    form_registro.append('orden', orden);
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_actividad', id_actividad);
    form_registro.append('action', 'actualizar');

    fetch(url_actividad, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success',`${capitalize_label_actividad} actualizada correctamente!`);
            $(modal_actividad).modal("hide");
            obtenerTablaActividad();
        }
        else
            $.notification.show('error',`Error al actualizar el ${label_actividad}!`);
    })
}

function eliminarActividad(id_actividad)
{
    let conf = confirm(`Desea eliminar esta ${label_actividad}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_actividad', id_actividad);
        form_registro.append('action', 'eliminar');

        fetch(url_actividad, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_actividad} eliminada correctamente!`);
                $(modal_actividad).modal("hide");
                obtenerTablaActividad();
            }
            else
                $.notification.show('error',`Error al eliminar la ${label_actividad}!`);
        })
    }
}
$(modal_actividad).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_actividad").val('');
    $("#orden_actividad").val('');

    document.getElementById('de_actividad').parentElement.classList.remove('has-error', 'has-success')

});

$(document).ready(function() {
    obtenerTablaActividad();
    llenarComboActividad();
} );