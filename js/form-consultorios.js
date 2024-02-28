var arrayConsultorios = [];
var botonNuevoConsultorio = document.getElementById('boton-nuevo-consultorio');
var tbodyConsultorios = document.getElementById('tbody-consultorios');
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerConsultorios();
};

function obtenerConsultorios() {
    fetch('./controller/obtener-consultorios.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((c) => {
                var consultorio = new Consultorio();
                consultorio.id = c.id;
                consultorio.nombre = c.nombre;
                consultorio.calle = c.calle;
                consultorio.colonia = c.colonia;
                consultorio.ciudad = c.ciudad;
                consultorio.codigoPostal = c.codigoPostal;
                consultorio.telefono = c.telefono;
                arrayConsultorios.push(consultorio);
            });
            tablaConsultorios();
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
function tablaConsultorios() {
    console.log(arrayConsultorios);
    clearDiv(tbodyConsultorios);
    arrayConsultorios.forEach(c => {
        const celda = document.createElement('tr');
        const nombreFila = document.createElement('td');
        const domicilioFila = document.createElement('td');
        const telefonoFila = document.createElement('td');
        const editarFila = document.createElement('td');
        const eliminarFila = document.createElement('td');

        const editarIcono = document.createElement('i');
        const eliminarIcono = document.createElement('i');

        editarIcono.className = "far fa-edit editar-consultorio";
        eliminarIcono.className = "fas fa-trash eliminar-consultorio";

        editarIcono.dataset.id = c.id;
        eliminarIcono.dataset.id = c.id;

        nombreFila.textContent = c.nombre;
        domicilioFila.textContent = c.calle + " " + c.colonia + ", " + c.ciudad + " " + c.codigoPostal;
        telefonoFila.textContent = c.telefono;
        editarFila.append(editarIcono);
        eliminarFila.append(eliminarIcono);

        celda.append(nombreFila);
        celda.append(domicilioFila);
        celda.append(telefonoFila);
        celda.append(editarFila);
        celda.append(eliminarFila);
        tbodyConsultorios.append(celda);
    });
}
function clearDiv(div) {
    div.replaceChildren();
}
botonNuevoConsultorio.addEventListener('click', function (e) {
    e.preventDefault();
    redirectConsultorio();
});
tbodyConsultorios.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains('editar-consultorio')) {
        consultorioEditar(e.target.dataset.id);
    }
    if (e.target.classList.contains('eliminar-consultorio')) {
        consultorioEliminar(e.target.dataset.id);
    }
});
function redirectConsultorio() {
    console.log("ir a consultorio");
    window.location.href = "./consultorio.php";
}
function consultorioEditar(idEditar) {
    window.location.href = "./consultorio.php?id=" + idEditar;
}
function consultorioEliminar(idEliminar) {
    datos={id:idEliminar};
    json=JSON.stringify(datos);
    fetch('./controller/eliminar-consultorio.php', {
        method: 'POST',
        body: json
    }).then(function(response){
        return response.text();
    })
    .then(function (data){
        arrayConsultorios=[];
        clearDiv(tbodyConsultorios);
        obtenerConsultorios();
        console.log(data);
        console.log("eliminacion exitosa");
    });
}
class Consultorio {
    set nombre(nombre) {
        this._nombre = nombre;
    }
    get nombre() {
        return this._nombre;
    }
    get calle() {
        return this._calle;
    }
    set calle(calle) {
        this._calle = calle;
    }
    set colonia(colonia) {
        this._colonia = colonia;
    }
    get colonia() {
        return this._colonia;
    }
    set ciudad(ciudad) {
        this._ciudad = ciudad;
    }
    get ciudad() {
        return this._ciudad;
    }
    set codigoPostal(codigoPostal) {
        this._codigoPostal = codigoPostal;
    }
    get codigoPostal() {
        return this._codigoPostal;
    }
    set telefono(telefono) {
        this._telefono = telefono;
    }
    get telefono() {
        return this._telefono;
    }
    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
}