let url = '../controllers/ActaController.php'
let label = 'acta'
let capitalize_label = label.charAt(0).toUpperCase() + label.slice(1)
const mostrarOpcion = [...document.querySelectorAll('.mostrarOpcion')]


function obtenerTablaEquipo(flag) {
    var id_equipo = $('#equipo_trabajo').val();
    let form_registro = new FormData;
    form_registro.append('id_equipo', id_equipo);
    form_registro.append('flag', flag);
    form_registro.append('action', 'obtenerTabla');

    fetch(url, {

            method: 'post',
            body: form_registro

        }).then(res => res.text())
        .then(res => {
            $(".records_equipo").html(res);
        })
}

function agregar() {
    let fecha_acta = document.getElementById('fecha_acta');
    let hora_inicio_acta = document.getElementById('hora_inicio_acta');
    let lugar = document.getElementById('lugar');
    let hora_finalizacion_acta = document.getElementById('hora_finalizacion_acta');
    let orden_acta = document.getElementById('orden_acta');
    let equipo_trabajo = document.getElementById('equipo_trabajo');
    let bitacora_aprendizaje_acta = document.getElementById('bitacora_aprendizaje_acta');
    let desarrollo_acta = document.getElementById('desarrollo_acta');

    let invitados = [];
    $("select[name='invitados[]'] option:selected").each(function () {
        invitados.push($(this).val());
    });

    let miembro_equipo = [];
    $(':hidden[name = id_miembro_equipo]').each(function () {
        if (this != null) {
            miembro_equipo.push($(this).val());
        }
    });

    let asistencia = [];
    $(':checkbox[name=chk_asistencia]').each(function () {
        if (this.checked) {
            asistencia.push($(this).val());
        } else
            asistencia.push('0');
    });
    
    let form_registro = new FormData;
    form_registro.append('fecha_acta', fecha_acta.value);
    form_registro.append('hora_inicio_acta', hora_inicio_acta.value);
    form_registro.append('lugar', lugar.value);
    form_registro.append('hora_finalizacion_acta', hora_finalizacion_acta.value);
    form_registro.append('orden_acta', orden_acta.value);
    form_registro.append('equipo_trabajo', equipo_trabajo.value);
    form_registro.append('bitacora_aprendizaje_acta', bitacora_aprendizaje_acta.value);
    form_registro.append('desarrollo_acta', desarrollo_acta.value);
    form_registro.append('action', 'guardarActa');
    let validacion = validarCampos([fecha_acta, hora_inicio_acta, lugar, hora_finalizacion_acta, orden_acta, equipo_trabajo, bitacora_aprendizaje_acta, desarrollo_acta]);
    if (validacion == true) {
        fetch(url, {
                method: 'post',
                body: form_registro

            }).then(res => res.text())
            .then(res => {
                let array = res.split("_");
                if (array[0] == 'ok') {
                    $.notification.show('success', `${capitalize_label} creada correctamente!`);
                    mostrarOpcion.map(e => e.style.display = 'block')
                    $("#id_acta").val(array[1]);
                    obtenerTablaAnexoActa();
                    guardaInvitados(array[1], JSON.stringify(invitados));
                    guardaAsistencia(array[1], JSON.stringify(miembro_equipo), JSON.stringify(asistencia));
                    $('#btn_guardar').attr('onclick', 'actualizar()');
                } else $.notification.show('error', `Error al crear el ${label}!`);

                $("#modal-default-cargando").modal("hide");
            })
    }
}

function guardaInvitados(id_acta, array_invitados) {
    let form_registro = new FormData;
    form_registro.append('id_acta', id_acta);
    form_registro.append('invitados', array_invitados);
    form_registro.append('action', 'guardaInvitados');

    fetch(url, {

            method: 'post',
            body: form_registro

        }).then(res => res.text())
        .then(res => {
            if (res == 'ok') {
                console.log('invitados guardados');
            } else
                console.log(res);
        })
}

