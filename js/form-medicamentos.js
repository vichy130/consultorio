//VARIABLES
var arrayMedicamentos = [];
var botonNuevoMedicamento = document.getElementById("boton-nuevo-medicamento");
var tablaMedicamentos = document.getElementById("tabla-medicamentos");
var notabla = document.getElementById('no-tabla');
var botonBuscar = document.getElementById('boton-buscar-medicamento');
var inputBuscar = document.getElementById('input-buscar');
var iconoBuscar = document.getElementById('icono-buscar');
const tipo = { obtener: "obtener", guardar: "guardar", eliminar: "eliminar", imprimir: "imprimir" };
//VARIABLES

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerMedicamentos();
};
//EVENT LISTENERS
tablaMedicamentos.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("editar-medicamento")) {
        const elementoEditar = e.target.dataset.id;
        editarMedicamento(elementoEditar);
    }
    if (e.target.classList.contains("eliminar-medicamento")) {
        modal.dataset.id = e.target.dataset.id;
        modal.dataset.medicamento = e.target.dataset.medicamento;
        modalBlock();
    }
});
botonNuevoMedicamento.addEventListener('click', function (e) {
    e.preventDefault();
    med();
});
botonBuscar.addEventListener('click', function (e) {
    e.preventDefault();
    buscarMedicamentos();
});
inputBuscar.addEventListener('keyup', iconoBuscarActivar);
inputBuscar.addEventListener('blur', iconoBuscarActivar);
iconoBuscar.addEventListener('click', function (e) {
    inputBuscar.value = "";
    obtenerMedicamentos();
    iconoBuscarActivar();
});
function iconoBuscarActivar() {
    if (inputBuscar.value == null || inputBuscar.value == "") {
        iconoBuscar.classList.add('form_validacion-buscar');
        iconoBuscar.classList.remove('form_validacion-buscar-activo');
    } else {
        iconoBuscar.classList.remove('form_validacion-buscar');
        iconoBuscar.classList.add('form_validacion-buscar-activo');
    }
}
//EVENT LISTENER
//FUNCION
function med() {
    window.location.href = "./medicamento.php";
}
function editarMedicamento(elementoEditar) {
    window.location.href = "./medicamento.php?id=" + elementoEditar;
}

