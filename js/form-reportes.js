var consultaMes = [];
var consultaSeis = [];
var consultaAno = [];
var medTres = [];
var medAno = [];
var medTodo = [];
var medTipo = [];
var enfSeis = [];
var enfAno = [];
var enfTodo = [];
var terTres = [];
var terSeis = [];
var terAno = [];
var terTodo = [];

var consultasChart;
var medicamentosChart;
var enfermedadesChart;
var terapiasChart;
var selectConsulta = document.getElementById('select-consultas');
var selectMedicamento = document.getElementById('select-medicamentos');
var selectEnfermedad = document.getElementById('select-enfermedades');
var selectTerapia = document.getElementById('select-terapias');

selectConsulta.addEventListener('change', e => {
    switch (selectConsulta.value) {
        case "0": changeCharts(consultasChart, consultaMes);
            break;
        case "1": changeCharts(consultasChart, consultaSeis);
            break;
        case "2": changeCharts(consultasChart, consultaAno);
            break;
        case "3": changeCharts(consultasChart, consultaTodo);
            break;
    }
})
selectMedicamento.addEventListener('change', e => {
    switch (selectMedicamento.value) {
        case "0": changeCharts(medicamentosChart, medTres);
            break;
        case "1": changeCharts(medicamentosChart, medAno);
            break;
        case "2": changeCharts(medicamentosChart, medTodo);
            break;
        case "3": changeCharts(medicamentosChart, medTipo);
            break;
    }
})
selectEnfermedad.addEventListener('change', e => {
    switch (selectEnfermedad.value) {
        case "0": changeCharts(enfermedadesChart, enfSeis);
            break;
        case "1": changeCharts(enfermedadesChart, enfAno);
            break;
        case "2": changeCharts(enfermedadesChart, enfTodo);
            break;
    }
})
selectTerapia.addEventListener('change', e => {
    switch (selectTerapia.value) {
        case "0": changeCharts(terapiasChart, terTres);
            break;
        case "1": changeCharts(terapiasChart, terSeis);
            break;
        case "2": changeCharts(terapiasChart, terAno);
            break;
        case "3": changeCharts(terapiasChart, terTodo);
            break;
    }
})
function loadCharts() {
    var ctxConsultas = document.getElementById('chart-consultas');
    consultasChart = new Chart(ctxConsultas, {
        type: 'line',
        data: {
            labels: consultaAno.map(function (item) {
                return item.label;
            }),
            datasets: [{
                label: 'Número de consultas',
                data: consultaAno.map(function (item) {
                    return item.data;
                }),
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Historial de consultas registradas'
                },
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Rango de fechas'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Número'
                    }
                }
            }
        }
    });

    var ctxMedicamentos = document.getElementById('chart-medicamentos');
    medicamentosChart = new Chart(ctxMedicamentos, {
        type: 'doughnut',
        data: {
            labels: medTodo.map(function (item) {
                return item.label
            }),
            datasets: [{
                label: 'Medicamentos',
                data: medTodo.map(function (item) {
                    return item.data
                }),
            }]
        },
        options: {
            cutout: '50%',
            plugins: {
                title: {
                    display: true,
                    text: 'Historial de medicamentos prescritos'
                },
            }
        }

    });

    var ctxEnfermedades = document.getElementById('chart-enfermedades');
    enfermedadesChart = new Chart(ctxEnfermedades, {
        type: 'pie',
        data: {
            labels: enfSeis.map(function (item) {
                return item.label
            }),
            datasets: [{
                label: 'Enfermedades',
                data: enfSeis.map(function (item) {
                    return item.data
                }),
            }]
        },
        options: {
            plugins: {
                title: {
                    display: true,
                    text: 'Historial de enfermedades registradas'
                }
            }
        }

    });

    var ctxTerapias = document.getElementById('chart-terapias');
    terapiasChart = new Chart(ctxTerapias, {
        type: 'doughnut',
        data: {
            labels: terTres.map(function (item) {
                return item.label
            }),
            datasets: [{
                label: 'Terapias',
                data: terTres.map(function (item) {
                    return item.data
                }),
            }]
        },
        options: {
            cutout: '50%',
            plugins: {
                title: {
                    display: true,
                    text: 'Historial de Terapias aplicadas'
                },
            }
        }
    });
}
function changeCharts(chart, consultaSelected) {
    chart.data.labels = consultaSelected.map(function (item) {
        return item.label;
    });
    chart.data.datasets[0].data = consultaSelected.map(function (item) {
        return item.data;
    });
    chart.update();
}
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerReporte();
};
document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO

});
function obtenerReporte() {
    fetch('./controller/reportes-obtener-datos.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            //CONSULTAS
            consultaMes = data.consulta[0];
            consultaSeis = data.consulta[1];
            consultaSeis = convertirMeses(consultaSeis);
            consultaAno = data.consulta[2];
            consultaAno = convertirMeses(consultaAno);
            consultaTodo = data.consulta[3];
            //MEDS
            medTres = data.medicamento.tres;
            medAno = data.medicamento.ano;
            medTodo = data.medicamento.todo;
            medTipo = data.medicamento.tipo;
            //ENFS
            enfSeis = data.antecedente.seis;
            enfAno = data.antecedente.ano;
            enfTodo = data.antecedente.todo;
            //TERAPIAS
            terTres = data.terapia.tres;
            terSeis = data.terapia.seis;
            terAno = data.terapia.ano;
            terTodo = data.terapia.todo;

            loadCharts();
        })// FIN FETCH
        .catch(error => {
            console.log(error);
        });
}
function convertirMeses(array) {
    var numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    var meses = {
        1: "Enero",
        2: "Febrero",
        3: "Marzo",
        4: "Abril",
        5: "Mayo",
        6: "Junio",
        7: "Julio",
        8: "Agosto",
        9: "Septiembre",
        10: "Octubre",
        11: "Noviembre",
        12: "Diciembre"
    };
    array.forEach(valor => {
        numeros.forEach(numero => {
            if (valor.label == numero) {
                valor.label = meses[numero];
            }
        })
    });
    return array;
}


