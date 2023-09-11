
document.addEventListener('DOMContentLoaded', function () {
    var fecha = document.getElementById("fecha-ficha");
    var fechaHoy = new Date();
    var dia = fechaHoy.getDate();
    var mes = fechaHoy.getMonth() + 1;
    var anio = fechaHoy.getFullYear();

    if (mes < 10) {
        mes = "0" + mes;
    }
    if (dia < 10) {
        dia = "0" + dia;
    }

    var format = anio + "-" + mes + "-" + dia;

    if (typeof fecha === 'undefined' || fecha === null || fecha.value === '') {
        // Habilita el campo temporalmente
        fecha.disabled = false;
        fecha.value = format; // Establece el valor
        // Vuelve a deshabilitar el campo si es necesario
        fecha.disabled = true;
        ocultoFecha.value = fecha.value;
    }
});

// Añadir un nuevo hijo

let anadirHijo = document.getElementById("agregarHijo");
let tablaHijos = document.getElementById("tabla-hijos");
var arrayHijos = [];
var fecha = document.getElementById("fecha-ficha");
var ocultoFecha = document.getElementById("oculto-fecha-ficha");

//Array de Objetos llamado "ArrayHijos"
function ingresarHijos() {
    let edad = document.getElementById("hijoedad-paciente").value;
    let sexo = document.querySelector('input[name="sexo-hijo"]:checked').value;
    var hijo = new Hijo(sexo, edad);
    arrayHijos.push(hijo);
    hijo.id = new Date().getTime();
    actualizarTablaHijos();
}

//Añadir nuevo antecedente
let agregarAntecedente = document.getElementById("agregarAntecedente");
let tablaAntecedentes = document.getElementById("tabla-antecedentes");
var arrayAntecedentes = [];

// Array de Objetos llamado "ArrayAntecedentes"
function ingresarAntecedentes() {
    let enfermedad = document.getElementById().value;
    let descripcion = document.getElementById().value;
    let estaActiva = document.getElementById().value;
    let ficha = document.getElementById().value;
    var antecedente = new Antecedente(enfermedad, descripcion, estaActiva, ficha);
    arrayAntecedentes.push(antecedente);
    antecedente.id = new Date().getTime();
    actualizarTablaAntecedentes();
}


// Añadir nuevo antedecente familia
let agregarAntecedenteFam = document.getElementById("agregarAntecedenteFam"); //Boton agregar antecedenteFam
let tablaAntecedentesFam = document.getElementById("tabla-AntecedentesFam");
var ArrayAntecedentesFam = [];

//Array de Objetos llamado "ArrayAntecedentesFam"
function ingresarAntecedentesFam() {
    let familiar = document.getElementById().value;
    let enfermedad = document.getElementById().value;
    let descripcion = document.getElementById().value;
    let ficha = document.getElementById().value;
    var antecedenteFam = new AntecedenteFam(familiar, enfermedad, descripcion, ficha);
    arrayAntecedentesFam.push(antecedenteFam);
    antecedenteFam.id = new Date().getTime();
    actualizarTablaAntecedentesFam();
}

function cleardiv(div) {
    div.replaceChildren();
}


// HIJOS functions//
function actualizarTablaHijos() {
    cleardiv(tablaHijos);
    let contador = 0;
    for (hijo of arrayHijos) {
        contador++
        tablaHijos.innerHTML += `<tr>
        <td class="column-to-hide">`+ contador + `</td>
        <td name="hijo-sexo">`+ hijo.sexo + `</td>
        <td name="hijo-edad">`+ hijo.edad + `</td>
        <td><i class="fas fa-trash" onclick =eliminarHijo(`+ hijo.id + `)></i></td>
        </tr>`;
    }
    console.log(arrayHijos);
}
function actualizarTablaAntecedentes(){
    cleardiv(tablaAntecedentes);
    let contador=0;
    for (antecedente of arrayAntecedentes)
}
function actualizarTablaAntecedentesFam(){
    cleardiv(tablaAntecedentesFam);
    let contador=0;
}


function eliminarHijo(id) {
    const filteredArray = arrayHijos.filter(hijo => hijo.id != id);
    arrayHijos = filteredArray;
    /*const mappedArray= arrayHijos.map(hijo=>({...hijo,id: hijo.id+1}))*/

    actualizarTablaHijos();

}
anadirHijo.addEventListener("click", ingresarHijos);

// HIJOS functions//

//FETCH formulario y arrays

var formFicha = document.getElementById('form-ficha');

formFicha.addEventListener('submit', function (e) {
    e.preventDefault();
    console.log('click enviar');

    var datosFicha = new FormData(formFicha);


    // Convierte el array de objetos a JSON
    var jsonHijos = JSON.stringify(arrayHijos);
    var jsonAntecedentes = JSON.stringify(arrayAntecedentes);
    var jsonAntecedentesFam = JSON.stringify(arrayAntecedentesFam);

    /*console.log(datosFicha.get('tipo-sangre'));
     console.log(jsonHijos);*/

    datosFicha.append('json-hijos', jsonHijos);
    datosFicha.append('json-antecedentes', arrayAntecedentes);
    datosFicha.append('json-antecedentesFam', arrayAntecedentesFam);

    // Enviar los datos a PHP utilizando fetch
    fetch('./controller/nueva-ficha.php', {
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


})

if (typeof tipoSangre !== "undefined") {
    // OPCION TIPO SANGRE
    // Obtener una referencia al elemento <select> por su ID
    var select = document.getElementById("tipo-sangre");

    for (var i = 0; i < select.options.length; i++) {
        var option = select.options[i];
        if (option.value === tipoSangre) {
            // Establecer la opción como seleccionada
            option.selected = true;
            break;
        }
    }
}
// OPCION TIPO SANGRE

//CLASES //

class Hijo {

    constructor(sexo, edad) {
        this._sexo = sexo;
        this._edad = edad;
    }
    get id() {
        return this._id;
    }
    set id(numero) {
        this._id = numero;
    }
    get sexo() {
        return this._sexo;
    }
    get edad() {
        return this._edad;
    }
}
class Antecedente {
    constructor(enfermedad, descripcion, estaActiva, ficha) {
        this._enfermedad = enfermedad;
        this._descripcion = descripcion;
        this._estaActiva = estaActiva;
        this._ficha = ficha;
    }
    get id() {
        return this._id;
    }
    set id(numero) {
        this._id = numero;
    }
}

class AntecedenteFam {
    constructor(enfermedad, descripcion, ficha) {
        this._enfermedad = enfermedad;
        this._descripcion = descripcion;
        this._ficha = ficha;
    }
    get id() {
        return this._id;
    }
    set id(numero) {
        this._id = numero;
    }
}



// CLASES //

