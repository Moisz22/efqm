let url = '../controllers/ParametroController.php'

function subirMisionVision()
{
    let mision_vision = document.getElementById("mision_vision");
    let form_registro = new FormData;
    form_registro.append('mision_vision', mision_vision.files[0]);
    form_registro.append('action', 'subirMisionVision');
    let validacion = validarCampos([mision_vision]);
    if(validacion==true)
    {
        fetch(url, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`Archivo Misión y Visión subido correctamente!`);
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error', res);
        })
    }
}


function subirOrganigrama()
{
    let mision_vision = document.getElementById("organigrama");
    let form_registro = new FormData;
    form_registro.append('organigrama', organigrama.files[0]);
    form_registro.append('action', 'subirOrgranigrama');
    let validacion = validarCampos([organigrama]);
    if(validacion==true)
    {
        fetch(url, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if(res=='ok')
            {
                $.notification.show('success',`Archivo Organigrama subido correctamente!`);
                setTimeout('document.location.reload()',1000);
            }
            else
                $.notification.show('error', res);
        })
    }
}

function activaUsuario(id_usuario)
{
    let permiso = '';
	if( $("#activa_"+id_usuario).is(':checked') )
	{
		permiso = 1;
    }
    else
    {
        permiso = 0;
    }
    let form_registro = new FormData;
    form_registro.append('id_usuario', id_usuario);
    form_registro.append('acceso', permiso);
    form_registro.append('action', 'activaUsuario');
        fetch(url, {
            method: 'post', 
            body: form_registro

        }).then( res => res.text())
        .then( res => {  
            if (res == 'ok') {
                if (permiso==1)
                {
                    opcion = 'Se ha habilidado el sistema para el usuario seleccionado!';
                    mensaje = 'success';
                }
                else 
                {
                    opcion = 'Se ha deshabilitado el sistema para el usuario seleccionado!';
                    mensaje = 'error';
                }
            
                $.notification.show(mensaje, opcion);
            } else
                $.notification.show(mensaje, `Error el ejecutar la opción!`);
        })
}