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
var consultaPdf=document.getElementById("icono-consulta-pdf");
var medicamentoPdf=document.getElementById("icono-medicamento-pdf");
var enfermedadPdf=document.getElementById("icono-enfermedad-pdf");
var terapiaPdf=document.getElementById("icono-terapia-pdf");

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
        case "tres": changeCharts(medicamentosChart, medTres);
            break;
        case "ano": changeCharts(medicamentosChart, medAno);
            break;
        case "todo": changeCharts(medicamentosChart, medTodo);
            break;
        case "tipo": changeCharts(medicamentosChart, medTipo);
            break;
    }
})
selectEnfermedad.addEventListener('change', e => {
    switch (selectEnfermedad.value) {
        case "seis": changeCharts(enfermedadesChart, enfSeis);
            break;
        case "ano": changeCharts(enfermedadesChart, enfAno);
            break;
        case "todo": changeCharts(enfermedadesChart, enfTodo);
            break;
    }
})
selectTerapia.addEventListener('change', e => {
    switch (selectTerapia.value) {
        case "tres": changeCharts(terapiasChart, terTres);
            break;
        case "seis": changeCharts(terapiasChart, terSeis);
            break;
        case "ano": changeCharts(terapiasChart, terAno);
            break;
        case "todo": changeCharts(terapiasChart, terTodo);
            break;
    }
})
consultaPdf.addEventListener('click', e => {
    e.preventDefault();
    idExportar=selectConsulta.value;
    window.open("./print/consultas-reporte.php?selected=" + idExportar, "_blank");
})
medicamentoPdf.addEventListener('click', e => {
    e.preventDefault();
    idExportar=selectMedicamento.value;
    window.open("./print/medicamentos-reporte.php?selected=" + idExportar, "_blank");
})
enfermedadPdf.addEventListener('click', e => {
    e.preventDefault();
    idExportar=selectEnfermedad.value;
    window.open("./print/enfermedades-reporte.php?selected=" + idExportar, "_blank");
})
terapiaPdf.addEventListener('click', e => {
    e.preventDefault();
    idExportar=selectTerapia.value;
    window.open("./print/terapias-reporte.php?selected=" + idExportar, "_blank");
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
            labels: terAno.map(function (item) {
                return item.label
            }),
            datasets: [{
                label: 'Terapias',
                data: terAno.map(function (item) {
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


