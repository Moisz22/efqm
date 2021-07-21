let label_entrada = 'entrada'
let modal_entrada = '#modal-default-entrada'
let url_entrada = '../controllers/EntradaController.php'
let capitalize_label_entrada = label_entrada.charAt(0).toUpperCase() + label_entrada.slice(1)

function obtenerTablaEntrada() 
{
    let id_proceso = $("#id_proceso").val();
    let form_registro = new FormData;
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_entrada, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        $(".records_entradas").html(res);
    })
}

function agregarEntrada()
{
    let descripcion_entrada = $("#descripcion_entrada").val();
    let id_proceso = $("#id_proceso").val();
    let id_actividad = $("#id_actividad_entrada").val();
    let form_registro = new FormData;
    form_registro.append('id_actividad', id_actividad);
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('descripcion_entrada', descripcion_entrada);
    form_registro.append('action', 'guardar');

    fetch(url_entrada, {
        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success',`${capitalize_label_entrada} creada correctamente!`);
            $(modal_entrada).modal("hide");
            obtenerTablaEntrada();
        }
        else
            $.notification.show('error',`Error al crear la ${res}!`);
    })
}

function getDataEntrada(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_entrada', id);
    form_registro.append('action', 'find');

    fetch(url_entrada, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_entrada_update").val(res[0].id_entrada);
            $("#id_actividad_entrada").val(res[0].id_actividad);
            $("#descripcion_entrada").val(res[0].descripcion_entrada);
            document.getElementById('leyendaAgregarEntrada').style.display = 'none';
            document.getElementById('leyendaEditarEntrada').style.display = 'block';
            document.getElementById('buttonGuardarEntrada').style.display = 'none';
            document.getElementById('buttonActualizarEntrada').style.display = 'block';
            $(modal_entrada).modal("show");
    })
}

function actualizarEntrada()
{
    let id_entrada = $("#id_entrada_update").val();
    let id_actividad_entrada = $("#id_actividad_entrada").val();
    let descripcion_entrada = $("#descripcion_entrada").val();
    let form_registro = new FormData;
    form_registro.append('id_entrada', id_entrada);
    form_registro.append('id_actividad_entrada', id_actividad_entrada);
    form_registro.append('descripcion_entrada', descripcion_entrada);
    form_registro.append('action', 'actualizar');

    fetch(url_entrada, {

        method: 'post', 
        body: form_registro

    }).then( res => res.text())
    .then( res => {  
        if(res=='ok')
        {
            $.notification.show('success',`${capitalize_label_entrada} actualizada correctamente!`);
            $(modal_entrada).modal("hide");
            obtenerTablaEntrada();
        }
        else
            $.notification.show('error',`Error al actualizar el ${label_entrada}!`);
    })
}

function eliminarEntrada(id_entrada)
{
    let conf = confirm(`Desea eliminar esta ${label_entrada}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_entrada', id_entrada);
        form_registro.append('action', 'eliminar');

        fetch(url_entrada, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label_entrada} eliminada correctamente!`);
                $(modal_entrada).modal("hide");
                obtenerTablaEntrada();
            }
            else
                $.notification.show('error',`Error al eliminar la ${label_entrada}!`);
        })
    }
}
$(modal_entrada).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#id_entrada_update").val('');
    $("#id_actividad_entrada").val('');
    $("#descripcion_entrada").val('');
});

$(document).ready(function() {
    obtenerTablaEntrada();
} );