var consultorio;
var botonGuardar = document.getElementById('boton-guardar');
var formConsultorio = document.getElementById('form-consultorio');
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerConsultorio();
};

function obtenerConsultorio() {
    fetch('./controller/obtener-consultorio.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                consultorio = new Consultorio(data.nombre, data.calle, data.colonia, data.ciudad, data.codigoPostal, data.telefono);
                consultorio.id = data.id;
                document.getElementById('nombre-consultorio').value = consultorio.nombre;
                document.getElementById('calle-consultorio').value = consultorio.calle;
                document.getElementById('colonia-consultorio').value = consultorio.colonia;
                document.getElementById('ciudad-consultorio').value = consultorio.ciudad;
                document.getElementById('cp-consultorio').value = consultorio.codigoPostal;
                document.getElementById('telefono-consultorio').value = consultorio.telefono;
            }
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
            console.log("catch");
        });
}
formConsultorio.addEventListener('submit', function (e) {
    e.preventDefault();
    datosConsultorio = new FormData(formConsultorio);
    if (consultorio != null) {
        fetch('./controller/editar-consultorio.php', {
            method: 'POST',
            body: datosConsultorio
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
    }else{
        fetch ('./controller/nuevo-consultorio.php', {
            method: 'POST',
            body: datosConsultorio
        })
        .then(function(response){
            return response.text();
        })
        .then(function (data){
            console.log(data);
        })
        .catch (function (error){
            console.log.error('Error:', error);
        })
    }
});

class Consultorio {
    constructor(nombre, calle, colonia, ciudad, codigoPostal, telefono) {
        this._nombre = nombre;
        this._calle = calle;
        this._colonia = colonia;
        this._ciudad = ciudad;
        this._codigoPostal = codigoPostal;
        this._telefono = telefono;
    }
    // Métodos set
    set id(id) {
        this._id = id;
    }
    set nombre(nombre) {
        this._nombre = nombre;
    }
    set calle(calle) {
        this._calle = calle;
    }
    set colonia(colonia) {
        this._colonia = colonia;
    }
    set ciudad(ciudad) {
        this._ciudad = ciudad;
    }
    set codigoPostal(codigoPostal) {
        this._codigoPostal = codigoPostal;
    }
    set telefono(telefono) {
        this._telefono = telefono;
    }
    // Métodos get
    get id() {
        return this._id;
    }
    get nombre() {
        return this._nombre;
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
    get telefono() {
        return this._telefono;
    }
}