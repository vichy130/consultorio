var formConsulta = document.getElementById("form-consulta"); //FORM
const inputsConsulta = document.querySelectorAll('#form-consulta input, #form-consulta select, #form-consulta textarea');
//INPUT
//INPUT
var inputConsultaFecha = document.getElementById('consultafecha-paciente');
var inputVitalesta = document.getElementById('vitalesta-paciente');
var inputVitalesoxigeno = document.getElementById('vitalesoxigeno-paciente');
var inputVitalespulso = document.getElementById('vitalespulso-paciente');
var inputVitalespeso = document.getElementById('vitalespeso-paciente');
var inputVitalestatura = document.getElementById('vitalesestatura-paciente');
var inputVitalestemperatura = document.getElementById('vitalestemperatura-paciente');
var inputConsultamotivo = document.getElementById('consultamotivo-paciente');
var inputConsultaexploracion = document.getElementById('consultaexploracion-paciente');
var inputConsultaindicaciones = document.getElementById('consultaindicaciones-paciente');
var inputConsultaNombreMed = document.getElementById('consultanombremed-paciente');
var inputIndicacionesMedicamento = document.getElementById("indicacionesmed-paciente"); //INPUT
var inputconsultanombremed = document.getElementById('id-medicamento');
var inputEstudiossolicitados = document.getElementById('estudiossolicitados-paciente');
var inputConsultaterapia = document.getElementById('consultaterapia-paciente');
var inputConsultaPreviaTratamiento = document.getElementById('consultapreviatratamiento-paciente');
var inputConsultaPreviaEstudio = document.getElementById('consultapreviaestudio-paciente');
var inputConsultaPreviaDiagnostico = document.getElementById('consultapreviadiagnostico-paciente');
var inputConsultaPreviaComentarios = document.getElementById('consultapreviacomentarios-paciente');
//INPUT
//INPUT
inputConsultaNombreMed.addEventListener('keyup', validarConsultaNombreMed);
inputConsultaNombreMed.addEventListener('blur', validarConsultaNombreMed);
var anadirMedicamentoIndicacion = document.getElementById("boton-medicamento-indicacion");



