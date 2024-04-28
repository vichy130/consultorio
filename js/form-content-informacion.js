var imagen = document.getElementById('imagen-sexo');
let fich;
let id;
let antecedentesC;
let pac;
let consultas;
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
                ficha = data;
                tipoSangreLabel.textContent = data.tipoSangre;
                antecedentesC = data.antecedentes;
                id = data.id;
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
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
        });
}//END FUNCTION OBTENERCONSULTAS






