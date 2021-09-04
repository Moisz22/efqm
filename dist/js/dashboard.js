let url = '../controllers/DashboardController.php'

function graficoProceso() {
    
    let divCanvas = document.getElementById('renderizarCanvas');
    if(divCanvas.children.length > 0) [...divCanvas.children].map(child => divCanvas.removeChild(child));
    let fragment = document.createDocumentFragment();
    let elementoCanvas = document.createElement('canvas');
    elementoCanvas.setAttribute('id', 'chart1');
    elementoCanvas.style.width = '50%';
    elementoCanvas.style.height = '100';
    fragment.append(elementoCanvas);
    divCanvas.append(fragment);
    let form_registro = new FormData;
    form_registro.append('action', 'graficoProceso');
    fetch(url, {
            method: 'post',
            body: form_registro

        }).then(res => res.json())
        .then(res => {
            let etiquetas = [];
            let resultados = [];
            for (const i of res)
            {
                etiquetas.push(i.label);            
                resultados.push(i.cuenta);
            }
            console.log(etiquetas);
            /*CODIGO DEL GRÁFICO*/
            let titulo = '¿Vehículo se encuentra en buen estado?';
            let ctx = document.getElementById('chart1').getContext('2d');
            let myChart = new Chart(ctx, {
                data: {
                    labels: etiquetas,
                    datasets: [
                        {
                            type: 'bar',
                            label: 'Resultado',
                            data: resultados,
                            backgroundColor: 'rgb(0, 78, 144)',
                            borderColor: 'rgb(0, 78, 144)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    onClick: function(evt){ alert(resultados) },
                    indexAxis: 'y',
                    scales: {
                        yAxes: [{
                            ticks: {
                                suggestedMin: 0
                            }
                        }],
                        x: {
                            suggestedMin: 0,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: false,
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
    graficoProceso();
});