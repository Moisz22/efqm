let url = '../models/FrecuenciaModel.php'

function agregar()
{
    let descripcion = $("#de_frecuencia").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('action', 'guardar');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Frecuencia creada correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al crear la frecuencia!');
    })
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
    let descripcion = $("#de_frecuencia").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_frecuencia', id_frecuencia);
    form_registro.append('action', 'actualizar');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Frecuencia actualizada correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al actualizar la frecuencia!');
    })
}

function eliminar(id_frecuencia)
{
    let conf = confirm("Desea eliminar esta frecuencia?");
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_frecuencia', id_frecuencia);
        form_registro.append('action', 'eliminar');

        fetch('../models/FrecuenciaModel.php', {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success','Frecuencia eliminado correctamente!');
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error','Error al eliminar la frecuencia!');
        })
    }
}

$("#modal-default").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_frecuencia").val('');
});