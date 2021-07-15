let url = '../models/TipoProcesoModel.php'

function agregar()
{
    let descripcion = $("#de_tipo_proceso").val();
    let abreviatura = $("#abreviatura_tipo_proceso").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('abreviatura', abreviatura);
    form_registro.append('action', 'guardar');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Tipo de proceso creado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al crear el tipo de proceso!');
    })
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
    let descripcion = $("#de_tipo_proceso").val();
    let abreviatura = $("#abreviatura_tipo_proceso").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_tipo_proceso', id_tipo_proceso);
    form_registro.append('abreviatura', abreviatura);
    form_registro.append('action', 'actualizar');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Tipo de proceso actualizado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al actualizar el tipo de proceso!'+res);
    })
}

function eliminar(id_tipo_proceso)
{
    let conf = confirm("Desea eliminar este tipo de proceso?");
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
                $.notification.show('success','Tipo de proceso eliminado correctamente!');
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error','Error al eliminar el tipo de proceso!');
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
});