const expresiones = {
    vitalesta: /^\d{1,3}\/\d{1,3}$/,
    vitalesoxigeno: /^\d{1,3}$/,
    vitalespulso: /^\d{1,3}$/,
    vitalespeso: /^\d{1,2}(?:\.\d)?$/,
    vitalesestatura: /^\d{1,3}(\.\d{1,2})?$/,
    vitalestemperatura: /^\d{1,2}(?:\.\d)?$/,
    consultamotivo: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{3,5000}$/,
    consultaexploracion: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{3,5000}$/,
    consultapreviacomentarios: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{0,1000}$/,
    consultapreviadiagnostico: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{0,2000}$/,
    consultapreviaestudio: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{0,2000}$/,
    consultapreviatratamientos: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{0,2000}$/,
    consultaindicaciones: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{1,5000}$/,
    consultanombremed: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{0,100}$/,
    indicacionesmed: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{0,500}$/,
    estudiossolicitados: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{0,100}$/,
    consultaterapia: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\d\s]{0,500}$/,
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
    consultapreviacomentarios: true,
    consultapreviadiagnostico: true,
    consultapreviaestudio: true,
    consultapreviatratamientos: true,
    consultaindicaciones: false,
    consultanombremed: true,
    indicacionesmed: true,
    estudiossolicitados: false,
    consultaterapia: false,
}
const validarFormulario = (e) => {
    switch (e.target.name) {
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
        // case "consultanombremed-paciente":
        //     validarCampo(expresiones.consultanombremed, e.target.value, 'consultanombremed');
        //     break;
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

inputsConsulta.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});
function validarConsulta() {
    validarCampo(expresiones.vitalesta, inputVitalesta.value, 'vitalesta');
    validarCampo(expresiones.vitalesoxigeno, inputVitalesoxigeno.value, 'vitalesoxigeno');
    validarCampo(expresiones.vitalespulso, inputVitalespulso.value, 'vitalespulso');
    validarCampo(expresiones.vitalespeso, inputVitalespeso.value, 'vitalespeso');
    validarCampo(expresiones.vitalesestatura, inputVitalestatura.value, 'vitalesestatura');
    validarCampo(expresiones.vitalestemperatura, inputVitalestemperatura.value, 'vitalestemperatura');
    validarCampo(expresiones.consultamotivo, inputConsultamotivo.value, 'consultamotivo');
    validarCampo(expresiones.consultaexploracion, inputConsultaexploracion.value, 'consultaexploracion');
    validarCampo(expresiones.consultapreviacomentarios, inputConsultaPreviaComentarios.value, 'consultapreviacomentarios');
    validarCampo(expresiones.consultapreviadiagnostico, inputConsultaPreviaDiagnostico.value, 'consultapreviadiagnostico');
    validarCampo(expresiones.consultapreviaestudio, inputConsultaPreviaEstudio.value, 'consultapreviaestudio');
    validarCampo(expresiones.consultapreviatratamientos, inputConsultaPreviaTratamiento.value, 'consultapreviatratamientos');
    validarCampo(expresiones.consultaindicaciones, inputConsultaindicaciones.value, 'consultaindicaciones');
    validarCampo(expresiones.indicacionesmed, inputIndicacionesMedicamento.value, 'indicacionesmed');
    validarCampo(expresiones.estudiossolicitados, inputEstudiossolicitados.value, 'estudiossolicitados');
    validarCampo(expresiones.consultaterapia, inputConsultaterapia.value, 'consultaterapia');
}
function validarConsultaNombreMed() {
    let validado = false;
    arrayMedicamentos.forEach(med => {
        if (inputConsultaNombreMed.value == med.medicamento) {
            console.log(inputConsultaNombreMed.value);
            console.log(med.medicamento);
            document.getElementById(`grupo_consultanombremed`).classList.remove('formulario_grupo-incorrecto');
            document.getElementById(`grupo_consultanombremed`).classList.add('formulario_grupo-correcto');
            document.querySelector(`#grupo_consultanombremed .form_validacion-estado`).classList.remove('fa-circle-xmark');
            document.querySelector(`#grupo_consultanombremed .form_validacion-estado`).classList.add('fa-circle-check');
            document.querySelector(`#grupo_consultanombremed .form_input-error`).classList.remove('form_input-error-activo');
            campos.consultanombremed = true;
            validado = true;
            return;
        }
    });
    if (inputConsultaNombreMed.value == '') {
        document.getElementById(`grupo_consultanombremed`).classList.remove('formulario_grupo-incorrecto');
        document.getElementById(`grupo_consultanombremed`).classList.add('formulario_grupo-correcto');
        document.querySelector(`#grupo_consultanombremed .form_validacion-estado`).classList.remove('fa-circle-xmark');
        document.querySelector(`#grupo_consultanombremed .form_validacion-estado`).classList.add('fa-circle-check');
        document.querySelector(`#grupo_consultanombremed .form_input-error`).classList.remove('form_input-error-activo');
        campos.consultanombremed = true;

    } else if (validado == false) {
        console.log(inputConsultaNombreMed.value);
        document.getElementById(`grupo_consultanombremed`).classList.add('formulario_grupo-incorrecto');
        document.getElementById(`grupo_consultanombremed`).classList.remove('formulario_grupo-correcto');
        document.querySelector(`#grupo_consultanombremed .form_validacion-estado`).classList.add('fa-circle-xmark');
        document.querySelector(`#grupo_consultanombremed .form_validacion-estado`).classList.remove('fa-circle-check');
        document.querySelector(`#grupo_consultanombremed .form_input-error`).classList.add('form_input-error-activo');
        campos.consultanombremed = false;
    }
    return validado;
}
anadirMedicamentoIndicacion.addEventListener('click', (e) => {
    e.preventDefault();
    var i = validarConsultaNombreMed();
    if (i) {
        console.log("el medicamento exiate");
        ingresarMedicamentoIndicacion()
    } else {
        console.log("el medicamento no existe");
    }
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
    } else {
        validarConsulta();
        modalError("campos",tipo.guardar);
    }
});