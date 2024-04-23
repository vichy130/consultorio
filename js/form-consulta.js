//VARIABLES
var fecha = document.getElementById("consultafecha-paciente");
var ocultoFecha = document.getElementById("oculto-fecha-consulta");
var consultaObjeto;
var usuario;
var arrayConsultorios = [];
var arrayCPrevias = [];
var arrayMedicamentos = [];
var arrayMedicamentoIndicaciones = [];
var arrayEstudiosSolicitados = [];
var arrayTerapiasAplicadas = [];
var receta = new Date().getTime();
var medicamentoDatalist = document.getElementById("datalist-consultanombremed-paciente");
var labelTamano = document.getElementById('label-tamano');
var tablaCPrevias = document.getElementById("tabla-consultas-previas");//
var tablaMedicamentoIndicacion = document.getElementById("tabla-medicamento-indicacion");
var tablaTerapiasAplicadas = document.getElementById("tabla-terapias-aplicadas");
var tablaEstudiosSolicitados = document.getElementById("tabla-estudios-solicitados");
var inputIndicacionesMedicamento = document.getElementById("indicacionesmed-paciente"); //INPUT
//TABLA
var selectConsultorio = document.getElementById("select-consultorio"); //SELECT
var selectMedicamentoHora = document.getElementById("select-medicamento-hora");
var anadirCPrevia = document.getElementById('boton-consulta-previa');//BOTON
var anadirEstudioSolicitado = document.getElementById("boton-estudios-solicitados");
var anadirTerapia = document.getElementById("boton-terapia");
var botonImprimirReceta = document.getElementById("boton-imprimir-receta");
var selectTamano = document.getElementById('select-tamano');
var grupoTamano=document.getElementById('grupo_tamano');
var botonGuardar=document.getElementById('boton-guardar');
var divImprimirConsulta=document.getElementById('imprimir');
botonCancelar=document.getElementById('boton-cancelar-consulta');
//VARIABLES

//BOTONES -- EVENT LISTENERS
anadirCPrevia.addEventListener("click", ingresarCPrevia);
// anadirMedicamentoIndicacion.addEventListener("click", ingresarMedicamentoIndicacion);
anadirEstudioSolicitado.addEventListener("click", ingresarEstudioSolicitado);
anadirTerapia.addEventListener("click", ingresarTerapia);
botonImprimirReceta.addEventListener("click", imprimirReceta);
//BOTONES

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    fetchedData = null;
    id = null;
    // obtenerMedicamentos();
    obtenerConsulta();
    obtenerConsultorios();
};

document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO
    divImprimirConsulta.style.display="none";
    obtenerMedicamentos();
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

