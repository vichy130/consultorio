var user;
botonIniciarSesion = document.getElementById('boton-iniciar-sesion');

function enviarFormIniciarSesion() {
    datosIniciarSesion = new FormData(formIniciarSesion);
    fetch('./controller/obtener-sesion.php', {
        method: 'POST',
        body: datosIniciarSesion
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            console.log(data);
            if(data===true){
                index();
            }else{
                datosIncorrectosActivo();
            }
      
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
}
function index() {
    window.location.href = "./index.php";
}

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