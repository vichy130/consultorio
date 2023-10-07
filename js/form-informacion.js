
var fetchedData;
var id;
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    fetchedData = null;
    id = null;
    fetch('./controller/obtener-paciente.php')
        .then(response => response.json())
        .then(data => {
            console.log("FETCHH");
            if (data && data.id != null) {
                fetchedData = data;
                console.log(data);
                // Procesa los datos y actualiza el HTML aquí
            }
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
            console.log("catch");
        });
};
//LOAD HTML
document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO
});
//FETCH FORMULARIO Y ARRAYS
var formPaciente = document.getElementById('form-paciente');
formPaciente.addEventListener('submit', function (e) {
    e.preventDefault();
    var datosFicha = new FormData(formFicha);
    if (fetchedData != null) {
        console.log("DATA ESTA DEFINIDO");
        fetch('./controller/editar-paciente.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosFicha // El JSON que contiene los datos y el formulario
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
    } else {
        console.log("NUEVo PACIENTE");
        fetch('./controller/nuevp-paciente.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosFicha // El JSON que contiene los datos y el formulario
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
})
//CLASES
class Paciente {
    id;
    constructor(
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
