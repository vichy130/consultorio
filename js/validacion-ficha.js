const formFicha = document.getElementById('form-ficha');
var paciente;

// INPUTS
// INPUTS
const inputHijoEdad = document.getElementById('hijoedad-paciente');
const inputs = document.querySelectorAll('#form-ficha input, #form-ficha select, #form-ficha textarea');
var inputRecomendo=document.getElementById("recomendo-paciente");
var inputTipoSangre = document.getElementById("tipo-sangre");
var inputEmbarazos = document.getElementById("embarazos-paciente");
var inputPartos = document.getElementById("partos-paciente");
var inputCesareas = document.getElementById("cesareas-paciente");
var inputAbortos = document.getElementById("abortos-paciente");
var inputMuertos = document.getElementById("muertos-paciente");
var inputEnfs = document.getElementById("enfs-paciente");
var inputMenstruacion = document.getElementById("menstruacion-paciente");
var inputMenstruacionPeriodicidad = document.getElementById("menstruacionperiodicidad-paciente");
var inputMenstruacionMolestias = document.getElementById("menstruacionmolestias-paciente");
var inputFuma = document.getElementById("fuma-paciente");
var inputCigarros = document.getElementById("cigarros-paciente");
var inputCigarrosAntiguedad = document.getElementById("cigarros-antiguedad-paciente");
var inputAlcohol = document.getElementById("alcohol-paciente");
var inputFrecuencia = document.getElementById("frecuencia-paciente");
var inputCantidad = document.getElementById("cantidad-paciente");
var inputTipos = document.getElementById("tipos-paciente");
var inputAdicciones = document.getElementById("adicciones-paciente");
var inputAlergias = document.getElementById("alergias-paciente");
var inputDesayuno = document.getElementById("desayuno-paciente");
var inputComida = document.getElementById("comida-paciente");
var inputCena = document.getElementById("cena-paciente");
var inputEntrecomidas = document.getElementById("entrecomidas-paciente");
var inputAgua = document.getElementById("agua-paciente");
var inputOtrosLiquidos = document.getElementById("otrosliquidos-paciente");
var inputIntolerancias = document.getElementById("intolerancias-paciente");
var inputOrinaDia = document.getElementById("orinadia-paciente");
var inputOrinaNoche = document.getElementById("orinanoche-paciente");
var inputOrinaColor = document.getElementById("orinacolor-paciente");
var inputOrinaOlor = document.getElementById("orinaolor-paciente");
var inputOrinaMolestias = document.getElementById("orinamolestias-paciente");
var inputExcrementoDia = document.getElementById("excrementoaldia-paciente");
var inputExcrementoConsistencia = document.getElementById("excrementoconsistencia-paciente");
var inputExcrementoOlor = document.getElementById("excrementoolor-paciente");
var inputExcrementoColor = document.getElementById("excrementocolor-paciente");
var inputExcrementoDolor = document.getElementById("excrementodolor-paciente");
var inputEjercicio = document.getElementById("ejercicio-paciente");
//INPUTS
//INPUTS

inputAlcohol.addEventListener('change', deshabilitarAlcohol);
inputFuma.addEventListener('change', deshabilitarFuma)

