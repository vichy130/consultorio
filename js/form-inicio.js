var hNutMeds = document.getElementById('nutrientes-registrados');
var hAloMeds = document.getElementById('alopatico-registrados');
var hHomMeds = document.getElementById('homeopatico-registrados');
var hPacs = document.getElementById('pacientes-registrados');
var hCons = document.getElementById('consultas-realizadas');
var botonAgregarMedicamento=document.getElementById('boton-agregar-medicamento');
var botonAgregarPaciente=document.getElementById('boton-agregar-paciente');
var pacientes;
var consultas;
var medsNut;
var medsAlo;
var medsHom;

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerDatos();
};

function obtenerDatos() {
    fetch('./controller/index-obtener-datos.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data != null) {
                pacientes = data.pacientes;
                consultas=data.consultas;
                medsNut=data.medicamentos.nutrientes;
                medsAlo=data.medicamentos.alopatica;
                medsHom=data.medicamentos.homeopatica;
                hPacs.innerHTML=pacientes;
                hCons.innerHTML=consultas;
                hNutMeds.innerHTML=medsNut;
                hAloMeds.innerHTML=medsAlo;
                hHomMeds.innerHTML=medsHom;
            }
        })// FIN FETCH
        .catch(error => {
           console.log(error);
        });
}

botonAgregarMedicamento.addEventListener('click',redirectNuevoMedicamento);
botonAgregarPaciente.addEventListener('click',redirectNuevoPaciente);

function redirectNuevoPaciente(){
    window.location.href = "./pacientes-informacion.php";
}
function redirectNuevoMedicamento(){
    window.location.href = "./medicamento.php";
}
