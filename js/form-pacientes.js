var tabla = document.getElementById('tabla-pacientes');
var notabla = document.getElementById('no-tabla');
var botonNuevoPaciente;
var botonEditarPaciente;
var botonEliminarPaciente;
var botonBuscar = document.getElementById('boton-buscar-paciente');
var inputBuscar = document.getElementById('input-buscar');
var botonNuevoPaciente = document.getElementById('nuevo-paciente-boton');
var iconoBuscar = document.getElementById('icono-buscar');
var array = []; //array pacientes
const tipo = { obtener: "obtener", guardar: "guardar", eliminar: "eliminar" };


botonNuevoPaciente.addEventListener('click', function (e) {
    e.preventDefault();
    paciente();
});


botonBuscar.addEventListener('click', function (e) {
    e.preventDefault();
    buscarPacientes();
});
inputBuscar.addEventListener('keyup', iconoBuscarActivar);
inputBuscar.addEventListener('blur', iconoBuscarActivar);
iconoBuscar.addEventListener('click', function (e) {
    e.preventDefault();
    inputBuscar.value = "";
    obtenerPacientes();
    iconoBuscarActivar();
});
tabla.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("editar-paciente")) {
        const idEditar = e.target.dataset.id
        pacienteEditar(idEditar);
    }
    if (e.target.classList.contains("eliminar-paciente")) {
        modal.dataset.id = e.target.dataset.id;
        modal.dataset.nombre = e.target.dataset.nombre;
        modal.dataset.apellidoPaterno = e.target.dataset.apellidoPaterno;
        modal.dataset.apellidoMaterno = e.target.dataset.apellidoMaterno;
        modalBlock();
    }
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