//FUNCION
function medicamentoEditar(idEditar) {
    window.location.href = "./pacientes-informacion.php?id=" + idEditar;
}
function obtenerSesion(){
    fetch('./controller/obtener-sessions.php')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        if (data != null) {
            tipoUsuario=data.tipoUsuario;
        }
        if (tipoUsuario=="A" || tipoUsuario=="S"){
            medicamentosF();
        }else{
            medicamentos();
        }
    })// FIN FETCH
    .catch(error => {
        console.log(error);
        modalError(error, tipo.obtener);
    });
}
function obtenerMedicamentos() { //pendiente 
    fetch('./controller/obtener-medicamentos.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                arrayMedicamentos = [];
                data.forEach((m) => {
                    if ('id' in m) {
                        var medicamento = new Medicamento(m.medicamento, m.tipo, m.descripcion);
                        medicamento.id = m.id;
                        arrayMedicamentos.push(medicamento);
                    } else {
                        modalError(m, tipo.obtener);
                    }
                });
            }
            obtenerSesion();
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
        });
}
function buscarMedicamentos() {
    stringBuscar = inputBuscar.value;
    var arrayBuscar = stringBuscar.split(" ")
    if (arrayBuscar.length < 6) {
        datos = JSON.stringify(arrayBuscar);
        console.log(datos);
        // datos={hola: "hola"};
        fetch('./controller/buscar-medicamentos.php', {
            method: 'POST',
            body: datos
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                if (data != null) {
                    arrayMedicamentos = [];
                    if (Array.isArray(data)) {
                        data.forEach((m) => {
                            if ('id' in m) {
                                var medicamento = new Medicamento(m.medicamento, m.tipo, m.descripcion);
                                medicamento.id = m.id;
                                arrayMedicamentos.push(medicamento);
                            } else {
                                modalError(m, tipo.obtener);
                            }
                        });
                    }
                }
                obtenerSesion();
            })
            .catch(function (error) {
                console.log(error);
            });
    } else {
        modalError("palabras", tipo.obtener);
    }
}
function medicamentos() {
    clearDiv(tablaMedicamentos);
    clearDiv(notabla);
    if (arrayMedicamentos.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const medicamento = document.createElement('th');
        const tipo = document.createElement('th');
        const descripcion = document.createElement('th');
        const editar = document.createElement('th');

        medicamento.textContent = "Nombre";
        tipo.textContent = "Tipo";
        descripcion.textContent = "Descripción";
        descripcion.className = "column-to-hide";
        editar.textContent = "Editar";

        propiedades.appendChild(medicamento);
        propiedades.appendChild(tipo);
        propiedades.appendChild(descripcion);
        propiedades.appendChild(editar);
        thead.appendChild(propiedades);
        tablaMedicamentos.appendChild(thead);

        const tbody = document.createElement('tbody');
        arrayMedicamentos.forEach((m) => {
            const celda = document.createElement('tr');
            const medicamentoFila = document.createElement('td');
            const tipoFila = document.createElement('td');
            const descripcionFila = document.createElement('td');
            const editarFila = document.createElement('td');

            const iconoEditar = document.createElement('i');

            iconoEditar.dataset.id = m.id;

            iconoEditar.className = "cursor far fa-edit editar-medicamento";

            medicamentoFila.textContent = m.medicamento;
            tipoFila.textContent = m.tipo;
            descripcionFila.textContent = m.descripcion;

            editarFila.appendChild(iconoEditar);
            celda.appendChild(medicamentoFila);
            celda.appendChild(tipoFila);
            celda.appendChild(descripcionFila);
            celda.appendChild(editarFila);
            tbody.appendChild(celda);
        });
        tablaMedicamentos.appendChild(tbody);
    } else {
        const mensaje = document.createElement('p');
        mensaje.textContent = "No existen registros";
        notabla.appendChild(mensaje);
    }
}
function medicamentosF() {
    clearDiv(tablaMedicamentos);
    clearDiv(notabla);
    if (arrayMedicamentos.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const medicamento = document.createElement('th');
        const tipo = document.createElement('th');
        const descripcion = document.createElement('th');
        const editar = document.createElement('th');
        const eliminar = document.createElement('th');

        medicamento.textContent = "Nombre";
        tipo.textContent = "Tipo";
        descripcion.textContent = "Descripción";
        descripcion.className = "column-to-hide";
        editar.textContent = "Editar";
        eliminar.textContent = "Eliminar";

        propiedades.appendChild(medicamento);
        propiedades.appendChild(tipo);
        propiedades.appendChild(descripcion);
        propiedades.appendChild(editar);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tablaMedicamentos.appendChild(thead);

        const tbody = document.createElement('tbody');
        arrayMedicamentos.forEach((m) => {
            const celda = document.createElement('tr');
            const medicamentoFila = document.createElement('td');
            const tipoFila = document.createElement('td');
            const descripcionFila = document.createElement('td');
            const editarFila = document.createElement('td');
            const eliminarFila = document.createElement('td');

            const iconoEditar = document.createElement('i');
            const iconoEliminar = document.createElement('i');

            iconoEditar.dataset.id = m.id;
            iconoEliminar.dataset.id = m.id;
            iconoEliminar.dataset.medicamento = m.medicamento;

            iconoEditar.className = "cursor far fa-edit editar-medicamento";
            iconoEliminar.className = "cursor fas fa-trash eliminar-medicamento";

            medicamentoFila.textContent = m.medicamento;
            tipoFila.textContent = m.tipo;
            descripcionFila.textContent = m.descripcion;

            editarFila.appendChild(iconoEditar);
            eliminarFila.appendChild(iconoEliminar);
            celda.appendChild(medicamentoFila);
            celda.appendChild(tipoFila);
            celda.appendChild(descripcionFila);
            celda.appendChild(editarFila);
            celda.appendChild(eliminarFila);
            tbody.appendChild(celda);
        });
        tablaMedicamentos.appendChild(tbody);
    } else {
        const mensaje = document.createElement('p');
        mensaje.textContent = "No existen registros";
        notabla.appendChild(mensaje);
    }
}
function eliminarMedicamento() {
    var id = { id: modal.dataset.id };
    var jsonId = JSON.stringify(id);
    fetch('./controller/eliminar-medicamento.php', {// Enviar los datos a PHP utilizando fetch
        method: 'POST',
        body: jsonId// El JSON que contiene el id 
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            clearDiv(modalContent);
            console.log(data);
            if (data === "true") {
                modalExito();
            } else {
                modalError(data.toString(), tipo.obtener);
            }
            arrayMedicamentos = [];
            clearDiv(tablaMedicamentos);
            obtenerMedicamentos();
        })
        .catch(function (error) {
            console.error('Error al eliminar Medicamento:', error);
        });
}
function clearDiv(div) {
    div.replaceChildren();
}
//MODAL
//MODAL
var modal = document.getElementById("modal");
var modalContent = document.getElementById("modal-contenido");
const botonModalAceptarEliminar = document.createElement('button');
botonModalAceptarEliminar.textContent = "Aceptar";
botonModalAceptarEliminar.className = "boton rojo aceptar-eliminar-medicamento";
const botonModalCancelarEliminar = document.createElement('button');
botonModalCancelarEliminar.textContent = "Cancelar";
botonModalCancelarEliminar.className = "boton azul cancelar-eliminar-medicamento";
botonModalAceptarCerrar = document.createElement('button');
botonModalAceptarCerrar.textContent = "Cerrar";
botonModalAceptarCerrar.className = "boton azul modal-cerrar";
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function modalBlock() {
    clearDiv(modalContent);
    modalContent.classList.remove('modal-contenido-exito');
    modalContent.classList.remove('modal-contenido-error');
    modalContent.classList.remove('modal-contenido-un-column');
    botonModalAceptarCerrar.className = "boton azul modal-cerrar";
    // modalContent.style.gridTemplateRows = '1fr 1fr';

    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const divBotonDos = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    const strongElement = document.createElement('strong');
    var medicamento = modal.dataset.medicamento;
    const medicamentoNodo = document.createTextNode(medicamento);

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton";
    divBotonDos.className = "modal-boton";

    titulo.textContent = "Confirmar Eliminación";
    parrafo.textContent = "¿Seguro que desea eliminar el medicamento ";
    strongElement.appendChild(medicamentoNodo);
    strongElement.style.fontWeight = 'bold';
    parrafo.appendChild(strongElement);

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);
    parrafo.textContent += "?";

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalAceptarEliminar);
    divBotonDos.appendChild(botonModalCancelarEliminar);
    modalContent.appendChild(divBoton);
    modalContent.appendChild(divBotonDos);
}
function modalExito() {
    modalContent.classList.add('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-un-column');
    botonModalAceptarCerrar.className = "boton azul modal-cerrar";

    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');

    titulo.textContent = "¡Medicamento eliminado!";
    parrafo.textContent = "Los datos se han eliminado con éxito.";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalAceptarCerrar);
    modalContent.appendChild(divBoton);
}
function modalError(error, tipo) {
    clearDiv(modalContent);
    modal.style.display = "block";
    modalContent.classList.add('modal-contenido-error');
    modalContent.classList.add('modal-contenido-un-column');
    modalContent.classList.remove('modal-contenido-exito');
    botonModalAceptarCerrar.className = "boton blanco modal-cerrar";

    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    const iconoAlerta = document.createElement('i');
    iconoAlerta.className = "fa-solid fa-bell";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    if (tipo == "eliminar") {
        titulo.textContent = '¡El medicamento NO ha sido eliminado!';
    } else if (tipo == "obtener") {
        titulo.textContent = '¡La información no pudo ser obtenida!';
    }
    if(error=="palabras"){
        parrafo.textContent = "Solo permite búsqueda de máximo 5 palabras";
    }
    else if (error != "false") {
        parrafo.textContent = "Contacta a tu administrador, Error: " + error;
    } else {
        parrafo.textContent = "Porfavor, revisa la información e intenta de nuevo.";
    }
    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalAceptarCerrar);
    modalContent.appendChild(divBoton);
}
modal.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("aceptar-eliminar-medicamento")) {
        eliminarMedicamento();
    };
    if (e.target.classList.contains("cancelar-eliminar-medicamento")) {
        modal.style.display = "none";
    }
    if (e.target.classList.contains("modal-cerrar")) {
        modal.style.display = "none";
    }
})
//MODAL
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
    set medicamento(m) {
        this._medicamento = m;
    }
    get tipo() {
        return this._tipo;
    }
    set tipo(t) {
        this._tipo = t;
    }
    get descripcion() {
        return this._descripcion;
    }
    set descripcion(d) {
        this._descripcion = d;
    }
}
