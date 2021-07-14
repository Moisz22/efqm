function agregar()
{
    let descripcion = $("#de_tipo_documento").val();
    let abreviatura = $("#abreviatura_tipo_documento").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('abreviatura', abreviatura);
    form_registro.append('action', 'guardar');

    fetch('../models/TipoDocumentoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Tipo de documento creado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al crear el tipo de documento!');
    })
}

function getData(id)
{
    let form_registro = new FormData;
    form_registro.append('id_tipo_documento', id);
    form_registro.append('action', 'find');

    fetch('../models/TipoDocumentoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_tipo_documento_update").val(res[0].id_tipo_documento);
            $("#de_tipo_documento").val(res[0].descripcion_tipo_documento);
            $("#abreviatura_tipo_documento").val(res[0].abreviatura_tipo_documento);
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default").modal("show");
    })
}

function actualizar()
{
    let id_tipo_documento = $("#id_tipo_documento_update").val();
    let descripcion = $("#de_tipo_documento").val();
    let abreviatura = $("#abreviatura_tipo_documento").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_tipo_documento', id_tipo_documento);
    form_registro.append('abreviatura', abreviatura);
    form_registro.append('action', 'actualizar');

    fetch('../models/TipoDocumentoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Tipo de documento actualizado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al actualizar el tipo de documento!'+res);
    })
}

function eliminar(id_tipo_documento)
{
    var conf = confirm("Desea eliminar este tipo de proceso?");
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_tipo_documento', id_tipo_documento);
        form_registro.append('action', 'eliminar');

        fetch('../models/TipoDocumentoModel.php', {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success','Tipo de documento eliminado correctamente!');
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error','Error al eliminar el tipo de documento!');
        })
    }
}

$("#modal-default").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_tipo_documento").val('');
    $("#abreviatura_tipo_documento").val('');
});