//VARIABLES
var arrayMedicamentos=[];
var botonNuevoMedicamento=document.getElementById('boton-nuevo-medicamento');
//VARIABLES

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerMedicamentos();
};
//EVENT LISTENERS
botonNuevoMedicamento.addEventListener('click', function (e) {
    e.preventDefault();
    medicamento();
});
//EVENT LISTENER

//FUNCION
function medicamento() {
    window.location.href = "./medicamento.php";
}
//FUNCION
function medicamentoEditar(idEditar){
    window.location.href = "./pacientes-informacion.php?id="+idEditar;
}
function obtenerMedicamentos() { //pendiente 
    fetch('./controller/obtener-medicamentos.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((m) => {
                medicamento = new Medicamento(m.id, m.medicamento, m.tipo, m.descripcion);
                arrayMedicamentos.push(medicamento);
            });
            console.log(arrayMedicamentos);
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
class Medicamento{
    constructor(medicamento, tipo, descripcion){
        this._medicamento=medicamento;
        this._tipo=tipo;
        this._descripcion=descripcion;
    }
    get id(){
        return this._id;
    }
    set id(id){
        this._id=id;
    }
}
