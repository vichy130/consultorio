var form=document.getElementById('form-medicamento');
var fetchedData;


window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    fetchedData = null;
    id = null;
    obtenerMedicamento();
};

function obtenerMedicamento(){
    fetch('./controller/obtener-medicamento.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.id != null) {
                fetchedData = data;
                console.log(data);
                var consulta = new Medicamento(data.medicamento,data.tipo,data.descripcion);
                consulta.id=data.id;
                document.getElementById('nombre-medicamento').value=consulta.medicamento;
                document.getElementById('tipo-medicamento').value=consulta.tipo;
                document.getElementById('medicamento-descripcion').value=consulta.descripcion;
            }
            })// FIN FETCH
            .catch(error => {
                console.error('Error:', error);
                console.log("catch");
            });
};

class Medicamento{
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
    get medicamento() {
        return this._medicamento;
    }
    get tipo() {
        return this._tipo;
    }
    get descripcion() {
        return this._descripcion;
    }
}