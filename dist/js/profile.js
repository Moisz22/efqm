let url = '../controllers/UsuarioController.php'

function cambiaPassword() {
    let id_usuario = document.getElementById("id_usuario").value;
    let contrasena_actual = document.getElementById("contrasena_actual");
    let nueva_contrasena = document.getElementById("nueva_contrasena");
    let confirmacion_nueva_contrasena = document.getElementById("confirmacion_nueva_contrasena");
    let form_registro = new FormData;
    form_registro.append('id_usuario', id_usuario);
    form_registro.append('contrasena_actual', contrasena_actual.value);
    form_registro.append('nueva_contrasena', nueva_contrasena.value);
    form_registro.append('confirmacion_nueva_contrasena', confirmacion_nueva_contrasena.value);
    form_registro.append('action', 'cambiaPassword');
    let validacion = validarCampos([contrasena_actual, nueva_contrasena, confirmacion_nueva_contrasena]);
    if (validacion == true) {
        fetch(url, {
                method: 'post',
                body: form_registro

            }).then(res => res.text())
            .then(res => {
                if (res == 'ok') {
                    $.notification.show('success', `Contraseña cambiada correctamente!`);
                    setTimeout('document.location.reload()',1000);
                } else
                    $.notification.show('error', res);
            })
    }
}
