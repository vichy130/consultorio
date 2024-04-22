var arrayConsultorios = [];
var botonNuevoConsultorio = document.getElementById('boton-nuevo-consultorio');
var tConsultorios = document.getElementById('tabla-consultorios');
var notabla=document.getElementById('no-tabla');
var botonBuscar = document.getElementById('boton-buscar-consultorio');
var inputBuscar = document.getElementById('input-buscar');
var iconoBuscar=document.getElementById('icono-buscar');
const tipo={obtener: "obtener", guardar:"guardar", eliminar:"eliminar", imprimir:"imprimir"};
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerConsultorios();
};
botonBuscar.addEventListener('click', function (e) {
    e.preventDefault();
    buscarConsultorios();
});
inputBuscar.addEventListener('keyup', iconoBuscarActivar);
inputBuscar.addEventListener('blur', iconoBuscarActivar);
iconoBuscar.addEventListener('click', function (e) {
    e.preventDefault();
    inputBuscar.value = "";
    obtenerConsultorios();
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
function obtenerConsultorios() {
    fetch('./controller/obtener-consultorios.php')
        .then(response => response.json())
        .then(data => {
            if(data!=null){
                arrayConsultorios=[];
                data.forEach((c) => {
                    if ('id' in c){
                        var consultorio = new Consultorio();
                        consultorio.id = c.id;
                        consultorio.nombre = c.nombre;
                        consultorio.calle = c.calle;
                        consultorio.colonia = c.colonia;
                        consultorio.ciudad = c.ciudad;
                        consultorio.codigoPostal = c.codigoPostal;
                        consultorio.telefono = c.telefono;
                        arrayConsultorios.push(consultorio);
                    }else{
                        modalError(c, tipo.obtener);
                            return;
                    }
                });
            }
            tablaConsultorios();
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
        });
}
function buscarConsultorios() {
    stringBuscar = inputBuscar.value;
    var arrayBuscar = stringBuscar.split(" ")

    if (arrayBuscar.length < 6) {
        datos = JSON.stringify(arrayBuscar);
        console.log(datos);
        fetch('./controller/buscar-consultorios.php', {
            method: 'POST',
            body: datos
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                if (data != null) {
                    arrayConsultorios = [];
                    if (Array.isArray(data)) {
                        data.forEach((c) => {
                            if ('id' in c){
                                var consultorio = new Consultorio();
                                consultorio.id = c.id;
                                consultorio.nombre = c.nombre;
                                consultorio.calle = c.calle;
                                consultorio.colonia = c.colonia;
                                consultorio.ciudad = c.ciudad;
                                consultorio.codigoPostal = c.codigoPostal;
                                consultorio.telefono = c.telefono;
                                arrayConsultorios.push(consultorio);
                            }else{
                                modalError(c, tipo.obtener);
                                    return;
                            }
                        });
                    }
                }
                tablaConsultorios();
            })
            .catch(function (error) {
                console.log(error);
            });
    }else{
        modalError("palabras", tipo.obtener);
    }
    }
function tablaConsultorios() {
    clearDiv(tConsultorios);
    clearDiv(notabla);

    if (arrayConsultorios.length > 0) {
        const thead=document.createElement('thead');
        const propiedades=document.createElement('tr');
        const nombre=document.createElement('th');
        const domicilio=document.createElement('th');
        const telefono=document.createElement('th');
        const editar=document.createElement('th');
        const eliminar=document.createElement('th');

        nombre.textContent="Nombre";
        domicilio.textContent="Domicilio";
        telefono.textContent="Teléfono";
        editar.textContent="Editar";
        eliminar.textContent="Eliminar";

        propiedades.appendChild(nombre);
        propiedades.appendChild(domicilio);
        propiedades.appendChild(telefono);
        propiedades.appendChild(editar);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tConsultorios.appendChild(thead);

        const tbody=document.createElement('tbody');
        arrayConsultorios.forEach(c => {
            const celda = document.createElement('tr');
            const nombreFila = document.createElement('td');
            const domicilioFila = document.createElement('td');
            const telefonoFila = document.createElement('td');
            const editarFila = document.createElement('td');
            const eliminarFila = document.createElement('td');

            const editarIcono = document.createElement('i');
            const eliminarIcono = document.createElement('i');

            editarIcono.className = "far fa-edit editar-consultorio";
            eliminarIcono.className = "fas fa-trash eliminar-consultorio";

            editarIcono.dataset.id = c.id;
            eliminarIcono.dataset.id = c.id;
            eliminarIcono.dataset.nombre=c.nombre;

            nombreFila.textContent = c.nombre;
            domicilioFila.textContent = c.calle + " " + c.colonia + ", " + c.ciudad + " " + c.codigoPostal;
            telefonoFila.textContent = c.telefono;
            editarFila.append(editarIcono);
            eliminarFila.append(eliminarIcono);

            celda.append(nombreFila);
            celda.append(domicilioFila);
            celda.append(telefonoFila);
            celda.append(editarFila);
            celda.append(eliminarFila);
            tbody.append(celda);
        });
        tConsultorios.appendChild(tbody);
    }else{
        const mensaje=document.createElement('p');
        mensaje.textContent="No existen registros";
        notabla.appendChild(mensaje);
    }
}
function clearDiv(div) {
    div.replaceChildren();
}
botonNuevoConsultorio.addEventListener('click', function (e) {
    e.preventDefault();
    redirectConsultorio();
});
tConsultorios.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains('editar-consultorio')) {
        consultorioEditar(e.target.dataset.id);
    }
    if (e.target.classList.contains('eliminar-consultorio')) {
        modal.dataset.id=e.target.dataset.id;
        modal.dataset.nombre=e.target.dataset.nombre;
        modalBlock();
    }
});
function redirectConsultorio() {
    window.location.href = "./consultorio.php";
}
function consultorioEditar(idEditar) {
    window.location.href = "./consultorio.php?id=" + idEditar;
}
function eliminarConsultorio() {
    datos = { id: modal.dataset.id };
    json = JSON.stringify(datos);
    fetch('./controller/eliminar-consultorio.php', {
        method: 'POST',
        body: json
    }).then(function (response) {
        return response.text();
    })
        .then(function (data) {
            clearDiv(modalContent);
            if(data==="true"){
                modalExito();
            }else{
                modalError(data.toString(), tipo.eliminar);
            }
            arrayConsultorios = [];
            clearDiv(tConsultorios);
            obtenerConsultorios();
        });
}

