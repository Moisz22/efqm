let url = '../models/VersionModel.php'

function agregar()
{
    let descripcion = $("#de_version").val();
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
            $.notification.show('success','Versión creado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al crear el versión!');
    })
}

function getData(id)
{
    let form_registro = new FormData;
    form_registro.append('id_version', id);
    form_registro.append('action', 'find');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_version_update").val(res[0].id_version);
            $("#de_version").val(res[0].descripcion_version);
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default").modal("show");
    })
}

function actualizar()
{
    let id_version = $("#id_version_update").val();
    let descripcion = $("#de_version").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_version', id_version);
    form_registro.append('action', 'actualizar');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Versión actualizado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al actualizar el versión!');
    })
}

function eliminar(id_version)
{
    let conf = confirm("Desea eliminar este versión?");
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_version', id_version);
        form_registro.append('action', 'eliminar');

        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success','Versión eliminada correctamente!');
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error','Error al eliminar la versión!');
        })
    }
}

$("#modal-default").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_version").val('');
});