function guardaAsistencia(id_acta, array_miembros, array_asistencia) {
    let form_registro = new FormData;
    form_registro.append('id_acta', id_acta);
    form_registro.append('miembros', array_miembros);
    form_registro.append('asistencia', array_asistencia);
    form_registro.append('action', 'guardaAsistencia');

    fetch(url, {

            method: 'post',
            body: form_registro

        }).then(res => res.text())
        .then(res => {
            if (res == 'ok') {
                console.log('asistentes guardados');
            } else
                console.log(res);
        })
}

function actualizar() {
    let id_acta = $('#id_acta').val();
    let secuencial_acta = document.getElementById('secuencial_acta');
    let fecha_acta = document.getElementById('fecha_acta');
    let hora_inicio_acta = document.getElementById('hora_inicio_acta');
    let lugar = document.getElementById('lugar');
    let hora_finalizacion_acta = document.getElementById('hora_finalizacion_acta');
    let orden_acta = document.getElementById('orden_acta');
    let equipo_trabajo = document.getElementById('equipo_trabajo');
    let bitacora_aprendizaje_acta = document.getElementById('bitacora_aprendizaje_acta');
    let desarrollo_acta = document.getElementById('desarrollo_acta');

    let invitados = [];
    $("select[name='invitados[]'] option:selected").each(function () {
        invitados.push($(this).val());
    });

    let miembro_equipo = [];
    $(':hidden[name = id_miembro_equipo]').each(function () {
        if (this != null) {
            miembro_equipo.push($(this).val());
        }
    });

    let asistencia = [];
    $(':checkbox[name=chk_asistencia]').each(function () {
        if (this.checked) {
            asistencia.push($(this).val());
        } else
            asistencia.push('0');
    });

    let form_registro = new FormData;
    form_registro.append('id_acta', id_acta);
    form_registro.append('secuencial_acta', secuencial_acta.value);
    form_registro.append('fecha_acta', fecha_acta.value);
    form_registro.append('hora_inicio_acta', hora_inicio_acta.value);
    form_registro.append('lugar', lugar.value);
    form_registro.append('hora_finalizacion_acta', hora_finalizacion_acta.value);
    form_registro.append('orden_acta', orden_acta.value);
    form_registro.append('equipo_trabajo', equipo_trabajo.value);
    form_registro.append('bitacora_aprendizaje_acta', bitacora_aprendizaje_acta.value);
    form_registro.append('desarrollo_acta', desarrollo_acta.value);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([secuencial_acta, fecha_acta, hora_inicio_acta, lugar, hora_finalizacion_acta, orden_acta, equipo_trabajo, bitacora_aprendizaje_acta, desarrollo_acta]);
    if (validacion == true) {
        fetch(url, {
                method: 'post',
                body: form_registro

            }).then(res => res.text())
            .then(res => {
                if (res == 'ok') {
                    $.notification.show('success', `${capitalize_label} actualizada correctamente!`);
                    guardaInvitados(id_acta, JSON.stringify(invitados));
                    guardaAsistencia(id_acta, JSON.stringify(miembro_equipo), JSON.stringify(asistencia));
                } else $.notification.show('error', `Error al actualizar el ${label}!`);

                $("#modal-default-cargando").modal("hide");
            })
    }
}

function eliminar(id_acta) {
    let conf = confirm(`Desea eliminar este ${label}?`);
    if (conf == true) {
        let form_registro = new FormData;
        form_registro.append('id_acta', id_acta);
        form_registro.append('action', 'eliminar');

        fetch(url, {

                method: 'post',
                body: form_registro

            }).then(res => res.text())
            .then(res => {
                if (res == 'ok') {
                    $.notification.show('success', `${capitalize_label} eliminada correctamente!`);
                    setTimeout('document.location.reload()', 1000);
                } else
                    $.notification.show('error', `Error al eliminar el ${label}!`);
            })
    }
}
