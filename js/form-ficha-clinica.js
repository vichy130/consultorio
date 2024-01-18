// Añadir un nuevo hijo
var anadirHijo = document.getElementById("agregarHijo"); //BOTON ANADIR HIJO
var tablaHijos = document.getElementById("tbody-hijos"); //TABLA HIJOS
/*var tablaHijosCompleta= document.getElementsById("tabla-hijos");//tabla completa (hide or display)*/
var arrayHijos = [];//ARRAY DE HIJOS
//Añadir nuevo antecedente
let anadirAntecedente = document.getElementById("agregarAntecedente"); //BOTON
let tablaAntecedentes = document.getElementById("tabla-antecedentes"); //TABLA
var arrayAntecedentes = [];
// Añadir nuevo antedecente familia
let anadirAntecedenteFam = document.getElementById("agregarAntecedenteFam"); //Boton agregar antecedenteFam
let tablaAntecedentesFam = document.getElementById("tabla-antecedentesFam"); //TABLA
var arrayAntecedentesFam = []; //ARREGLO DE ANTECEDENTES FAMILIARES
var tipoSangre; // VARIABLE TIPO SANGRE
var fetchedData;
var id;
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    fetchedData = null;
    id = null;
    fetch('./controller/obtener-ficha.php')
        .then(response => response.json())
        .then(data => {
            if (data.id != null) {
                fetchedData = data;
                console.log(data);
                document.getElementById("fecha-ficha").value = data.fecha;
                document.getElementById("recomendo-paciente").value = data.quienRecomendo;
                document.getElementById("tipo-sangre").value = data.tipoSangre;
                tipoSangre = data.tipoSangre;
                data.hijos.forEach(function (elemento) {// crea una instancia tipo hijo y la añade a un array
                    var hijo = new Hijo(elemento.sexo, elemento.edad);
                    hijo.id = elemento.id;
                    arrayHijos.push(hijo);
                    actualizarTablaHijos();
                });
                document.getElementById("embarazos-paciente").value = data.embarazo;
                document.getElementById("partos-paciente").value = data.partos;
                document.getElementById("cesareas-paciente").value = data.cesareas;
                document.getElementById("abortos-paciente").value = data.abortos;
                document.getElementById("muertos-paciente").value = data.muertos;
                document.getElementById("enfs-paciente").value = data.enfs;
                document.getElementById("menstruacion-paciente").value = data.fechaMenstruacion;
                document.getElementById("menstruacionperiodicidad-paciente").value = data.mensPeriodicidad;
                document.getElementById("menstruacionmolestias-paciente").value = data.mensMolestias;
                document.getElementById("fuma-paciente").value = data.fuma;
                document.getElementById("cigarros-paciente").value = data.cigarrosDia;
                document.getElementById("cigarros-antiguedad-paciente").value = data.fumaAntiguedad;
                document.getElementById("alcohol-paciente").value = data.alcohol;
                document.getElementById("frecuencia-paciente").value = data.alcFrecuencia;
                document.getElementById("cantidad-paciente").value = data.alcoholCantidad;
                document.getElementById("tipos-paciente").value = data.alcoholTipos;
                document.getElementById("adicciones-paciente").value = data.adicciones;
                document.getElementById("alergias-paciente").value = data.alergias;
                document.getElementById("desayuno-paciente").value = data.desayuno;
                document.getElementById("comida-paciente").value = data.comida;
                document.getElementById("cena-paciente").value = data.cena;
                document.getElementById("entrecomidas-paciente").value = data.entreComidas;
                document.getElementById("agua-paciente").value = data.vasoAguaDia;
                document.getElementById("otrosliquidos-paciente").value = data.otrosLiquidos;
                document.getElementById("intolerancias-paciente").value = data.intolerancias;
                document.getElementById("orinadia-paciente").value = data.orinaDia;
                document.getElementById("orinanoche-paciente").value = data.orinaNoche;
                document.getElementById("orinacolor-paciente").value = data.orinaColor;
                document.getElementById("orinaolor-paciente").value = data.orinaOlor;
                document.getElementById("orinamolestias-paciente").value = data.orinaMolestias;
                document.getElementById("excrementoaldia-paciente").value = data.excrementoDia;
                document.getElementById("excrementoconsistencia-paciente").value = data.exConsistencia;
                document.getElementById("excrementoolor-paciente").value = data.exOlor;
                document.getElementById("excrementocolor-paciente").value = data.exColor;
                document.getElementById("excrementodolor-paciente").value = data.exDolor;
                document.getElementById("ejercicio-paciente").value = data.ejercicioSemana;
                id = data.id;
                data.antecedentes.forEach(function (elemento) {
                    var antecedente = new Antecedente(elemento.enfermedad, elemento.descripcion, elemento.estaActiva);
                    antecedente.id = elemento.id;
                    arrayAntecedentes.push(antecedente);
                    actualizarTablaAntecedentes();
                });
                data.antecedentesFam.forEach(function (elemento) {
                    var antecedenteFam = new AntecedenteFam(elemento.familiar, elemento.enfermedad, elemento.descripcion);
                    antecedenteFam.id = elemento.id;
                    arrayAntecedentesFam.push(antecedenteFam);
                    actualizarTablaAntecedentesFam();
                });
            }// SI ID DE DATA ESTA NULL NO MANDAR VALORES A HTML
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
};

//LOAD HTML
document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO

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
        fecha.disabled = false;
        fecha.value = format;
        fecha.disabled = true;
        /*ocultoFecha.value = fecha.value;*/
    }
});
//FECHA
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
//FETCH FORMULARIO Y ARRAYS
var formFicha = document.getElementById('form-ficha');
formFicha.addEventListener('submit', function (e) {
    e.preventDefault();
    var datosFicha = new FormData(formFicha);
    var jsonHijos = JSON.stringify(arrayHijos);
    var jsonAntecedentes = JSON.stringify(arrayAntecedentes);
    var jsonAntecedentesFam = JSON.stringify(arrayAntecedentesFam);
    var jsonId;
    /*console.log(datosFicha.get('tipo-sangre'));
     console.log(jsonHijos);*/
    datosFicha.append('json-hijos', jsonHijos);
    datosFicha.append('json-antecedentes', jsonAntecedentes);
    datosFicha.append('json-antecedentesFam', jsonAntecedentesFam);
    if (fetchedData != null) {
        jsonId = JSON.stringify(id);
        datosFicha.append('id', jsonId);
        fetch('./controller/editar-ficha.php', {// Enviar los datos a PHP utilizando fetch
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
    }
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
class Ficha {
    constructor() {
    }
}
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
    set ficha(numero) {
        this._ficha = numero;
    }
    get ficha() {
        return this._ficha;
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
    set ficha(numero) {
        this._ficha = numero;
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
    set ficha(numero) {
        this._ficha = numero;
    }
}// CLASES //

