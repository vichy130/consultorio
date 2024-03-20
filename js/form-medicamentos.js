//VARIABLES
var arrayMedicamentos = [];
var botonNuevoMedicamento = document.getElementById("boton-nuevo-medicamento");
var tablaMedicamentos = document.getElementById("tabla-medicamentos");
var notabla = document.getElementById('no-tabla');
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
        const elementoEliminar = e.target.dataset.id;
        eliminarMedicamento(elementoEliminar);
    }
});
botonNuevoMedicamento.addEventListener('click', function (e) {
    e.preventDefault();
    med();
});
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
function obtenerMedicamentos() { //pendiente 
    fetch('./controller/obtener-medicamentos.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((m) => {
                medicamento = new Medicamento(m.medicamento, m.tipo, m.descripcion);
                medicamento.id = m.id;
                arrayMedicamentos.push(medicamento);
            });
            medicamentos();
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
function medicamentos() {
    if (arrayMedicamentos.length>0) {
        const thead=document.createElement('thead');
        const propiedades=document.createElement('tr');
        const medicamento=document.createElement('th');
        const tipo=document.createElement('th');
        const descripcion=document.createElement('th');
        const editar=document.createElement('th');
        const eliminar=document.createElement('th');

        medicamento.textContent="Fecha";
        tipo.textContent="Motivo de consulta";
        descripcion.textContent="Motivo de consulta";
        descripcion.className="column-to-hide";
        editar.textContent="Editar";
        eliminar.textContent="Eliminar";

        propiedades.appendChild(medicamento);
        propiedades.appendChild(tipo);
        propiedades.appendChild(descripcion);
        propiedades.appendChild(editar);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tablaMedicamentos.appendChild(thead);

        const tbody=document.createElement('tbody');
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

            iconoEditar.className = "far fa-edit editar-medicamento";
            iconoEliminar.className = "fas fa-trash eliminar-medicamento";

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
    }else{
        const mensaje=document.createElement('p');
        mensaje.textContent="No existen registros";
        notabla.appendChild(mensaje);
    }
}
function eliminarMedicamento(elementoEliminar) {
    var id = { id: elementoEliminar };
    var jsonId = JSON.stringify(id);
    fetch('./controller/eliminar-medicamento.php', {// Enviar los datos a PHP utilizando fetch
        method: 'POST',
        body: jsonId// El JSON que contiene el id 
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            /*cerrarPregunta();*/
            arrayMedicamentos = [];
            clearDiv(tablaMedicamentos);
            obtenerMedicamentos();
            if (data) {
                /*modalExito.style.display = 'block';*/
            } else {
                /*modalError.style.display = 'block';*/
            }
        })
        .catch(function (error) {
            console.error('Error al eliminar Medicamento:', error);
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
