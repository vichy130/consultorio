
var paciente;
const sexo = { femenino: "femenino", masculino: "masculino", otro: "otro" };
// const tipo={obtener: "obtener", guardar:"guardar", eliminar:"eliminar"};
var botonImprimirPaciente = document.getElementById('boton-imprimir-paciente');
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerPaciente();
};
function obtenerPaciente() {
    fetch('./controller/obtener-paciente.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                if ('id' in data) {
                    paciente = new Paciente(data.nombre, data.apellidoPaterno, data.apellidoMaterno, data.sexo, data.fechaNacimiento, data.lugarNacimiento, data.calle, data.colonia, data.ciudad, data.codigoPostal, data.telCasa, data.telOficina, data.celular, data.edoCivil, data.ocupacion, data.escolaridad, data.correo);
                    paciente.id = data.id;
                    inputNombre.value = paciente.nombre;
                    inputApellidoPaterno.value = paciente.apellidoPaterno;
                    inputApellidoMaterno.value = paciente.apellidoMaterno;
                    for (const i in sexo) {
                        if (i == paciente.sexo) {
                            document.getElementById(sexo[i]).checked = true;
                        }
                    }
                    inputNacimiento.value = paciente.fechaNacimiento;
                    inputLugar.value = paciente.lugarNacimiento;
                    inputCalle.value = paciente.calle;
                    inputColonia.value = paciente.colonia;
                    inputCiudad.value = paciente.ciudad;
                    inputCp.value = paciente.codigoPostal;
                    inputCasa.value = paciente.telCasa;
                    inputOficina.value = paciente.telOficina;
                    inputCel.value = paciente.celular;
                    inputCivil.value = paciente.edoCivil;
                    inputOcupacion.value = paciente.ocupacion;
                    inputEscolaridad.value = paciente.escolaridad;
                    inputEmail.value = paciente.correo;
                    validarInformacion();
                }else{
                    modalError(error, tipo.obtener);
                }
            }
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
        });
}
//LOAD HTML
document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO
});
botonImprimirPaciente.addEventListener('click', imprimirPaciente);
//FETCH FORMULARIO Y ARRAYS
function enviarFormPaciente() {
    var datosPaciente = new FormData(formPaciente);
    if (paciente != null) {
        fetch('./controller/editar-paciente.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosPaciente // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if ('id' in data) {
                    paciente = new Paciente(data.nombre, data.apellidoPaterno, data.apellidoMaterno, data.sexo, data.fechaNacimiento, data.lugarNacimiento, data.calle, data.colonia, data.ciudad, data.codigoPostal, data.telCasa, data.telOficina, data.celular, data.edoCivil, data.ocupacion, data.escolaridad, data.correo);
                    paciente.id = data.id;
                    if(paciente.id != null){
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
        fetch('./controller/nuevo-paciente.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosPaciente // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if ('id' in data) {
                    paciente = new Paciente(data.nombre, data.apellidoPaterno, data.apellidoMaterno, data.sexo, data.fechaNacimiento, data.lugarNacimiento, data.calle, data.colonia, data.ciudad, data.codigoPostal, data.telCasa, data.telOficina, data.celular, data.edoCivil, data.ocupacion, data.escolaridad, data.correo);
                    paciente.id = data.id;
                    if(paciente.id != null){
                        modalExito();
                    }
                } else {
                    modalError(data, tipo.guardar);
                }
            })
            .catch(function (error) {
                modalError(error,tipo.guardar);
            });
    }
}
function imprimirPaciente() {
    if (paciente != null) {
        window.open("./print/paciente.php", "_blank");
    } else {

    }
}

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
    // const iconoAlerta = document.createElement('i');
    // iconoAlerta.className = "fa-solid fa-bell";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";
    if (tipo == "guardar") {
        titulo.textContent = '¡Los cambios NO han sido guardados!';
    } else if (tipo == "obtener") {
        titulo.textContent = '¡La información no pudo ser obtenida!';
    }
    if(error=="campos"){
        parrafo.textContent = "Porfavor, revisa todos los campos e intenta de nuevo.";
    }
    else if (error != "false") {
        parrafo.textContent = "Contacta a tu administrador, Error: " + error;
    }else {
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

//CLASES
class Paciente {
    constructor(
        nombre, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, lugarNacimiento, calle, colonia, ciudad, codigoPostal, telCasa, telOficina, celular, edoCivil, ocupacion, escolaridad, correo
    ) {
        this._nombre = nombre;
        this._apellidoPaterno = apellidoPaterno;
        this._apellidoMaterno = apellidoMaterno;
        this._sexo = sexo;
        this._fechaNacimiento = fechaNacimiento;
        this._lugarNacimiento = lugarNacimiento;
        this._calle = calle;
        this._colonia = colonia;
        this._ciudad = ciudad;
        this._codigoPostal = codigoPostal;
        this._telCasa = telCasa;
        this._telOficina = telOficina;
        this._celular = celular;
        this._edoCivil = edoCivil;
        this._ocupacion = ocupacion;
        this._escolaridad = escolaridad;
        this._correo = correo;
    }
    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
    get nombre() {
        return this._nombre;
    }

    get apellidoPaterno() {
        return this._apellidoPaterno;
    }

    get apellidoMaterno() {
        return this._apellidoMaterno;
    }
    get sexo() {
        return this._sexo;
    }

    get fechaNacimiento() {
        return this._fechaNacimiento;
    }

    get lugarNacimiento() {
        return this._lugarNacimiento;
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

    get telCasa() {
        return this._telCasa;
    }

    get telOficina() {
        return this._telOficina;
    }
    get celular() {
        return this._celular;
    }

    get edoCivil() {
        return this._edoCivil;
    }

    get ocupacion() {
        return this._ocupacion;
    }

    get escolaridad() {
        return this._escolaridad;
    }

    get correo() {
        return this._correo;
    }
}

/*const { //destructuracion de datos
    nombre,
    apellidoPaterno,
    apellidoMaterno,
    sexo,
    fechaNacimiento,
    lugarNacimiento,
    calle,
    colonia,
    ciudad,
    codigoPostal,
    telCasa,
    telOficina,
    celular,
    edoCivil,
    ocupacion,
    escolaridad,
    correo
} = data;*/
