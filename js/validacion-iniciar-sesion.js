const formIniciarSesion = document.getElementById('form-iniciar-sesion');
const inputs = document.querySelectorAll('#form-iniciar-sesion input');
const inputUsername = document.getElementById('username');
const inputContrasena = document.getElementById('contrasena');
var datosIncorrectos = document.getElementById('grupo_datos-incorrectos');
var captchaError = document.getElementById('grupo_captcha-error');

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
    password: /^.{8,16}$/, // 8 a 16 digitos.
}
const validarFormulario = (e) => {
    switch (e.target.name) {
        case "username":
            validarCampo(expresiones.usuario, e.target, 'usuario');
            break;
        case "contrasena":
            validarCampo(expresiones.password, e.target, 'contrasena');
            break;
    }
}
const campos = {
    usuario: false,
    contrasena: false
}
const validarCampo = (expresion, input, campo) => {
    captchaError.classList.remove('formulario_captcha-error-activo');
    captchaError.classList.add('formulario_captcha-error');

    if (expresion.test(input.value)) {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times')
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check')
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo] = true;
    } else {
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times')
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check')
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo] = false;
    }
}
function datosIncorrectosActivo() {
    datosIncorrectos.classList.add('formulario_datos-incorrectos-activo');
    datosIncorrectos.classList.remove('formulario_datos-incorrectos');
}
function captchaErrorActivo() {
    captchaError.classList.add('formulario_captcha-error-activo');
    captchaError.classList.remove('formulario_captcha-error');
}
inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
    input.addEventListener('change', function (e){
        datosIncorrectos.classList.remove('formulario_datos-incorrectos-activo');
        datosIncorrectos.classList.add('formulario_datos-incorrectos');
    })
});

function validarIniciarSesion() {
    validarCampo(expresiones.usuario, inputUsername.value, 'usuario');
    validarCampo(expresiones.password, inputContrasena.value, 'contrasena');
}
formIniciarSesion.addEventListener('submit', (e) => {
    e.preventDefault();
    validarIniciarSesion() 
    var i = true;
    for (key in campos) {
        if (campos[key] === false) {
            i = false;
            break;
        }
    }
    // Validar reCAPTCHA
    // var response = grecaptcha.getResponse();
    // if (response.length === 0) {
    //     i = false;
    //     captchaErrorActivo();
    //     console.log("error activo")
    // 
    // }
    //      else 
    if (i) {
        enviarFormIniciarSesion();
    } else {
        validarIniciarSesion();
    }
});