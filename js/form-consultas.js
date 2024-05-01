var tabla = document.getElementById('tabla-consultas');
var notabla = document.getElementById('no-tabla');
var botonNuevaConsulta;
var botonEditarConsulta;
var botonEliminarConsulta;
var botonBuscar = document.getElementById('boton-buscar-consulta');
var inputBuscar = document.getElementById('input-buscar');
var array = []; // array consultas

botonNuevaConsulta = document.getElementById('nueva-consulta-boton');
botonNuevaConsulta.addEventListener('click', function (e) {
    e.preventDefault();
    consulta();
});
botonBuscar.addEventListener('click', function (e) {
    e.preventDefault();
    fecha = inputBuscar.value;
    buscarConsultas(fecha);
});

tabla.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("editar-consulta")) {
        const idEditar = e.target.dataset.id
        consultaEditar(idEditar);
    }
    if (e.target.classList.contains("eliminar-consulta")) {
        modal.dataset.id = e.target.dataset.id;
        modal.dataset.fecha = e.target.dataset.fecha;
        modalBlock();
    }
    if (e.target.classList.contains("exportar-consulta")) {
        consultaExportar(e.target.dataset.id);
    }
});
// BOTONES
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerConsultas();
};
function obtenerSesion(){
    fetch('./controller/obtener-sessions.php')
    .then(response => response.json())
    .then(data => {
        if (data != null) {
            tipoUsuario=data.tipoUsuario;
        }
        if (tipoUsuario=="A" || tipoUsuario=="S"){
            tablaConsultasF()
        }else{
            tablaConsultas();
        }
    })// FIN FETCH
    .catch(error => {
        console.log(error);
        modalError(error, tipo.obtener);
    });
}
function obtenerConsultas() {
    fetch('./controller/obtener-consultas.php')
        .then(response => response.json())
        .then(data => {
            array = [];
            data.forEach((c) => {
                if ('id' in c) {
                    var consulta = new Consulta(c.fecha, c.usuario, c.paciente, c.ta, c.oxigeno, c.pulso, c.peso, c.estatura, c.temperatura, c.motivoConsulta, c.exploracion, c.receta, c.consultorio);
                    consulta.id = c.id;
                    array.push(consulta);
                } else {
                    modalError(c, tipo.obtener);
                    return;
                }
            });
            obtenerSesion();
        })// FIN FETCH
        .catch(error => {
            modalError(error, tipo.obtener);
        });
}//END FUNCTION OBTENERCONSULTAS
function buscarConsultas(fecha) { //TODO
    datos = JSON.stringify({ fecha: fecha });
    if (fecha == "") {
        obtenerConsultas();
    } else {
        fetch('./controller/buscar-consultas.php', {// Enviar los datos a PHP utilizando fetch
            method: 'POST',
            body: datos  // El JSON que contiene los datos y el formulario
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                array = [];
                data.forEach((c) => {
                    if ('id' in c) {
                        var consulta = new Consulta(c.fecha, c.usuario, c.paciente, c.ta, c.oxigeno, c.pulso, c.peso, c.estatura, c.temperatura, c.motivoConsulta, c.exploracion, c.receta, c.consultorio);
                        consulta.id = c.id;
                        array.push(consulta);
                    } else {
                        modalError(c, tipo.obtener);
                        return;
                    }
                });
                obtenerSesion();
            })
            .catch(function (error) {
                console.log(error);
                modalError(error, tipo.obtener);
            });
    }
}
function eliminarConsulta() {
    var datos = { id: modal.dataset.id };
    var json = JSON.stringify(datos);
    fetch('./controller/eliminar-consulta.php', {// Enviar los datos a PHP utilizando fetch
        method: 'POST',
        body: json// El JSON que contiene los datos 
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            clearDiv(tabla);
            clearDiv(modalContent);
            if (data === "true") {
                modalExito();
            } else {
                modalError(data.toString(), tipo.eliminar);
            }
            array = [];
            obtenerConsultas();
        })
        .catch(function (error) {
            modalError(error, tipo.eliminar)
        });
}
function tablaConsultas() {
    clearDiv(tabla);
    clearDiv(notabla);
    if (array.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const fecha = document.createElement('th');
        const motivo = document.createElement('th');
        const editar = document.createElement('th');
        const exportar = document.createElement('th');

        fecha.textContent = "Fecha";
        motivo.textContent = "Motivo de consulta";
        motivo.className = "column-to-hide";
        editar.textContent = "Editar";
        exportar.textContent = "Exportar";

        propiedades.appendChild(fecha);
        propiedades.appendChild(motivo);
        propiedades.appendChild(editar);
        propiedades.appendChild(exportar);
        thead.appendChild(propiedades);
        tabla.appendChild(thead);

        const tbody = document.createElement('tbody');

        array.forEach(co => {
            const celda = document.createElement('tr');
            const filaFecha = document.createElement('td');
            const filaMotivo = document.createElement('td');
            const filaEditar = document.createElement('td');
            const filaExportar = document.createElement('td');
            const iconoEditar = document.createElement('i');
            const iconoExportar = document.createElement('i');

            iconoEditar.className = "cursor far fa-edit editar-consulta";
            iconoExportar.className = "cursor fa-solid fa-file-pdf exportar-consulta";

            iconoEditar.dataset.id = co.id;
            iconoExportar.dataset.id = co.id;

            filaFecha.textContent = co.fecha;
            filaMotivo.textContent = co.motivoConsulta;
            filaEditar.appendChild(iconoEditar);
            filaExportar.appendChild(iconoExportar);

            celda.appendChild(filaFecha);
            celda.appendChild(filaMotivo);
            celda.appendChild(filaEditar);
            celda.appendChild(filaExportar);
            tbody.appendChild(celda);
        });
        tabla.appendChild(tbody);
    } else {
        const mensaje = document.createElement('p');
        mensaje.textContent = "No existen registros";
        notabla.appendChild(mensaje);
    }
}
function tablaConsultasF() {
    clearDiv(tabla);
    clearDiv(notabla);
    if (array.length > 0) {
        const thead = document.createElement('thead');
        const propiedades = document.createElement('tr');
        const fecha = document.createElement('th');
        const motivo = document.createElement('th');
        const editar = document.createElement('th');
        const exportar = document.createElement('th');
        const eliminar = document.createElement('th');

        fecha.textContent = "Fecha";
        motivo.textContent = "Motivo de consulta";
        motivo.className = "column-to-hide";
        editar.textContent = "Editar";
        exportar.textContent = "Exportar";
        eliminar.textContent = "Eliminar";

        propiedades.appendChild(fecha);
        propiedades.appendChild(motivo);
        propiedades.appendChild(editar);
        propiedades.appendChild(exportar);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tabla.appendChild(thead);

        const tbody = document.createElement('tbody');

        array.forEach(co => {
            const celda = document.createElement('tr');
            const filaFecha = document.createElement('td');
            const filaMotivo = document.createElement('td');
            const filaEditar = document.createElement('td');
            const filaExportar = document.createElement('td');
            const filaEliminar = document.createElement('td');
            const iconoEditar = document.createElement('i');
            const iconoExportar = document.createElement('i');
            const iconoEliminar = document.createElement('i');

            iconoEditar.className = "cursor far fa-edit editar-consulta";
            iconoExportar.className = "cursor fa-solid fa-file-pdf exportar-consulta";
            iconoEliminar.className = "cursor fas fa-trash eliminar-consulta";

            iconoEditar.dataset.id = co.id;
            iconoExportar.dataset.id = co.id;
            iconoEliminar.dataset.id = co.id;
            iconoEliminar.dataset.fecha = co.fecha;

            filaFecha.textContent = co.fecha;
            filaMotivo.textContent = co.motivoConsulta;
            filaEditar.appendChild(iconoEditar);
            filaExportar.appendChild(iconoExportar);
            filaEliminar.appendChild(iconoEliminar);

            celda.appendChild(filaFecha);
            celda.appendChild(filaMotivo);
            celda.appendChild(filaEditar);
            celda.appendChild(filaExportar);
            celda.appendChild(filaEliminar);
            tbody.appendChild(celda);
        });
        tabla.appendChild(tbody);
    } else {
        const mensaje = document.createElement('p');
        mensaje.textContent = "No existen registros";
        notabla.appendChild(mensaje);
    }
}
//FUNCION BORRAR TABLA
function clearDiv(div) {
    div.replaceChildren();
}
function consulta() {
    window.location.href = "./pacientes-consulta.php";
}
function consultaEditar(idEditar) {
    window.location.href = "./pacientes-consulta.php?id=" + idEditar;
}
function consultaExportar(idExportar) {
    window.open("./print/consulta.php?id=" + idExportar, "_blank");
}
//MODAL
var modal = document.getElementById("modal");
var modalContent = document.getElementById("modal-contenido");
const botonModalAceptarEliminar = document.createElement('button');
botonModalAceptarEliminar.textContent = "Aceptar";
botonModalAceptarEliminar.className = "boton rojo aceptar-eliminar-consulta";
const botonModalCancelarEliminar = document.createElement('button');
botonModalCancelarEliminar.textContent = "Cancelar";
botonModalCancelarEliminar.className = "boton azul cancelar-eliminar-consulta";
botonModalAceptarCerrar = document.createElement('button');
botonModalAceptarCerrar.textContent = "Cerrar";
botonModalAceptarCerrar.className = "boton azul modal-cerrar";
//MODAL
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function modalBlock() {
    clearDiv(modalContent);
    modalContent.classList.remove('modal-contenido-exito');
    modalContent.classList.remove('modal-contenido-error');
    modalContent.classList.remove('modal-contenido-un-column');
    botonModalAceptarCerrar.className = "boton azul modal-cerrar";
    // modalContent.style.gridTemplateRows = '1fr 1fr';

    modal.style.display = "block";
    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const divBotonDos = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    const strongElement = document.createElement('strong');
    var fecha = modal.dataset.fecha;
    const nombreNodo = document.createTextNode(fecha);

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton";
    divBotonDos.className = "modal-boton";

    titulo.textContent = "Confirmar Eliminación";
    parrafo.textContent = "¿Seguro que desea eliminar la consulta con fecha: ";
    strongElement.appendChild(nombreNodo);
    strongElement.style.fontWeight = 'bold';
    parrafo.appendChild(strongElement);

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);
    parrafo.textContent += "?";

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalAceptarEliminar);
    divBotonDos.appendChild(botonModalCancelarEliminar);
    modalContent.appendChild(divBoton);
    modalContent.appendChild(divBotonDos);
}
function modalExito() {
    modalContent.classList.add('modal-contenido-exito');
    modalContent.classList.add('modal-contenido-un-column');
    botonModalAceptarCerrar.className = "boton azul modal-cerrar";

    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');

    titulo.textContent = "¡Consulta eliminada!";
    parrafo.textContent = "Los datos se han eliminado con éxito.";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    divMensaje.appendChild(titulo);
    divMensaje.appendChild(parrafo);

    modalContent.appendChild(divMensaje);
    divBoton.appendChild(botonModalAceptarCerrar);
    modalContent.appendChild(divBoton);
}
function modalError(error, tipo) {
    clearDiv(modalContent);
    modal.style.display = "block";
    modalContent.classList.add('modal-contenido-error');
    modalContent.classList.add('modal-contenido-un-column');
    modalContent.classList.remove('modal-contenido-exito');
    botonModalAceptarCerrar.className = "boton blanco modal-cerrar";

    const divMensaje = document.createElement('div');
    const divBoton = document.createElement('div');
    const titulo = document.createElement('h2');
    const parrafo = document.createElement('p');
    const iconoAlerta = document.createElement('i');
    iconoAlerta.className = "fa-solid fa-bell";

    divMensaje.className = "modal-mensaje";
    divBoton.className = "modal-boton modal-boton-dos-espacios";

    if (tipo == "eliminar") {
        titulo.textContent = '¡La consulta NO ha sido eliminada!';
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
    divBoton.appendChild(botonModalAceptarCerrar);
    modalContent.appendChild(divBoton);
}
modal.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("aceptar-eliminar-consulta")) {
        eliminarConsulta();
    };
    if (e.target.classList.contains("cancelar-eliminar-consulta")) {
        modal.style.display = "none";
    }
    if (e.target.classList.contains("modal-cerrar")) {
        modal.style.display = "none";
    }
})
//MODAL END
//CLASES
class Consulta {
    constructor(fecha, usuario, paciente, ta, oxigeno, pulso, peso, estatura, temperatura, motivoConsulta, exploracion, receta, consultorio,/* consultasPrevias, terapias, medicamentosIndicacion, estudiosSolicitados*/) {
        this._fecha = fecha;
        this._usuario = usuario;
        this._paciente = paciente;
        this._ta = ta;
        this._oxigeno = oxigeno;
        this._pulso = pulso;
        this._peso = peso;
        this._estatura = estatura;
        this.tempratura = temperatura;
        this._motivoConsulta = motivoConsulta;
        this._exploracion = exploracion;
        this._receta = receta;
        this._consultorio = consultorio;/*
        this._consultasPrevias=consultasPrevias;
        this._terapias=terapias;
        this._medicamentosIndicacion=medicamentosIndicacion;
        this._estudiosSolicitados=estudiosSolicitados;*/
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
}