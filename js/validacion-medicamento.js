const inputs=document.querySelectorAll('#form-medicamento input, #form-medicamento select, #form-medicamento textarea');
var inputNombre=document.getElementById('nombre-medicamento');
var inputTipo=document.getElementById('tipo-medicamento');
var inputDescripcion=document.getElementById('medicamento-descripcion');
var formMedicamento=document.getElementById('form-medicamento');


const campos={
    nombre:false,
    tipo:false,
    descripcion:false,
}
const expresiones= {
    nombre: /^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]{3,100}$/,
    tipo:/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]{3,500}$/,
    descripcion:/^[a-zA-Z0-9áéíóúÁÉÍÓÚüÜñÑ\s]{3,500}$/

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
        case "nombre-medicamento":
            validarCampo(expresiones.nombre, e.target.value, 'nombre');
            break;
        case "tipo-medicamento":
            validarCampo(expresiones.tipo, e.target.value, 'tipo');
            break;
        case "medicamento-descripcion":
            validarCampo(expresiones.descripcion, e.target.value, 'descripcion');
            break;
    }
}
function validarMedicamento(){
    validarCampo(expresiones.nombre, inputNombre.value, 'nombre');
    validarCampo(expresiones.tipo, inputTipo.value, 'tipo');
    validarCampo(expresiones.descripcion, inputDescripcion.value, 'descripcion');
}
inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

formMedicamento.addEventListener('submit', (e)=>{
    e.preventDefault();
    validarMedicamento();
    var i=true;
    for (const key in campos) {
        if (campos[key] === false) {
            i = false;
            break;
        }
    }
    if(i){
        enviarFormMedicamento();
    }else{
        validarMedicamento();
        modalError("campos", tipo.guardar);
    }
});