//FUNCIONES : OBTENER
//FUNCIONES : OBTENER
function obtenerConsulta() {
    fetch('./controller/obtener-consulta.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data != null) {
                if ('id' in data) {
                    consultaObjeto = new Consulta(data.fecha, data.usuario, data.paciente, data.ta, data.oxigeno, data.pulso, data.peso, data.estatura, data.temperatura, data.motivoConsulta, data.exploracion, data.indicaciones, data.receta, data.consultorio);
                    receta = data.receta;
                    inputConsultaFecha.value = consultaObjeto.fecha;
                    inputVitalesta.value = consultaObjeto.ta;
                    inputVitalesoxigeno.value = consultaObjeto.oxigeno;
                    inputVitalespulso.value = consultaObjeto.pulso;
                    inputVitalespeso.value = consultaObjeto.peso;
                    inputVitalestatura.value = consultaObjeto.estatura;
                    inputVitalestemperatura.value = consultaObjeto.temperatura;
                    inputConsultamotivo.value = consultaObjeto.motivoConsulta;
                    inputConsultaexploracion.value = consultaObjeto.exploracion;
                    inputConsultaindicaciones.value = consultaObjeto.indicaciones;
                    //pendiente
                    data.consultasPrevias.forEach(cp => {
                        var consultaPrevia = new ConsultaPrevia(cp.comentarios, cp.diagnostico, cp.estudios, cp.tratamiento);
                        consultaPrevia.id = cp.id;
                        arrayCPrevias.push(consultaPrevia);
                    });
                    actualizarTablaCPrevias();
                    data.medicamentosIndicacion.forEach(mi => {
                        var medicamentoIndicacion = new MedicamentoIndicacion(mi.medicamento, mi.hora, mi.indicaciones);
                        medicamentoIndicacion.id = mi.id;
                        medicamentoIndicacion.receta = mi.receta;
                        arrayMedicamentoIndicaciones.push(medicamentoIndicacion);
                    });
                    actualizarTablaMedicamentoIndicacion();
                    data.terapiasAplicadas.forEach(t => {
                        var terapiaAplicada = new TerapiaAplicada(t.terapia);
                        terapiaAplicada.id = t.id;
                        terapiaAplicada.consulta = t.consulta;
                        arrayTerapiasAplicadas.push(terapiaAplicada);
                    });
                    actualizarTablaTerapiasAplicadas();
                    data.estudiosSolicitados.forEach(e => {
                        var estudio = new EstudioSolicitado(e.estudio);
                        estudio.id = e.id;
                        estudio.receta = e.receta;
                        arrayEstudiosSolicitados.push(estudio);
                    })
                    actualizarTablaEstudiosSolicitados();
                    validarConsulta();
                    obtenerUsuario();
                } else {
                    console.log(data);
                    modalError(data, tipo.obtener);
                }
            }
        })// FIN FETCH
        .catch(error => {
            console.log(error);
            modalError(error, tipo.obtener);
        });
}
//FUNCIONES: OBTENER CONSULTORIO
function obtenerConsultorios() {
    fetch('./controller/obtener-consultorios.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((c) => {
                consultorio = new Consultorio(c.nombre, c.calle, c.colonia, c.ciudad, c.codigoPostal, c.telefono);
                consultorio.id = c.id;
                arrayConsultorios.push(consultorio);
            });
            consultorioSelect();
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
            modalError(error, tipo.obtener)
        });
}
//FUNCIONES: OBTENER MEDICAMENTOS
function obtenerMedicamentos() { //pendiente 
    fetch('./controller/obtener-medicamentos.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            data.forEach((m) => {
                medicamento = new Medicamento(m.medicamento, m.tipo, m.descripcion);
                medicamento.id = m.id;
                arrayMedicamentos.push(medicamento);
            });
            actualizarDatalistMedicamentos();
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
function obtenerUsuario() { 
    fetch('./controller/obtener-usuario-receta.php?id=' + consultaObjeto.usuario)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data != null && 'nombre' in data) {
                usuario = new Usuario();
                usuario.username = data.username;
                usuario.nombre = data.nombre;
                usuario.apellidoPaterno = data.apellidoPaterno;
                usuario.apellidoMaterno = data.apellidoMaterno;
                usuario.telefono = data.telefono;
                usuario.correo = data.correo;
                usuario.tipoUsuario = data.tipoUsuario;
                usuario.especialidad = data.especialidad;
                usuario.universidad = data.universidad;
                usuario.cedula = data.cedula;
                if(usuario.tipoUsuario!='M'){
                    divImprimirConsulta.style.display="none";
                }else {
                    divImprimirConsulta.style.display="block";
                }
            }
        })// FIN FETCH
        .catch(error => {
            console.log(error);
            modalError(error, tipo.obtener);
        });
}
// FUNCIONES : OBTENER CONSULTORIOS
function consultorioSelect() {
    return new Promise((resolve, reject) => {
        arrayConsultorios.forEach(consultorio => {
            const opcion = document.createElement('option');
            opcion.value = consultorio.id;
            opcion.text = consultorio.nombre;
            selectConsultorio.add(opcion);
            if (consultaObjeto != null) {
                if (consultaObjeto.consultorio != null) {
                    if (consultaObjeto.consultorio == opcion.value) {
                        opcion.selected = true;
                    }
                }
            }
        });
        setTimeout(() => {
            resolve();
        }, 2000);
    });
}
// FUNCIONES : OBTENER CONSULTORIOS
//FUNCIONES INSERTAR
// FUNCIONES INSERTAR ARRAY INGRESAR CONSULTAS PREVIAS
function ingresarCPrevia() {
    let comentarios = document.getElementById('consultapreviacomentarios-paciente').value;
    let diagnostico = document.getElementById('consultapreviadiagnostico-paciente').value;
    let estudios = document.getElementById('consultapreviaestudio-paciente').value;
    let tratamiento = document.getElementById('consultapreviatratamiento-paciente').value;
    cPrevia = new ConsultaPrevia(comentarios, diagnostico, estudios, tratamiento);
    cPrevia.id = new Date().getTime();
    arrayCPrevias.push(cPrevia);
    actualizarTablaCPrevias();
}
// FUNCIONES INSERTAR ARRAY INGRESAR CONSULTAS PREVIAS
//FUNCIONES INSERTAR ARRAY INGRESAR MEDICAMENTO
function ingresarMedicamentoIndicacion() {
    // return new Promise((resolve, reject) => {
    let inputMedicamento = document.getElementById("consultanombremed-paciente").value;
    const optionMedicamento = document.querySelector(`#datalist-consultanombremed-paciente option[value="${inputMedicamento}"]`);
    const med = optionMedicamento.getAttribute('id-medicamento');
    let indicaciones = inputIndicacionesMedicamento.value;
    let hora = document.getElementById("select-medicamento-hora").value;
    var medicamentoIndicacion = new MedicamentoIndicacion(med, hora, indicaciones);
    medicamentoIndicacion.id = new Date().getTime();
    medicamentoIndicacion.receta = receta;
    arrayMedicamentoIndicaciones.push(medicamentoIndicacion);
    actualizarTablaMedicamentoIndicacion();
    //     setTimeout(() => {
    //         resolve();
    //     }, 2000);
    // });
    inputMedicamento = "";
    inputIndicacionesMedicamento.value = "";
}
//FUNCIONES INSERTAR ARRAY INGRESAR MEDICAMENTO
function ingresarEstudioSolicitado() {
    let estudioInput = document.getElementById('estudiossolicitados-paciente').value;
    estudioSolicitado = new EstudioSolicitado(estudioInput);
    estudioSolicitado.id = new Date().getTime();
    estudioSolicitado.receta = receta;
    arrayEstudiosSolicitados.push(estudioSolicitado);
    actualizarTablaEstudiosSolicitados();
    estudioInput = "";
}
function ingresarTerapia() {
    let terapiaInput = document.getElementById('consultaterapia-paciente').value;
    terapiaAplicada = new TerapiaAplicada(terapiaInput);
    terapiaAplicada.id = new Date().getTime();
    arrayTerapiasAplicadas.push(terapiaAplicada);
    actualizarTablaTerapiasAplicadas();
    terapiaInput = "";
}
//FETCH FORMULARIO Y ARRAYS
//FETCH FORMULARIO Y ARRAYS

