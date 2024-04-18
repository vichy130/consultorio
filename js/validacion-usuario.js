const formUsuario = document.getElementById('form-usuario');
const inputs = document.querySelectorAll('#form-usuario input, #form-usuario select');
var inputUsername = document.getElementById('username-usuario');
var inputNombre = document.getElementById('nombre-usuario');
var inputApellidoPaterno = document.getElementById('apellidoPaterno-usuario');
var inputApellidoMaterno = document.getElementById('apellidoMaterno-usuario');
var inputTelefono = document.getElementById('telefono-usuario');
var inputTipo = document.getElementById('tipo-usuario');
var inputCorreo = document.getElementById('correo-usuario');
var inputContrasenaUno = document.getElementById('contrasena-usuario');
var inputContrasenaDos = document.getElementById('contrasena-usuario2');
var inputEspecialidad=document.getElementById('especialidad-usuario');
var inputUniversidad=document.getElementById('universidad-usuario');
var inputCedula=document.getElementById('cedula-usuario');

inputTipo.addEventListener('change', validarMedico);
const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellidoPaterno: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    apellidoMaterno: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    contrasena: /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,16}$/, // 8 a 16 digitos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7,14}$/, // 7 a 14 numeros.
    tipo: /^[a-zA-Z]$/,
    especialidad: /^$|^[a-zA-ZÀ-ÿ\s]{0,100}$/,
    universidad: /^$|^[a-zA-ZÀ-ÿ\s]{0,100}$/,
    cedula: /^$|^\d{0,10}$/
}
const campos = {
    usuario: false,
    nombre: false,
    apellidoPaterno: false,
    apellidoMaterno: false,
    contrasena: false,
    contrasena2: true,
    correo: false,
    telefono: false,
    tipo: false,
    especialidad: true,
    universidad: true,
    cedula: true
}
function validarUsuarioExistente() {
    campos.contrasena = true;
    expresiones.contrasena = /^(.{8,12})?$/;
}
const validarFormulario = (e) => {
    switch (e.target.name) {
        case "username-usuario":
            validarCampo(expresiones.usuario, e.target.value, 'usuario');
            break;
        case "nombre-usuario":
            validarCampo(expresiones.nombre, e.target.value, 'nombre');
            break;
        case "apellidoPaterno-usuario":
            validarCampo(expresiones.apellidoPaterno, e.target.value, 'apellidoPaterno');
            break;
        case "apellidoMaterno-usuario":
            validarCampo(expresiones.apellidoMaterno, e.target.value, 'apellidoMaterno');
            break;
        case "telefono-usuario":
            validarCampo(expresiones.telefono, e.target.value, 'telefono');
            break;
        case "tipo-usuario":
            validarCampo(expresiones.tipo, e.target.value, 'tipo');
            break;
        case "correo-usuario":
            validarCampo(expresiones.correo, e.target.value, 'correo');
            break;
        case "especialidad-usuario":
            validarCampo(expresiones.especialidad, inputEspecialidad.value, 'especialidad');
            break;
        case "universidad-usuario":
            validarCampo(expresiones.universidad, inputUniversidad.value, 'universidad');
            break;
        case "cedula-usuario":
            validarCampo(expresiones.cedula, inputCedula.value, 'cedula');
            break;
        case "contrasena-usuario":
            validarCampo(expresiones.contrasena, e.target.value, 'contrasena');
            validarConstrasena2();
            break;
        case "contrasena-usuario2":
            validarConstrasena2();
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
    if (inputContrasenaUno.value !== inputContrasenaDos.value) {
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
function validarMedico(){
    if(inputTipo.value=='M'){
        expresiones.especialidad=/^[a-zA-ZÀ-ÿ\s]{3,100}$/;
        campos.especialidad=false;
        inputEspecialidad.disabled=false;

        expresiones.universidad=/^[a-zA-ZÀ-ÿ\s]{3,100}$/;
        campos.universidad=false;
        inputUniversidad.disabled=false; 

        expresiones.cedula=/^\d{6,10}$/;
        campos.cedula=false;
        inputCedula.disabled=false;
    }else{
        expresiones.especialidad=/^$|^[a-zA-ZÀ-ÿ\s]{0,100}$/;
        campos.especialidad=true;
        inputEspecialidad.disabled=true;
        inputEspecialidad.value="";
        validarCampo(expresiones.especialidad, inputEspecialidad.value, 'especialidad');

        expresiones.universidad= /^$|^[a-zA-ZÀ-ÿ\s]{0,100}$/;
        campos.universidad=true;
        inputUniversidad.disabled=true; 
        inputUniversidad.value="";
        validarCampo(expresiones.universidad, inputUniversidad.value, 'universidad');

        expresiones.cedula=/^$|^\d{0,10}$/;
        campos.cedula=true;
        inputCedula.disabled=true;
        inputCedula.value="";
        validarCampo(expresiones.cedula, inputCedula.value, 'cedula');
    }
}
function validarUsuario() {
    validarCampo(expresiones.usuario, inputUsername.value, 'usuario');
    validarCampo(expresiones.nombre, inputNombre.value, 'nombre');
    validarCampo(expresiones.apellidoPaterno, inputApellidoPaterno.value, 'apellidoPaterno');
    validarCampo(expresiones.apellidoMaterno, inputApellidoMaterno.value, 'apellidoMaterno');
    validarCampo(expresiones.telefono, inputTelefono.value, 'telefono');
    validarCampo(expresiones.tipo, inputTipo.value, 'tipo');
    validarCampo(expresiones.correo, inputCorreo.value, 'correo');
    validarCampo(expresiones.contrasena, inputContrasenaUno.value, 'contrasena');
    validarCampo(expresiones.especialidad, inputEspecialidad.value, 'especialidad');
    validarCampo(expresiones.universidad, inputUniversidad.value, 'universidad');
    validarCampo(expresiones.cedula, inputCedula.value, 'cedula');
    validarConstrasena2();
}
formUsuario.addEventListener('submit', (e) => {
    e.preventDefault();
    validarMedico();
    validarUsuario();
    var i = true;
    for (key in campos) {
        if (campos[key] === false) {
            i = false;
            console.log(i);
            break;
        }
    }
    if (i) {
        enviarFormUsuario();
    } else {
        console.log("else en formusuario")
        validarMedico();
        validarUsuario();
        modalError("campos", tipo.guardar);
    }
});