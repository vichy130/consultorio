//LOAD HTML
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

//FECHA
var fecha = document.getElementById("fecha-ficha");
var ocultoFecha = document.getElementById("oculto-fecha-ficha");

// Añadir un nuevo hijo
let anadirHijo = document.getElementById("agregarHijo"); //BOTON ANADIR HIJO
let tablaHijos = document.getElementById("tabla-hijos"); //TABLA HIJOS
var arrayHijos = [];
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
let anadirAntecedente = document.getElementById("agregarAntecedente"); //BOTON
let tablaAntecedentes = document.getElementById("tabla-antecedentes"); //TABLA
var arrayAntecedentes = [];
// Añadir nuevo antedecente familia
let anadirAntecedenteFam = document.getElementById("agregarAntecedenteFam"); //Boton agregar antecedenteFam
let tablaAntecedentesFam = document.getElementById("tabla-antecedentesFam"); //TABLA
var arrayAntecedentesFam = [];

function ingresarAntecedentes() {
    let enfermedad = document.getElementById('enfermedad-paciente').value;
    let descripcion = document.getElementById('enfermedad-descripcion-paciente').value;
    let estaActiva = document.getElementById('enfermedad-activa').value;
    var antecedente = new Antecedente(enfermedad, descripcion, estaActiva);
    arrayAntecedentes.push(antecedente);
    antecedente.id = new Date().getTime();
    actualizarTablaAntecedentes();
}
//Array de Objetos llamado "ArrayAntecedentesFam"
function ingresarAntecedentesFam() {
    let familiar = document.getElementById('parentesco-paciente').value;
    let enfermedad = document.getElementById('familiarenfermedad-paciente').value;
    let descripcion = document.getElementById('familiarenfermedad-descripcion-paciente').value;
    var antecedenteFam = new AntecedenteFam(familiar, enfermedad, descripcion);
    arrayAntecedentesFam.push(antecedenteFam);
    antecedenteFam.id = new Date().getTime();
    actualizarTablaAntecedentesFam();
}
//FUNCION BORRAR TABLA
function cleardiv(div) {
    div.replaceChildren();
}
// FUNCION ACTUALIZAR
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
}
function actualizarTablaAntecedentes() {
    console.log(arrayAntecedentesFam);
    cleardiv(tablaAntecedentes);
    let contador = 0;
    for (antecedente of arrayAntecedentes) {
        contador++
        tablaAntecedentes.innerHTML += `<tr>
        <td class="column-to-hide">`+ contador + `</td>
        <td name="antecedente-enfermedad">`+ antecedente.enfermedad + `</td>
        <td name="antecedente-descripcion">`+ antecedente.descripcion + `</td>
        <td name="antecedente-estaActivo">`+ antecedente.estaActiva + `</td>
        <td><i class="fas fa-trash" onclick =eliminarAntecedente(`+ antecedente.id + `)></i></td>
        </tr>`;
    }
}
function actualizarTablaAntecedentesFam() {
    cleardiv(tablaAntecedentesFam);
    let contador = 0;
    for (antecedente of arrayAntecedentesFam) {
        contador++
        tablaAntecedentesFam.innerHTML += `<tr>
        <td class="column-to-hide">`+ contador + `</td>
        <td name="antecedenteFam-familiar">`+ antecedente.familiar + `</td>
        <td name="antecedenteFam-enfermedad">`+ antecedente.enfermedad + `</td>
        <td name="antecedenteFam-descripcion">`+ antecedente.descripcion + `</td>
        <td><i class="fas fa-trash" onclick =eliminarantecedenteFam(`+ antecedente.id + `)></i></td>
        </tr>`;
    }
}
//ELIMINAR VALORES DE ARRAY
function eliminarHijo(id) {
    const filteredArray = arrayHijos.filter(hijo => hijo.id != id);
    arrayHijos = filteredArray;
    /*const mappedArray= arrayHijos.map(hijo=>({...hijo,id: hijo.id+1}))*/
    actualizarTablaHijos();
}
function eliminarAntecedente(id) {
    const filterdArray = arrayAntecedentes.filter(antecedente => antecedente.id != id);
    arrayAntecedentes = filterdArray;
    actualizarTablaAntecedentes();
}
function eliminarantecedenteFam(id) {
    const filterdArray = arrayAntecedentesFam.filter(antecedenteFam => antecedenteFam.id != id);
    arrayAntecedentesFam = filterdArray;
    actualizarTablaAntecedentesFam();
}

// EVENT LISTENERS
anadirHijo.addEventListener("click", ingresarHijos);
anadirAntecedente.addEventListener("click", ingresarAntecedentes);
anadirAntecedenteFam.addEventListener("click", ingresarAntecedentesFam);


//FETCH FORMULARIO Y ARRAYS
var formFicha = document.getElementById('form-ficha');
formFicha.addEventListener('submit', function (e) {
    e.preventDefault();
    var datosFicha = new FormData(formFicha);
    var jsonHijos = JSON.stringify(arrayHijos);
    var jsonAntecedentes = JSON.stringify(arrayAntecedentes);
    var jsonAntecedentesFam = JSON.stringify(arrayAntecedentesFam);
    /*console.log(datosFicha.get('tipo-sangre'));
     console.log(jsonHijos);*/
    datosFicha.append('json-hijos', jsonHijos);
    datosFicha.append('json-antecedentes', jsonAntecedentes);
    datosFicha.append('json-antecedentesFam', jsonAntecedentesFam);
    fetch('./controller/nueva-ficha.php', {// Enviar los datos a PHP utilizando fetch
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
    var select = document.getElementById("tipo-sangre");
    for (var i = 0; i < select.options.length; i++) {
        var option = select.options[i];
        if (option.value === tipoSangre) {
            // Establecer la opción como seleccionada
            option.selected = true;
            break;
        }
    }
}// OPCION TIPO SANGRE


class Hijo { //CLASES //

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
    constructor(enfermedad, descripcion, estaActiva) {
        this._enfermedad = enfermedad;
        this._descripcion = descripcion;
        this._estaActiva = estaActiva;
    }
    get id() {
        return this._id;
    }
    set id(numero) {
        this._id = numero;
    }
    get enfermedad() {
        return this._enfermedad;
    }
    get descripcion() {
        return this._descripcion;
    }
    get estaActiva() {
        return this._estaActiva;
    }
    get ficha() {
        return this._ficha;
    }
}
class AntecedenteFam {
    constructor(familiar, enfermedad, descripcion) {
        this._familiar = familiar;
        this._enfermedad = enfermedad;
        this._descripcion = descripcion;
    }
    get id() {
        return this._id;
    }
    set id(numero) {
        this._id = numero;
    }
    get familiar() {
        return this._familiar;
    }
    get enfermedad() {
        return this._enfermedad;
    }
    get descripcion() {
        return this._descripcion;
    }
    get ficha() {
        return this._ficha;
    }
}// CLASES //

