const formUsuario = document.getElementById('form-usuario');
const inputs = document.querySelectorAll('#form-usuario input, #form-usuario select');

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellidoPaterno: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellidoMaterno: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    contrasena: /^.{8,12}$/, // 4 a 12 digitos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7,14}$/, // 7 a 14 numeros.
    tipo: /^[a-zA-Z]$/,
    firma: /(\.(jpg|jpeg|png))?$/
}
const campos = {
    usuario: false,
    nombre: false,
    apellidoPaterno: false,
    apellidoMaterno: false,
    contrasena: false,
    contrasena2: false,
    correo: false,
    telefono: false,
    tipo: false, 
    firma: false
}
const validarFormulario = (e) => {
    switch (e.target.name) {
        case "username-usuario":
        validarCampo(expresiones.usuario, e.target, 'usuario');
            break;
        case "nombre-usuario":
        validarCampo(expresiones.nombre, e.target, 'nombre');
            break;
        case "apellidoPaterno-usuario":
            validarCampo(expresiones.apellidoPaterno, e.target, 'apellidoPaterno');
            break;
        case "apellidoMaterno-usuario":
            validarCampo(expresiones.apellidoMaterno, e.target, 'apellidoMaterno');
            break;
        case "telefono-usuario":
            validarCampo(expresiones.telefono, e.target, 'telefono');
            break;
        case "tipo-usuario":
            validarCampo(expresiones.tipo, e.target, 'tipo');
            break;
        case "correo-usuario":
            validarCampo(expresiones.correo, e.target, 'correo');
            break;
        case "contrasena-usuario":
            validarCampo(expresiones.contrasena, e.target, 'contrasena');
            validarConstrasena2();
            break;
        case "contrasena-usuario2":
            validarConstrasena2();
            break;
        case "firma-usuario":
            validarCampo(expresiones.firma, e.target, 'firma');
            break;
    }
}
const validarCampo= (expresion, input, campo)=>{
    if (expresion.test(input.value)) {
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-correcto');
        document.querySelector(`#grupo_${campo} i`).classList.remove('fa-circle-xmark');
        document.querySelector(`#grupo_${campo} i`).classList.add('fa-circle-check');                document.querySelector(`#grupo_${campo} .form_input-error`).classList.remove('form_input-error-activo');
        campos[campo]=true;
    } else {
        document.getElementById(`grupo_${campo}`).classList.add('formulario_grupo-incorrecto');
        document.getElementById(`grupo_${campo}`).classList.remove('formulario_grupo-correcto');
        document.querySelector(`#grupo_${campo} i`).classList.add('fa-circle-xmark');
        document.querySelector(`#grupo_${campo} i`).classList.remove('fa-circle-check');
        document.querySelector(`#grupo_${campo} .form_input-error`).classList.add('form_input-error-activo');
        campos[campo]=false;
    }
}

const validarConstrasena2= ()=>{
    const inputContrasena1=document.getElementById('contrasena-usuario');
    const inputContrasena2=document.getElementById('contrasena-usuario2');
    if (inputContrasena1.value !== inputContrasena2.value){
        document.getElementById(`grupo_contrasena2`).classList.add('formulario_grupo-incorrecto');
        document.getElementById(`grupo_contrasena2`).classList.remove('formulario_grupo-correcto');
        document.querySelector(`#grupo_contrasena2 i`).classList.add('fa-circle-xmark');
        document.querySelector(`#grupo_contrasena2 i`).classList.remove('fa-circle-check');
        document.querySelector(`#grupo_contrasena2 .form_input-error`).classList.add('form_input-error-activo');
        campos['contrasena2']=false;
    }else{
        document.getElementById(`grupo_contrasena2`).classList.remove('formulario_grupo-incorrecto');
        document.getElementById(`grupo_contrasena2`).classList.add('formulario_grupo-correcto');
        document.querySelector(`#grupo_contrasena2 i`).classList.remove('fa-circle-xmark');
        document.querySelector(`#grupo_contrasena2 i`).classList.add('fa-circle-check');
        document.querySelector(`#grupo_contrasena2 .form_input-error`).classList.remove('form_input-error-activo');
        campos['contrasena2']=true;
    }
}

inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

formUsuario.addEventListener('submit', (e) => {
    e.preventDefault();
    if(campos.usuario && campos.nombre && campos.apellidoPaterno && campos.apellidoPaterno && campos.contrasena && campos.contrasena2 && campos.correo && campos.firma){
        enviarFormUsuario();
    }else{
       //todo
    }
});