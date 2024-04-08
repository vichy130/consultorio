var formMedicamento = document.getElementById('form-medicamento');
var medicamento;

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerMedicamento();
};

function obtenerMedicamento() {
    fetch('./controller/obtener-medicamento.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.id != null) {
                medicamento = new Medicamento(data.medicamento, data.tipo, data.descripcion);
                medicamento.id = data.id;
                document.getElementById('nombre-medicamento').value = medicamento.medicamento;
                document.getElementById('tipo-medicamento').value = medicamento.tipo;
                document.getElementById('medicamento-descripcion').value = medicamento.descripcion;
            }
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
            console.log("catch");
        });
};
function enviarFormMedicamento(){
    datosMedicamento = new FormData(formMedicamento);
    if (medicamento != null ) {
        fetch('./controller/editar-medicamento.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosMedicamento // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.text();
            })
            .then(function (data) {
                console.log(data);
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
    }else{
        var id=new Date().getTime();
        jsonId=JSON.stringify(id);
        datosMedicamento.append('id',jsonId);
        fetch('./controller/nuevo-medicamento.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosMedicamento // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.text();
            })
            .then(function (data) {
                console.log(data);
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
    }
};
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