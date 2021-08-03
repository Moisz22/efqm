let label_anexo_acta = 'Anexo'
let modal_anexo_acta = '#modal-default-anexo-acta'
let url_anexo_acta = '../controllers/AnexoActaController.php'
let capitalize_label_anexo_acta = label_anexo_acta.charAt(0).toUpperCase() + label_anexo_acta.slice(1)

function obtenerTablaAnexoActa() 
{
    let id_acta = $("#id_acta").val();
    let form_registro = new FormData;
    form_registro.append('id_acta', id_acta);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_anexo_acta, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_anexo_acta").html(res);
    })
}

function agregarAnexoActa()
{
    let descripcion_anexo_acta = document.getElementById("descripcion_anexo_acta");
    let anexo = document.getElementById("anexo");
    let id_acta = $("#id_acta").val();
    let form_registro = new FormData;
    form_registro.append('descripcion_anexo_acta', descripcion_anexo_acta.value);
    form_registro.append('anexo_acta', anexo.files[0]);
    form_registro.append('id_acta', id_acta);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([descripcion_anexo_acta, anexo]);
    if(validacion==true)
    {
        fetch(url_anexo_acta, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_anexo_acta} subido correctamente!`);
                descripcion_anexo_acta.value = '';
                anexo.value = '';
                obtenerTablaAnexoActa();
            }
            else
                $.notification.show('error',`Error al subir el ${res}!`);
        })
    }
}

function getDataAnexoActa(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_anexo_acta', id);
    form_registro.append('action', 'find');

    fetch(url_anexo_acta, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_anexo_acta_update").val(res[0].id_anexo_acta);
            $("#descripcion_anexo_acta_update").val(res[0].descripcion_anexo_acta);
            $(modal_anexo_acta).modal("show");
    })
}

function actualizarAnexoActa()
{
    let descripcion_anexo_acta_update = document.getElementById("descripcion_anexo_acta_update");
    let id_anexo_acta_update = $("#id_anexo_acta_update").val();
    let form_registro = new FormData;
    form_registro.append('id_anexo_acta_update', id_anexo_acta_update);
    form_registro.append('descripcion_anexo_acta_update', descripcion_anexo_acta_update.value);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([descripcion_anexo_acta_update]);
    if(validacion==true)
    {
        fetch(url_anexo_acta, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_anexo_acta} actualizado correctamente!`);
                $(modal_anexo_acta).modal("hide");
                obtenerTablaAnexoActa();
            }
            else
                $.notification.show('error',`Error al cargar el ${label_anexo_acta}!`);
        })
    }
}

function eliminarAnexoActa(id_anexo_acta)
{
    let conf = confirm(`Desea eliminar este ${label_anexo_acta}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_anexo_acta', id_anexo_acta);
        form_registro.append('action', 'eliminar');

        fetch(url_anexo_acta, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_anexo_acta} eliminado correctamente!`);
                $(modal_anexo_acta).modal("hide");
                obtenerTablaAnexoActa();
            }
            else
                $.notification.show('error',`Error al eliminar el ${label_anexo_acta}!`);
        })
    }
}
$(modal_anexo_acta).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregarAnexoActa').style.display = 'block';
    document.getElementById('leyendaEditarAnexoActa').style.display = 'none';
    document.getElementById('buttonGuardarAnexoActa').style.display = 'block';
    document.getElementById('buttonActualizarAnexoActa').style.display = 'none';
    $("#id_anexo_acta_update").val('');
    $("#id_actividad_anexo_acta").val('');
    $("#descripcion_anexo_acta").val('');

    quitarErrorValidacion()
});

$(document).ready(function() {
    obtenerTablaAnexoActa();
} );