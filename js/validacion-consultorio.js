const inputs = document.querySelectorAll('#form-consultorio input');
var formConsultorio=document.getElementById('form-consultorio');
var inputNombre= document.getElementById('nombre-consultorio');
var inputCalle= document.getElementById('calle-consultorio');
var inputColonia=document.getElementById('colonia-consultorio');
var inputCiudad=document.getElementById('ciudad-consultorio');
var inputCP=document.getElementById('cp-consultorio');
var inputTelefono=document.getElementById('telefono-consultorio');

const campos={
    nombre:false,
    calle:false,
    colonia:false,
    ciudad:false,
    cp:false,
    telefono:false
}
const expresiones= {
    nombre: /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]{3,100}$/,
    calle:/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]{3,45}$/,
    colonia:/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]{3,45}$/,
    ciudad:/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]{3,45}$/,
    cp:/^\d{5}$/,
    telefono:/^\d{7,14}$/,
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
const validarFormulario = (e) => {
    switch (e.target.name) {
        case "nombre-consultorio":
            validarCampo(expresiones.nombre, e.target.value, 'nombre');
            break;
        case "calle-consultorio":
            validarCampo(expresiones.calle, e.target.value, 'calle');
            break;
        case "colonia-consultorio":
            validarCampo(expresiones.colonia, e.target.value, 'colonia');
            break;
        case "ciudad-consultorio":
            validarCampo(expresiones.ciudad,e.target.value, 'ciudad');
            break;
        case "cp-consultorio":
            validarCampo(expresiones.cp, e.target.value, 'cp');
            break;
        case "telefono-consultorio":
            validarCampo(expresiones.telefono, e.target.value, 'telefono');
            break;

    }
}
inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});
function validarConsultorio(){
    validarCampo(expresiones.nombre, inputNombre.value, 'nombre');
    validarCampo(expresiones.calle, inputCalle.value, 'calle');
    validarCampo(expresiones.colonia, inputColonia.value, 'colonia');
    validarCampo(expresiones.ciudad, inputCiudad.value, 'ciudad');
    validarCampo(expresiones.cp, inputCP.value, 'cp');
    validarCampo(expresiones.telefono, inputTelefono.value, 'telefono');
}
formConsultorio.addEventListener('submit', (e)=>{
    e.preventDefault();
    var i = true;
    for (const key in campos) {
        if (campos[key] === false) {
            i = false;
            break;
        }
    }
    if(i){
        enviarFormConsultorio();
        console.log("enviado");
    }else{
        validarConsultorio();
        console.log("NO se pudo enviar");
    }

});