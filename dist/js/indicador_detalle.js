let label_indicador_detalle = 'detalle'
let modal_indicador_detalle = '#modal-default-indicador-detalle'
let url_indicador_detalle = '../controllers/IndicadorDetalleController.php'
let capitalize_label_indicador_detalle = label_indicador_detalle.charAt(0).toUpperCase() + label_indicador_detalle.slice(1)


function filtraGrafico(categoria_indicador)
{
    if (categoria_indicador=='')
    {
        location.href = "grafico_indicador";   
    }
    else
        location.href = "grafico_indicador?id="+btoa(categoria_indicador);
    
}

function obtenerTablaIndicadorDetalle() {
    let id_indicador = $("#id_indicador").val();
    let form_registro = new FormData;
    form_registro.append('id_indicador', id_indicador);
    form_registro.append('action', 'obtenerTabla');

    fetch(url_indicador_detalle, {

            method: 'post',
            body: form_registro

        }).then(res => res.text())
        .then(res => {
            $(".records_indicador_detalles").html(res);
        })
}

function agregarIndicadorDetalle() {
    let anio_detalle = document.getElementById("anio_detalle");
    let resultado_detalle = document.getElementById("resultado_detalle");
    let meta_detalle = document.getElementById("meta_detalle");
    let id_indicador = $("#id_indicador").val();
    let flag_codefe = '';
    flag_codefe = (document.getElementById('flag_codefe').checked) ? 1 : 0;
    let form_registro = new FormData;
    form_registro.append('anio_detalle', anio_detalle.value);
    form_registro.append('id_indicador', id_indicador);
    form_registro.append('resultado_detalle', resultado_detalle.value);
    form_registro.append('meta_detalle', meta_detalle.value);
    form_registro.append('flag_codefe', flag_codefe);
    form_registro.append('action', 'guardar');
    let validacion = validarCampos([anio_detalle, resultado_detalle]);
    if (validacion == true) {
        fetch(url_indicador_detalle, {
                method: 'post',
                body: form_registro

            }).then(res => res.text())
            .then(res => {
                if (res == 'ok') {
                    $.notification.show('success', `${capitalize_label_indicador_detalle} creada correctamente!`);
                    $(modal_indicador_detalle).modal("hide");
                    obtenerTablaIndicadorDetalle();
                    graficoDetalle();
                } else
                    $.notification.show('error', `Error al crear la ${res}!`);
            })
    }
}

function getDataIndicadorDetalle(id) {
    let validacion = '';
    let form_registro = new FormData;
    form_registro.append('id_indicador_detalle', id);
    form_registro.append('action', 'find');

    fetch(url_indicador_detalle, {

            method: 'post',
            body: form_registro

        }).then(res => res.json())
        .then(res => {
            $("#id_detalle_update").val(res[0].id_indicador_detalle);
            $("#anio_detalle").val(res[0].anio_detalle);
            $("#resultado_detalle").val(res[0].resultado_detalle);
            $("#meta_detalle").val(res[0].meta_detalle);
            validacion = (res[0].flag_codefe == 1) ? true : false;
            $("#flag_codefe").prop('checked', validacion);
            document.getElementById('leyendaAgregarIndicadorDetalle').style.display = 'none';
            document.getElementById('leyendaEditarIndicadorDetalle').style.display = 'block';
            document.getElementById('buttonGuardarIndicadorDetalle').style.display = 'none';
            document.getElementById('buttonActualizarIndicadorDetalle').style.display = 'block';
            $(modal_indicador_detalle).modal("show");
        })
}

function actualizarIndicadorDetalle() {
    let anio_detalle = document.getElementById("anio_detalle");
    let resultado_detalle = document.getElementById("resultado_detalle");
    let meta_detalle = document.getElementById("meta_detalle");
    let flag_codefe = '';
    flag_codefe = (document.getElementById('flag_codefe').checked) ? 1 : 0;
    let id_detalle_update = $("#id_detalle_update").val();
    let form_registro = new FormData;
    form_registro.append('id_detalle_update', id_detalle_update);
    form_registro.append('anio_detalle', anio_detalle.value);
    form_registro.append('id_indicador', id_indicador);
    form_registro.append('resultado_detalle', resultado_detalle.value);
    form_registro.append('meta_detalle', meta_detalle.value);
    form_registro.append('flag_codefe', flag_codefe);
    form_registro.append('action', 'actualizar');
    let validacion = validarCampos([anio_detalle, resultado_detalle, meta_detalle]);
    if (validacion == true) {
        fetch(url_indicador_detalle, {

                method: 'post',
                body: form_registro

            }).then(res => res.text())
            .then(res => {
                if (res == 'ok') {
                    $.notification.show('success', `${capitalize_label_indicador_detalle} actualizada correctamente!`);
                    $(modal_indicador_detalle).modal("hide");
                    obtenerTablaIndicadorDetalle();
                    graficoDetalle();
                } else
                    $.notification.show('error', `Error al actualizar el ${label_indicador_detalle}!`);
            })
    }
}

