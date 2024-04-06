
var paciente;
const sexo = { femenino: "femenino", masculino: "masculino", otro: "otro" };
var botonImprimirPaciente=document.getElementById('boton-imprimir-paciente');
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerPaciente();
};
function obtenerPaciente() {
    fetch('./controller/obtener-paciente.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.id != null) {
                paciente = new Paciente(data.nombre, data.apellidoPaterno, data.apellidoMaterno, data.sexo, data.fechaNacimiento, data.lugarNacimiento, data.calle, data.colonia, data.ciudad, data.codigoPostal, data.telCasa, data.telOficina, data.celular, data.edoCivil, data.ocupacion, data.escolaridad, data.correo);
                paciente.id = data.id;
                document.getElementById('nombre-paciente').value = paciente.nombre;
                validarCampo(expresiones.nombre, paciente.nombre, 'nombre');
                document.getElementById('apellidop-paciente').value = paciente.apellidoPaterno;
                validarCampo(expresiones.apellidop, paciente.apellidoPaterno, 'apellidop');
                document.getElementById('apellidom-paciente').value = paciente.apellidoMaterno;
                validarCampo(expresiones.apellidom, paciente.apellidoMaterno, 'apellidom');
                for (const i in sexo) {
                    if (i == paciente.sexo) {
                        document.getElementById(sexo[i]).checked = true;
                    }
                }
                document.getElementById('nacimiento-paciente').value = paciente.fechaNacimiento;
                validarCampo(expresiones.nacimiento, paciente.fechaNacimiento, 'nacimiento');
                document.getElementById('lugar-paciente').value = paciente.lugarNacimiento;
                validarCampo(expresiones.lugar, paciente.lugarNacimiento, 'lugar');
                document.getElementById('calle-paciente').value = paciente.calle;
                validarCampo(expresiones.calle, paciente.calle, 'calle');
                document.getElementById('colonia-paciente').value = paciente.colonia;
                validarCampo(expresiones.colonia, paciente.colonia, 'colonia');
                document.getElementById('ciudad-paciente').value = paciente.ciudad;
                validarCampo(expresiones.ciudad, paciente.ciudad, 'ciudad');
                document.getElementById('cp-paciente').value = paciente.codigoPostal;
                validarCampo(expresiones.cp, paciente.codigoPostal, 'cp');
                document.getElementById('telefono-casa-paciente').value = paciente.telCasa;
                validarCampo(expresiones.casa, paciente.telCasa, 'casa');
                document.getElementById('telefono-oficina-paciente').value = paciente.telOficina;
                validarCampo(expresiones.oficina, paciente.telOficina, 'oficina');
                document.getElementById('telefono-cel-paciente').value = paciente.celular;
                validarCampo(expresiones.celular, paciente.celular, 'celular');
                document.getElementById('civil-paciente').value = paciente.edoCivil;
                validarCampo(expresiones.estadoCivil, paciente.edoCivil, 'estadoCivil');
                document.getElementById('ocupacion-paciente').value = paciente.ocupacion;
                validarCampo(expresiones.ocupacion, paciente.ocupacion, 'ocupacion');
                document.getElementById('escolaridad-paciente').value = paciente.escolaridad;
                validarCampo(expresiones.escolaridad, paciente.escolaridad, 'escolaridad');
                document.getElementById('email-paciente').value = paciente.correo;
                validarCampo(expresiones.email, paciente.correo, 'email');
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
botonImprimirPaciente.addEventListener('click',imprimirPaciente);
//FETCH FORMULARIO Y ARRAYS
function enviarFormPaciente(){
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
                    console.log(data);
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
                    fetchedData = data;
                    console.log(data);
                } else {
                    console.log("error");
                }
            })
            .catch(function (error) {
                console.error('Error:', error);
            });
    }
}
function imprimirPaciente(){
    if (paciente!=null){
        window.open("./print/paciente.php", "_blank");
    }else{
        
    }
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