// BOTONES

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerPacientes();
};
function obtenerPacientes() {
    fetch('./controller/obtener-pacientes.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                array = [];
                data.forEach((p) => {
                    if ('id' in p) {
                        var paciente = new Paciente(p.nombre, p.apellidoPaterno, p.apellidoMaterno, p.sexo, p.fechaNacimiento, p.lugarNacimiento, p.calle, p.colonia, p.ciudad, p.codigoPostal, p.telCasa, p.telOficina, p.celular, p.edoCivil, p.ocupacion, p.escolaridad, p.correo);
                        paciente.id = p.id;
                        array.push(paciente);
                    } else {
                        modalError(p, tipo.obtener);
                        return;
                    }
                });
            }
            tablaPacientes();
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
        });
}
function buscarPacientes() {
    stringBuscar = inputBuscar.value;
    var arrayBuscar = stringBuscar.split(" ")

    if (arrayBuscar.length < 6) {
        datos = JSON.stringify(arrayBuscar);
        console.log(datos);
        fetch('./controller/buscar-pacientes.php', {
            method: 'POST',
            body: datos
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                if (data != null) {
                    array = [];
                    if (Array.isArray(data)) {
                        data.forEach((p) => {
                            if ('id' in p) {
                                var paciente = new Paciente(p.nombre, p.apellidoPaterno, p.apellidoMaterno, p.sexo, p.fechaNacimiento, p.lugarNacimiento, p.calle, p.colonia, p.ciudad, p.codigoPostal, p.telCasa, p.telOficina, p.celular, p.edoCivil, p.ocupacion, p.escolaridad, p.correo);
                                paciente.id = p.id;
                                array.push(paciente);
                            } else {
                                modalError(p, tipo.obtener);
                                return;
                            }
                        });
                    }
                }
                tablaPacientes();

            })
            .catch(function (error) {
                console.log(error);
            });
    }else{
        modalError("palabras", tipo.obtener);
    }
    }
    //FUNCION BORRAR TABLA
    function clearDiv(div) {
        div.replaceChildren();
    }

    function eliminarPaciente() {
        var datos = { id: modal.dataset.id };
        var json = JSON.stringify(datos);
        fetch('./controller/eliminar-paciente.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: json// El JSON que contiene los datos 
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
                array = [];
                clearDiv(tabla);
                obtenerPacientes();
            })
            .catch(function (error) {
                modalError(error, tipo.eliminar);
            });
    }
    function tablaPacientes() {
        clearDiv(tabla);
        clearDiv(notabla);
        if (array.length > 0) {
            const thead = document.createElement('thead');
            const propiedades = document.createElement('tr');
            const registro = document.createElement('th');
            const nombre = document.createElement('th');
            const apellidos = document.createElement('th');
            const telefono = document.createElement('th');
            const editar = document.createElement('th');
            const eliminar = document.createElement('th');

            registro.textContent = "Registro";
            nombre.textContent = "Nombre(s)";
            apellidos.textContent = "Apellidos";
            telefono.textContent = "Teléfono";
            editar.textContent = "Editar";
            eliminar.textContent = "Eliminar";
            telefono.className = "column-to-hide";

            propiedades.appendChild(registro);
            propiedades.appendChild(nombre);
            propiedades.appendChild(apellidos);
            propiedades.appendChild(telefono);
            propiedades.appendChild(editar);
            propiedades.appendChild(eliminar);
            thead.appendChild(propiedades);
            tabla.appendChild(thead);

            const tbody = document.createElement('tbody');

            array.forEach(pa => {
                const celda = document.createElement('tr');
                const idFila = document.createElement('td');
                const nombreFila = document.createElement('td');
                const apellidosFila = document.createElement('td');
                const telefonoFila = document.createElement('td');
                const editarFila = document.createElement('td');
                const eliminarFila = document.createElement('td');
                const iconoEditar = document.createElement('i');
                const iconoEliminar = document.createElement('i');

                iconoEditar.className = "cursor far fa-edit editar-paciente";
                iconoEliminar.className = "cursor fas fa-trash eliminar-paciente";

                iconoEditar.dataset.id = pa.id;
                iconoEliminar.dataset.id = pa.id;
                iconoEliminar.dataset.nombre = pa.nombre;
                iconoEliminar.dataset.apellidoPaterno = pa.apellidoPaterno;
                iconoEliminar.dataset.apellidoMaterno = pa.apellidoMaterno;

                idFila.textContent = pa.id;
                nombreFila.textContent = pa.nombre;
                apellidosFila.textContent = pa.apellidoPaterno + " " + pa.apellidoMaterno;
                telefonoFila.textContent = pa.celular;

                editarFila.appendChild(iconoEditar);
                eliminarFila.appendChild(iconoEliminar);
                celda.appendChild(idFila);
                celda.appendChild(nombreFila);
                celda.appendChild(apellidosFila);
                celda.appendChild(telefonoFila);
                celda.appendChild(editarFila);
                celda.appendChild(eliminarFila);
                tbody.appendChild(celda);
            });
            tabla.appendChild(tbody);
        } else {
            const mensaje = document.createElement('p');
            mensaje.textContent = "No existen registros";
            notabla.appendChild(mensaje);
        }
    }
    function paciente() {
        window.location.href = "./pacientes-informacion.php";
    }
    function pacienteEditar(idEditar) {
        window.location.href = "./pacientes-informacion.php?id=" + idEditar;
    }
    //MODAL
    //MODAL
    var modal = document.getElementById("modal");
    var modalContent = document.getElementById("modal-contenido");
    const botonModalAceptarEliminar = document.createElement('button');
    botonModalAceptarEliminar.textContent = "Aceptar";
    botonModalAceptarEliminar.className = "boton rojo aceptar-eliminar-paciente";
    const botonModalCancelarEliminar = document.createElement('button');
    botonModalCancelarEliminar.textContent = "Cancelar";
    botonModalCancelarEliminar.className = "boton azul cancelar-eliminar-paciente";
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
        var nombre = modal.dataset.nombre + " " + modal.dataset.apellidoPaterno + " " + modal.dataset.apellidoMaterno;
        const nombreNodo = document.createTextNode(nombre);

        divMensaje.className = "modal-mensaje";
        divBoton.className = "modal-boton";
        divBotonDos.className = "modal-boton";

        titulo.textContent = "Confirmar Eliminación";
        parrafo.textContent = "¿Seguro que desea eliminar al paciente ";
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
        clearDiv(modalContent);
        modalContent.classList.add('modal-contenido-exito');
        modalContent.classList.add('modal-contenido-un-column');
        modalContent.classList.remove('modal-contenido-error');
        botonModalAceptarCerrar.className = "boton azul modal-cerrar";

        const divMensaje = document.createElement('div');
        const divBoton = document.createElement('div');
        const titulo = document.createElement('h2');
        const parrafo = document.createElement('p');

        titulo.textContent = "¡Paciente eliminado!";
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
            titulo.textContent = '¡El paciente NO ha sido eliminado!';
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
        if (e.target.classList.contains("aceptar-eliminar-paciente")) {
            eliminarPaciente();
        };
        if (e.target.classList.contains("cancelar-eliminar-paciente")) {
            modal.style.display = "none";
        }
        if (e.target.classList.contains("modal-cerrar")) {
            modal.style.display = "none";
        }
    })
    //MODAL END
    //CLASES
    class Paciente {
        constructor(
            nombre, apellidoPaterno, apellidoMaterno, sexo, fechaNacimiento, lugarNacimiento, calle, colonia, ciudad, codigoPostal, telCasa, telOficina, celular, edoCivil, ocupacion, escolaridad, correo
        ) {
            this._nombre = nombre;
            this._apellidoPaterno = apellidoPaterno;
            this._apellidoMaterno = apellidoMaterno;
            this._sexo = sexo;
            this._fechaNacimiento = fechaNacimiento;
            this._lugarNacimiento = lugarNacimiento;
            this._calle = calle;
            this._colonia = colonia;
            this._ciudad = ciudad;
            this._codigoPostal = codigoPostal;
            this._telCasa = telCasa;
            this._telOficina = telOficina;
            this._celular = celular;
            this._edoCivil = edoCivil;
            this._ocupacion = ocupacion;
            this._escolaridad = escolaridad;
            this._correo = correo;
        }
        set id(id) {
            this._id = id;
        }
        get id() {
            return this._id;
        }
        get nombre() {
            return this._nombre;
        }

        get apellidoPaterno() {
            return this._apellidoPaterno;
        }

        get apellidoMaterno() {
            return this._apellidoMaterno;
        }
        get sexo() {
            return this._sexo;
        }
        get fechaNacimiento() {
            return this._fechaNacimiento;
        }
        get lugarNacimiento() {
            return this._lugarNacimiento;
        }
        get calle() {
            return this._calle;
        }

        get colonia() {
            return this._colonia;
        }

        get ciudad() {
            return this._ciudad;
        }

        get codigoPostal() {
            return this._codigoPostal;
        }

        get telCasa() {
            return this._telCasa;
        }

        get telOficina() {
            return this._telOficina;
        }
        get celular() {
            return this._celular;
        }

        get edoCivil() {
            return this._edoCivil;
        }

        get ocupacion() {
            return this._ocupacion;
        }

        get escolaridad() {
            return this._escolaridad;
        }

        get correo() {
            return this._correo;
        }
    }