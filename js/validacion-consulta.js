var formConsulta = document.getElementById("form-consulta"); //FORM
const inputsConsulta = document.querySelectorAll('#form-consulta input, #form-consulta select, #form-consulta textarea');

const expresiones = {
    vitalesta: /^\d{1,3}\/\d{1,3}$/,
    vitalesoxigeno: /^\d{1,3}$/,
    vitalespulso: /^\d{1,3}$/,
    vitalespeso: /^\d{1,2}(?:\.\d)?$/,
    vitalesestatura: /^\d{1,3}(\.\d{1,2})?$/,
    vitalestemperatura: /^\d{1,2}(?:\.\d)?$/,
    consultamotivo: /^[a-zA-Z0-9,. -]{3,5000}$/,
    consultaexploracion: /^[a-zA-Z0-9,. -]{3,5000}$/,
    consultapreviacomentarios: /^$[a-zA-Z0-9,. -]{3,5000}$/,
    consultapreviadiagnostico: /^$[a-zA-Z0-9,. -]{3,5000}$/,
    consultapreviaestudio: /^$[a-zA-Z0-9,. -]{3,5000}$/,
    consultapreviatratamientos: /^$[a-zA-Z0-9,. -]{3,5000}$/,
    consultaindicaciones: /^$|^[a-zA-Z0-9]{1,45}$/,
    consultanombremed: /^$|^[a-zA-Z0-9]{1,45}$/,
    indicacionesmed: /^$|^[a-zA-Z0-9]{1,45}$/,
    estudiossolicitados: /^$|^[a-zA-Z0-9]{1,45}$/,
    consultaterapia: /^$|^[a-zA-Z0-9]{1,45}$/
}

const campos = {
    vitalesta: false,
    vitalesoxigeno: false,
    vitalespulso: false,
    vitalespeso: false,
    vitalesestatura: false,
    vitalestemperatura: false,
    consultamotivo: false,
    consultaexploracion: false,
    consultapreviacomentarios: false,
    consultapreviadiagnostico: false,
    consultapreviaestudio: false,
    consultapreviatratamientos: false,
    consultaindicaciones: false,
    consultanombremed: false,
    indicacionesmed: false,
    estudiossolicitados: false,
    consultaterapia: false,
}

const validarFormulario = (e) => {
    switch (e.target.name) {
        case "select-consultorio":
            validarCampo(expresiones.consultorio, e.target.value, 'consultorio');
            break;
        case "vitalesta-paciente":
            validarCampo(expresiones.vitalesta, e.target.value, 'vitalesta');
            break;
        case "vitalesoxigeno-paciente":
            validarCampo(expresiones.vitalesoxigeno, e.target.value, 'vitalesoxigeno');
            break;
        case "vitalespulso-paciente":
            validarCampo(expresiones.vitalespulso, e.target.value, 'vitalespulso');
            break;
        case "vitalespeso-paciente":
            validarCampo(expresiones.vitalespeso, e.target.value, 'vitalespeso');
            break;
        case "vitalesestatura-paciente":
            validarCampo(expresiones.vitalesestatura, e.target.value, 'vitalesestatura');
            break;
        case "vitalestemperatura-paciente":
            validarCampo(expresiones.vitalestemperatura, e.target.value, 'vitalestemperatura');
            break;
        case "consultamotivo-paciente":
            validarCampo(expresiones.consultamotivo, e.target.value, 'consultamotivo');
            break;
        case "consultaexploracion-paciente":
            validarCampo(expresiones.consultaexploracion, e.target.value, 'consultaexploracion');
            break;
        case "consultapreviacomentarios-paciente":
            validarCampo(expresiones.consultapreviacomentarios, e.target.value, 'consultapreviacomentarios');
            break;
        case "consultapreviadiagnostico-paciente":
            validarCampo(expresiones.consultapreviadiagnostico, e.target.value, 'consultapreviadiagnostico');
            break;
        case "consultapreviaestudio-paciente":
            validarCampo(expresiones.consultapreviaestudio, e.target.value, 'consultapreviaestudio');
            break;
        case "consultapreviatratamientos-paciente":
            validarCampo(expresiones.consultapreviatratamientos, e.target.value, 'consultapreviatratamientos');
            break;
        case "consultaindicaciones-paciente":
            validarCampo(expresiones.consultaindicaciones, e.target.value, 'consultaindicaciones');
            break;
        case "consultanombremed-paciente":
            validarCampo(expresiones.consultanombremed, e.target.value, 'consultanombremed');
            break;
        case "indicacionesmed-paciente":
            validarCampo(expresiones.indicacionesmed, e.target.value, 'indicacionesmed');
            break;
        case "estudiossolicitados-paciente":
            validarCampo(expresiones.estudiossolicitados, e.target.value, 'estudiossolicitados');
            break;
        case "consultaterapia-paciente":
            validarCampo(expresiones.consultaterapia, e.target.value, 'consultaterapia');
            break;
    }
}
const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input)) {
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-incorrecto');
        /*document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-correcto');*/
        document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.remove('fa-circle-xmark');
        /*document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.add('fa-circle-check'); */
        document.querySelector(`#grupo_${campo} .form_input-error`).classList.remove('form_input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-incorrecto');
        /* document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-correcto');*/
        document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.add('fa-circle-xmark');
        /* document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.remove('fa-circle-check');*/
        document.querySelector(`#grupo_${campo} .form_input-error`).classList.add('form_input-error-activo');
        campos[campo] = false;
    }
}

inputsConsulta.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

formConsulta.addEventListener('submit', (e) => {
    e.preventDefault();
    var i = true;
    for (const key in campos) {
        if (campos[key] === false) {
            i = false;
            break;
        }
    }
    if (i) {
        enviarFormConsulta();
        console.log("enviado");
    } else {
        console.log("NO se pudo enviar");
    }
});