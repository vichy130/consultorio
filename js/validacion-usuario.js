const formUsuario = document.getElementById('form-usuario');
const inputs = document.querySelectorAll('#form-usuario input, #form-usuario select');

const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
    nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
    password: /^.{4,12}$/, // 4 a 12 digitos.
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
    telefono: /^\d{7,14}$/ // 7 a 14 numeros.
}
const validarFormulario = (e) => {
    switch (e.target.name) {
        case "username-usuario":
            break;
        case "nombre-usuario":
            break;
        case "apellidoPaterno-usuario":
            break;
        case "apellidoMaterno-usuario":
            break;
        case "telefono-usuario":
            break;
        case "tipo-usuario": 
            break;
        case "correo-usuario":
            break;
        case "contrasena-usuario":
            break;
        case "contrasena-usuario2":
            break;
        case "firma-usuario":
            break;
    }
}
inputs.forEach((input) => {
    input.addEventListener('keyup', validarFormulario);
    input.addEventListener('blur', validarFormulario);
});

formUsuario.addEventListener('submit', (e) => {
    e.preventDefault();
});