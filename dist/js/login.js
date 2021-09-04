let url = '../controllers/LoginController.php'

function login() {
    let user = document.getElementById("user");
    let pwd = document.getElementById("pwd");
    let form_registro = new FormData;
    form_registro.append('user', user.value);
    form_registro.append('pwd', pwd.value);
    form_registro.append('action', 'login');
    let validacion = validarCampos([user, pwd]);
    if (validacion == true) {
        fetch(url, {
                method: 'post',
                body: form_registro

            }).then(res => res.text())
            .then(res => {
                if (res == 'ok') {
                    $.notification.show('success', `Acceso correcto`);
                    setTimeout('window.location="../index"', 1000);
                } else
                    $.notification.show('error', `Usuario o contraseña incorrecta!`);
            })
    }
}
