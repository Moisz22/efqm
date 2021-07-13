function agregar()
{
    let descripcion = $("#de_recurso").val();
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('action', 'guardar');

    fetch('../models/RecursoModel.php', {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success','Recurso creado correctamente!');
            $("#modal-default").modal("hide");
            setTimeout('document.location.reload()',1000);
        }
        else
            $.notification.show('error','Error al crear el recurso!');
    })
}