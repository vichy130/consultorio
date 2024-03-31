var tabla = document.getElementById('tabla-pacientes');
var notabla = document.getElementById('no-tabla');
var botonNuevoPaciente;
var botonEditarPaciente;
var botonEliminarPaciente;
var array = []; //array pacientes

botonNuevoPaciente = document.getElementById('nuevo-paciente-boton');
botonNuevoPaciente.addEventListener('click', function (e) {
    e.preventDefault();
    paciente();
});
var modalPregunta = document.getElementById('modalPregunta');
var modalExito = document.getElementById('modalExito');
var modalError = document.getElementById('modalError');
var botonAceptarEliminar = document.getElementById('botonAceptarEliminar');
var botonCancelarEliminar = document.getElementById('botonCancelarEliminar');
var cerrarModalPregunta = document.getElementById('cerrarModalPregunta');
var cerrarModalExito = document.getElementById('cerrarModalExito');
var cerrarModalError = document.getElementById('cerrarModalError');
tabla.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("editar-paciente")) {
        const idEditar = e.target.dataset.id
        pacienteEditar(idEditar);
    }
    if (e.target.classList.contains("eliminar-paciente")) {
        const idEliminar = e.target.dataset.id;
        preguntaEliminar(idEliminar);
    }
});

// BOTONES
botonCancelarEliminar.addEventListener('click', function (e) {
    e.preventDefault();
    cerrarPregunta();
});
cerrarModalPregunta.addEventListener('click', function (e) {
    e.preventDefault()
    cerrarPregunta();
});
cerrarModalExito.addEventListener('click', function (e) {
    e.preventDefault();
    cerrarExito();
});
cerrarModalError.addEventListener('click', function (e) {
    e.preventDefault();
    cerrarError()
});
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerPacientes();
};
function obtenerPacientes() {
    fetch('./controller/obtener-pacientes.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((p) => {
                var paciente = new Paciente(p.nombre, p.apellidoPaterno, p.apellidoMaterno, p.sexo, p.fechaNacimiento, p.lugarNacimiento, p.calle, p.colonia, p.ciudad, p.codigoPostal, p.telCasa, p.telOficina, p.celular, p.edoCivil, p.ocupacion, p.escolaridad, p.correo);
                paciente.id = p.id;
                array.push(paciente);
            });
            tablaPacientes();
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
//FUNCION BORRAR TABLA
function clearDiv(div) {
    div.replaceChildren();
}
function preguntaEliminar(idEliminar) {
    modalPregunta.style.display = 'block';
    botonAceptarEliminar.onclick = function (e) {
        e.preventDefault();
        eliminarPaciente(idEliminar);
        console.log('ejecucion aceptar eliminar');
    };
}
function cerrarPregunta() {
    modalPregunta.style.display = 'none';
}
function cerrarExito() {
    modalExito.style.display = 'none';
}
function cerrarError() {
    modalError.style.display = 'none';
}
function eliminarPaciente(idEliminar) {
    var datos = { id: idEliminar };
    var json = JSON.stringify(datos);
    fetch('./controller/eliminar-paciente.php', {// Enviar los datos a PHP utilizando fetch
        method: 'POST',
        body: json// El JSON que contiene los datos 
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            if (data == "1") {
                modalExito.style.display = 'block';
            } else {
                modalError.style.display = 'block';
            }
            cerrarPregunta();
            array = [];
            clearDiv(tabla);
            obtenerPacientes();
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
}
function tablaPacientes() {
    if (array.length > 0) {
        const thead=document.createElement('thead');
        const propiedades=document.createElement('tr');
        const registro=document.createElement('th');
        const nombre=document.createElement('th');
        const apellidos=document.createElement('th');
        const telefono=document.createElement('th');
        const editar=document.createElement('th');
        const eliminar=document.createElement('th');

        registro.textContent="Registro";
        nombre.textContent="Nombre(s)";
        apellidos.textContent="Apellidos";
        telefono.textContent="Teléfono";
        editar.textContent="Editar";
        eliminar.textContent="Eliminar";
        telefono.className="column-to-hide";

        propiedades.appendChild(registro);
        propiedades.appendChild(nombre);
        propiedades.appendChild(apellidos);
        propiedades.appendChild(telefono);
        propiedades.appendChild(editar);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tabla.appendChild(thead);

        const tbody=document.createElement('tbody');
        
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

            iconoEditar.className = "far fa-edit editar-paciente";
            iconoEliminar.className = "fas fa-trash eliminar-paciente";

            iconoEditar.dataset.id = pa.id;
            iconoEliminar.dataset.id = pa.id;

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
        const mensaje=document.createElement('p');
        mensaje.textContent="No existen registros";
        notabla.appendChild(mensaje);
    }
}
function paciente() {
    window.location.href = "./pacientes-informacion.php";
}
function pacienteEditar(idEditar) {
    window.location.href = "./pacientes-informacion.php?id=" + idEditar;
}
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