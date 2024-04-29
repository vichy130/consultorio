var imagen = document.getElementById('imagen-sexo');
let fich;
let id;
let antecedentesC;
let pac;
let consultas;
var enfermedadesDiv=document.getElementById("enfermedades-content");
var consultasDiv=document.getElementById("consultas-content");
const tipo = { obtener: "obtener", guardar: "guardar", eliminar: "eliminar", imprimir: "imprimir" };
var tipoSangreLabel = document.getElementById("tipo-sangre-content");
var botonNuevaContent=document.getElementById("boton-nueva-content");
botonNuevaContent.addEventListener('click',function (e){
    e.preventDefault();
    redirectConsulta();
} )
function redirectConsulta() {
    window.location.href = "./pacientes-consulta.php";
}
document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO
    obtenerFichaContent();
    obtenerPacienteContent();
    obtenerConsultasContent();

});

function obtenerFichaContent() {
    fetch('./controller/obtener-ficha.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                fich = data;
                tipoSangreLabel.textContent = data.tipoSangre;
                antecedentesC = data.antecedentes;
                id = data.id;
                mostrarEnfermedades();
                // console.log(antecedentesC[1].enfermedad)
            }// SI ID DE DATA ESTA NULL NO MANDAR VALORES A HTML
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
function obtenerPacienteContent() {
    fetch('./controller/obtener-paciente.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                pac= data;
                document.getElementById("nombre-content").textContent = data.nombre + " " + data.apellidoMaterno;
                document.getElementById("cumpleanos-content").textContent = data.fechaNacimiento;
                document.getElementById("telefono-content").textContent = data.celular;
                if (data.sexo == null) {
                    imagen.src = "./img/otro.png";
                    document.getElementById("genero-content").textContent = "otro";
                } else if (data.sexo == "femenino") {
                    imagen.src = "./img/female.png";
                    document.getElementById("genero-content").textContent = data.sexo;
                } else if (data.sexo == "masculino") {
                    imagen.src = "./img/male.png";
                    document.getElementById("genero-content").textContent = data.sexo;
                } else {
                    imagen.src = "./img/otro.png";
                    document.getElementById("genero-content").textContent = data.sexo;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
function obtenerConsultasContent() {
    fetch('./controller/obtener-consultas.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            consultas=data;
            mostrarConsultas();
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
        });
}//END FUNCTION OBTENERCONSULTAS


function mostrarEnfermedades(){
    if(antecedentesC.length >0){
        const titulo=document.createElement('p');
        titulo.className="titulo";
        titulo.textContent="Enfermedades del paciente:";
        enfermedadesDiv.appendChild(titulo);
        let contador=0;
        antecedentesC.forEach(element  => {
            if(contador <5 ){
                const division = document.createElement('div');
                division.className="division-enfermedades";
                const enfermedad= document.createElement('p');
                enfermedad.textContent=element.enfermedad;
                division.appendChild(enfermedad);
                enfermedadesDiv.appendChild(division);
                contador++;
                division.dataset.id=element.id;
            }
        });
    }
}
function mostrarConsultas(){
    if(consultas.length >0){
        const titulo=document.createElement('p');
        titulo.className="titulo";
        titulo.textContent="Consultas:";
        consultasDiv.appendChild(titulo);
        let contador=0;
        consultas.forEach(element => {
            if(contador <5 ){
            const division = document.createElement('div');
            division.className="division-consultas";
            const fecha= document.createElement('p');
            const motivo= document.createElement('p');
            fecha.className="line-division";
            fecha.textContent="Fecha: "+element.fecha;
            motivo.textContent=element.motivoConsulta;
            division.appendChild(fecha);
            division.appendChild(motivo);
           consultasDiv.appendChild(division);
           contador++;
           division.dataset.id=element.id;
            }
        });
    }
}
consultasDiv.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("division-consultas")) {
        const elementoConsulta = e.target.dataset.id;
        console.log(elementoConsulta);
    }
});