tablaCPrevias.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("eliminar-consulta-previa")) {
        const elementoEliminar = e.target.dataset.id;
        eliminarConsultaPrevia(elementoEliminar);
    }
});
tablaEstudiosSolicitados.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("eliminar-estudio-solicitado")) {
        const elementoEliminar = e.target.dataset.id;
        eliminarEstudioSolicitado(elementoEliminar);
    }
});
tablaMedicamentoIndicacion.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("eliminar-medicamento-indicacion")) {
        const elementoEliminar = e.target.dataset.id;
        eliminarMedicamentoIndicacion(elementoEliminar);
    }
});
tablaTerapiasAplicadas.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("eliminar-terapia")) {
        const elementoEliminar = e.target.dataset.id;
        eliminarTerapiaAplicada(elementoEliminar);
    }
});

function enviarFormConsulta() {
    var datosConsulta = new FormData(formConsulta);
    var jsonReceta = JSON.stringify(receta);
    var jsonConsultasPrevias = JSON.stringify(arrayCPrevias);
    var jsonTerapiasAplicadas = JSON.stringify(arrayTerapiasAplicadas);
    var jsonEstudiosSolicitados = JSON.stringify(arrayEstudiosSolicitados);
    var jsonMedicamentoIndicaciones = JSON.stringify(arrayMedicamentoIndicaciones);
    datosConsulta.append('jsonConsultasPrevias', jsonConsultasPrevias);
    datosConsulta.append('jsonTerapiasAplicadas', jsonTerapiasAplicadas);
    datosConsulta.append('jsonEstudiosSolicitados', jsonEstudiosSolicitados);
    datosConsulta.append('jsonMedicamentoIndicaciones', jsonMedicamentoIndicaciones);
    if (consultaObjeto != null) {
        fetch('./controller/editar-consulta.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosConsulta // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                console.log(data);
                if (data != null) {
                    if (data.id !== undefined) {
                        consultaObjeto = new Consulta(data.fecha, data.usuario, data.paciente, data.ta, data.oxigeno, data.pulso, data.peso, data.estatura, data.temperatura, data.motivoConsulta, data.exploracion, data.indicaciones, data.receta, data.consultorio);
                        receta = data.receta;
                        consultaObjeto.id = data.id;
                        obtenerUsuario();
                        modalExito();
                    } else {
                        modalError(data, tipo.guardar)
                    }
                }
            })
            .catch(function (error) {
                console.log(error);
                modalError(error, tipo.guardar);
            });
    } else {
        datosConsulta.append('jsonReceta', jsonReceta);
        fetch('./controller/nueva-consulta.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datosConsulta // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                if (data = !null) {
                    if ('id' in data) {
                        consultaObjeto = new Consulta(data.fecha, data.usuario, data.paciente, data.ta, data.oxigeno, data.pulso, data.peso, data.estatura, data.temperatura, data.motivoConsulta, data.exploracion, data.indicaciones, data.receta, data.consultorio);
                        receta = data.receta;
                        consultaObjeto.id = data.id;
                        obtenerUsuario();
                        modalExito();
                    } else {
                        modalError(data, tipo.guardar);
                    }
                }
            })
            .catch(function (error) {
                modalError(error, tipo.guardar);
            });
    }
}
//FETCH FORMULARIO Y ARRAYS
//FETCH FORMULARIO Y ARRAYS
function imprimirReceta() {
    var tamano = selectTamano.value;
    if (consultaObjeto != null) {
        if(usuario.tipoUsuario=='M'){
            window.open("./print/receta.php?size=" + tamano, "_blank");
        }
        else{
            modalError("medico", tipo.imprimir);
        }
    } else {
        //TODO
        modalError("imprimir", tipo.imprimir);
    }
}

