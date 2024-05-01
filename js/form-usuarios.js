var tUsuarios = document.getElementById('tabla-usuarios');
var notabla = document.getElementById('no-tabla');
var botonBuscar = document.getElementById('boton-buscar-usuario');
var inputBuscar = document.getElementById('input-buscar');
var iconoBuscar = document.getElementById('icono-buscar');
var arrayUsuarios = [];
const tipo = { obtener: "obtener", guardar: "guardar", eliminar: "eliminar", imprimir: "imprimir" };
var botonNuevoUsuario = document.getElementById('boton-nuevo-usuario');
inputBuscar.addEventListener('keyup', iconoBuscarActivar);
inputBuscar.addEventListener('blur', iconoBuscarActivar);
iconoBuscar.addEventListener('click', function (e) {
    e.preventDefault();
    inputBuscar.value = "";
    obtenerUsuarios();
    iconoBuscarActivar();
});
botonBuscar.addEventListener('click', function (e) {
    e.preventDefault();
    buscarUsuarios();
});
function iconoBuscarActivar() {
    if (inputBuscar.value == null || inputBuscar.value == "") {
        iconoBuscar.classList.add('form_validacion-buscar');
        iconoBuscar.classList.remove('form_validacion-buscar-activo');
    } else {
        iconoBuscar.classList.remove('form_validacion-buscar');
        iconoBuscar.classList.add('form_validacion-buscar-activo');
    }
}
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerUsuarios();
};
function obtenerUsuarios() {
    fetch('./controller/obtener-usuarios.php')
        .then(response => response.json())
        .then(data => {
            arrayUsuarios = [];
            data.forEach(element => {
                if ('username' in element) {
                    var usuario = new Usuario();
                    usuario.username = element.username;
                    usuario.nombre = element.nombre;
                    usuario.apellidoPaterno = element.apellidoPaterno;
                    usuario.apellidoMaterno = element.apellidoMaterno;
                    usuario.telefono = element.telefono;
                    usuario.correo = element.correo;
                    usuario.tipoUsuario = element.tipoUsuario;
                    arrayUsuarios.push(usuario);
                } else {
                    modalError(element, tipo.obtener);
                    return;
                }
            });
            tablaUsuarios();
        })// FIN FETCH
        .catch(error => {
            console.log(error);
            modalError(error, tipo.obtener);
        });
}
function buscarUsuarios() {
    stringBuscar = inputBuscar.value;
    var arrayBuscar = stringBuscar.split(" ")
    if (arrayBuscar.length < 6) {
        datos = JSON.stringify(arrayBuscar);
        fetch('./controller/buscar-usuarios.php', {
            method: 'POST',
            body: datos
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data != null) {
                    arrayUsuarios = [];
                    if (Array.isArray(data)) {
                        data.forEach(element => {
                            if ('username' in element) {
                                var usuario = new Usuario();
                                usuario.username = element.username;
                                usuario.nombre = element.nombre;
                                usuario.apellidoPaterno = element.apellidoPaterno;
                                usuario.apellidoMaterno = element.apellidoMaterno;
                                usuario.telefono = element.telefono;
                                usuario.correo = element.correo;
                                usuario.tipoUsuario = element.tipoUsuario;
                                arrayUsuarios.push(usuario);
                            } else {
                                modalError(element, tipo.obtener);
                                return;
                            }
                        });
                    }
                }
                tablaUsuarios();
            })
            .catch(function (error) {
                console.log(error);
            });
    } else {
        modalError("palabras", tipo.obtener);
    }
}
tUsuarios.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains('editar-usuario')) {
        usuarioEditar(e.target.dataset.id);
    }
    if (e.target.classList.contains('eliminar-usuario')) {
        modal.dataset.id = e.target.dataset.id;
        modal.dataset.nombre = e.target.dataset.nombre;
        modalBlock();
    }
});
botonNuevoUsuario.addEventListener('click', function (e) {
    e.preventDefault();
    usuar();
});
function tablaUsuarios() {
    tUsuarios.replaceChildren();
    notabla.replaceChildren();
    if (arrayUsuarios.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const username = document.createElement('th');
        const nombre = document.createElement('th');
        const telefono = document.createElement('th');
        const correo = document.createElement('th');
        const tipoUsuario = document.createElement('th');
        const editar = document.createElement('th');
        const eliminar = document.createElement('th');
        username.textContent = "Usuario";
        nombre.textContent = "Nombre";
        telefono.textContent = "Teléfono";
        correo.textContent = "Email";
        tipoUsuario.textContent = "Tipo de usuario";
        editar.textContent = "Editar";
        eliminar.textContent = "Eliminar";
        telefono.className = "column-to-hide";
        correo.className = "column-to-hide";
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

            iconoEditar.className = "cursor fas fa-edit editar-usuario";
            iconoEliminar.className = "cursor fas fa-trash eliminar-usuario";
            telefonoFila.className = "column-to-hide";
            correoFila.className = "column-to-hide";

            iconoEditar.dataset.id = u.username;
            iconoEliminar.dataset.id = u.username;
            iconoEliminar.dataset.nombre = u.nombre;

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
    } else {
        const mensaje = document.createElement('p');
        mensaje.textContent = "No existen registros";
        notabla.appendChild(mensaje);
    }
}
function usuar() {
    window.location.href = './usuario.php';
}
function usuarioEditar(idEditar) {
    window.location.href = './usuario.php?id=' + idEditar;
}
function eliminarUsuario() {
    var datos = { id: modal.dataset.id };
    jsonDatos = JSON.stringify(datos);
    fetch('./controller/eliminar-usuario.php', {
        method: 'POST',
        body: jsonDatos
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            clearDiv(modalContent);
            if (data === "true") {
                modalExito();
            } else {
                modalError(data.toString(), tipo.eliminar);
            }
            arrayUsuarios = [];
            obtenerUsuarios();
        })
        .catch(function (error) {
            modalError(error, tipo.eliminar);
        });
}
function clearDiv(div) {
    div.replaceChildren();
}
//MODAL
//MODAL
var modal = document.getElementById("modal");
var modalContent = document.getElementById("modal-contenido");
const botonModalAceptarEliminar = document.createElement('button');
botonModalAceptarEliminar.textContent = "Aceptar";
botonModalAceptarEliminar.className = "boton rojo aceptar-eliminar-usuario";
const botonModalCancelarEliminar = document.createElement('button');
botonModalCancelarEliminar.textContent = "Cancelar";
botonModalCancelarEliminar.className = "boton azul cancelar-eliminar-usuario";
botonModalAceptarCerrar = document.createElement('button');
botonModalAceptarCerrar.textContent = "Cerrar";
botonModalAceptarCerrar.className = "boton azul modal-cerrar";
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function modalBlock() {
    clearDiv(modalContent);
    modalContent.classList.remove('modal-contenido-exito');
    modalContent.classList.remove('modal-contenido-error');
    modalContent.classList.remove('modal-contenido-un-column');
    botonModalAceptarCerrar.className = "boton azul modal-cerrar";
    // modalContent.style.gridTemplateRows = '1fr 1fr';

    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const divBotonDos = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    const strongElement = document.createElement('strong');
    var nombre = modal.dataset.nombre;
    const nombreNodo = document.createTextNode(nombre);

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton";
    divBotonDos.className = "modal-boton";

    titulo.textContent = "Confirmar Eliminación";
    parrafo.textContent = "¿Seguro que desea eliminar al usuario ";
    strongElement.appendChild(nombreNodo);
    strongElement.style.fontWeight = 'bold';
    parrafo.appendChild(strongElement);

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);
    parrafo.textContent += "?";

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalAceptarEliminar);
    divBotonDos.appendChild(botonModalCancelarEliminar);
    modalContent.appendChild(divBoton);
    modalContent.appendChild(divBotonDos);
}
function modalExito() {
    modalContent.classList.add('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-un-column');
    botonModalAceptarCerrar.className = "boton azul modal-cerrar";

    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');

    titulo.textContent = "¡Usuario eliminado!";
    parrafo.textContent = "Los datos se han eliminado con éxito.";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalAceptarCerrar);
    modalContent.appendChild(divBoton);
}
function modalError(error, tipo) {
    clearDiv(modalContent);
    modal.style.display = "block";
    modalContent.classList.add('modal-contenido-error');
    modalContent.classList.add('modal-contenido-un-column');
    modalContent.classList.remove('modal-contenido-exito');
    botonModalAceptarCerrar.className = "boton blanco modal-cerrar";

    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    const iconoAlerta = document.createElement('i');
    iconoAlerta.className = "fa-solid fa-bell";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    if (tipo == "eliminar") {
        titulo.textContent = '¡El usuario NO ha sido eliminado!';
    } else if (tipo == "obtener") {
        titulo.textContent = '¡La información no pudo ser obtenida!';
    }
    if(error=="palabras"){
        parrafo.textContent = "Solo permite búsqueda de máximo 5 palabras";
    }
    else if (error != "false") {
        parrafo.textContent = "Contacta a tu administrador, Error: " + error;
    } else {
        parrafo.textContent = "Porfavor, revisa la información e intenta de nuevo.";
    }
    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalAceptarCerrar);
    modalContent.appendChild(divBoton);
}
modal.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("aceptar-eliminar-usuario")) {
        eliminarUsuario();
    };
    if (e.target.classList.contains("cancelar-eliminar-usuario")) {
        modal.style.display = "none";
    }
    if (e.target.classList.contains("modal-cerrar")) {
        modal.style.display = "none";
    }
})
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
}