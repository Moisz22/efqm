let url = '../controllers/FrecuenciaController.php'
let label = 'frecuencia';
let capitalize_label = label.charAt(0).toUpperCase() + label.slice(1)

function agregar()
{
    let descripcion = document.getElementById('de_frecuencia');
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion.value);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([descripcion]);
    if(validacion==true)
    {
        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} creada correctamente!`);
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al crear la ${label}!`);
        })
    }
}

function getData(id)
{
    let form_registro = new FormData;
    form_registro.append('id_frecuencia', id);
    form_registro.append('action', 'find');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_frecuencia_update").val(res[0].id_frecuencia);
            $("#de_frecuencia").val(res[0].descripcion_frecuencia);
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default").modal("show");
    })
}

function actualizar()
{
    let id_frecuencia = $("#id_frecuencia_update").val();
    let descripcion = document.getElementById('de_frecuencia');
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion.value);
    form_registro.append('id_frecuencia', id_frecuencia);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([descripcion]);
    if(validacion==true)
    {
        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} actualizada correctamente!`);
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al actualizar la ${label}!`);
        })
    }
}

function eliminar(id_frecuencia)
{
    let conf = confirm(`Desea eliminar esta ${label}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_frecuencia', id_frecuencia);
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
                $.notification.show('error',`Error al eliminar la ${label}!`);
        })
    }
}

$("#modal-default").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_frecuencia").val('');
    quitarErrorValidacion();

});