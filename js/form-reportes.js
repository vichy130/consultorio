var consultaMes=[];
function loadCharts(){
    var ctxConsultas = document.getElementById('chart-consultas');
    var consultasChart = new Chart(ctxConsultas, {
        type: 'line',
        data: {
            labels: ['label', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
            datasets: [{
                label: 'Consultas',
                data: [2, 19, 3, 5, 2, 3],
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
        consultaMes=data;
        console.log(consultaMes[0])
    })// FIN FETCH
    .catch(error => {
       console.log(error);
    });
}