const expresiones = {
    recomendo: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0\s]{1,100}$/,
    tipo: /^[a-zA-Z-+]+$/,
    hijoedad: /^(?:\d{1,100})?$/,
    hijosexo: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    embarazos: /^(1[0-5]?|[0-9])$/,
    partos: /^(1[0-5]?|[0-9])$/,
    cesareas: /^(1[0-5]?|[0-9])$/,
    abortos: /^(1[0-5]?|[0-9])$/,
    muertos: /^(1[0-5]?|[0-9])$/,
    enfs: /^(1[0-5]?|[0-9])$/,
    menstruacion: /\S/,
    menstruacionperiodicidad:  /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,200}$/,
    menstruacionmolestias: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,200}$/,
    cigarros: /^\d{1,2}$/,
    cigarrosantiguedad: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,45}$/,
    frecuencia: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,45}$/,
    cantidad: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,45}$/,
    tipos: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,45}$/,
    adicciones: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,1000}$/,
    alergias: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,1000}$/,
    desayuno: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,200}$/,
    comida: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,200}$/,
    cena: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,200}$/,
    entrecomidas: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,200}$/,
    agua: /^[a-zA-Z0-9]{1,45}$/,
    otrosliquidos: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,200}$/,
    intolerancias: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,1000}$/,
    orinadia: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,200}$/,
    orinanoche: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,200}$/,
    orinacolor: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,45}$/,
    orinaolor: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,45}$/,
    orinamolestias: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,200}$/,
    excrementoaldia:/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,45}$/,
    excrementoconsistencia: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,45}$/,
    excrementoolor:/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,45}$/,
    excrementocolor:/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,45}$/,
    excrementodolor: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,45}$/,
    ejercicio: /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s.,]{1,500}$/,
    parentesco:/^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0\s]{1,200}$/,
    familiarenfermedad: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0\s.,\[\]()]{1,200}$/,
    familiarenfermedaddescripcion: /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0\s.,]{1,200}$/,
    enfermedad:/^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0\s.,\[\]()]{1,200}$/,
    enfermedadactiva:/^\d{1,2}$/,
    enfermedaddescripcion:/^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0\s.,]{1,200}$/
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
        case "parentesco-paciente":
            validarCampo(expresiones.parentesco, e.target.value, 'parentesco');
            break;
        case "familiarenfermedad-paciente":
            validarCampo(expresiones.familiarenfermedad, e.target.value, 'familiarenfermedad');
            break;
        case "familiarenfermedad-descripcion-paciente":
            validarCampo(expresiones.familiarenfermedaddescripcion, e.target.value, 'familiarenfermedaddescripcion');
            break;
        case "enfermedad-paciente":
            validarCampo(expresiones.enfermedad, e.target.value, 'enfermedad');
            break;
        case "enfermedad-activa":
            validarCampo(expresiones.enfermedadactiva, e.target.value, 'enfermedadactiva');
            break;
        case "enfermedad-descripcion-paciente":
            validarCampo(expresiones.enfermedaddescripcion, e.target.value, 'enfermedaddescripcion');
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
document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA 
obtenerPaciente();
// deshabilitarFuma();
// deshabilitarAlcohol();
});

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});
function validarFicha(){
    validarCampo(expresiones.recomendo,inputRecomendo.value ,'recomendo');
    validarCampo(expresiones.tipo, inputTipoSangre.value, 'tipo');
    validarCampo(expresiones.embarazos, inputEmbarazos.value, 'embarazos');
    validarCampo(expresiones.partos, inputPartos.value, 'partos');
    validarCampo(expresiones.cesareas, inputCesareas.value, 'cesareas');
    validarCampo(expresiones.abortos, inputAbortos.value, 'abortos');
    validarCampo(expresiones.muertos, inputMuertos.value, 'muertos');
    validarCampo(expresiones.enfs, inputEnfs.value, 'enfs');
    validarCampo(expresiones.menstruacion, inputMenstruacion.value, 'menstruacion');
    validarCampo(expresiones.menstruacionperiodicidad, inputMenstruacionPeriodicidad.value, 'menstruacionperiodicidad');
    validarCampo(expresiones.menstruacionmolestias, inputMenstruacionMolestias.value, 'menstruacionmolestias');
    validarCampo(expresiones.cigarros, inputCigarros.value, 'cigarros');
    validarCampo(expresiones.cigarrosantiguedad, inputCigarrosAntiguedad.value, 'cigarrosantiguedad');
    validarCampo(expresiones.frecuencia, inputFrecuencia.value, 'frecuencia');
    validarCampo(expresiones.cantidad, inputCantidad.value, 'cantidad');
    validarCampo(expresiones.tipos, inputTipos.value, 'tipos');
    validarCampo(expresiones.adicciones, inputAdicciones.value, 'adicciones');
    validarCampo(expresiones.alergias, inputAlergias.value, 'alergias');
    validarCampo(expresiones.desayuno, inputDesayuno.value, 'desayuno');
    validarCampo(expresiones.comida, inputComida.value, 'comida');
    validarCampo(expresiones.cena, inputCena.value, 'cena');
    validarCampo(expresiones.entrecomidas, inputEntrecomidas.value, 'entrecomidas');
    validarCampo(expresiones.agua, inputAgua.value, 'agua');
    validarCampo(expresiones.otrosliquidos, inputOtrosLiquidos.value, 'otrosliquidos');
    validarCampo(expresiones.intolerancias, inputIntolerancias.value, 'intolerancias');
    validarCampo(expresiones.orinadia, inputOrinaDia.value, 'orinadia');
    validarCampo(expresiones.orinanoche, inputOrinaNoche.value, 'orinanoche');
    validarCampo(expresiones.orinacolor, inputOrinaColor.value, 'orinacolor');
    validarCampo(expresiones.orinaolor, inputOrinaOlor.value, 'orinaolor');
    validarCampo(expresiones.orinamolestias, inputOrinaMolestias.value, 'orinamolestias');
    validarCampo(expresiones.excrementoaldia, inputExcrementoDia.value, 'excrementoaldia');
    validarCampo(expresiones.excrementoconsistencia, inputExcrementoConsistencia.value, 'excrementoconsistencia');
    validarCampo(expresiones.excrementoolor, inputExcrementoOlor.value, 'excrementoolor');
    validarCampo(expresiones.excrementocolor, inputExcrementoColor.value, 'excrementocolor');
    validarCampo(expresiones.excrementodolor, inputExcrementoDolor.value, 'excrementodolor');
    validarCampo(expresiones.ejercicio, inputEjercicio.value, 'ejercicio');
    
}
function deshabilitarFuma() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            if (inputFuma.value === "0") { // NO FUMA
                inputCigarros.disabled = true;
                inputCigarros.value = "0";
                campos.cigarros = true;
                expresiones.cigarros = /^$|^\d{1,2}$/;
                validarCampo(expresiones.cigarros,inputCigarros.value,'cigarros');
                inputCigarrosAntiguedad.disabled=true;
                inputCigarrosAntiguedad.value='';
                campos.cigarrosantiguedad=true;
                expresiones.cigarrosantiguedad=/^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,45}$/;
                validarCampo(expresiones.cigarrosantiguedad,inputCigarrosAntiguedad.value,'cigarrosantiguedad');
                resolve(); // Resolvemos la promesa si la operación se realizó con éxito
            } else {
                inputCigarros.disabled = false;
                // inputCigarros.value = "";
                campos.cigarros = false;
                expresiones.cigarros = /^\d{1,2}$/;

                inputCigarrosAntiguedad.disabled=false;
                // inputCigarrosAntiguedad.value="";
                campos.cigarrosantiguedad=false;
                expresiones.cigarrosantiguedad=/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,45}$/;
                resolve(); // Resolvemos la promesa si la operación se realizó con éxito
            }
        }, 2000); // Demora de 1 segundo
    });
}

