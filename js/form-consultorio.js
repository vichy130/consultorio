var consultorio;
var botonGuardar = document.getElementById('boton-guardar');
var formConsultorio = document.getElementById('form-consultorio');
const tipo={obtener: "obtener", guardar:"guardar", eliminar:"eliminar"};
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerConsultorio();
};

function obtenerConsultorio() {
    fetch('./controller/obtener-consultorio.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                if('id' in data){
                    consultorio = new Consultorio(data.nombre, data.calle, data.colonia, data.ciudad, data.codigoPostal, data.telefono);
                    consultorio.id = data.id;
                    inputNombre.value = consultorio.nombre;
                    inputCalle.value = consultorio.calle;
                    inputColonia.value = consultorio.colonia;
                    inputCiudad.value = consultorio.ciudad;
                    inputCP.value = consultorio.codigoPostal;
                    inputTelefono.value = consultorio.telefono;
                    validarConsultorio();
                }else {
                    modalError(data, tipo.obtener);
                }
            }
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
        });
}
function enviarFormConsultorio(){
    datosConsultorio = new FormData(formConsultorio);
    if (consultorio != null) {
        fetch('./controller/editar-consultorio.php', {
            method: 'POST',
            body: datosConsultorio
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                if (data!=null){
                    if('id' in data){
                        consultorio = new Consultorio(data.nombre, data.calle, data.colonia, data.ciudad, data.codigoPostal, data.telefono);
                        consultorio.id = data.id;
                        modalExito();
                    }else{
                        modalError(data,tipo.guardar);
                    }
                }
            })
            .catch(function (error) {
                modalError(error,tipo.guardar);
            });
    }else{
        fetch ('./controller/nuevo-consultorio.php', {
            method: 'POST',
            body: datosConsultorio
        })
        .then(function(response){
            return response.json();
        })
        .then(function (data){
            console.log(data);
            if (data!=null){
                if('id' in data){
                    consultorio = new Consultorio(data.nombre, data.calle, data.colonia, data.ciudad, data.codigoPostal, data.telefono);
                    consultorio.id = data.id;
                    modalExito();
                }else{
                    modalError(data,tipo.guardar);
                }
            }
        })
        .catch (function (error){
            modalError(error,tipo.guardar);
        })
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

    titulo.textContent = "Consultorio guardado!";
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
    // const iconoAlerta = document.createElement('i');
    // iconoAlerta.className = "fa-solid fa-bell";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";
    if (tipo == "guardar") {
        titulo.textContent = '¡Los cambios NO han sido guardados!';
    } else if (tipo == "obtener") {
        titulo.textContent = '¡La información no pudo ser obtenida!';
    }
    if (error == "campos") {
        parrafo.textContent = "Porfavor, revisa todos los campos e intenta de nuevo.";
    } 
    else if (error != "false") {
        parrafo.textContent = "Contacta a tu administrador, Error: " + error;
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

class Consultorio {
    constructor(nombre, calle, colonia, ciudad, codigoPostal, telefono) {
        this._nombre = nombre;
        this._calle = calle;
        this._colonia = colonia;
        this._ciudad = ciudad;
        this._codigoPostal = codigoPostal;
        this._telefono = telefono;
    }
    // Métodos set
    set id(id) {
        this._id = id;
    }
    set nombre(nombre) {
        this._nombre = nombre;
    }
    set calle(calle) {
        this._calle = calle;
    }
    set colonia(colonia) {
        this._colonia = colonia;
    }
    set ciudad(ciudad) {
        this._ciudad = ciudad;
    }
    set codigoPostal(codigoPostal) {
        this._codigoPostal = codigoPostal;
    }
    set telefono(telefono) {
        this._telefono = telefono;
    }
    // Métodos get
    get id() {
        return this._id;
    }
    get nombre() {
        return this._nombre;
    }
    get calle() {
        return this._calle;
    }
    get colonia() {
        return this._colonia;
    }
    get ciudad() {
        return this._ciudad;
    }
    get codigoPostal() {
        return this._codigoPostal;
    }
    get telefono() {
        return this._telefono;
    }
}