//MODAL
//MODAL
var modal = document.getElementById("modal");
var modalContent = document.getElementById("modal-contenido");
const botonModalAceptarEliminar = document.createElement('button');
botonModalAceptarEliminar.textContent = "Aceptar";
botonModalAceptarEliminar.className = "boton rojo aceptar-eliminar-consultorio";
const botonModalCancelarEliminar = document.createElement('button');
botonModalCancelarEliminar.textContent = "Cancelar";
botonModalCancelarEliminar.className = "boton azul cancelar-eliminar-consultorio";
botonModalAceptarCerrar=document.createElement('button');
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
    const divMensaje=document.createElement('div');
    const divBoton=document.createElement('div');
    const divBotonDos=document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    const strongElement = document.createElement('strong');
    var nombre = modal.dataset.nombre;
    const nombreNodo = document.createTextNode(nombre);

    divMensaje.className="modal-mensaje";
    divBoton.className="modal-boton";
    divBotonDos.className="modal-boton";

    titulo.textContent = "Confirmar Eliminación";
    parrafo.textContent = "¿Seguro que desea eliminar el consultorio ";
    strongElement.appendChild(nombreNodo);
    strongElement.style.fontWeight = 'bold';
    parrafo.appendChild(strongElement);

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);
    parrafo.textContent += " y las consultas registradas?";

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalAceptarEliminar);
    divBotonDos.appendChild(botonModalCancelarEliminar);
    modalContent.appendChild(divBoton);
    modalContent.appendChild(divBotonDos);
}
function modalExito(){
    modalContent.classList.add('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-un-column');
    botonModalAceptarCerrar.className = "boton azul modal-cerrar";

    const divMensaje=document.createElement('div');
    const divBoton=document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');

    titulo.textContent = "¡Consultorio eliminado!";
    parrafo.textContent = "Los datos se han eliminado con éxito.";

    divMensaje.className="modal-mensaje";
    divBoton.className="modal-boton modal-boton-dos-espacios";

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
        titulo.textContent = '¡El consultorio NO ha sido eliminado!';
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
//FUNCION BORRAR TABLA
function clearDiv(div) {
    div.replaceChildren();
}
modal.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("aceptar-eliminar-consultorio")) {
        eliminarConsultorio();
    };
    if (e.target.classList.contains("cancelar-eliminar-consultorio")){
        modal.style.display = "none";
    }
    if (e.target.classList.contains("modal-cerrar")){
        modal.style.display = "none";
    }
})
//MODAL END

class Consultorio {
    set nombre(nombre) {
        this._nombre = nombre;
    }
    get nombre() {
        return this._nombre;
    }
    get calle() {
        return this._calle;
    }
    set calle(calle) {
        this._calle = calle;
    }
    set colonia(colonia) {
        this._colonia = colonia;
    }
    get colonia() {
        return this._colonia;
    }
    set ciudad(ciudad) {
        this._ciudad = ciudad;
    }
    get ciudad() {
        return this._ciudad;
    }
    set codigoPostal(codigoPostal) {
        this._codigoPostal = codigoPostal;
    }
    get codigoPostal() {
        return this._codigoPostal;
    }
    set telefono(telefono) {
        this._telefono = telefono;
    }
    get telefono() {
        return this._telefono;
    }
    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
}