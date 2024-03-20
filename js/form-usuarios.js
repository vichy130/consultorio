var tUsuarios = document.getElementById('tabla-usuarios');
var notabla = document.getElementById('no-tabla');
var arrayUsuarios = [];
var botonNuevoUsuario = document.getElementById('boton-nuevo-usuario');

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerUsuarios();
};
function obtenerUsuarios() {
    console.log("OBTENER");
    fetch('./controller/obtener-usuarios.php')
        .then(response => response.json())
        .then(data => {
            data.forEach(element => {
                usuario = new Usuario();
                usuario.username = element.username;
                usuario.nombre = element.nombre;
                usuario.apellidoPaterno = element.apellidoPaterno;
                usuario.apellidoMaterno = element.apellidoMaterno;
                usuario.telefono = element.telefono;
                usuario.correo = element.correo;
                usuario.tipoUsuario = element.tipoUsuario;
                arrayUsuarios.push(usuario);
            });
            tablaUsuarios();
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
tUsuarios.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains('editar-usuario')) {
        usuarioEditar(e.target.dataset.id);
    }
    if (e.target.classList.contains('eliminar-usuario')) {
        usuarioEliminar(e.target.dataset.id);
    }
});
botonNuevoUsuario.addEventListener('click', function (e) {
    e.preventDefault();
    usuar();
});
function tablaUsuarios() {
    tUsuarios.replaceChildren();
    if (arrayUsuarios.length>0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const username = document.createElement('th');
        const nombre = document.createElement('th');
        const telefono = document.createElement('th');
        const correo = document.createElement('th');
        const tipoUsuario = document.createElement('th');
        const editar = document.createElement('th');
        const eliminar = document.createElement('th');
        username.textContent="Usuario";
        nombre.textContent="Nombre";
        telefono.textContent="Teléfono";
        correo.textContent="Email";
        tipoUsuario.textContent="Tipo de usuario";
        editar.textContent="Editar";
        eliminar.textContent="Eliminar";
        telefono.className="column-to-hide";
        correo.className="column-to-hide";
        propiedades.appendChild(username);
        propiedades.appendChild(nombre);
        propiedades.appendChild(telefono);
        propiedades.appendChild(correo);
        propiedades.appendChild(tipoUsuario);
        propiedades.appendChild(editar);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tUsuarios.appendChild(thead);

        const tbody = document.createElement('tbody');

        arrayUsuarios.forEach(u => {
            const celda = document.createElement('tr');
            const usernameFila = document.createElement('td');
            const nombreFila = document.createElement('td');
            const telefonoFila = document.createElement('td');
            const correoFila = document.createElement('td');
            const tipoUsuarioFila = document.createElement('td');
            const editarFila = document.createElement('td');
            const eliminarFila = document.createElement('td');

            const iconoEditar = document.createElement('i');
            const iconoEliminar = document.createElement('i');

            iconoEditar.className = "fas fa-edit editar-usuario";
            iconoEliminar.className = "fas fa-trash eliminar-usuario";

            iconoEditar.dataset.id = u.username;
            iconoEliminar.dataset.id = u.username;

            usernameFila.textContent = u.username;
            nombreFila.textContent = u.nombre + " " + u.apellidoPaterno + " " + u.apellidoMaterno;
            telefonoFila.textContent = u.telefono;
            correoFila.textContent = u.correo;
            tipoUsuarioFila.textContent = u.tipoUsuario;

            editarFila.append(iconoEditar);
            eliminarFila.append(iconoEliminar);

            celda.append(usernameFila);
            celda.append(nombreFila);
            celda.append(telefonoFila);
            celda.append(correoFila);
            celda.append(tipoUsuarioFila);
            celda.append(editarFila);
            celda.append(eliminarFila);
            tbody.append(celda);
        });
        tUsuarios.appendChild(tbody);
    }else{
        const mensaje=document.createElement('p');
        mensaje.textContent="No existen registros";
        notabla.appendChild(mensaje);
    }
}
function usuar() {
    window.location.href = './usuario.php';
}
function usuarioEditar(idEditar) {
    window.location.href = './usuario.php?id=' + idEditar;
}
function usuarioEliminar(idEliminar) {
    var datos = { id: idEliminar };
    jsonDatos = JSON.stringify(datos);
    fetch('./controller/eliminar-usuario.php', {
        method: 'POST',
        body: jsonDatos
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            arrayUsuarios = [];
            obtenerUsuarios();
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
}
function clearDiv(div) {
    div.replaceChildren();
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