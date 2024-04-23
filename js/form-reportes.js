var ctxConsultas = document.getElementById('chart-consultas');
var consultasChart = new Chart(ctxConsultas, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: 'Consultas',
            data: [12, 19, 3, 5, 2, 3],
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
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
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


