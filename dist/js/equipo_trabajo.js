function agregar()
{
    let descripcion = $("#de_equipo_trabajo").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('action', 'guardar');

    fetch('../models/EquipoTrabajoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','equipo de trabajo creado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al crear el equipo de trabajo!');
    })
}

function getData(id)
{
    let form_registro = new FormData;
    form_registro.append('id_equipo_trabajo', id);
    form_registro.append('action', 'find');

    fetch('../models/EquipoTrabajoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_equipo_trabajo_update").val(res[0].id_equipo_trabajo);
            $("#de_equipo_trabajo").val(res[0].descripcion_equipo_trabajo);
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default").modal("show");
    })
}

function actualizar()
{
    let id_equipo_trabajo = $("#id_equipo_trabajo_update").val();
    let descripcion = $("#de_equipo_trabajo").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_equipo_trabajo', id_equipo_trabajo);
    form_registro.append('action', 'actualizar');

    fetch('../models/EquipoTrabajoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','equipo de trabajo actualizada correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al actualizar la equipo_trabajo!');
    })
}

function eliminar(id_equipo_trabajo)
{
    let conf = confirm("Desea eliminar esta equipo de trabajo?");
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_equipo_trabajo', id_equipo_trabajo);
        form_registro.append('action', 'eliminar');

        fetch('../models/EquipoTrabajoModel.php', {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success','equipo de trabajo eliminado correctamente!');
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error','Error al eliminar el equipo de trabajo!');
        })
    }
}

$("#modal-default").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_equipo_trabajo").val('');
});