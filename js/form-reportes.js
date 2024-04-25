var consultaMes = [];
var consultaSeis = [];
var consultaAno = [];
var medMes = [];
var medSeis = [];
var medAno = [];
var medTipo = [];
var enfSeis = [];
var enfAño = [];
var enfTodo = [];
var terMes = [];
var terSeis = [];
var terAno = [];

var consultasChart;
var selectConsulta = document.getElementById('select-consultas');
var selectMedicamentos = document.getElementById('select-medicamentos');
var selectEnfrmedades = document.getElementById('select-enfermedades');
var selectTerapias = document.getElementById('select-terapias');

selectConsulta.addEventListener('change', e => {
    switch (selectConsulta.value) {
        case "0": changeChartsConsultas(consultaMes);
            break;
        case "1": changeChartsConsultas(consultaSeis);
            break;
        case "2": changeChartsConsultas(consultaAno);
            break;
        case "3": changeChartsConsultas(consultaTodo);
            break;
    }
})
function loadCharts() {
    var ctxConsultas = document.getElementById('chart-consultas');
    consultasChart = new Chart(ctxConsultas, {
        type: 'line',
        data: {
            labels: consultaMes.map(function (item) {
                return item.label;
            }),
            datasets: [{
                label: 'Consultas',
                data: consultaMes.map(function (item) {
                    return item.data;
                }),
            }]
        },
    });

    var ctxMedicamentos = document.getElementById('chart-medicamentos');
    var mmedicamentosChart = new Chart(ctxMedicamentos, {
        type: 'doughnut',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'Medicamentos',
                data: [12, 19, 3, 5, 2, 3],
            }]
        },
        options: {
            cutout: '50%',
        }
    });

    var ctxEnfermedades = document.getElementById('chart-enfermedades');
    var enfermedadesChart = new Chart(ctxEnfermedades, {
        type: 'polarArea',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple'],
            datasets: [{
                label: 'Enfermedades',
                data: [12, 19, 3, 5, 2, 3],
            }]
        },
    });

    var ctxTerapias = document.getElementById('chart-terapias');
    var terapiasChart = new Chart(ctxTerapias, {
        type: 'doughnut',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'Terapias',
                data: [12, 19, 3, 5, 2, 3],
            }]
        },
        options: {
            cutout: '50%',
        }
    });
}
function changeChartsConsultas(consultaSelected) {
    consultasChart.data.labels = consultaSelected.map(function (item) {
        return item.label;
    });
    consultasChart.data.datasets[0].data = consultaSelected.map(function (item) {
        return item.data;
    });
    consultasChart.update();
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

            //ENFS

            //TERAPIAS

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


