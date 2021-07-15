let url = '../models/CategoriaIndicadorModel.php'
let label = 'categoria indicador'
let capitalize_label = label.charAt(0).toUpperCase() + label.slice(1)

function agregar()
{
    let descripcion = $("#de_categoria_indicador").val();
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
            $.notification.show('success',`${capitalize_label} creada correctamente!`);
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error',`Error al crear la ${label}`);
    })
}

function getData(id)
{
    let form_registro = new FormData;
    form_registro.append('id_categoria_indicador', id);
    form_registro.append('action', 'find');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_categoria_indicador_update").val(res[0].id_categoria_indicador);
            $("#de_categoria_indicador").val(res[0].descripcion_categoria_indicador);
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default").modal("show");
    })
}

function actualizar()
{
    let id_categoria_indicador = $("#id_categoria_indicador_update").val();
    let descripcion = $("#de_categoria_indicador").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_categoria_indicador', id_categoria_indicador);
    form_registro.append('action', 'actualizar');

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
            $.notification.show('error',`Error al actualizar la ${label}`);
    })
}

function eliminar(id_categoria_indicador)
{
    let conf = confirm(`Desea eliminar esta ${label}`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_categoria_indicador', id_categoria_indicador);
        form_registro.append('action', 'eliminar');

        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} indicador eliminada correctamente!`);
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al eliminar la ${label}`);
        })
    }
}

$("#modal-default").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#de_categoria_indicador").val('');
});