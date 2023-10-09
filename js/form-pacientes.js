window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerPacientes();
};
function obtenerPacientes(){
    fetch('./controller/obtener-pacientes.php')
        .then(response => response.json())
        .then(data => {
            tabla = document.getElementById('tabla-pacientes');
            const cuerpoTabla = tabla.createTBody();
            data.forEach((p) => {
                var paciente = new Paciente(p.nombre,p.apellidoPaterno,p.apellidoMaterno,p.sexo,p.fechaNacimiento,p.lugarNacimiento,p.calle,p.colonia,p.ciudad,p.codigoPostal,p.telCasa,p.telOficina,p.celular,p.edoCivil,p.ocupacion,p.escolaridad,p.correo);
                paciente.id=p.id;
                const fila = cuerpoTabla.insertRow();
                const celdaNombre = fila.insertCell();
                celdaNombre.textContent = paciente.nombre;
                const celdaApellidos = fila.insertCell();
                celdaApellidos.textContent = paciente.apellidoPaterno+" "+paciente.apellidoMaterno;
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
                aEditar.href="pacientes-informacion.php?id="+paciente.id;
                celdaEditar.append(aEditar);
                aEditar.append(iconoEditar);
                iconoEliminar.addEventListener('click',eliminarPaciente);
            });
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
function eliminarPaciente(){
    console.log("eliminando");
}
var botonNuevoPaciente;
var tabla = document.getElementById('tabla-pacientes');
botonNuevoPaciente = document.getElementById('nuevo-paciente-boton');
botonNuevoPaciente.addEventListener('click', paciente);
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