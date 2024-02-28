const formPaciente = document.getElementById('form-paciente');
const inputsPaciente = document.querySelectorAll('#form-paciente input');
const radio=document.getElementsByName('sexo');
const expresiones = {
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    apellidop: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    apellidom: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    nacimiento: /\S/,
    lugar: /^[a-zA-ZÀ-ÿ\s]{1,40}$/,
    calle: /^[a-zA-Z0-9#]{1,45}$/,
    colonia: /^[a-zA-Z0-9]{1,45}$/,
    ciudad: /^[a-zA-Z0-9]{1,45}$/,
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
formPaciente.addEventListener('submit', (e) => {
    e.preventDefault();
    if (campos.nombre && campos.apellidop && campos.apellidom && campos.nacimiento && campos.lugar && campos.calle && campos.colonia && campos.ciudad && campos.cp && campos.casa && campos.oficina && campos.celular && campos.estadoCivil && campos.ocupacion && campos.escolaridad && campos.email) {
        enviarFormPaciente();
    } else {
        //todo
        console.log("No se cumplieron los campos");
    }
});