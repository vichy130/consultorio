const formPaciente = document.getElementById('form-paciente');
const inputsPaciente = document.querySelectorAll('#form-paciente input');
const radio = document.getElementsByName('sexo');
let temp;
let arrayCodigos;
//INPUTS
//INPUTS
var inputNombre = document.getElementById('nombre-paciente');
var inputApellidoPaterno = document.getElementById('apellidop-paciente');
var inputApellidoMaterno = document.getElementById('apellidom-paciente');
var inputNacimiento = document.getElementById('nacimiento-paciente');
var inputLugar = document.getElementById('lugar-paciente');
var inputCalle = document.getElementById('calle-paciente');
var inputColonia = document.getElementById('colonia-paciente');
var inputCiudad = document.getElementById('ciudad-paciente');
var inputCp = document.getElementById('cp-paciente');
var inputCasa = document.getElementById('telefono-casa-paciente');
var inputOficina = document.getElementById('telefono-oficina-paciente');
var inputCel = document.getElementById('telefono-cel-paciente');
var inputCivil = document.getElementById('civil-paciente');
var inputOcupacion = document.getElementById('ocupacion-paciente');
var inputEscolaridad = document.getElementById('escolaridad-paciente');
var inputEmail = document.getElementById('email-paciente');
var dataListColonia = document.getElementById('datalist-colonia');

// inputCp.addEventListener('keyup', validarCodigoPostal);
//INPUTS
//INPUTS
function validarCodigoPostal() {
    var client = new XMLHttpRequest();
    client.open("GET", "http://api.zippopotam.us/MX/" + inputCp.value, true);
    client.onreadystatechange = function () {
        if (client.readyState == 4) {
            if (client.status == 200) { // Verifica si la solicitud fue exitosa
                arrayCodigos = JSON.parse(client.responseText);
                if (arrayCodigos.places && arrayCodigos.places.length > 0) {
                    colonias = arrayCodigos.places;
                    actualizarDL();
                }
            }
        };
    }
    client.send();
}
function actualizarDL() {
    clearDiv(dataListColonia);
    places = arrayCodigos.places;
    if (places.length == 1) {
        inputColonia.value = places[0]['place name'];
    } else {
        places.forEach(element => {
            const opcion = document.createElement('option');
            opcion.value = element['place name'];
            dataListColonia.appendChild(opcion);
        })
    }
    inputCiudad.value = places[0].state;
}
const expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    apellidop: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    apellidom: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    nacimiento: /\S/,
    lugar: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    calle: /^[a-zA-Z0-9#\s]{1,45}$/,
    colonia: /^[a-zA-Z0-9\s]{1,45}$/,
    ciudad: /^[a-zA-Z0-9\s]{1,45}$/,
    cp: /^\d{5}$/,
    casa: /^(\d{7,14})?$/,
    oficina: /^(\d{7,14})?$/,
    celular: /^(\d{7,14})?$/,
    estadoCivil: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    ocupacion: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    escolaridad: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    email: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/
}
const campos = {
    nombre: false,
    apellidop: false,
    apellidom: false,
    nacimiento: false,
    lugar: false,
    calle: false,
    colonia: false,
    ciudad: false,
    cp: false,
    casa: true,
    oficina: true,
    celular: true,
    estadoCivil: false,
    ocupacion: false,
    escolaridad: false,
    email: false
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre-paciente":
            validarCampo(expresiones.nombre, e.target.value, 'nombre');
            break;
        case "apellidop-paciente":
            validarCampo(expresiones.apellidop, e.target.value, 'apellidop');
            break;
        case "apellidom-paciente":
            validarCampo(expresiones.apellidom, e.target.value, 'apellidom');
            break;
        case "nacimiento-paciente":
            validarCampo(expresiones.nacimiento, e.target.value, 'nacimiento');
            break;
        case "lugar-paciente":
            validarCampo(expresiones.lugar, e.target.value, 'lugar');
            break;
        case "calle-paciente":
            validarCampo(expresiones.calle, e.target.value, 'calle');
            break;
        case "colonia-paciente":
            validarCampo(expresiones.colonia, e.target.value, 'colonia');
            break;
        case "ciudad-paciente":
            validarCampo(expresiones.ciudad, e.target.value, 'ciudad');
            break;
        case "cp-paciente":
            validarCampo(expresiones.cp, e.target.value, 'cp');
            if (campos.cp == true && inputCp.value != temp) {
                temp = inputCp.value;
                validarCodigoPostal();
            }
            break;
        case "telefono-casa-paciente":
            validarCampo(expresiones.casa, e.target.value, 'casa');
            break;
        case "telefono-oficina-paciente":
            validarCampo(expresiones.oficina, e.target.value, 'oficina');
            break;
        case "telefono-cel-paciente":
            validarCampo(expresiones.celular, e.target.value, 'celular');
            break;
        case "civil-paciente":
            validarCampo(expresiones.estadoCivil, e.target.value, 'estadoCivil');
            break;
        case "ocupacion-paciente":
            validarCampo(expresiones.ocupacion, e.target.value, 'ocupacion');
            break;
        case "escolaridad-paciente":
            validarCampo(expresiones.escolaridad, e.target.value, 'escolaridad');
            break;
        case "email-paciente":
            validarCampo(expresiones.email, e.target.value, 'email');
            break;
    }
}

const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input)) {
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-correcto');
        document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.remove('fa-circle-xmark');
        document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.add('fa-circle-check');
        document.querySelector(`#grupo_${campo} .form_input-error`).classList.remove('form_input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-correcto');
        document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.add('fa-circle-xmark');
        document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.remove('fa-circle-check');
        document.querySelector(`#grupo_${campo} .form_input-error`).classList.add('form_input-error-activo');
        campos[campo] = false;
    }
}
inputsPaciente.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});
function validarInformacion() {
    validarCampo(expresiones.nombre, inputNombre.value, 'nombre');
    validarCampo(expresiones.apellidop, inputApellidoPaterno.value, 'apellidop');
    validarCampo(expresiones.apellidom, inputApellidoMaterno.value, 'apellidom');
    validarCampo(expresiones.nacimiento, inputNacimiento.value, 'nacimiento');
    validarCampo(expresiones.lugar, inputLugar.value, 'lugar');
    validarCampo(expresiones.calle, inputCalle.value, 'calle');
    validarCampo(expresiones.colonia, inputColonia.value, 'colonia');
    validarCampo(expresiones.ciudad, inputCiudad.value, 'ciudad');
    validarCampo(expresiones.cp, inputCp.value, 'cp');
    validarCampo(expresiones.casa, inputCasa.value, 'casa');
    validarCampo(expresiones.oficina, inputOficina.value, 'oficina');
    validarCampo(expresiones.celular, inputCel.value, 'celular');
    validarCampo(expresiones.estadoCivil, inputCivil.value, 'estadoCivil');
    validarCampo(expresiones.ocupacion, inputOcupacion.value, 'ocupacion');
    validarCampo(expresiones.escolaridad, inputEscolaridad.value, 'escolaridad');
    validarCampo(expresiones.email, inputEmail.value, 'email');

}
formPaciente.addEventListener('submit', (e) => {
    e.preventDefault();
    var i = true;
    for (const key in campos) {
        if (campos[key] === false) {
            i = false;
            break;
        }
    }
    if (i) {
        inputsPaciente.forEach(input => {
            if (input.disabled) {
                input.disabled = false;
            }
        })
        enviarFormPaciente();
    } else {
        //todo
        validarInformacion();
        modalError("campos", tipo.guardar)
    }
});