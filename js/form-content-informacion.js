var fetchedDataFicha;
var id;
var antecedentes;
var fetchedDataPaciente;
const tipo={obtener: "obtener", guardar:"guardar", eliminar:"eliminar"};
fetchedDataFicha = null;
id = null;
antecedentes = null;
fetchedDataPaciente = null;
// Obtener la URL actual
/*const url = new URL(window.location.href);
// Verificar si existe el parámetro "ID" en la URL
if (url.searchParams.has('id')) {*/
fetch('./controller/obtener-ficha.php')
    .then(response => response.json())
    .then(data => {
        if (data != null) {
            fetchedDataFicha = data;
            document.getElementById("tipo-sangre-content").textContent = data.tipoSangre;
            antecedentes = data.antecedentes;
            document.getElementById("enfermedad-content").textContent = antecedentes[0].enfermedad;
            document.getElementById("descripcion-content").textContent = antecedentes[0].descripcion;
            id = data.id;
        }// SI ID DE DATA ESTA NULL NO MANDAR VALORES A HTML
    })// FIN FETCH
    .catch(error => {
        console.error('Error:', error);
    });
fetch('./controller/obtener-paciente.php')
    .then(response => response.json())
    .then(data => {
        if (data!= null) {
            fetchedDataPaciente = data;
            document.getElementById("nombre-content").textContent = data.nombre + " " + data.apellidoMaterno;
            document.getElementById("cumpleanos-content").textContent = data.fechaNacimiento;
            document.getElementById("telefono-content").textContent = data.celular;
            if (data.sexo == null) {
                document.getElementById("genero-content").textContent = "otro";
            } else {
                document.getElementById("genero-content").textContent = data.sexo;
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });/*
} else {
    console.log('No existe usuario aun');
}*/




