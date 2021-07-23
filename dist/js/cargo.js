let url = '../controllers/CargoController.php'
let label = 'cargo'
let capitalize_label = label.charAt(0).toUpperCase() + label.slice(1)

function agregar()
{
    let descripcion = document.getElementById('de_cargo');
    let jefe_cargo = '';
    jefe_cargo = (document.getElementById('jefe_cargo').checked) ? 1 : 0;
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion.value);
    form_registro.append('jefe_cargo', jefe_cargo);
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
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_cargo', id);
    form_registro.append('action', 'find');

    fetch(url, {

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
    let descripcion = document.getElementById('de_cargo');
    jefe_cargo = (document.getElementById('jefe_cargo').checked) ? 1 : 0;
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion.value);
    form_registro.append('id_cargo', id_cargo);
    form_registro.append('action', 'actualizar');
    form_registro.append('jefe_cargo', jefe_cargo);
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
                $.notification.show('success',`${capitalize_label} actualizado correctamente!`);
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al actualizar el ${label}!`);
        })
    }
}

function eliminar(id_cargo)
{
    let conf = confirm(`Desea eliminar este ${label}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_cargo', id_cargo);
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
    $("#de_cargo").val('');
    $("#jefe_cargo").prop('checked', false);
    quitarErrorValidacion()
});