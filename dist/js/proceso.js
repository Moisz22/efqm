let url = '../models/ProcesoModel.php'
let label = 'proceso'
let capitalize_label = label.charAt(0).toUpperCase() + label.slice(1)
const mostrarOpcion = [...document.querySelectorAll('.mostrarOpcion')]



function agregar()
{
    let nombre_proceso = $("#nombre_proceso").val();
    let abreviatura_proceso = $("#abreviatura_proceso").val();
    let tipo_proceso = $("#tipo_proceso").val();
    let propietario = $("#propietario").val();
    let version = $("#version").val();
    let fecha_elaboracion = $("#fecha_elaboracion").val();
    let objetivo = $("#objetivo").val();
    let alcance = $("#alcance").val();
    let responsables = [];
    $("select[name='responsables[]'] option:selected").each(function(){
        responsables.push($(this).val());
    });

    let indicador = [];
    $("select[name='indicador[]'] option:selected").each(function(){
        indicador.push($(this).val());
    });

    let procesos_relacionados = [];
    $("select[name='procesos_relacionados[]'] option:selected").each(function(){
        procesos_relacionados.push($(this).val());
    });
      
    let form_registro = new FormData;
    form_registro.append('nombre_proceso', nombre_proceso);
    form_registro.append('abreviatura_proceso', abreviatura_proceso);
    form_registro.append('tipo_proceso', tipo_proceso);
    form_registro.append('propietario', propietario);
    form_registro.append('version', version);
    form_registro.append('fecha_elaboracion', fecha_elaboracion);
    form_registro.append('objetivo', objetivo);
    form_registro.append('alcance', alcance);
    form_registro.append('action', 'guardarProceso');
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
            $("#id_proceso").val(array[1]);
            guardaResponsables(array[1],JSON.stringify(responsables));
            guardaIndicadores(array[1],JSON.stringify(indicador));
            guardaProcesosRelacionados(array[1],JSON.stringify(procesos_relacionados));
            $('#btn_guardar').attr('onclick', '');
        }
        else $.notification.show('error',`Error al crear el ${label}!`);

        $("#modal-default-cargando").modal("hide");
    })
}
function guardaResponsables(id_proceso, array_responsables)
{
        let form_registro = new FormData;
        form_registro.append('id_proceso', id_proceso);
        form_registro.append('responsables', array_responsables);
        form_registro.append('action', 'guardarResponsables');
    
        fetch(url, {
    
            method: 'post', 
            body: form_registro
    
        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
               console.log('responsables guardados');
            }
            else
            alert('EEEEEE');
        })
}
function guardaIndicadores(id_proceso, array_indicadores)
{
        let form_registro = new FormData;
        form_registro.append('id_proceso', id_proceso);
        form_registro.append('indicadores', array_indicadores);
        form_registro.append('action', 'guardarIndicadores');
    
        fetch(url, {
    
            method: 'post', 
            body: form_registro
    
        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
               console.log('indicadores guardados');
            }
            else
            alert(res);
        })
}
function guardaProcesosRelacionados(id_proceso, array_procesos)
{
        let form_registro = new FormData;
        form_registro.append('id_proceso', id_proceso);
        form_registro.append('procesos_relacionados', array_procesos);
        form_registro.append('action', 'guardarProcesosRelacionados');
    
        fetch(url, {
    
            method: 'post', 
            body: form_registro
    
        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
               console.log('procesos relacionados guardados');
            }
            else
            alert(res);
        })
}
function getData(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_proceso', id);
    form_registro.append('action', 'find');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_proceso_update").val(res[0].id_proceso);
            $("#de_proceso").val(res[0].descripcion_proceso);
            validacion = (res[0].jefe_proceso==1) ? true : false;
            $("#jefe_proceso").prop('checked', validacion); 
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default").modal("show");
    })
}

function actualizar()
{
    let id_proceso = $("#id_proceso_update").val();
    let descripcion = $("#de_proceso").val();
    jefe_proceso = (document.getElementById('jefe_proceso').checked) ? 1 : 0;
    let form_registro = new FormData;
    form_registro.append('descripcion', descripcion);
    form_registro.append('id_proceso', id_proceso);
    form_registro.append('action', 'actualizar');
    form_registro.append('jefe_proceso', jefe_proceso);

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

function eliminar(id_proceso)
{
    let conf = confirm(`Desea eliminar este ${label}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_proceso', id_proceso);
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
    $("#de_proceso").val('');
    $("#jefe_proceso").prop('checked', false); 
});