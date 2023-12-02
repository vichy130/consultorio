var tabla = document.getElementById('tabla-pacientes');
const cuerpoTabla = tabla.createTBody();
var botonNuevoPaciente;
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
                const fila = cuerpoTabla.insertRow();
                const celdaId = fila.insertCell();
                celdaId.textContent = paciente.id;
                const celdaNombre = fila.insertCell();
                celdaNombre.textContent = paciente.nombre;
                const celdaApellidos = fila.insertCell();
                celdaApellidos.textContent = paciente.apellidoPaterno + " " + paciente.apellidoMaterno;
                const celdaCelular = fila.insertCell();
                celdaCelular.textContent = paciente.celular;
                const iconoEditar = document.createElement("i");
                const iconoEliminar = document.createElement("i");
                iconoEditar.className = "far fa-edit";
                iconoEliminar.className = "fas fa-trash";
                const celdaEditar = fila.insertCell();
                const celdaEliminar = fila.insertCell();
                celdaEliminar.append(iconoEliminar);
                const aEditar = document.createElement('a');
                aEditar.href = "pacientes-informacion.php?id=" + paciente.id;
                celdaEditar.append(aEditar);
                aEditar.append(iconoEditar);
                iconoEliminar.addEventListener('click', function (e) {
                    e.preventDefault();
                    preguntaEliminar(paciente.id);
                });
            });
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
//FUNCION BORRAR TABLA
function clearDiv(div) {
    div.replaceChildren();
}
function preguntaEliminar(id) {
    modalPregunta.style.display = 'block';
    botonAceptarEliminar.dataset.id = id;
    botonAceptarEliminar.addEventListener('click', function (e) {
        e.preventDefault();
        eliminarPaciente();
    });
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
function eliminarPaciente() {
    var id = botonAceptarEliminar.dataset.id;
    var datos = { id: id };
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
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
    cerrarPregunta();
    clearDiv(cuerpoTabla);
    obtenerPacientes();
}
function paciente() {
    window.location.href = "./pacientes-informacion.php";
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