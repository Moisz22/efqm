let label_permiso = 'permiso'
let url_permiso = '../controllers/PermisoController.php'
let capitalize_label_permiso = label_permiso.charAt(0).toUpperCase() + label_permiso.slice(1)

function cargaPermiso(id_rol) {
    let form_registro = new FormData;
    form_registro.append('id_rol', id_rol);
    form_registro.append('action', 'cargaPermiso');

    fetch(url_permiso, {

            method: 'post',
            body: form_registro

        }).then(res => res.text())
        .then(res => {
            $(".records_permisos").html(res);
        })
}

function asignaPermiso(id_permiso) {
    let opcion = '';
    let mensaje = '';
    let permiso = '';

    if (document.getElementById('check_' + id_permiso).checked)
        permiso = 1;
    else
        permiso = 0;

    let form_registro = new FormData;
    form_registro.append('id_permiso', id_permiso);
    form_registro.append('permiso', permiso);
    form_registro.append('action', 'asignaPermiso');
    fetch(url_permiso, {

            method: 'post',
            body: form_registro

        }).then(res => res.text())
        .then(res => {
            if (res == 'ok') {
                if (permiso==1)
                {
                    opcion = 'asignado';
                }
                else 
                {
                    opcion = 'revocado';
                }
            
                $.notification.show('success', `${capitalize_label_permiso} ${opcion} correctamente!`);
            } else
                $.notification.show('error', `Error al asignar el ${label_permiso}!`);
        })
}
