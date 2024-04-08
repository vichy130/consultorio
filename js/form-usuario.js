var usuario;
var botonGuardarUsuario=document.getElementById('boton-guardar-usuario');
formUsuario=document.getElementById('form-usuario');

window.onload = function () {
    obtenerUsuario();
};
function obtenerUsuario(){
    fetch('./controller/obtener-usuario.php')
    .then(response => response.json())
    .then(data => {
        if (data != null) {
            usuario = new Usuario();
            usuario.username = data.username;
            usuario.nombre = data.nombre;
            usuario.apellidoPaterno = data.apellidoPaterno;
            usuario.apellidoMaterno = data.apellidoMaterno;
            usuario.telefono = data.telefono;
            usuario.correo = data.correo;
            usuario.tipoUsuario = data.tipoUsuario;
            inputUsername.value=usuario.username;
            inputNombre.value=usuario.nombre;
            inputApellidoPaterno.value=usuario.apellidoPaterno;
            inputApellidoMaterno.value=usuario.apellidoMaterno;
            inputTelefono.value=usuario.telefono;
            inputCorreo.value=usuario.correo;
            inputTipo.value=usuario.tipoUsuario;
            validarUsuarioExistente();
            validarUsuario();
        }
    })// FIN FETCH
    .catch(error => {
        console.error('Error:', error);
        console.log("catch");
    });
}
// FUNCION ENVIAR FORMULARIO A BD //
// FUNCION ENVIAR FORMULARIO A BD //
function enviarFormUsuario(){
    datosUsuario=new FormData(formUsuario);
    console.log(datosUsuario);
    if(usuario!=null){
        fetch('./controller/editar-usuario.php', {
            method:'POST',
            body:datosUsuario
        })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            console.log(data);
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    }else{
        fetch('./controller/nuevo-usuario.php', {
            method:'POST',
            body:datosUsuario
        })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            console.log(data);
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    }
};
// FUNCION ENVIAR FORMULARIO A BD //
// FUNCION ENVIAR FORMULARIO A BD //
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
}