function eliminarIndicadorDetalle(id_indicador_detalle) {
    let conf = confirm(`Desea eliminar esta ${label_indicador_detalle}?`);
    if (conf == true) {
        let form_registro = new FormData;
        form_registro.append('id_indicador_detalle', id_indicador_detalle);
        form_registro.append('action', 'eliminar');

        fetch(url_indicador_detalle, {

                method: 'post',
                body: form_registro

            }).then(res => res.text())
            .then(res => {
                if (res == 'ok') {
                    $.notification.show('success', `${capitalize_label_indicador_detalle} eliminado correctamente!`);
                    $(modal_indicador_detalle).modal("hide");
                    obtenerTablaIndicadorDetalle();
                    graficoDetalle();
                } else
                    $.notification.show('error', `Error al eliminar el ${label_indicador_detalle}!`);
            })
    }
}
$(modal_indicador_detalle).on('hidden.bs.modal', function () {
    document.getElementById('leyendaAgregarIndicadorDetalle').style.display = 'block';
    document.getElementById('leyendaEditarIndicadorDetalle').style.display = 'none';
    document.getElementById('buttonGuardarIndicadorDetalle').style.display = 'block';
    document.getElementById('buttonActualizarIndicadorDetalle').style.display = 'none';
    $("#anio_detalle").val('');
    $("#resultado_detalle").val('');
    $("#meta_detalle").val('');
    $("#flag_codefe").prop('checked', false);
    quitarErrorValidacion()
});

function graficoDetalle() {
    
    let divCanvas = document.getElementById('renderizarCanvas');
    if(divCanvas.children.length > 0) [...divCanvas.children].map(child => divCanvas.removeChild(child));
    let fragment = document.createDocumentFragment();
    let elementoCanvas = document.createElement('canvas');
    elementoCanvas.setAttribute('id', 'chart1');
    elementoCanvas.style.width = '50%';
    elementoCanvas.style.height = '100';
    fragment.append(elementoCanvas);
    divCanvas.append(fragment);

    let id_indicador = $("#id_indicador").val();
    let form_registro = new FormData;
    form_registro.append('id_indicador', id_indicador);
    form_registro.append('action', 'grafico');
    fetch(url_indicador_detalle, {
            method: 'post',
            body: form_registro

        }).then(res => res.json())
        .then(res => {
            let etiquetas = [];
            let metas = [];
            let resultados = [];
            let colores = [];
            for (const i of res)
            {
                etiquetas.push(i.anio_detalle);
                if (i.anio_detalle=='CODEFE')
                {
                    colores.push('rgb(254, 0, 19)');
                }
                else
                {
                    colores.push('rgb(0, 78, 144)');
                    metas.push(i.meta_detalle);
                }
                    
                
                resultados.push(i.resultado_detalle);
            }
            console.log(etiquetas);
            /*CODIGO DEL GRÁFICO*/
            let titulo = $('#descripcion_indicador').val();
            let ctx = document.getElementById('chart1').getContext('2d');
            let myChart = new Chart(ctx, {
                data: {
                    labels: etiquetas,
                    datasets: [{
                            type: 'line',
                            label: 'Metas',
                            data: metas,
                            backgroundColor: ['rgb(254, 204, 86)'],
                            borderColor: ['rgb(254, 204, 86)'],
                            borderWidth: 1
                        },
                        {
                            type: 'bar',
                            label: 'Resultados',
                            data: resultados,
                            backgroundColor: colores,
                            borderColor: colores,
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMin: 0
                            }
                        }]
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: titulo,
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                        }
                    }
                }
            });
            
        })

}

function graficoReporte(id_indicador, titulo)
{
    let form_registro = new FormData;
    form_registro.append('id_indicador', id_indicador);
    form_registro.append('action', 'grafico');
    fetch(url_indicador_detalle, {
            method: 'post',
            body: form_registro

        }).then(res => res.json())
        .then(res => {
            let etiquetas = [];
            let metas = [];
            let resultados = [];
            let colores = [];
            for (const i of res)
            {
                etiquetas.push(i.anio_detalle);
                if (i.anio_detalle=='CODEFE')
                {
                    colores.push('rgb(254, 0, 19)');
                }
                else
                {
                    colores.push('rgb(0, 78, 144)');
                    metas.push(i.meta_detalle);
                }
                    
                
                resultados.push(i.resultado_detalle);
            }
            /*CODIGO DEL GRÁFICO*/
            let ctx = document.getElementById('chart_'+id_indicador).getContext('2d');
            let myChart = new Chart(ctx, {
                data: {
                    labels: etiquetas,
                    datasets: [{
                            type: 'line',
                            label: 'Metas',
                            data: metas,
                            backgroundColor: ['rgb(254, 204, 86)'],
                            borderColor: ['rgb(254, 204, 86)'],
                            borderWidth: 1
                        },
                        {
                            type: 'bar',
                            label: 'Resultados',
                            data: resultados,
                            backgroundColor: colores,
                            borderColor: colores,
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMin: 0
                            }
                        }]
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: titulo,
                        },
                        legend: {
                            display: true,
                            position: 'bottom',
                        }
                    }
                }
            });
            
        })

}

$(document).ready(function () {
    obtenerTablaIndicadorDetalle();
    graficoDetalle();
});