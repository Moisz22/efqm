let url = '../controllers/TipoProcesoController.php'
let label = 'tipo de proceso'
let capitalize_label = label.charAt(0).toUpperCase() + label.slice(1)

function agregar()
{
    let descripcion = document.getElementById('de_tipo_proceso');
    let abreviatura = document.getElementById('abreviatura_tipo_proceso');
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion.value);
    form_registro.append('abreviatura', abreviatura.value);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([descripcion, abreviatura]);
    if(validacion==true)
    {
        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} creado correctamente!`);
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al crear el ${label}!`);
        })
    }
}

function getData(id)
{
    let form_registro = new FormData;
    form_registro.append('id_tipo_proceso', id);
    form_registro.append('action', 'find');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_tipo_proceso_update").val(res[0].id_tipo_proceso);
            $("#de_tipo_proceso").val(res[0].descripcion_tipo_proceso);
            $("#abreviatura_tipo_proceso").val(res[0].abreviatura_tipo_proceso);
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default").modal("show");
    })
}

function actualizar()
{
    let id_tipo_proceso = $("#id_tipo_proceso_update").val();
    let descripcion = document.getElementById('de_tipo_proceso');
    let abreviatura = document.getElementById('abreviatura_tipo_proceso');
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion.value);
    form_registro.append('id_tipo_proceso', id_tipo_proceso);
    form_registro.append('abreviatura', abreviatura.value);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([descripcion, abreviatura]);
    if(validacion==true)
    {
        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} actualizado correctamente!`);
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al actualizar el ${label}`);
        })
    }
}

function eliminar(id_tipo_proceso)
{
    let conf = confirm(`Desea eliminar este ${label}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_tipo_proceso', id_tipo_proceso);
        form_registro.append('action', 'eliminar');

        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} eliminado correctamente!`);
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al eliminar el ${label}!`);
        })
    }
}

$("#modal-default").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_tipo_proceso").val('');
    $("#abreviatura_tipo_proceso").val('');
    quitarErrorValidacion()
});