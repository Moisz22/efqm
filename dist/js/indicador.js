let url = '../controllers/IndicadorController.php'
let label = 'indicador'
let capitalize_label = label.charAt(0).toUpperCase() + label.slice(1)
const mostrarOpcion = [...document.querySelectorAll('.mostrarOpcion')]



function agregar()
{
    let nombre_indicador = document.getElementById('descripcion_indicador');
    let formula_indicador = document.getElementById('formula_indicador');
    let criterio_efqm = document.getElementById('criterio_efqm');
    let meta_indicador = document.getElementById('meta_indicador');
    let frecuencia_indicador = document.getElementById('frecuencia_indicador');
    let categoria_indicador = document.getElementById('categoria_indicador');

    let form_registro = new FormData;
    form_registro.append('nombre_indicador', nombre_indicador.value);
    form_registro.append('formula_indicador', formula_indicador.value);
    form_registro.append('criterio_efqm', criterio_efqm.value);
    form_registro.append('meta_indicador', meta_indicador.value);
    form_registro.append('frecuencia_indicador', frecuencia_indicador.value);
    form_registro.append('categoria_indicador', categoria_indicador.value);
    form_registro.append('action', 'guardarIndicador');
    let validacion = validarCampos([nombre_indicador, formula_indicador, criterio_efqm, meta_indicador, frecuencia_indicador, categoria_indicador]);
    if(validacion==true)
    {
        fetch(url, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {
            let array = res.split("_");
            if(array[0]=='ok')
            {
                $.notification.show('success',`${capitalize_label} creado correctamente!`);
                mostrarOpcion.map( e=> e.style.display = 'block' )
                $("#id_indicador").val(array[1]);
                $('#btn_guardar').attr('onclick', 'actualizar()');
                obtenerTablaIndicadorDetalle();
            }
            else $.notification.show('error',`Error al crear el ${res}!`);

            $("#modal-default-cargando").modal("hide");
        })
    }
}

function actualizar()
{
    let id_indicador = $('#id_indicador').val();
    let nombre_indicador = document.getElementById('descripcion_indicador');
    let formula_indicador = document.getElementById('formula_indicador');
    let criterio_efqm = document.getElementById('criterio_efqm');
    let meta_indicador = document.getElementById('meta_indicador');
    let frecuencia_indicador = document.getElementById('frecuencia_indicador');
    let categoria_indicador = document.getElementById('categoria_indicador');
      
    let form_registro = new FormData;
    form_registro.append('id_indicador', id_indicador);
    form_registro.append('nombre_indicador', nombre_indicador.value);
    form_registro.append('formula_indicador', formula_indicador.value);
    form_registro.append('criterio_efqm', criterio_efqm.value);
    form_registro.append('meta_indicador', meta_indicador.value);
    form_registro.append('frecuencia_indicador', frecuencia_indicador.value);
    form_registro.append('categoria_indicador', categoria_indicador.value);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([nombre_indicador, formula_indicador, criterio_efqm, meta_indicador, frecuencia_indicador, categoria_indicador]);
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
                guardaResponsables(id_indicador,JSON.stringify(responsables));
                guardaIndicadores(id_indicador,JSON.stringify(indicador));
                guardaProcesosRelacionados(id_indicador,JSON.stringify(indicadors_relacionados));
            }
            else $.notification.show('error',`Error al actualizar el ${label}!`);

            $("#modal-default-cargando").modal("hide");
        })
    }
}

function getData(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_indicador', id);
    form_registro.append('action', 'find');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
        $("#id_indicador_update").val(res[0].id_indicador);
        document.getElementById('descripcion_indicador').value = (res[0].descripcion_indicador);
        document.getElementById('formula_indicador').value = (res[0].formula_indicador);
        document.getElementById('frecuencia_indicador').value = (res[0].frecuencia_indicador);
        document.getElementById('meta_indicador').value = (res[0].meta_indicador);
        document.getElementById('categoria_indicador').value = (res[0].categoria_indicador);
        document.getElementById('criterio_efqm').value = (res[0].criterio_efqm);
        document.getElementById('leyendaAgregar').style.display = 'none';
        document.getElementById('leyendaEditar').style.display = 'block';
        document.getElementById('buttonGuardar').style.display = 'none';
        document.getElementById('buttonActualizar').style.display = 'block';
        $("#modal-default").modal("show");
    })
}


function eliminar(id_indicador)
{
    let conf = confirm(`Desea eliminar este ${label}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_indicador', id_indicador);
        form_registro.append('action', 'eliminar');

        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} eliminado correctamente!`);
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
    $("#de_indicador").val('');
});