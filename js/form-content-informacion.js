var fetchedData;
var id;
var antecedentes;

fetchedData = null;
id = null;
antecedentes=null;
fetch('./controller/obtener-ficha.php')
    .then(response => response.json())
    .then(data => {
        if (data.id != null) {
            fetchedData = data;
            console.log(fetchedData);
            document.getElementById("tipo-sangre-content").textContent = data.tipoSangre;
            antecedentes=data.antecedentes;
            document.getElementById("enfermedad-content").textContent=antecedentes[0].enfermedad;
            document.getElementById("descripcion-content").textContent=antecedentes[0].descripcion;
            console.log(data.tipoSangre);
            console.log(antecedentes[0].enfermedad);
            console.log(antecedentes[0].descripcion);
            id = data.id;
        }// SI ID DE DATA ESTA NULL NO MANDAR VALORES A HTML
    })// FIN FETCH
    .catch(error => {
        console.error('Error:', error);
    });