function deshabilitarAlcohol() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            if (inputAlcohol.value === "0") { // NO FUMA
                inputFrecuencia.disabled = true;
                inputFrecuencia.value = "";
                campos.frecuencia = true;
                expresiones.frecuencia =  /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{0,45}$/;
                validarCampo(expresiones.frecuencia,inputFrecuencia.value,'frecuencia');

                inputCantidad.disabled = true;
                inputCantidad.value = "";
                campos.cantidad = true;
                expresiones.cantidad =  /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{0,45}$/;
                validarCampo(expresiones.cantidad,inputCantidad.value,'cantidad');

                inputTipos.disabled = true;
                inputTipos.value = "";
                campos.tipos = true;
                expresiones.tipos =  /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{0,45}$/;
                validarCampo(expresiones.tipos,inputTipos.value,'tipos');
                resolve(); // Resolvemos la promesa si la operación se realizó con éxito
            } else {
                 inputFrecuencia.disabled = false;
                // inputFrecuencia.value = "";
                campos.frecuencia = false;
                expresiones.frecuencia = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,45}$/;

                inputCantidad.disabled = false;
                // inputCantidad.value = "";
                campos.cantidad = false;
                expresiones.cantidad = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,45}$/;

                inputTipos.disabled = false;
                // inputTipos.value = "";
                campos.tipos = false;
                expresiones.tipos = /^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{1,45}$/;
                resolve(); // Resolvemos la promesa si la operación se realizó con éxito
            }
        }, 1000); // Demora
    });
}
function obtenerPaciente() {
    console.log("obtenerpaciente");
    fetch('./controller/obtener-paciente.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.id != null) {
                if (data.sexo != "femenino") {
                    console.log("femenino");
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
    expresiones.embarazos= /^$|^(1[0-5]?|[0-9])$/;
    expresiones.partos= /^$|^(1[0-5]?|[0-9])$/;
    expresiones.cesareas= /^$|^(1[0-5]?|[0-9])$/;
    expresiones.abortos= /^$|^(1[0-5]?|[0-9])$/;
    expresiones.muertos= /^$|^(1[0-5]?|[0-9])$/;
    expresiones.enfs= /^$|^(1[0-5]?|[0-9])$/;
    expresiones.menstruacion= /.*/;
    expresiones.menstruacionperiodicidad=  /^$|^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ0-9\s]{0,200}$/;
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
formFicha.addEventListener('submit', (e) => {
    e.preventDefault();
    validarFicha();
    var i = true;
    for (const key in campos) {
        if (campos[key] === false) {
            i = false;
            break;
        }
    }
    if (i) {
        inputs.forEach(input => {
            if (input.disabled) {
                input.disabled = false;
            }
        })
        enviarFormFicha();
    } else {
        modalError("campos",tipo.guardar);
    }
});



