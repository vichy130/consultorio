const formFicha = document.getElementById('form-ficha');
const inputHijoEdad = document.getElementById('hijoedad-paciente');
const inputs = document.querySelectorAll('#form-ficha input, #form-ficha select, #form-ficha textarea');
var paciente;
function obtenerPaciente() {
    fetch('./controller/obtener-paciente.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.id != null) {
                if (data.sexo != "femenino") {
                    deshabilitarFemenino();
                }
            }
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
            console.log("catch");
        });
}
function deshabilitarFemenino() {
    var femeninoClass = document.getElementsByClassName('femenino');
    for (var i = 0; i < femeninoClass.length; i++) {
        femeninoClass[i].classList.add('hide');
    }
    campos.embarazos = true;
    campos.partos = true;
    campos.cesareas = true;
    campos.abortos = true;
    campos.muertos = true;
    campos.enfs = true;
    campos.menstruacion = true;
    campos.menstruacionperiodicidad = true;
    campos.menstruacionmolestias = true;
}
const expresiones = {
    recomendo: /^[a-zA-Z\s]{0,100}$/,
    tipo: /^[a-zA-Z-+]+$/,
    hijoedad: /^(?:\d{1,100})?$/,
    hijosexo: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    embarazos: /^(?:0|1?\d|20)?$/,
    partos: /^(?:0|1?\d|20)?$/,
    cesareas: /^(?:0|1?\d|20)?$/,
    abortos: /^(?:0|1?\d|20)?$/,
    muertos: /^(?:0|1?\d|20)?$/,
    enfs: /^(?:0|1?\d|20)?$/,
    menstruacion: /\S/,
    menstruacionperiodicidad: /^[a-zA-Z0-9]{1,200}$/,
    menstruacionmolestias: /^$|^[a-zA-Z0-9]{1,200}$/,
    cigarros: /^\d{1,2}$/,
    cigarrosantiguedad: /^[a-zA-Z0-9]{1,45}$/,
    frecuencia: /^[a-zA-Z0-9]{1,45}$/,
    cantidad: /^[a-zA-Z0-9]{1,45}$/,
    tipos: /^[a-zA-Z0-9]{1,45}$/,
    adicciones: /^$|^[a-zA-Z0-9]{1,45}$/,
    alergias: /^$|^[a-zA-Z0-9]{1,45}$/,
    desayuno: /^[a-zA-Z0-9]{1,45}$/,
    comida: /^[a-zA-Z0-9]{1,45}$/,
    cena: /^[a-zA-Z0-9]{1,45}$/,
    entrecomidas: /^[a-zA-Z0-9]{1,45}$/,
    agua: /^[a-zA-Z0-9]{1,45}$/,
    otrosliquidos: /^[a-zA-Z0-9]{1,45}$/,
    intolerancias: /^[a-zA-Z0-9]{1,45}$/,
    orinadia: /^[a-zA-Z0-9]{1,45}$/,
    orinanoche: /^[a-zA-Z0-9]{1,45}$/,
    orinacolor: /^[a-zA-Z0-9]{1,45}$/,
    orinaolor: /^[a-zA-Z0-9]{1,45}$/,
    orinamolestias: /^[a-zA-Z0-9]{1,45}$/,
    excrementoaldia: /^[a-zA-Z0-9]{1,45}$/,
    excrementoconsistencia: /^[a-zA-Z0-9]{1,45}$/,
    excrementoolor: /^[a-zA-Z0-9]{1,45}$/,
    excrementocolor: /^[a-zA-Z0-9]{1,45}$/,
    excrementodolor: /^[a-zA-Z0-9]{1,45}$/,
    ejercicio: /^[a-zA-Z0-9]{1,45}$/
}
const campos = {
    recomendo: true,
    hijoedad: true,
    tipo: false,
    embarazos: false,
    partos: false,
    cesareas: false,
    abortos: false,
    muertos: false,
    enfs: false,
    menstruacion: false,
    menstruacionperiodicidad: false,
    menstruacionmolestias: false,
    cigarros: false,
    cigarrosantiguedad: false,
    frecuencia: false,
    cantidad: false,
    tipos: false,
    adicciones: false,
    alergias: false,
    desayuno: false,
    comida: false,
    cena: false,
    entrecomidas: false,
    agua: false,
    otrosliquidos: false,
    intolerancias: false,
    orinadia: false,
    orinanoche: false,
    orinacolor: false,
    orinaolor: false,
    orinamolestias: false,
    excrementoaldia: false,
    excrementoconsistencia: false,
    excrementoolor: false,
    excrementocolor: false,
    excrementodolor: false,
    ejercicio: false
}
const validarFormulario = (e) => {
    switch (e.target.name) {
        case "hijoedad-paciente":
            validarCampo(expresiones.hijoedad, e.target.value, 'hijoedad');
            break;
        case "recomendo-paciente":
            validarCampo(expresiones.recomendo, e.target.value, 'recomendo');
            break;
        case "tipo-sangre":
            validarCampo(expresiones.tipo, e.target.value, 'tipo');
            break;
        case "embarazos-paciente":
            validarCampo(expresiones.embarazos, e.target.value, 'embarazos');
            break;
        case "partos-paciente":
            validarCampo(expresiones.partos, e.target.value, 'partos');
            break;
        case "cesareas-paciente":
            validarCampo(expresiones.cesareas, e.target.value, 'cesareas');
            break;
        case "abortos-paciente":
            validarCampo(expresiones.abortos, e.target.value, 'abortos');
            break;
        case "muertos-paciente":
            validarCampo(expresiones.muertos, e.target.value, 'muertos');
            break;
        case "enfs-paciente":
            validarCampo(expresiones.enfs, e.target.value, 'enfs');
            break;
        case "menstruacion-paciente":
            validarCampo(expresiones.menstruacion, e.target.value, 'menstruacion');
            break;
        case "menstruacionperiodicidad-paciente":
            validarCampo(expresiones.menstruacionperiodicidad, e.target.value, 'menstruacionperiodicidad');
            break;
        case "menstruacionmolestias-paciente":
            validarCampo(expresiones.menstruacionmolestias, e.target.value, 'menstruacionmolestias');
            break;
        case "cigarros-paciente":
            validarCampo(expresiones.cigarros, e.target.value, 'cigarros');
            break;
        case "cigarros-antiguedad-paciente":
            validarCampo(expresiones.cigarrosantiguedad, e.target.value, 'cigarrosantiguedad');
            break;
        case "frecuencia-paciente":
            validarCampo(expresiones.frecuencia, e.target.value, 'frecuencia');
            break;
        case "cantidad-paciente":
            validarCampo(expresiones.cantidad, e.target.value, 'cantidad');
            break;
        case "tipos-paciente":
            validarCampo(expresiones.tipos, e.target.value, 'tipos');
            break;
        case "adicciones-paciente":
            validarCampo(expresiones.adicciones, e.target.value, 'adicciones');
            break;
        case "alergias-paciente":
            validarCampo(expresiones.alergias, e.target.value, 'alergias');
            break;
        case "desayuno-paciente":
            validarCampo(expresiones.desayuno, e.target.value, 'desayuno');
            break;
        case "comida-paciente":
            validarCampo(expresiones.comida, e.target.value, 'comida');
            break;
        case "cena-paciente":
            validarCampo(expresiones.cena, e.target.value, 'cena');
            break;
        case "entrecomidas-paciente":
            validarCampo(expresiones.entrecomidas, e.target.value, 'entrecomidas');
            break;
        case "agua-paciente":
            validarCampo(expresiones.agua, e.target.value, 'agua');
            break;
        case "otrosliquidos-paciente":
            validarCampo(expresiones.otrosliquidos, e.target.value, 'otrosliquidos');
            break;
        case "intolerancias-paciente":
            validarCampo(expresiones.intolerancias, e.target.value, 'intolerancias');
            break;
        case "orinadia-paciente":
            validarCampo(expresiones.orinadia, e.target.value, 'orinadia');
            break;
        case "orinanoche-paciente":
            validarCampo(expresiones.orinanoche, e.target.value, 'orinanoche');
            break;
        case "orinacolor-paciente":
            validarCampo(expresiones.orinacolor, e.target.value, 'orinacolor');
            break;
        case "orinaolor-paciente":
            validarCampo(expresiones.orinaolor, e.target.value, 'orinaolor');
            break;
        case "excrementoaldia-paciente":
            validarCampo(expresiones.excrementoaldia, e.target.value, 'excrementoaldia');
            break;
        case "orinamolestias-paciente":
            validarCampo(expresiones.orinamolestias, e.target.value, 'orinamolestias');
            break;
        case "excrementoconsistencia-paciente":
            validarCampo(expresiones.excrementoconsistencia, e.target.value, 'excrementoconsistencia');
            break;
        case "excrementoolor-paciente":
            validarCampo(expresiones.excrementoolor, e.target.value, 'excrementoolor');
            break;
        case "excrementocolor-paciente":
            validarCampo(expresiones.excrementocolor, e.target.value, 'excrementocolor');
            break;
        case "excrementodolor-paciente":
            validarCampo(expresiones.excrementodolor, e.target.value, 'excrementodolor');
            break;
        case "ejercicio-paciente":
            validarCampo(expresiones.ejercicio, e.target.value, 'ejercicio');
            break;

        /*
    case "":
        validarCampo(expresiones., e.target.value, '');
        break;
        */
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

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});
obtenerPaciente();
formFicha.addEventListener('submit', (e) => {
    e.preventDefault();
    var i = true;
    for (const key in campos) {
        if (campos[key] === false) {
            i = false;
            break;
        }
    }
    if (i) {
        enviarFormFicha();
        console.log("enviado");
    } else {
        console.log("NO se pudo enviar");
    }
});
