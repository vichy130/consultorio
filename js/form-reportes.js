var consultaMes=[];
var selectConsulta=document.getElementById('select-consultas');
function loadCharts(){
    var ctxConsultas = document.getElementById('chart-consultas');
    var consultasChart = new Chart(ctxConsultas, {
        type: 'line',
        data: {
            labels: [consultaMes[0].label, consultaMes[1].label, consultaMes[2].label, consultaMes[3].label,],
            datasets: [{
                label: 'Consultas',
                data: [consultaMes[0].data, consultaMes[1].data, consultaMes[2].data, consultaMes[3].data],
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
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS

    loadCharts();

};
document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO
    obtenerReporte();
});
function obtenerReporte(){
    fetch('./controller/reportes-obtener-datos.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        consultaMes=data.consultaMes;
        console.log(consultaMes)
    })// FIN FETCH
    .catch(error => {
       console.log(error);
    });
}


