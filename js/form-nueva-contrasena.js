const formulario=document.getElementById('form-nueva-contrasena');
const inputs=document.querySelectorAll('#form-nueva-contrasena input');

const expresiones = {
	password: /^.{4,12}$/, // 4 a 12 digitos.
}
const validarFormulario = (e)=>{
    switch(e.target.name){
        case "nuevacontrasena":
            validarCampo(expresiones.password, e.target, 'nuevacontrasena');
            validarContrasena2();
            break;
        case "nuevacontrasena2":
            validarContrasena2();
        break;
    }
}

const validarContrasena2 = () =>{
    const inputPassword1= document.getElementById('nuevacontrasena');
    const inputPassword2= document.getElementById('nuevacontrasena2');
    if(inputPassword1.value !== inputPassword2.value){
        document.getElementById(`grupo__nuevacontrasena2`).classList.add('formulario__grupo-incorrecto');
        document.getElementById(`grupo__nuevacontrasena2`).classList.remove('formulario__grupo-correcto');
        document.querySelector(`#grupo__nuevacontrasena2 i`).classList.add('fa-times')
        document.querySelector(`#grupo__nuevacontrasena2 i`).classList.remove('fa-check')
        document.querySelector(`#grupo__nuevacontrasena2 .formulario__input-error`).classList.add('formulario__input-error-activo');
        campos[nuevacontrasena]=false;
    }else{
        document.getElementById(`grupo__nuevacontrasena2`).classList.remove('formulario__grupo-incorrecto');
        document.getElementById(`grupo__nuevacontrasena2`).classList.add('formulario__grupo-correcto');
        document.querySelector(`#grupo__nuevacontrasena2 i`).classList.remove('fa-times')
        document.querySelector(`#grupo__nuevacontrasena2 i`).classList.add('fa-check')
        document.querySelector(`#grupo__nuevacontrasena2 .formulario__input-error`).classList.remove('formulario__input-error-activo');
        campos[nuevacontrasena]=true;
    }
}

const campos = {
    nuevacontrasena:false
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

    validarFormulario();
    if(campos.nuevacontrasena){
        document.querySelectorAll('formulario__grupo-correcto').forEach((icono) => {
            icono.classList.remove('formulario__grupo-correcto');
        });
    }else{
        e.preventDefault();

    }
});