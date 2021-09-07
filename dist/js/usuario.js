let url = '../controllers/UsuarioController.php'
let label = 'usuario'
let capitalize_label = label.charAt(0).toUpperCase() + label.slice(1)

function asignaUsuario(id_persona)
{
    let form_registro = new FormData;
    form_registro.append('id_persona', id_persona);
    form_registro.append('action', 'find');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#username").val(res[0].dni_persona);
    })
}

function agregar()
{
    let id_persona = document.getElementById('id_persona');
    let username = document.getElementById('username');
    let id_rol = document.getElementById('id_rol');
    let equipo_trabajo = document.getElementById('equipo_trabajo');
    let form_registro = new FormData;
    form_registro.append('id_persona', id_persona.value);
    form_registro.append('username', username.value);
    form_registro.append('id_rol', id_rol.value);
    form_registro.append('equipo_trabajo', equipo_trabajo.value);
    form_registro.append('action', 'guardar');

    let validacion = validarCampos([id_persona, username, id_rol, equipo_trabajo])

    if(validacion == true){

        fetch(url, {

            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`${capitalize_label} creado correctamente!`);
                $("#modal-default-usuario").modal("hide");
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error',`Error al crear el ${label}, usuario duplicado!`);
        })

    }
}

function getData(id)
{
    let form_registro = new FormData;
    form_registro.append('id_usuario', id);
    form_registro.append('action', 'find');

    fetch(url, {

        method: 'post', 
        body: form_registro

    }).then( res => res.json())
    .then( res => {  
            $("#id_usuario_update").val(res[0].id_usuario);
            $("#id_persona").val(res[0].id_persona);
            $("#username").val(res[0].username);
            $("#id_rol").val(res[0].id_rol);
            $("#equipo_trabajo").val(res[0].equipo_usuario);
            $("#id_persona").prop('disabled', true);
            document.getElementById('leyendaAgregar').style.display = 'none';
            document.getElementById('leyendaEditar').style.display = 'block';
            document.getElementById('buttonGuardar').style.display = 'none';
            document.getElementById('buttonActualizar').style.display = 'block';
            $("#modal-default-usuario").modal("show");
    })
}

function actualizar()
{
    let id_usuario = document.getElementById('id_usuario_update');
    let id_rol = document.getElementById('id_rol');
    let equipo_trabajo = document.getElementById('equipo_trabajo');
    let form_registro = new FormData;
    form_registro.append('id_usuario', id_usuario.value);
    form_registro.append('id_rol', id_rol.value);
    form_registro.append('equipo_trabajo', equipo_trabajo.value);
    form_registro.append('action', 'actualizar');

    let validacion = validarCampos([id_rol, equipo_trabajo])

    if(validacion == true){

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

function eliminar(id_usuario)
{
    let conf = confirm(`Desea eliminar este ${label}?`);
    if (conf == true)
    {
        let form_registro = new FormData;
        form_registro.append('id_usuario', id_usuario);
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
$("#modal-default-usuario").on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregar').style.display = 'block';
    document.getElementById('leyendaEditar').style.display = 'none';
    document.getElementById('buttonGuardar').style.display = 'block';
    document.getElementById('buttonActualizar').style.display = 'none';
    $("#id_persona").val("");
    $("#username").val("");
    $("#id_rol").val("");
    $("#equipo_trabajo").val("");
    $("#id_persona").prop('disabled', false);
    quitarErrorValidacion()
});