// TABLAS: CONSULTAS PREVIAS
function actualizarTablaCPrevias() {
    clearDiv(tablaCPrevias);
    if (arrayCPrevias.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const comentarios = document.createElement('th');
        const diagnostico = document.createElement('th');
        const estudios = document.createElement('th');
        const tratamientos = document.createElement('th');
        const eliminar = document.createElement('th');

        comentarios.textContent = "Comentarios";
        diagnostico.textContent = "Diagnostico";
        estudios.textContent = "Estudios";
        tratamientos.textContent = "Tratamientos";
        eliminar.textContent = "Eliminar";

        propiedades.appendChild(comentarios);
        propiedades.appendChild(diagnostico);
        propiedades.appendChild(estudios);
        propiedades.appendChild(tratamientos);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tablaCPrevias.appendChild(thead);

        const tbody = document.createElement('tbody');
        arrayCPrevias.forEach(cp => {
            const celda = document.createElement('tr');
            const comentariosFila = document.createElement('td');
            const diagnosticoFila = document.createElement('td');
            const estudiosFila = document.createElement('td');
            const tratamientoFila = document.createElement('td');
            const eliminarFila = document.createElement('td');

            const iconoEliminar = document.createElement('i');

            iconoEliminar.dataset.id = cp.id;
            comentariosFila.textContent = cp.comentarios;
            diagnosticoFila.textContent = cp.diagnostico;
            estudiosFila.textContent = cp.estudios;
            tratamientoFila.textContent = cp.tratamiento;
            iconoEliminar.className = "fas fa-trash eliminar-consulta-previa";

            eliminarFila.appendChild(iconoEliminar);
            celda.appendChild(comentariosFila);
            celda.appendChild(diagnosticoFila);
            celda.appendChild(estudiosFila);
            celda.appendChild(tratamientoFila);
            celda.appendChild(eliminarFila);
            tbody.appendChild(celda);
        });
        tablaCPrevias.appendChild(tbody);
    }
}
// TABLAS: CONSULTAS PREVIAS
// DATALIST MEDICAMENTOS
function actualizarDatalistMedicamentos() {
    arrayMedicamentos.forEach(m => {
        const opcion = document.createElement('option');
        opcion.value = m.medicamento;
        opcion.setAttribute('id-medicamento', m.id);
        medicamentoDatalist.appendChild(opcion);
    });
}
// DATALIST MEDICAMENTOS
function actualizarTablaMedicamentoIndicacion() {
    clearDiv(tablaMedicamentoIndicacion);
    if (arrayMedicamentoIndicaciones.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const medicamento = document.createElement('th');
        const indicaciones = document.createElement('th');
        const eliminar = document.createElement('th');

        medicamento.textContent = "Medicamento";
        indicaciones.textContent = "Indicaciones";
        eliminar.textContent = "Eliminar";

        propiedades.appendChild(medicamento);
        propiedades.appendChild(indicaciones);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tablaMedicamentoIndicacion.appendChild(thead);

        const tbody = document.createElement('tbody');

        arrayMedicamentoIndicaciones.forEach(i => {
            const celda = document.createElement('tr');
            const medicamentoFila = document.createElement('td');
            const indicacionesFila = document.createElement('td');
            const eliminarFila = document.createElement('td');
            const iconoEliminar = document.createElement('i');
            iconoEliminar.dataset.id = i.id;
            iconoEliminar.className = "fas fa-trash eliminar-medicamento-indicacion";
            arrayMedicamentos.forEach(m => {
                if (m.id == i.medicamento) {
                    medicamentoFila.textContent = m.medicamento;
                }
            });
            indicacionesFila.textContent = i.indicaciones;

            eliminarFila.appendChild(iconoEliminar);
            celda.appendChild(medicamentoFila);
            celda.appendChild(indicacionesFila);
            celda.appendChild(eliminarFila);
            tbody.appendChild(celda);
        });
        tablaMedicamentoIndicacion.appendChild(tbody);
    }
}
function actualizarTablaTerapiasAplicadas() {
    clearDiv(tablaTerapiasAplicadas);
    if (arrayTerapiasAplicadas.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const terapia = document.createElement('th');
        const eliminar = document.createElement('th');
        terapia.textContent = "Terapia aplicada";
        eliminar.textContent = "Eliminar";

        propiedades.appendChild(terapia);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tablaTerapiasAplicadas.appendChild(thead);

        const tbody = document.createElement('tbody');
        arrayTerapiasAplicadas.forEach(t => {
            const celda = document.createElement('tr');
            const terapiaFila = document.createElement('td');
            const eliminarFila = document.createElement('td');
            const iconoEliminar = document.createElement('i');
            iconoEliminar.dataset.id = t.id;
            iconoEliminar.className = "fas fa-trash eliminar-terapia";

            terapiaFila.textContent = t.terapia;
            eliminarFila.appendChild(iconoEliminar);
            celda.appendChild(terapiaFila);
            celda.appendChild(eliminarFila);
            tbody.appendChild(celda);
        });
        tablaTerapiasAplicadas.appendChild(tbody);
    }
}
function actualizarTablaEstudiosSolicitados() {
    clearDiv(tablaEstudiosSolicitados);
    if (arrayEstudiosSolicitados.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const estudio = document.createElement('th');
        const eliminar = document.createElement('th');
        estudio.textContent = "Estudio";
        eliminar.textContent = "Eliminar";

        propiedades.appendChild(estudio);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tablaEstudiosSolicitados.appendChild(thead);

        const tbody = document.createElement('tbody');
        arrayEstudiosSolicitados.forEach(e => {
            const celda = document.createElement('tr');
            const estudioFila = document.createElement('td');
            const eliminarFila = document.createElement('td');
            const iconoEliminar = document.createElement('i');
            iconoEliminar.dataset.id = e.id;
            iconoEliminar.className = "fas fa-trash eliminar-estudio-solicitado";
            estudioFila.textContent = e.estudio;

            eliminarFila.appendChild(iconoEliminar);
            celda.appendChild(estudioFila);
            celda.appendChild(eliminarFila);
            tablaEstudiosSolicitados.appendChild(celda);
        });
        tablaEstudiosSolicitados.appendChild(tbody);
    }
}
function eliminarConsultaPrevia(id) {
    arrayCPrevias = arrayCPrevias.filter(cp => cp.id != id);
    actualizarTablaCPrevias();
}
function eliminarEstudioSolicitado(id) {
    arrayEstudiosSolicitados = arrayEstudiosSolicitados.filter(es => es.id != id);
    actualizarTablaEstudiosSolicitados();
}
function eliminarMedicamentoIndicacion(id) {
    arrayMedicamentoIndicaciones = arrayMedicamentoIndicaciones.filter(mi => mi.id != id);
    actualizarTablaMedicamentoIndicacion();
}
function eliminarTerapiaAplicada(id) {
    arrayTerapiasAplicadas = arrayTerapiasAplicadas.filter(ta => ta.id != id);
    actualizarTablaTerapiasAplicadas();
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

    titulo.textContent = "¡Consulta guardada!";
    parrafo.textContent = "Los datos se han almacenado con éxito.";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalCerrar);
    modalContent.appendChild(divBoton);
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
    } else if (tipo == "imprimir") {
        titulo.textContent = 'No se puede imprimir receta';
    }
    if (error == "no existe") {
        parrafo.textContent = "El medicamento no existe.";
    } else
    if (error == "campos") {
        parrafo.textContent = "Porfavor, revisa todos los campos e intenta de nuevo.";
    } else if (error == "imprimir") {
        parrafo.textContent = "No existen datos para generar la receta";
    }
    else if (error == "medico") {
        parrafo.textContent = "La receta no ha sido actualizada por un Médico";
    }
    else if (error != "false") {
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
botonCancelar.addEventListener('click', function(e){
    e.preventDefault();
    redirectConsultas();
})
function redirectConsultas() {
    window.location.href = "./pacientes-consultas.php";
}

//FUNCION BORRAR DIV
function clearDiv(div) {
    div.replaceChildren();
}
//MODAL END

//CLASES
//CLASES
class EstudioSolicitado {
    constructor(estudio) {
        this._estudio = estudio;
    }
    get id() {
        return this._id;
    }
    get estudio() {
        return this._estudio;
    }
    get receta() {
        return this._receta;
    }
    set id(id) {
        this._id = id;
    }
    set receta(receta) {
        this._receta = receta;
    }
}
class Consulta {
    constructor(fecha, usuario, paciente, ta, oxigeno, pulso, peso, estatura, temperatura, motivoConsulta, exploracion, indicaciones, receta, consultorio) {
        this._fecha = fecha;
        this._usuario = usuario;
        this._paciente = paciente;
        this._ta = ta;
        this._oxigeno = oxigeno;
        this._pulso = pulso;
        this._peso = peso;
        this._estatura = estatura;
        this.temperatura = temperatura;
        this._motivoConsulta = motivoConsulta;
        this._exploracion = exploracion;
        this._indicaciones = indicaciones;
        this._receta = receta;
        this._consultorio = consultorio;
    }
    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
    set fecha(fecha) {
        this._fecha = fecha;
    }
    get fecha() {
        return this._fecha;
    }
    set usuario(usuario) {
        this._usuario = usuario;
    }
    get usuario() {
        return this._usuario;
    }
    set paciente(paciente) {
        this._paciente = paciente;
    }
    get paciente() {
        return this._paciente;
    }
    set ta(ta) {
        this._ta = ta;
    }
    get ta() {
        return this._ta;
    }
    set oxigeno(oxigeno) {
        this._oxigeno = oxigeno;
    }
    get oxigeno() {
        return this._oxigeno;
    }
    set pulso(pulso) {
        this._pulso = pulso;
    }
    get pulso() {
        return this._pulso;
    }
    set peso(peso) {
        this._peso = peso;
    }
    get peso() {
        return this._peso;
    }
    set estatura(estatura) {
        this._estatura = estatura;
    }
    get estatura() {
        return this._estatura;
    }
    set temperatura(temperatura) {
        this._temperatura = temperatura;
    }
    get temperatura() {
        return this._temperatura;
    }
    set motivoConsulta(motivoConsulta) {
        this._motivoConsulta = motivoConsulta;
    }
    get motivoConsulta() {
        return this._motivoConsulta;
    }
    set exploracion(exploracion) {
        this._exploracion = exploracion;
    }
    get exploracion() {
        return this._exploracion;
    }
    set receta(receta) {
        this._receta = receta;
    }
    get receta() {
        return this._receta;
    }
    set consultorio(consultorio) {
        this._consultorio = consultorio;
    }
    get consultorio() {
        return this._consultorio;
    }
    set indicaciones(indicaciones) {
        this._indicaciones = indicaciones;
    }
    get indicaciones() {
        return this._indicaciones;
    }
}
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
class ConsultaPrevia {
    constructor(comentarios, diagnostico, estudios, tratamiento) {
        this._comentarios = comentarios;
        this._diagnostico = diagnostico;
        this._estudios = estudios;
        this._tratamiento = tratamiento;
    }

    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
    get comentarios() {
        return this._comentarios;
    }
    get diagnostico() {
        return this._diagnostico;
    }
    get estudios() {
        return this._estudios;
    }
    get tratamiento() {
        return this._tratamiento;
    }
    get consulta() {
        return this._consulta;
    }
    set consulta(consulta) {
        this._consulta = consulta;
    }
}
class Medicamento {
    constructor(medicamento, tipo, descripcion) {

        this._medicamento = medicamento;
        this._tipo = tipo;
        this._descripcion = descripcion;
    }
    get id() {
        return this._id;
    }
    set id(id) {
        this._id = id;
    }
    get medicamento() {
        return this._medicamento;
    }
    get tipo() {
        return this._tipo;
    }
    get descripcion() {
        return this._descripcion;
    }
}
class MedicamentoIndicacion {
    constructor(medicamento, hora, indicaciones) {
        this._medicamento = medicamento;
        this._hora = hora;
        this._indicaciones = indicaciones;
    }
    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
    get medicamento() {
        return this._medicamento;
    }
    get hora() {
        return this._hora;
    }
    get indicaciones() {
        return this._indicaciones;
    }
    get receta() {
        return this._receta;
    }
    set receta(receta) {
        this._receta = receta;
    }
}
class TerapiaAplicada {
    constructor(terapia) {
        this._terapia = terapia;
    }
    get id() {
        return this._id;
    }
    get terapia() {
        return this._terapia;
    }
    get consulta() {
        return this._consulta;
    }
    set id(id) {
        this._id = id;
    }
    set terapia(terapia) {
        this._terapia = terapia;
    }
    get consulta() {
        return this._consulta;
    }
    set consulta(consulta) {
        this._consulta = consulta;
    }
}
class Usuario {
    set username(username) {
        this._username = username;
    }
    get username() {
        return this._username;
    }
    set nombre(nombre) {
        this._nombre = nombre;
    }
    get nombre() {
        return this._nombre;
    }
    set apellidoPaterno(apellidoPaterno) {
        this._apellidoPaterno = apellidoPaterno;
    }
    get apellidoPaterno() {
        return this._apellidoPaterno;
    }
    set apellidoMaterno(apellidoMaterno) {
        this._apellidoMaterno = apellidoMaterno;
    }
    get apellidoMaterno() {
        return this._apellidoMaterno;
    }
    set telefono(telefono) {
        this._telefono = telefono;
    }
    get telefono() {
        return this._telefono;
    }
    set correo(correo) {
        this._correo = correo;
    }
    get correo() {
        return this._correo;
    }
    set tipoUsuario(tipoUsuario) {
        this._tipoUsuario = tipoUsuario;
    }
    get tipoUsuario() {
        return this._tipoUsuario;
    }
    set especialidad(especialidad) {
        this._especialidad = especialidad;
    }
    get especialidad() {
        return this._especialidad;
    }
    set universidad(universidad) {
        this._universidad = universidad;
    }
    get universidad() {
        return this._universidad;
    }
    set cedula(cedula) {
        this._cedula = cedula;
    }
    get cedula() {
        return this._cedula;
    }
}