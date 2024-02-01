//VARIABLES
var arrayMedicamentos = [];
var botonNuevoMedicamento = document.getElementById("boton-nuevo-medicamento");
var tablaMedicamentos = document.getElementById("tbody-tabla-medicamentos");
//VARIABLES

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerMedicamentos();
};
//EVENT LISTENERS
botonNuevoMedicamento.addEventListener('click', function (e) {
    e.preventDefault();
    med();
});
//EVENT LISTENER
//FUNCION
function med() {
    window.location.href = "./medicamento.php";
}
//FUNCION
function medicamentoEditar(idEditar) {
    window.location.href = "./pacientes-informacion.php?id=" + idEditar;
}
function obtenerMedicamentos() { //pendiente 
    fetch('./controller/obtener-medicamentos.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((m) => {
                medicamento = new Medicamento( m.medicamento, m.tipo, m.descripcion);
                medicamento.id=m.id;
                arrayMedicamentos.push(medicamento);
            });
            medicamentos();
            console.log(arrayMedicamentos);
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
function medicamentos() {
    arrayMedicamentos.forEach((m) => {
        console.log(m);
        const celda = document.createElement('tr');
        const medicamentoFila = document.createElement('td');
        const tipoFila = document.createElement('td');
        const descripcionFila = document.createElement('td');
        const editarFila = document.createElement('td');
        const eliminarFila = document.createElement('td');

        const iconoEditar = document.createElement('i');
        const iconoEliminar = document.createElement('i');

        iconoEditar.dataset.id = m.id;
        iconoEliminar.dataset.id=m.id;

        iconoEditar.className="far fa-edit editar-medicamento";
        iconoEliminar.className="fas fa-trash eliminar-medicamento";

        medicamentoFila.textContent=m.medicamento;
        tipoFila.textContent=m.tipo;
        descripcionFila.textContent=m.descripcion;

        editarFila.appendChild(iconoEditar);
        eliminarFila.appendChild(iconoEliminar);
        celda.appendChild(medicamentoFila);
        celda.appendChild(tipoFila);
        celda.appendChild(descripcionFila);
        celda.appendChild(iconoEditar);
        celda.appendChild(iconoEliminar);
        tablaMedicamentos.appendChild(celda);
    });
}
function clearDiv(div) {
    div.replaceChildren();
}
class Medicamento {
    constructor(medicamento, tipo, descripcion) {
        this._medicamento = medicamento;
        this._tipo = tipo;
        this._descripcion = descripcion;
    }
    get id() {
        return this._id;
    }
    set id(id) {
        this._id = id;
    }
    get medicamento(){
        return this._medicamento;
    }
    set medicamento(m){
        this._medicamento=m;
    }
    get tipo(){
        return this._tipo;
    }
    set tipo(t){
        this._tipo=t;
    }
    get descripcion(){
        return this._descripcion;
    }
    set descripcion(d){
        this._descripcion=d;
    }
}
