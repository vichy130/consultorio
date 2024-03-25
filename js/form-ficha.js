//VARIABLES
var fecha = document.getElementById("fecha-ficha");
var ocultoFecha = document.getElementById("oculto-fecha-ficha");
var fetchedData;
var ficha;
var arrayHijos = [];
var arrayAntecedentes = [];
var arrayAFamiliares = [];
var usuarioInput = document.getElementById('usuario-actualizacion');
var tipoSangre = document.getElementById('tipo-sangre');
var tablaHijos = document.getElementById('tabla-hijos');
var tablaAntecedentes = document.getElementById('tabla-antecedentes');
var tablaAFamiliares = document.getElementById('tabla-antecedentes-familiares');

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
                validarCampo(expresiones.recomendo, ficha.quienRecomendo, 'recomendo');
                document.getElementById("tipo-sangre").value = ficha.tipoSangre
                validarCampo(expresiones.tipo, ficha.tipoSangre, 'tipo');
                document.getElementById("embarazos-paciente").value = ficha.embarazo;
                validarCampo(expresiones.embarazos, ficha.embarazo, 'embarazos');
                document.getElementById("partos-paciente").value = ficha.partos;
                validarCampo(expresiones.partos, ficha.partos, 'partos');
                document.getElementById("cesareas-paciente").value = ficha.cesareas;
                validarCampo(expresiones.cesareas, ficha.cesareas, 'cesareas');
                document.getElementById("abortos-paciente").value = ficha.abortos;
                validarCampo(expresiones.abortos, ficha.abortos, 'abortos');
                document.getElementById("muertos-paciente").value = ficha.muertos;
                validarCampo(expresiones.muertos, ficha.muertos, 'muertos');
                document.getElementById("enfs-paciente").value = ficha.enfs;
                validarCampo(expresiones.enfs, ficha.enfs, 'enfs');
                document.getElementById("menstruacion-paciente").value = ficha.fechaMenstruacion;
                validarCampo(expresiones.menstruacion, ficha.fechaMenstruacion, 'menstruacion');
                document.getElementById("menstruacionperiodicidad-paciente").value = ficha.mensPeriodicidad;
                validarCampo(expresiones.menstruacionperiodicidad, ficha.mensMolestias, 'menstruacionperiodicidad');
                document.getElementById("menstruacionmolestias-paciente").value = ficha.mensMolestias;
                validarCampo(expresiones.menstruacionmolestias, ficha.mensMolestias, 'menstruacionmolestias');
                document.getElementById("fuma-paciente").value = ficha.fuma;
                document.getElementById("cigarros-paciente").value = ficha.cigarrosDia;
                validarCampo(expresiones.cigarros, ficha.cigarrosDia, 'cigarros');
                document.getElementById("cigarros-antiguedad-paciente").value = ficha.fumaAntiguedad;
                validarCampo(expresiones.cigarrosantiguedad, ficha.fumaAntiguedad, 'cigarrosantiguedad');
                document.getElementById("alcohol-paciente").value = ficha.alcohol;

                document.getElementById("frecuencia-paciente").value = ficha.alcFrecuencia;
                validarCampo(expresiones.frecuencia, ficha.alcFrecuencia, 'frecuencia');
                document.getElementById("cantidad-paciente").value = ficha.alcoholCantidad;
                validarCampo(expresiones.cantidad, ficha.alcoholCantidad, 'cantidad');
                document.getElementById("tipos-paciente").value = ficha.alcoholTipos;
                validarCampo(expresiones.tipos, ficha.alcoholTipos, 'tipos');
                document.getElementById("adicciones-paciente").value = ficha.adicciones;
                validarCampo(expresiones.adicciones, ficha.adicciones, 'adicciones');
                document.getElementById("alergias-paciente").value = ficha.alergias;
                validarCampo(expresiones.alergias, ficha.alergias, 'alergias');
                document.getElementById("desayuno-paciente").value = ficha.desayuno;
                validarCampo(expresiones.desayuno, ficha.desayuno, 'desayuno');
                document.getElementById("comida-paciente").value = ficha.comida;
                validarCampo(expresiones.comida, ficha.comida, 'comida');
                document.getElementById("cena-paciente").value = ficha.cena;
                validarCampo(expresiones.cena, ficha.cena, 'cena');
                document.getElementById("entrecomidas-paciente").value = ficha.entreComidas;
                validarCampo(expresiones.entrecomidas, ficha.entreComidas, 'entrecomidas');
                document.getElementById("agua-paciente").value = ficha.vasoAguaDia;
                validarCampo(expresiones.agua, ficha.vasoAguaDia, 'agua');
                document.getElementById("otrosliquidos-paciente").value = ficha.otrosLiquidos;
                validarCampo(expresiones.otrosliquidos, ficha.otrosLiquidos, 'otrosliquidos');
                document.getElementById("intolerancias-paciente").value = ficha.intolerancias;
                validarCampo(expresiones.intolerancias, ficha.intolerancias, 'intolerancias');
                document.getElementById("orinadia-paciente").value = ficha.orinaDia;
                validarCampo(expresiones.orinadia, ficha.orinaDia, 'orinadia');
                document.getElementById("orinanoche-paciente").value = ficha.orinaNoche;
                validarCampo(expresiones.orinanoche, ficha.orinaNoche, 'orinanoche');
                document.getElementById("orinacolor-paciente").value = ficha.orinaColor;
                validarCampo(expresiones.orinacolor, ficha.orinaColor, 'orinacolor');
                document.getElementById("orinaolor-paciente").value = ficha.orinaOlor;
                validarCampo(expresiones.orinaolor, ficha.orinaOlor, 'orinaolor');
                document.getElementById("orinamolestias-paciente").value = ficha.orinaMolestias;
                validarCampo(expresiones.orinamolestias, ficha.orinaMolestias, 'orinamolestias');
                document.getElementById("excrementoaldia-paciente").value = ficha.excrementoDia;
                validarCampo(expresiones.excrementoaldia, ficha.excrementoDia, 'excrementoaldia');
                document.getElementById("excrementoconsistencia-paciente").value = ficha.exConsistencia;
                validarCampo(expresiones.excrementoconsistencia, ficha.exConsistencia, 'excrementoconsistencia');
                document.getElementById("excrementoolor-paciente").value = ficha.exOlor;
                validarCampo(expresiones.excrementoolor, ficha.exOlor, 'excrementoolor');
                document.getElementById("excrementocolor-paciente").value = ficha.exColor;
                validarCampo(expresiones.excrementocolor, ficha.exColor, 'excrementocolor');
                document.getElementById("excrementodolor-paciente").value = ficha.exDolor;
                validarCampo(expresiones.excrementodolor, ficha.exDolor, 'excrementodolor');
                document.getElementById("ejercicio-paciente").value = ficha.ejercicioSemana;
                validarCampo(expresiones.ejercicio, ficha.ejercicioSemana, 'ejercicio');
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
tablaHijos.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("eliminar-hijo")) {
        const elementoEliminar = e.target.dataset.id;
        eliminarHijo(elementoEliminar);
    }
});
tablaAntecedentes.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("eliminar-antecedente")) {
        const elementoEliminar = e.target.dataset.id;
        eliminarAntecedente(elementoEliminar);
    }
});
tablaAFamiliares.addEventListener('click', function (e) {
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
function enviarFormFicha() {
    var datosFicha = new FormData(formFicha);
    jsonHijos = JSON.stringify(arrayHijos);
    jsonAntecedentes = JSON.stringify(arrayAntecedentes);
    jsonAFamiliares = JSON.stringify(arrayAFamiliares);
    datosFicha.append('hijos', jsonHijos);
    datosFicha.append('json-antecedentes', jsonAntecedentes);
    datosFicha.append('json-antecedentesFam', jsonAFamiliares);
    if (ficha != null) {
        jsonFicha = JSON.stringify(ficha);
        datosFicha.append('ficha', jsonFicha);
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
    clearTabla(tablaHijos);
    contador = 0;
    if (arrayHijos.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const registro = document.createElement('th');
        const sexo = document.createElement('th');
        const edad = document.createElement('th');
        const eliminar = document.createElement('th');
        sexo.textContent = "Sexo";
        edad.textContent = "Edad";
        eliminar.textContent = "Eliminar";
        registro.className = "column-to-hide";
        propiedades.appendChild(registro);
        propiedades.appendChild(sexo);
        propiedades.appendChild(edad);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tablaHijos.appendChild(thead);
        const tbody = document.createElement('tbody');
        arrayHijos.forEach(elemento => {
            contador++;
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
        tablaHijos.appendChild(tbody);
    }
}
function actualizarTablaAntecedentes() {
    clearTabla(tablaAntecedentes);
    contador = 0;
    if (arrayAntecedentes.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const registro = document.createElement('th');
        const enfermedad = document.createElement('th');
        const descripcion = document.createElement('th');
        const estaActiva = document.createElement('th');
        const eliminar = document.createElement('th');

        enfermedad.textContent = "Enfermedad";
        descripcion.textContent = "Descripción";
        estaActiva.textContent = "Está activa";
        eliminar.textContent = "Eliminar";
        registro.className = "column-to-hide";
        propiedades.appendChild(registro);
        propiedades.appendChild(enfermedad);
        propiedades.appendChild(descripcion);
        propiedades.appendChild(estaActiva);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tablaAntecedentes.appendChild(thead);
        const tbody = document.createElement('tbody');
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
            tablaAntecedentes.append(celda);
        });
        tablaAntecedentes.appendChild(tbody);
    }
}
function actualizarTablaAFamiliares() {
    clearTabla(tablaAFamiliares);
    contador = 0;
    if (arrayAFamiliares.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const registro = document.createElement('th');
        const parentesco = document.createElement('th');
        const enfermedad = document.createElement('th');
        const descripcion = document.createElement('th');
        const eliminar = document.createElement('th');
        parentesco.textContent = "Parentesco";
        enfermedad.textContent = "Enfermedad";
        descripcion.textContent = "Descripción";
        eliminar.textContent = "Eliminar";
        registro.className = "column-to-hide";
        propiedades.appendChild(registro);
        propiedades.appendChild(parentesco);
        propiedades.appendChild(enfermedad);
        propiedades.appendChild(descripcion);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tablaAFamiliares.appendChild(thead);
        const tbody = document.createElement('tbody');
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
            tablaAFamiliares.append(celda);
        });
        tablaAFamiliares.appendChild(tbody);
    }
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

