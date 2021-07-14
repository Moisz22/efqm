function agregar()
{
    let descripcion = $("#de_cargo").val();
    let jefe_cargo = '';

    jefe_cargo = (document.getElementById('jefe_cargo').checked) ? 1 : 0;
        
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('jefe_cargo', jefe_cargo);
    form_registro.append('action', 'guardar');

    fetch('../models/CargoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Cargo creado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al crear el cargo!');
    })
}

function getData(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_cargo', id);
    form_registro.append('action', 'find');

    fetch('../models/CargoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_cargo_update").val(res[0].id_cargo);
            $("#de_cargo").val(res[0].descripcion_cargo);
            validacion = (res[0].jefe_cargo==1) ? true : false;
            $("#jefe_cargo").prop('checked', validacion); 
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default").modal("show");
    })
}

function actualizar()
{
    let id_cargo = $("#id_cargo_update").val();
    let descripcion = $("#de_cargo").val();
    jefe_cargo = (document.getElementById('jefe_cargo').checked) ? 1 : 0;
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_cargo', id_cargo);
    form_registro.append('action', 'actualizar');
    form_registro.append('jefe_cargo', jefe_cargo);

    fetch('../models/CargoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Cargo actualizado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al actualizar el cargo!');
    })
}

function eliminar(id_cargo)
{
    var conf = confirm("Desea eliminar este cargo?");
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_cargo', id_cargo);
        form_registro.append('action', 'eliminar');

        fetch('../models/CargoModel.php', {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success','Cargo eliminado correctamente!');
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error','Error al eliminar el cargo!');
        })
    }
}

$("#modal-default").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_cargo").val('');
    $("#jefe_cargo").prop('checked', false); 
});