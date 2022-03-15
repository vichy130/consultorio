const formulario=document.getElementById('form');
const inputs=document.querySelectorAll('#form input');

const expresiones = {
	usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
	nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
	password: /^.{4,12}$/, // 4 a 12 digitos.
	correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
	telefono: /^\d{7,14}$/ // 7 a 14 numeros.
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

inputs.forEach((input)=>{
    input.addEventListener('keyup',validarFormulario);
    input.addEventListener('blur',validarFormulario);
});


formulario.addEventListener('submit', (e)=>{
    // e.preventDefault();
    validarFormulario();
    if(campos.usuario && campos.contrasena){
        document.querySelectorAll('formulario__grupo-correcto').forEach((icono) => {
            icono.classList.remove('formulario__grupo-correcto');
        });
    }else{
        e.preventDefault();
    }
});