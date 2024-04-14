//VARIABLES
var fecha = document.getElementById("fecha-ficha");
var ocultoFecha = document.getElementById("oculto-fecha-ficha");
var fetchedData;
var ficha;
var paciente;
var arrayHijos = [];
var arrayAntecedentes = [];
var arrayAFamiliares = [];
// const tipo={obtener: "obtener", guardar:"guardar", eliminar:"eliminar"};
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
    deshabilitarAlcohol();
    deshabilitarFuma();
};
function obtenerFicha() {
    fetch('./controller/obtener-ficha.php')
        .then(response => response.json())
        .then(data => {
            if (data != null) {
                if ('id' in data) {
                    ficha = new Ficha(data.tipoSangre, data.quienRecomendo, data.embarazo, data.partos, data.cesareas, data.abortos, data.muertos, data.enfs, data.fuma, data.cigarrosDia, data.fumaAntiguedad, data.alcohol, data.alcFrecuencia, data.alcoholCantidad, data.alcoholTipos, data.adicciones, data.alergias, data.desayuno, data.comida, data.cena, data.entreComidas, data.vasoAguaDia, data.otrosLiquidos, data.intolerancias, data.orinaDia, data.orinaNoche, data.orinaColor, data.orinaOlor, data.orinaMolestias, data.excrementoDia, data.exConsistencia, data.exOlor, data.exColor, data.exDolor, data.fechaMenstruacion, data.mensPeriodicidad, data.mensMolestias, data.ejercicioSemana, data.fecha, data.hora);
                    ficha.id = data.id;
                    ficha.paciente = data.paciente;
                    ficha.usuario = data.usuario;
                    document.getElementById('fecha-ficha').value = ficha.fecha;
                    inputRecomendo.value = ficha.quienRecomendo;
                    inputTipoSangre.value = ficha.tipoSangre
                    inputEmbarazos.value = ficha.embarazo;
                    inputPartos.value = ficha.partos;
                    inputCesareas.value = ficha.cesareas;
                    inputAbortos.value = ficha.abortos;
                    inputMuertos.value = ficha.muertos;
                    inputEnfs.value = ficha.enfs;
                    inputMenstruacion.value = ficha.fechaMenstruacion;
                    inputMenstruacionPeriodicidad.value = ficha.mensPeriodicidad;
                    inputMenstruacionMolestias.value = ficha.mensMolestias;
                    inputFuma.value = ficha.fuma;
                    inputCigarros.value = ficha.cigarrosDia;
                    inputCigarrosAntiguedad.value = ficha.fumaAntiguedad;
                    inputAlcohol.value = ficha.alcohol;
                    inputFrecuencia.value = ficha.alcFrecuencia;
                    inputCantidad.value = ficha.alcoholCantidad;
                    inputTipos.value = ficha.alcoholTipos;
                    inputAdicciones.value = ficha.adicciones;
                    inputAlergias.value = ficha.alergias;
                    inputDesayuno.value = ficha.desayuno;
                    inputComida.value = ficha.comida;
                    inputCena.value = ficha.cena;
                    inputEntrecomidas.value = ficha.entreComidas;
                    inputAgua.value = ficha.vasoAguaDia;
                    inputOtrosLiquidos.value = ficha.otrosLiquidos;
                    inputIntolerancias.value = ficha.intolerancias;
                    inputOrinaDia.value = ficha.orinaDia;
                    inputOrinaNoche.value = ficha.orinaNoche;
                    inputOrinaColor.value = ficha.orinaColor;
                    inputOrinaOlor.value = ficha.orinaOlor;
                    inputOrinaMolestias.value = ficha.orinaMolestias;
                    inputExcrementoDia.value = ficha.excrementoDia;
                    inputExcrementoConsistencia.value = ficha.exConsistencia;
                    inputExcrementoOlor.value = ficha.exOlor;
                    inputExcrementoColor.value = ficha.exColor;
                    inputExcrementoDolor.value = ficha.exDolor;
                    inputEjercicio.value = ficha.ejercicioSemana;
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
                        aFamiliar.familiar = elemento.familiar;
                        aFamiliar.enfermedad = elemento.enfermedad;
                        aFamiliar.descripcion = elemento.descripcion;
                        arrayAFamiliares.push(aFamiliar);
                    });
                    actualizarTablaAFamiliares();
                    validarFicha();

                } else {
                    modalError(data, tipo.obtener);
                }
            }
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
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
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                if (data != null) {
                    if ('id' in data) {
                        console.log("id en data");
                        console.log(data.quienRecomendo);
                        ficha = new Ficha(data.tipoSangre, data.quienRecomendo, data.embarazo, data.partos, data.cesareas, data.abortos, data.muertos, data.enfs, data.fuma, data.cigarrosDia, data.fumaAntiguedad, data.alcohol, data.alcFrecuencia, data.alcoholCantidad, data.alcoholTipos, data.adicciones, data.alergias, data.desayuno, data.comida, data.cena, data.entreComidas, data.vasoAguaDia, data.otrosLiquidos, data.intolerancias, data.orinaDia, data.orinaNoche, data.orinaColor, data.orinaOlor, data.orinaMolestias, data.excrementoDia, data.exConsistencia, data.exOlor, data.exColor, data.exDolor, data.fechaMenstruacion, data.mensPeriodicidad, data.mensMolestias, data.ejercicioSemana, data.fecha, data.hora);
                        ficha.id = data.id;
                        ficha.paciente = data.paciente;
                        ficha.usuario = data.usuario;
                        modalExito();
                    } else {
                        console.log(data);
                        modalError(data, tipo.guardar);
                    }
                }
            })
            .catch(function (error) {
                console.log(data);
                modalError(error, tipo.guardar);
            });
    } else {
        fetch('./controller/nueva-ficha.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosFicha // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data != null) {
                    if ('id' in data) {
                        ficha = new Ficha(data.tipoSangre, data.quienRecomendo, data.embarazo, data.partos, data.cesareas, data.abortos, data.muertos, data.enfs, data.fuma, data.cigarrosDia, data.fumaAntiguedad, data.alcohol, data.alcFrecuencia, data.alcoholCantidad, data.alcoholTipos, data.adicciones, data.alergias, data.desayuno, data.comida, data.cena, data.entreComidas, data.vasoAguaDia, data.otrosLiquidos, data.intolerancias, data.orinaDia, data.orinaNoche, data.orinaColor, data.orinaOlor, data.orinaMolestias, data.excrementoDia, data.exConsistencia, data.exOlor, data.exColor, data.exDolor, data.fechaMenstruacion, data.mensPeriodicidad, data.mensMolestias, data.ejercicioSemana, data.fecha, data.hora);
                        ficha.id = data.id;
                        ficha.paciente = data.paciente;
                        ficha.usuario = data.usuario;
                        if(ficha.id != null){
                            modalExito();
                        }
                    } else {
                        console.log(data);
                        modalError(data, tipo.guardar);
                    }
                }
            })
            .catch(function (error) {
                console.log(data);
                modalError(error, tipo.guardar);
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
    let familiar = document.getElementById('parentesco-paciente').value;
    let enfermedad = document.getElementById('familiarenfermedad-paciente').value;
    let descripcion = document.getElementById('familiarenfermedad-descripcion-paciente').value;
    aFamiliar = new AntecedenteFamiliar();
    aFamiliar.id = new Date().getTime();
    aFamiliar.familiar = familiar;
    aFamiliar.enfermedad = enfermedad;
    aFamiliar.descripcion = descripcion;
    arrayAFamiliares.push(aFamiliar);
    console.log(familiar);
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
        const familiar = document.createElement('th');
        const enfermedad = document.createElement('th');
        const descripcion = document.createElement('th');
        const eliminar = document.createElement('th');
        familiar.textContent = "Parentesco";
        enfermedad.textContent = "Enfermedad";
        descripcion.textContent = "Descripción";
        eliminar.textContent = "Eliminar";
        registro.className = "column-to-hide";
        propiedades.appendChild(registro);
        propiedades.appendChild(familiar);
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
            const familiarFila = document.createElement('td');
            const enfermedadFila = document.createElement('td');
            const descripcionFila = document.createElement('td');
            const eliminarFila = document.createElement('td');

            const iconoEliminar = document.createElement('i');
            iconoEliminar.className = "fas fa-trash eliminar-antecedente-familiar";
            iconoEliminar.dataset.id = elemento.id;

            contadorFila.textContent = contador;
            familiarFila.textContent = elemento.familiar;
            enfermedadFila.textContent = elemento.enfermedad;
            descripcionFila.textContent = elemento.descripcion;

            celda.append(contadorFila);
            celda.append(familiarFila);
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

//MODAL
var modal = document.getElementById("modal");
var modalContent = document.getElementById("modal-contenido");
const botonModalCerrar = document.createElement('button');
botonModalCerrar.textContent = "Cerrar";
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function modalExito() {
    clearDiv(modalContent);
    botonModalCerrar.className = "boton azul modal-cerrar";
    modalContent.classList.remove('modal-contenido-error');
    modalContent.classList.add('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-un-column');
    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');

    titulo.textContent = "¡Ficha clínica guardada!";
    parrafo.textContent = "Los datos se han almacenado con éxito.";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalCerrar);
    modalContent.appendChild(divBoton);
    // setTimeout(modal.style.display = "none", 10000);
}
function modalError(error, tipo) {
    clearDiv(modalContent);
    botonModalCerrar.className = "boton blanco modal-cerrar";
    modalContent.classList.remove('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-error');
    modalContent.classList.add('modal-contenido-un-column');

    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    // const iconoAlerta = document.createElement('i');
    // iconoAlerta.className = "fa-solid fa-bell";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";
    if (tipo == "guardar") {
        titulo.textContent = '¡Los cambios NO han sido guardados!';
    } else if (tipo == "obtener") {
        titulo.textContent = '¡La información no pudo ser obtenida!';
    }
    if(error=="campos"){
        parrafo.textContent = "Porfavor, revisa todos los campos e intenta de nuevo.";
    }
    if (error != "false") {
        parrafo.textContent = "Contacta a tu administrador, Error: " + error;
    }else {
        parrafo.textContent = "Porfavor, revisa la información e intenta de nuevo.";
    }
    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalCerrar);
    modalContent.appendChild(divBoton);
}
function modalErrorCampos(error, tipo) {
    clearDiv(modalContent);
    botonModalCerrar.className = "boton blanco modal-cerrar";
    modalContent.classList.remove('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-error');
    modalContent.classList.add('modal-contenido-un-column');

    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    // const iconoAlerta = document.createElement('i');
    // iconoAlerta.className = "fa-solid fa-bell";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";
    if (tipo == "guardar") {
        titulo.textContent = '¡Los cambios NO han sido guardados!';
    } else if (tipo == "obtener") {
        titulo.textContent = '¡La información no pudo ser obtenida!';
    }
    if (error != "false") {
        parrafo.textContent = "Contacta a tu administrador, Error: " + error;
    } else {
        parrafo.textContent = "Porfavor, revisa la información e intenta de nuevo.";
    }
    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalCerrar);
    modalContent.appendChild(divBoton);
}
modal.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("modal-cerrar")) {
        modal.style.display = "none";
    }
})
//FUNCION BORRAR DIV
function clearDiv(div) {
    div.replaceChildren();
}
//MODAL END

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
    set familiar(familiar) {
        this._familiar = familiar;
    }
    get familiar() {
        return this._familiar;
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

