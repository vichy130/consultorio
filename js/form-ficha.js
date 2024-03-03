//VARIABLES
var fecha = document.getElementById("fecha-ficha");
var ocultoFecha = document.getElementById("oculto-fecha-ficha");
var fetchedData;
var ficha;
var arrayHijos = [];
var arrayAntecedentes = [];
var arrayAFamiliares = [];
var usuarioInput = document.getElementById('usuario-actualizacion');
var tbodyHijos = document.getElementById('tbody-hijos');
var tbodyAntecedentes = document.getElementById('tbody-antecedentes');
var tbodyAFamiliares = document.getElementById('tbody-antecedentes-familiares');
var tipoSangre = document.getElementById('tipo-sangre');
var tablaHijos= document.getElementById('tabla-hijos');
var tablaAntecedentes=document.getElementById('tabla-antecedentes');
var tablaAFamiliares=document.getElementById('tabla-antecedentes-familiares');

var botonAnadirHijo = document.getElementById('agregarHijo');
var botonAnadirAntecedente = document.getElementById('agregarAntecedente');
var botonAnadirAFamiliares = document.getElementById('agregarAntecedenteFam');

document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO
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
        ocultoFecha.value = fecha.value;
    }
});
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerFicha();
};
function obtenerFicha() {
    fetch('./controller/obtener-ficha.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.id != null) {
                console.log(data);
                ficha = new Ficha(data.tipoSangre, data.quienRecomendo, data.embarazo, data.partos, data.cesareas, data.abortos, data.muertos, data.enfs, data.fuma, data.cigarrosDia, data.fumaAntiguedad, data.alcohol, data.alcFrecuencia, data.alcoholCantidad, data.alcoholTipos, data.adicciones, data.alergias, data.desayuno, data.comida, data.cena, data.entreComidas, data.vasoAguaDia, data.otrosLiquidos, data.intolerancias, data.orinaDia, data.orinaNoche, data.orinaColor, data.orinaOlor, data.orinaMolestias, data.excrementoDia, data.exConsistencia, data.exOlor, data.exColor, data.exDolor, data.fechaMenstruacion, data.mensPeriodicidad, data.mensMolestias, data.ejercicioSemana, data.fecha, /*firmaPaciente*/ data.hora);
                ficha.id = data.id;
                ficha.paciente = data.paciente;
                ficha.usuario = data.usuario;
                document.getElementById('fecha-ficha').value = ficha.fecha;
                document.getElementById("recomendo-paciente").value = ficha.quienRecomendo;
                document.getElementById("tipo-sangre").value = ficha.tipoSangre
                document.getElementById("embarazos-paciente").value = ficha.embarazo;
                document.getElementById("partos-paciente").value = ficha.partos;
                document.getElementById("cesareas-paciente").value = ficha.cesareas;
                document.getElementById("abortos-paciente").value = ficha.abortos;
                document.getElementById("muertos-paciente").value = ficha.muertos;
                document.getElementById("enfs-paciente").value = ficha.enfs;
                document.getElementById("menstruacion-paciente").value = ficha.fechaMenstruacion;
                document.getElementById("menstruacionperiodicidad-paciente").value = ficha.mensPeriodicidad;
                document.getElementById("menstruacionmolestias-paciente").value = ficha.mensMolestias;
                document.getElementById("fuma-paciente").value = ficha.fuma;
                document.getElementById("cigarros-paciente").value = ficha.cigarrosDia;
                document.getElementById("cigarros-antiguedad-paciente").value = ficha.fumaAntiguedad;
                document.getElementById("alcohol-paciente").value = ficha.alcohol;
                document.getElementById("frecuencia-paciente").value = ficha.alcFrecuencia;
                document.getElementById("cantidad-paciente").value = ficha.alcoholCantidad;
                document.getElementById("tipos-paciente").value = ficha.alcoholTipos;
                document.getElementById("adicciones-paciente").value = ficha.adicciones;
                document.getElementById("alergias-paciente").value = ficha.alergias;
                document.getElementById("desayuno-paciente").value = ficha.desayuno;
                document.getElementById("comida-paciente").value = ficha.comida;
                document.getElementById("cena-paciente").value = ficha.cena;
                document.getElementById("entrecomidas-paciente").value = ficha.entreComidas;
                document.getElementById("agua-paciente").value = ficha.vasoAguaDia;
                document.getElementById("otrosliquidos-paciente").value = ficha.otrosLiquidos;
                document.getElementById("intolerancias-paciente").value = ficha.intolerancias;
                document.getElementById("orinadia-paciente").value = ficha.orinaDia;
                document.getElementById("orinanoche-paciente").value = ficha.orinaNoche;
                document.getElementById("orinacolor-paciente").value = ficha.orinaColor;
                document.getElementById("orinaolor-paciente").value = ficha.orinaOlor;
                document.getElementById("orinamolestias-paciente").value = ficha.orinaMolestias;
                document.getElementById("excrementoaldia-paciente").value = ficha.excrementoDia;
                document.getElementById("excrementoconsistencia-paciente").value = ficha.exConsistencia;
                document.getElementById("excrementoolor-paciente").value = ficha.exOlor;
                document.getElementById("excrementocolor-paciente").value = ficha.exColor;
                document.getElementById("excrementodolor-paciente").value = ficha.exDolor;
                document.getElementById("ejercicio-paciente").value = ficha.ejercicioSemana;
                usuarioInput.textContent = "Ultima actualización realizada por: " + ficha.usuario + ".";
                data.hijos.forEach(elemento => {
                    hijo = new Hijo();
                    hijo.id = elemento.id;
                    hijo.sexo = elemento.sexo;
                    hijo.edad = elemento.edad;
                    arrayHijos.push(hijo);
                });
                actualizarTablaHijos();
                data.antecedentes.forEach(elemento => {
                    antecedente = new Antecedente()
                    antecedente.id = elemento.id;
                    antecedente.enfermedad = elemento.enfermedad;
                    antecedente.estaActiva = elemento.estaActiva;
                    antecedente.descripcion = elemento.descripcion;
                    arrayAntecedentes.push(antecedente);
                });
                actualizarTablaAntecedentes();
                data.antecedentesFam.forEach(elemento => {
                    aFamiliar = new AntecedenteFamiliar();
                    aFamiliar.id = elemento.id;
                    aFamiliar.parentesco = elemento.parentesco;
                    aFamiliar.enfermedad = elemento.enfermedad;
                    aFamiliar.descripcion = elemento.descripcion;
                    arrayAFamiliares.push(aFamiliar);
                });
                actualizarTablaAFamiliares();
            }
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
            console.log("catch");
        });
}
tbodyHijos.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("eliminar-hijo")) {
        const elementoEliminar = e.target.dataset.id;
        eliminarHijo(elementoEliminar);
    }
});
tbodyAntecedentes.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("eliminar-antecedente")) {
        const elementoEliminar = e.target.dataset.id;
        eliminarAntecedente(elementoEliminar);
    }
});
tbodyAFamiliares.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("eliminar-antecedente-familiar")) {
        const elementoEliminar = e.target.dataset.id;
        eliminarAFamiliar(elementoEliminar);
    }
});
botonAnadirHijo.addEventListener("click", function (e) {
    e.preventDefault();
    insertarHijo();
});
botonAnadirAntecedente.addEventListener("click", function (e) {
    e.preventDefault();
    insertarAntecedente();
});
botonAnadirAFamiliares.addEventListener("click", function (e) {
    e.preventDefault();
    insertarAFamiliar();
});
function enviarFormFicha(){
    e.preventDefault();
    var datosFicha = new FormData(formFicha);
    jsonHijos=JSON.stringify(arrayHijos);
    jsonAntecedentes= JSON.stringify(arrayAntecedentes);
    jsonAFamiliares=JSON.stringify(arrayAFamiliares);
    datosFicha.append('hijos', jsonHijos);
    datosFicha.append('json-antecedentes', jsonAntecedentes);
    datosFicha.append('json-antecedentesFam', jsonAFamiliares);
    if (ficha!=null){
        jsonFicha=JSON.stringify(ficha);
        datosFicha.append('ficha',jsonFicha);
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
    }else{
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
};
//FUNCIONES
function insertarHijo() {
    let sexo = document.querySelector('input[name="sexo-hijo"]:checked').value;
    let edad = document.getElementById('hijoedad-paciente').value;
    hijo = new Hijo();
    hijo.id = new Date().getTime();
    hijo.sexo = sexo;
    hijo.edad = edad;
    arrayHijos.push(hijo);
    actualizarTablaHijos();
}
function insertarAntecedente() {
    let enfermedad = document.getElementById('enfermedad-paciente').value;
    let estaActiva = document.getElementById('enfermedad-activa').value;
    let descripcion = document.getElementById('enfermedad-descripcion-paciente').value;
    antecedente = new Antecedente();
    antecedente.id = new Date().getTime();
    antecedente.enfermedad = enfermedad;
    antecedente.estaActiva = estaActiva;
    antecedente.descripcion = descripcion;
    arrayAntecedentes.push(antecedente);
    actualizarTablaAntecedentes();
}
function insertarAFamiliar() {
    let parentesco = document.getElementById('parentesco-paciente').value;
    let enfermedad = document.getElementById('familiarenfermedad-paciente').value;
    let descripcion = document.getElementById('familiarenfermedad-descripcion-paciente').value;
    aFamiliar = new AntecedenteFamiliar();
    aFamiliar.id = new Date().getTime();
    aFamiliar.parentesco = parentesco;
    aFamiliar.enfermedad = enfermedad;
    aFamiliar.descripcion = descripcion;
    arrayAFamiliares.push(aFamiliar);
    console.log(parentesco);
    actualizarTablaAFamiliares();
}
function actualizarTablaHijos() {
    clearTabla(tbodyHijos);
    contador = 0;

    arrayHijos.forEach(elemento => {
        contador++;
        const tabla=document.createElement('table');
        tabla.className="table span-4 tabla-hijos";
        const thead=document.createElement('thead');
        const propiedades=document.createElement('tr');
        const registro=document.createElement('th');
        const sexo=document.createElement('th');
        const edad=document.createElement('th');
        const eliminar=document.createElement('th');

        const tbody=document.createElement('tbody');
        

        const celda = document.createElement('tr');
        const contadorFila = document.createElement('td');
        const sexoFila = document.createElement('td');
        const edadFila = document.createElement('td');
        const eliminarFila = document.createElement('td');

        const iconoEliminar = document.createElement('i');
        iconoEliminar.className = "fas fa-trash eliminar-hijo";
        iconoEliminar.dataset.id = elemento.id;

        contadorFila.textContent = contador;
        sexoFila.textContent = elemento.sexo;
        edadFila.textContent = elemento.edad;

        celda.append(contadorFila);
        celda.append(sexoFila);
        celda.append(edadFila);
        eliminarFila.append(iconoEliminar);
        celda.append(eliminarFila);
        tbody.append(celda);
    });
}
function actualizarTablaAntecedentes() {
    clearTabla(tbodyAntecedentes);
    contador = 0;
    arrayAntecedentes.forEach(elemento => {
        contador++;
        const celda = document.createElement('tr');
        const contadorFila = document.createElement('td');
        const enfermedadFila = document.createElement('td');
        const estaActivaFila = document.createElement('td');
        const descripcionFila = document.createElement('td');
        const eliminarFila = document.createElement('td');

        const iconoEliminar = document.createElement('i');
        iconoEliminar.className = "fas fa-trash eliminar-antecedente";
        iconoEliminar.dataset.id = elemento.id;

        contadorFila.textContent = contador;
        enfermedadFila.textContent = elemento.enfermedad;
        estaActivaFila.textContent = elemento.estaActiva;
        descripcionFila.textContent = elemento.descripcion;

        celda.append(contadorFila);
        celda.append(enfermedadFila);
        celda.append(descripcionFila);
        celda.append(estaActivaFila);
        eliminarFila.append(iconoEliminar);
        celda.append(eliminarFila);
        tbodyAntecedentes.append(celda);
    });
}
function actualizarTablaAFamiliares() {
    clearTabla(tbodyAFamiliares);
    contador = 0;
    arrayAFamiliares.forEach(elemento => {
        contador++;
        const celda = document.createElement('tr');
        const contadorFila = document.createElement('td');
        const parentescoFila = document.createElement('td');
        const enfermedadFila = document.createElement('td');
        const descripcionFila = document.createElement('td');
        const eliminarFila = document.createElement('td');

        const iconoEliminar = document.createElement('i');
        iconoEliminar.className = "fas fa-trash eliminar-antecedente-familiar";
        iconoEliminar.dataset.id = elemento.id;

        contadorFila.textContent = contador;
        parentescoFila.textContent = elemento.parentesco;
        enfermedadFila.textContent = elemento.enfermedad;
        descripcionFila.textContent = elemento.descripcion;

        celda.append(contadorFila);
        celda.append(parentescoFila);
        celda.append(enfermedadFila);
        celda.append(descripcionFila);
        eliminarFila.append(iconoEliminar);
        celda.append(eliminarFila);
        tbodyAFamiliares.append(celda);
    });
}
function clearTabla(div) {
    div.replaceChildren();
}
function eliminarHijo(id) {
    arrayHijos = arrayHijos.filter(ele => ele.id != id);
    actualizarTablaHijos();
}
function eliminarAntecedente(id) {
    arrayAntecedentes = arrayAntecedentes.filter(ele => ele.id != id);
    actualizarTablaAntecedentes();
}
function eliminarAFamiliar(id) {
    arrayAFamiliares = arrayAFamiliares.filter(ele => ele.id != id);
    actualizarTablaAFamiliares();
}

class Hijo {
    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
    set sexo(sexo) {
        this._sexo = sexo;
    }
    get sexo() {
        return this._sexo;
    }
    set edad(edad) {
        this._edad = edad;
    }
    get edad() {
        return this._edad;
    }
}
class Antecedente {
    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
    set enfermedad(elemento) {
        this._enfermedad = elemento;
    }
    get enfermedad() {
        return this._enfermedad;
    }
    set estaActiva(elemento) {
        this._estaActiva = elemento;
    }
    get estaActiva() {
        return this._estaActiva;
    }
    set descripcion(elemento) {
        this._descripcion = elemento;
    }
    get descripcion() {
        return this._descripcion;
    }
}
class AntecedenteFamiliar {
    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
    set parentesco(parentesco) {
        this._parentesco = parentesco;
    }
    get parentesco() {
        return this._parentesco;
    }
    set enfermedad(enfermedad) {
        this._enfermedad = enfermedad;
    }
    get enfermedad() {
        return this._enfermedad;
    }
    set descripcion(descripcion) {
        this._descripcion = descripcion;
    }
    get descripcion() {
        return this._descripcion;
    }
}
class Ficha {
    constructor(tipoSangre, quienRecomendo, embarazo, partos, cesareas, abortos, muertos, enfs, fuma, cigarrosDia, fumaAntiguedad, alcohol, alcFrecuencia, alcoholCantidad, alcoholTipos, adicciones, alergias, desayuno, comida, cena, entreComidas, vasoAguaDia, otrosLiquidos, intolerancias, orinaDia, orinaNoche, orinaColor, orinaOlor, orinaMolestias, excrementoDia, exConsistencia, exOlor, exColor, exDolor, fechaMenstruacion, mensPeriodicidad, mensMolestias, ejercicioSemana, fecha, /*firmaPaciente*/ hora) {
        this._tipoSangre = tipoSangre;
        this._quienRecomendo = quienRecomendo;
        this._embarazo = embarazo;
        this._partos = partos;
        this._cesareas = cesareas;
        this._abortos = abortos;
        this._muertos = muertos;
        this._enfs = enfs;
        this._fuma = fuma;
        this._cigarrosDia = cigarrosDia;
        this._fumaAntiguedad = fumaAntiguedad;
        this._alcohol = alcohol;
        this._alcFrecuencia = alcFrecuencia;
        this._alcoholCantidad = alcoholCantidad;
        this._alcoholTipos = alcoholTipos;
        this._adicciones = adicciones;
        this._alergias = alergias;
        this._desayuno = desayuno;
        this._comida = comida;
        this._cena = cena;
        this._entreComidas = entreComidas;
        this._vasoAguaDia = vasoAguaDia;
        this._otrosLiquidos = otrosLiquidos;
        this._intolerancias = intolerancias;
        this._orinaDia = orinaDia;
        this._orinaNoche = orinaNoche;
        this._orinaColor = orinaColor;
        this._orinaOlor = orinaOlor;
        this._orinaMolestias = orinaMolestias;
        this._excrementoDia = excrementoDia;
        this._exConsistencia = exConsistencia;
        this._exOlor = exOlor;
        this._exColor = exColor;
        this._exDolor = exDolor;
        this._fechaMenstruacion = fechaMenstruacion;
        this._mensPeriodicidad = mensPeriodicidad;
        this._mensMolestias = mensMolestias;
        this._ejercicioSemana = ejercicioSemana;
        this._fecha = fecha;
        // this._firmaPaciente = firmaPaciente;
        this._hora = hora;
    }
    get usuario() {
        return this._usuario;
    }
    set usuario(usuario) {
        this._usuario = usuario;
    }
    get id() {
        return this._id;
    }
    set id(id) {
        this._id = id;
    }
    get paciente() {
        return this._paciente;
    }
    set paciente(paciente) {
        this._paciente = paciente;
    }
    get tipoSangre() {
        return this._tipoSangre;
    }

    get quienRecomendo() {
        return this._quienRecomendo;
    }
    get fuma() {
        return this._fuma;
    }

    get cigarrosDia() {
        return this._cigarrosDia;
    }

    get fumaAntiguedad() {
        return this._fumaAntiguedad;
    }

    get alcohol() {
        return this._alcohol;
    }

    get alcFrecuencia() {
        return this._alcFrecuencia;
    }

    get alcoholCantidad() {
        return this._alcoholCantidad;
    }

    get alcoholTipos() {
        return this._alcoholTipos;
    }

    get adicciones() {
        return this._adicciones;
    }

    get alergias() {
        return this._alergias;
    }

    get desayuno() {
        return this._desayuno;
    }

    get comida() {
        return this._comida;
    }

    get cena() {
        return this._cena;
    }

    get entreComidas() {
        return this._entreComidas;
    }

    get vasoAguaDia() {
        return this._vasoAguaDia;
    }

    get otrosLiquidos() {
        return this._otrosLiquidos;
    }

    get intolerancias() {
        return this._intolerancias;
    }

    get orinaDia() {
        return this._orinaDia;
    }

    get orinaNoche() {
        return this._orinaNoche;
    }

    get orinaColor() {
        return this._orinaColor;
    }

    get orinaOlor() {
        return this._orinaOlor;
    }

    get orinaMolestias() {
        return this._orinaMolestias;
    }

    get excrementoDia() {
        return this._excrementoDia;
    }

    get exConsistencia() {
        return this._exConsistencia;
    }

    get exOlor() {
        return this._exOlor;
    }

    get exColor() {
        return this._exColor;
    }

    get exDolor() {
        return this._exDolor;
    }

    get fechaMenstruacion() {
        return this._fechaMenstruacion;
    }

    get mensPeriodicidad() {
        return this._mensPeriodicidad;
    }

    get mensMolestias() {
        return this._mensMolestias;
    }

    get ejercicioSemana() {
        return this._ejercicioSemana;
    }

    get fecha() {
        return this._fecha;
    }
    get embarazo() {
        return this._embarazo;
    }
    get partos() {
        return this._partos
    }
    get cesareas() {
        return this._cesareas;
    }
    get muertos() {
        return this._muertos;
    }
    get enfs() {
        return this._enfs;
    }
    get abortos() {
        return this._abortos;
    }
    // get firmaPaciente() {
    //     return this._firmaPaciente;
    // }

    get hora() {
        return this._hora;
    }
}

