var formMedicamento = document.getElementById('form-medicamento');
var medicamento;
const tipo = { obtener: "obtener", guardar: "guardar" };

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerMedicamento();
};

function obtenerMedicamento() {
    fetch('./controller/obtener-medicamento.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                if ('id' in data) {
                    medicamento = new Medicamento(data.medicamento, data.tipo, data.descripcion);
                    medicamento.id = data.id;
                    inputNombre.value = medicamento.medicamento;
                    inputTipo.value = medicamento.tipo;
                    inputDescripcion.value = medicamento.descripcion;
                    validarMedicamento();
                } else {
                    modalError(data, tipo.obtener);
                }
            }
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
        });
};
function enviarFormMedicamento() {
    datosMedicamento = new FormData(formMedicamento);
    if (medicamento != null) {
        fetch('./controller/editar-medicamento.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosMedicamento // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data != null) {
                    if ('id' in data) {
                        medicamento = new Medicamento(data.medicamento, data.tipo, data.descripcion);
                        medicamento.id = data.id;
                        modalExito();
                    }
                } else {
                    modalError(data, tipo.guardar);
                }
            })
            .catch(function (error) {
                modalError(error, tipo.guardar);
            });
    } else {
        var id = new Date().getTime();
        jsonId = JSON.stringify(id);
        datosMedicamento.append('id', jsonId);
        fetch('./controller/nuevo-medicamento.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosMedicamento // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data != null) {
                    if ('id' in data) {
                        medicamento = new Medicamento(data.medicamento, data.tipo, data.descripcion);
                        medicamento.id = data.id;
                        modalExito();
                    }
                } else {
                    modalError(data, tipo.guardar);
                }
            })
            .catch(function (error) {
                modalError(error, tipo.guardar);
            });
    }
};

//MODAL
var modal = document.getElementById("modal");
var modalContent = document.getElementById("modal-contenido");
const botonModalCerrar = document.createElement('button');
botonModalCerrar.textContent = "Cerrar";
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function modalExito() {
    clearDiv(modalContent);
    botonModalCerrar.className = "boton azul modal-cerrar";
    modalContent.classList.remove('modal-contenido-error');
    modalContent.classList.add('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-un-column');
    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');

    titulo.textContent = "¡Paciente guardado!";
    parrafo.textContent = "Los datos se han almacenado con éxito.";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalCerrar);
    modalContent.appendChild(divBoton);
    // setTimeout(modal.style.display = "none", 10000);
}
function modalError(error, tipo) {
    clearDiv(modalContent);
    botonModalCerrar.className = "boton blanco modal-cerrar";
    modalContent.classList.remove('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-error');
    modalContent.classList.add('modal-contenido-un-column');

    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";
    if (tipo == "guardar") {
        titulo.textContent = '¡Los cambios NO han sido guardados!';
    } else if (tipo == "obtener") {
        titulo.textContent = '¡La información no pudo ser obtenida!';
    }
    if (error != "false") {
        parrafo.textContent = "Contacta a tu administrador, Error: " + error;
    } if(error=="campos"){
        parrafo.textContent = "Porfavor, revisa todos los campos e intenta de nuevo.";
    } else {
        parrafo.textContent = "Porfavor, revisa la información e intenta de nuevo.";
    }
    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalCerrar);
    modalContent.appendChild(divBoton);
}
modal.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("modal-cerrar")) {
        modal.style.display = "none";
    }
})
//FUNCION BORRAR DIV
function clearDiv(div) {
    div.replaceChildren();
}
//MODAL END

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