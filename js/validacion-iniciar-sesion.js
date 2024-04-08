const formIniciarSesion=document.getElementById('form-iniciar-sesion');
const inputs=document.querySelectorAll('#form-iniciar-sesion input');
const inputUsername=document.getElementById('username');
const inputContrasena=document.getElementById('contrasena');
var datosIncorrectos=document.getElementById('grupo_datos-incorrectos');

const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	password: /^.{4,12}$/, // 4 a 12 digitos.
}
const validarFormulario = (e)=>{
    switch(e.target.name){
        case "username":
            validarCampo(expresiones.usuario, e.target, 'usuario');
        break;
        case "contrasena":
            validarCampo(expresiones.password, e.target, 'contrasena');
        break;
    }
}
const campos = {
    usuario:false,
    contrasena: false
}
const validarCampo = (expresion, input, campo) => {
    datosIncorrectos.classList.remove('formulario_datos-incorrectos-activo');
    datosIncorrectos.classList.add('formulario_datos-incorrectos');
    if(expresion.test(input.value)){
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-correcto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-incorrecto');
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-times')
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-check')
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[campo]=true;
    }else{
        document.getElementById(`grupo__${campo}`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__${campo}`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__${campo} i`).classList.add('fa-times')
        document.querySelector(`#grupo__${campo} i`).classList.remove('fa-check')
        document.querySelector(`#grupo__${campo} .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[campo]=false;
    }
}
function datosIncorrectosActivo(){
    datosIncorrectos.classList.add('formulario_datos-incorrectos-activo');
    datosIncorrectos.classList.remove('formulario_datos-incorrectos');
}
inputs.forEach((input)=>{
    input.addEventListener('keyup',validarFormulario);
    input.addEventListener('blur',validarFormulario);
    
});
function validarIniciarSesion(){
    validarCampo(expresiones.usuario,inputUsername.value, 'usuario');
    validarCampo(expresiones.password,inputContrasena.value,'contrasena');
}
formIniciarSesion.addEventListener('submit', (e)=>{
    e.preventDefault();
    var i=true;
    for(key in campos){
        if(campos[key]===false){
            i=false;
            break;
        }
    }
    if(i){
        enviarFormIniciarSesion();
    }else{
        validarIniciarSesion();
        console.log("no se pudo enviar");
    }
});