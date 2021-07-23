let url = '../controllers/PersonaController.php';
let label = 'persona';
let capitalize_label = label.charAt(0).toUpperCase() + label.slice(1)

function agregar()
{
    let identificacion_persona = document.getElementById('identificacion_persona');
    let nombre_persona = document.getElementById('nombre_persona');
    let apellido_persona = document.getElementById('apellido_persona');
    let impresion_persona = document.getElementById('impresion_persona');
    let id_cargo = document.getElementById('id_cargo');
    let flag_empleado = '';

    flag_empleado = (document.getElementById('flag_empleado').checked) ? 0 : 1;
        
    let form_registro = new FormData;
    form_registro.append('identificacion_persona', identificacion_persona.value);
    form_registro.append('nombre_persona', nombre_persona.value);
    form_registro.append('apellido_persona', apellido_persona.value);
    form_registro.append('impresion_persona', impresion_persona.value);
    form_registro.append('id_cargo', id_cargo.value);
    form_registro.append('flag_empleado', flag_empleado);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([identificacion_persona, nombre_persona, apellido_persona, impresion_persona, id_cargo]);
    if(validacion==true)
    {
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
                $.notification.show('error',`Error al crear la ${label}!`);
        })
    }
}

function getData(id)
{
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_persona', id);
    form_registro.append('action', 'find');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_persona_update").val(res[0].id_persona);
            $("#identificacion_persona").val(res[0].dni_persona);
            $("#nombre_persona").val(res[0].nombre_persona);
            $("#apellido_persona").val(res[0].apellido_persona);
            $("#impresion_persona").val(res[0].impresion_persona);
            $("#id_cargo").val(res[0].id_cargo);
            validacion = (res[0].flag_empleado==1) ? false : true;
            $("#flag_empleado").prop('checked', validacion); 
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default").modal("show");
    })
}

function actualizar()
{
    let id_persona = $("#id_persona_update").val();
    let identificacion_persona = document.getElementById('identificacion_persona');
    let nombre_persona = document.getElementById('nombre_persona');
    let apellido_persona = document.getElementById('apellido_persona');
    let impresion_persona = document.getElementById('impresion_persona');
    let id_cargo = document.getElementById('id_cargo');
    let flag_empleado = '';
    flag_empleado = (document.getElementById('flag_empleado').checked) ? 0 : 1;
    let form_registro = new FormData;
    form_registro.append('id_persona', id_persona);
    form_registro.append('identificacion_persona', identificacion_persona.value);
    form_registro.append('nombre_persona', nombre_persona.value);
    form_registro.append('apellido_persona', apellido_persona.value);
    form_registro.append('impresion_persona', impresion_persona.value);
    form_registro.append('id_cargo', id_cargo.value);
    form_registro.append('flag_empleado', flag_empleado);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([identificacion_persona, nombre_persona, apellido_persona, impresion_persona, id_cargo]);
    if(validacion==true)
    {
        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} actualizada correctamente!`);
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al actualizar la ${label}!`);
        })
    }
}

function eliminar(id_persona)
{
    let conf = confirm(`Desea eliminar esta ${label}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_persona', id_persona);
        form_registro.append('action', 'eliminar');

        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} eliminada correctamente!`);
                $("#modal-default").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al eliminar la ${label}!`);
        })
    }
}

$("#modal-default").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#identificacion_persona").val('');
    $("#nombre_persona").val('');
    $("#apellido_persona").val('');
    $("#impresion_persona").val('');
    $("#id_cargo").val('');
    $("#flag_empleado").prop('checked', false); 
    quitarErrorValidacion();
});