var usuario;
const tipo = { obtener: "obtener", guardar: "guardar", eliminar: "eliminar" };
var botonGuardarUsuario = document.getElementById('boton-guardar-usuario');
formUsuario = document.getElementById('form-usuario');

window.onload = function () {
    obtenerUsuario();
};
function obtenerUsuario() {
    fetch('./controller/obtener-usuario.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                if ('username' in data) {
                    usuario = new Usuario();
                    usuario.username = data.username;
                    usuario.nombre = data.nombre;
                    usuario.apellidoPaterno = data.apellidoPaterno;
                    usuario.apellidoMaterno = data.apellidoMaterno;
                    usuario.telefono = data.telefono;
                    usuario.correo = data.correo;
                    usuario.tipoUsuario = data.tipoUsuario;
                    usuario.especialidad=data.especialidad;
                    usuario.universidad=data.universidad;
                    usuario.cedula=data.cedula;
                    inputUsername.value = usuario.username;
                    inputNombre.value = usuario.nombre;
                    inputApellidoPaterno.value = usuario.apellidoPaterno;
                    inputApellidoMaterno.value = usuario.apellidoMaterno;
                    inputTelefono.value = usuario.telefono;
                    inputCorreo.value = usuario.correo;
                    inputTipo.value = usuario.tipoUsuario;
                    inputEspecialidad.value=usuario.especialidad;
                    inputUniversidad.value=usuario.universidad;
                    inputCedula.value=usuario.cedula;
                    console.log(usuario.cedula);
                    validarUsuarioExistente();
                    validarUsuario();
                    validarMedico();
                } else {
                    modalError(data, tipo.obtener);
                }
            }
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener)
        });
}
// FUNCION ENVIAR FORMULARIO A BD //
// FUNCION ENVIAR FORMULARIO A BD //
function enviarFormUsuario() {
    datosUsuario = new FormData(formUsuario);
    if (usuario != null) {
        fetch('./controller/editar-usuario.php', {
            method: 'POST',
            body: datosUsuario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                if (data != null) {
                    if ('username' in data) {
                        usuario = new Usuario();
                        usuario.username = data.username;
                        usuario.nombre = data.nombre;
                        usuario.apellidoPaterno = data.apellidoPaterno;
                        usuario.apellidoMaterno = data.apellidoMaterno;
                        usuario.telefono = data.telefono;
                        usuario.correo = data.correo;
                        usuario.tipoUsuario = data.tipoUsuario;
                        modalExito();
                    } else {
                        console.log(data);
                        modalError(data, tipo.guardar);
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
                modalError(error, tipo.guardar);
            });
    } else {
        fetch('./controller/nuevo-usuario.php', {
            method: 'POST',
            body: datosUsuario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                if (data != null) {
                    const expresion=/SQLSTATE\[23000\]/;
                    if (expresion.test(data)){
                        modalError("duplicate", tipo.guardar);
                    }
                    else if ('username' in data) {
                        usuario = new Usuario();
                        usuario.username = data.username;
                        usuario.nombre = data.nombre;
                        usuario.apellidoPaterno = data.apellidoPaterno;
                        usuario.apellidoMaterno = data.apellidoMaterno;
                        usuario.telefono = data.telefono;
                        usuario.correo = data.correo;
                        usuario.tipoUsuario = data.tipoUsuario;
                        usuario.especialidad=data.especialidad;
                        usuario.universidad=data.universidad;
                        usuario.cedula=data.cedula;
                        modalExito();
                    }else {
                        console.log(data);
                        modalError(data, tipo.guardar);
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
                modalError(error, tipo.guardar);
            });
    }
};
// FUNCION ENVIAR FORMULARIO A BD //
// FUNCION ENVIAR FORMULARIO A BD //

//MODAL
var modal = document.getElementById("modal");
var modalContent = document.getElementById("modal-contenido");
const botonModalCerrar = document.createElement('button');
botonModalCerrar.textContent = "Cerrar";
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function modalExito() {
    clearDiv(modalContent);
    botonModalCerrar.className = "boton azul modal-cerrar";
    modalContent.classList.remove('modal-contenido-error');
    modalContent.classList.add('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-un-column');
    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');

    titulo.textContent = "¡Usuario guardado!";
    parrafo.textContent = "Los datos se han almacenado con éxito.";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalCerrar);
    modalContent.appendChild(divBoton);
}
function modalError(error, tipo) {
    clearDiv(modalContent);
    botonModalCerrar.className = "boton blanco modal-cerrar";
    modalContent.classList.remove('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-error');
    modalContent.classList.add('modal-contenido-un-column');

    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    // const iconoAlerta = document.createElement('i');
    // iconoAlerta.className = "fa-solid fa-bell";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";
    if (tipo == "guardar") {
        titulo.textContent = '¡Los cambios NO han sido guardados!';
    } else if (tipo == "obtener") {
        titulo.textContent = '¡La información no pudo ser obtenida!';
    }
    if (error == "campos") {
        parrafo.textContent = "Porfavor, revisa todos los campos e intenta de nuevo.";
    }else if(error=="duplicate"){
        parrafo.textContent = "El nombre de usuario ya existe, porfavor ingresa uno nuevo.";
    }
    else if (error != "false" || error!=null) {
        parrafo.textContent = "Contacta a tu administrador, Error: " + error;
    } else {
        parrafo.textContent = "Porfavor, revisa la información e intenta de nuevo.";
    }
    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalCerrar);
    modalContent.appendChild(divBoton);
}
modal.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("modal-cerrar")) {
        modal.style.display = "none";
    }
})
//FUNCION BORRAR DIV
function clearDiv(div) {
    div.replaceChildren();
}
//MODAL END

class Usuario {
    set username(username) {
        this._username = username;
    }
    get username() {
        return this._username;
    }
    set nombre(nombre) {
        this._nombre = nombre;
    }
    get nombre() {
        return this._nombre;
    }
    set apellidoPaterno(apellidoPaterno) {
        this._apellidoPaterno = apellidoPaterno;
    }
    get apellidoPaterno() {
        return this._apellidoPaterno;
    }
    set apellidoMaterno(apellidoMaterno) {
        this._apellidoMaterno = apellidoMaterno;
    }
    get apellidoMaterno() {
        return this._apellidoMaterno;
    }
    set telefono(telefono) {
        this._telefono = telefono;
    }
    get telefono() {
        return this._telefono;
    }
    set correo(correo) {
        this._correo = correo;
    }
    get correo() {
        return this._correo;
    }
    set tipoUsuario(tipoUsuario) {
        this._tipoUsuario = tipoUsuario;
    }
    get tipoUsuario() {
        return this._tipoUsuario;
    }
    set especialidad(especialidad){
        this._especialidad=especialidad;
    }
    get especialidad(){
        return this._especialidad;
    }
    set universidad(universidad){
        this._universidad=universidad;
    }
    get universidad(){
        return this._universidad;
    }
    set cedula(cedula){
        this._cedula=cedula;
    }
    get cedula(){
       return this._cedula;
    }
}