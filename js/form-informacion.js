
var paciente;
const sexo = { femenino: "femenino", masculino: "masculino", otro: "otro" };
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerPaciente();
};
function obtenerPaciente() {
    fetch('./controller/obtener-paciente.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.id != null) {
                var paciente = new Paciente(data.nombre, data.apellidoPaterno, data.apellidoMaterno, data.sexo, data.fechaNacimiento, data.lugarNacimiento, data.calle, data.colonia, data.ciudad, data.codigoPostal, data.telCasa, data.telOficina, data.celular, data.edoCivil, data.ocupacion, data.escolaridad, data.correo);
                paciente.id = data.id;
                document.getElementById('nombre-paciente').value = paciente.nombre;
                document.getElementById('apellidop-paciente').value = paciente.apellidoPaterno;
                document.getElementById('apellidom-paciente').value = paciente.apellidoMaterno;
                for (const i in sexo) {
                    if (i == paciente.sexo) {
                        document.getElementById(sexo[i]).checked = true;
                    }
                }
                document.getElementById('nacimiento-paciente').value = paciente.fechaNacimiento;
                document.getElementById('lugar-paciente').value = paciente.lugarNacimiento;
                document.getElementById('calle-paciente').value = paciente.calle;
                document.getElementById('colonia-paciente').value = paciente.colonia;
                document.getElementById('ciudad-paciente').value = paciente.ciudad;
                document.getElementById('cp-paciente').value = paciente.codigoPostal;
                document.getElementById('telefono-casa-paciente').value = paciente.telCasa;
                document.getElementById('telefono-oficina-paciente').value = paciente.telOficina;
                document.getElementById('telefono-cel-paciente').value = paciente.celular;
                document.getElementById('civil-paciente').value = paciente.edoCivil;
                document.getElementById('ocupacion-paciente').value = paciente.ocupacion;
                document.getElementById('escolaridad-paciente').value = paciente.escolaridad;
                document.getElementById('email-paciente').value = paciente.correo;
            }
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
            console.log("catch");
        });
}
//LOAD HTML
document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO
});
const modalExito = document.getElementById('modalExito');//MODAL EXITO
const botonCerrarModal = document.getElementById('cerrarModal');
function mostrarModalExito() {
    modalExito.style.display = "block";
}
function cerrarModalExito() {
    modalExito.style.display = "none";
}
botonCerrarModal.addEventListener('click', cerrarModalExito);
//FETCH FORMULARIO Y ARRAYS
var formPaciente = document.getElementById('form-paciente');
formPaciente.addEventListener('submit', function (e) {
    e.preventDefault();
    var datosPaciente = new FormData(formPaciente);
    if (paciente != null) {
        fetch('./controller/editar-paciente.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosPaciente // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.text();
            })
            .then(function (data) {
                console.log(data);
                if (data != null) {
                    mostrarModalExito();
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
    } else {
        fetch('./controller/nuevo-paciente.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosPaciente // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.text();
            })
            .then(function (data) {
                if (data == true) {
                    mostrarModalExito();
                    fetchedData = data;
                    console.log(data);
                } else {
                    console.log("error");
                    mostrarModalError();
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
    }
})
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

/*const { //destructuracion de datos
    nombre,
    apellidoPaterno,
    apellidoMaterno,
    sexo,
    fechaNacimiento,
    lugarNacimiento,
    calle,
    colonia,
    ciudad,
    codigoPostal,
    telCasa,
    telOficina,
    celular,
    edoCivil,
    ocupacion,
    escolaridad,
    correo
} = data;*/
