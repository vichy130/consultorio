const formFicha= document.getElementById('form-ficha');

const inputs = document.querySelectorAll('#form-ficha input, #form-ficha select');

const expresiones = {
    recomendo:/^[a-zA-ZÀ-ÿ\s]{1,100}$/,
    tipo:/^[a-zA-Z-+]+$/,
    hijoedad:/^(?:0|[1-9]\d?|1[01]\d|120)$/,
    hijosexo:/^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    embarazos:/^(?:0|1?\d|20)?$/,
    partos:/^(?:0|1?\d|20)?$/,
    cesareas: /^(?:0|1?\d|20)?$/,
    abortos:/^(?:0|1?\d|20)?$/,
    muertos:/^(?:0|1?\d|20)?$/,
    enfs:/^(?:0|1?\d|20)?$/,
    menstruacion:/^(\d{4}-\d{2}-\d{2})?$/,
    menstruacionperiodicidad:/^$|^[a-zA-Z0-9]{1,200}$/,
    menstruacionmolestias:/^$|^[a-zA-Z0-9]{1,200}$/,
    fuma:/^[a-zA-Z]$/,
    cigarros:/^$|^\d{1,2}$/,
    cigarrosantiguedad: /^$|^[a-zA-Z0-9]{1,45}$/,
    frecuencia:/^$|^[a-zA-Z0-9]{1,45}$/,
    cantidad:/^$|^[a-zA-Z0-9]{1,45}$/

}
const campos = {
    recomendo:false,
    tipo: false,
    embarazos: true,
    partos: true,
    cesareas: true,
    abortos:true,
    muertos:true,
    enfs: true,
    menstruacion: true,
    menstruacionperiodicidad:true,
    menstruacionmolestias: true,
    cigarros:false,
    cigarrosantiguedad:false,
    frecuencia: true,
    cantidad: true,

}
const camposHijo={
    hijoedad: false,
    hijosexo:false,
}
const validarFormulario = (e) => {
    switch (e.target.name) {
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
    }
}
const validarCampo = (expresion, input, campo) => {
    if (expresion.test(input)) {
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-correcto');
        document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.remove('fa-circle-xmark');
        document.querySelector(`#grupo_${campo} .form_validacion-estado`).classList.add('fa-circle-check'); document.querySelector(`#grupo_${campo} .form_input-error`).classList.remove('form_input-error-activo');
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

const validarConstrasena2 = () => {
    const inputContrasena1 = document.getElementById('contrasena-usuario');
    const inputContrasena2 = document.getElementById('contrasena-usuario2');
    if (inputContrasena1.value !== inputContrasena2.value) {
        document.getElementById(`grupo_contrasena2`).classList.add('formulario_grupo-incorrecto');
        document.getElementById(`grupo_contrasena2`).classList.remove('formulario_grupo-correcto');
        document.querySelector(`#grupo_contrasena2 i`).classList.add('fa-circle-xmark');
        document.querySelector(`#grupo_contrasena2 i`).classList.remove('fa-circle-check');
        document.querySelector(`#grupo_contrasena2 .form_input-error`).classList.add('form_input-error-activo');
        campos['contrasena2'] = false;
    } else {
        document.getElementById(`grupo_contrasena2`).classList.remove('formulario_grupo-incorrecto');
        document.getElementById(`grupo_contrasena2`).classList.add('formulario_grupo-correcto');
        document.querySelector(`#grupo_contrasena2 i`).classList.remove('fa-circle-xmark');
        document.querySelector(`#grupo_contrasena2 i`).classList.add('fa-circle-check');
        document.querySelector(`#grupo_contrasena2 .form_input-error`).classList.remove('form_input-error-activo');
        campos['contrasena2'] = true;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

formFicha.addEventListener('submit', (e) => {
    e.preventDefault();
    if (true) {
        /*enviarFormUsuario();*/
        console.log("enviado");
    } else {
        console.log("NO se pudo enviar");
    }
});