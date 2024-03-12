var tabla = document.getElementById('tabla-consultas');
var notabla=document.getElementById('no-tabla');
var botonNuevaConsulta;
var botonEditarConsulta;
var botonEliminarConsulta;
var array = []; // array consultas

botonNuevaConsulta = document.getElementById('nueva-consulta-boton');
botonNuevaConsulta.addEventListener('click', function (e) {
    e.preventDefault();
    consulta();
});
var modalPregunta = document.getElementById('modalPregunta');
var modalExito = document.getElementById('modalExito');
var modalError = document.getElementById('modalError');
var botonAceptarEliminar = document.getElementById('botonAceptarEliminar');
var botonCancelarEliminar = document.getElementById('botonCancelarEliminar');
var cerrarModalPregunta = document.getElementById('cerrarModalPregunta');
var cerrarModalExito = document.getElementById('cerrarModalExito');
var cerrarModalError = document.getElementById('cerrarModalError');

tabla.addEventListener('click', function (e) {
    e.preventDefault();
    if (e.target.classList.contains("editar-consulta")) {
        const idEditar = e.target.dataset.id
        consultaEditar(idEditar);
    }
    if (e.target.classList.contains("eliminar-consulta")) {
        const idEliminar = e.target.dataset.id;
        preguntaEliminar(idEliminar);
    }
});
// BOTONES
botonCancelarEliminar.addEventListener('click', function (e) {
    e.preventDefault();
    cerrarPregunta();
});
cerrarModalPregunta.addEventListener('click', function (e) {
    e.preventDefault()
    cerrarPregunta();
});
cerrarModalExito.addEventListener('click', function (e) {
    e.preventDefault();
    cerrarExito();
});
cerrarModalError.addEventListener('click', function (e) {
    e.preventDefault();
    cerrarError()
});
window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    obtenerConsultas();
};

function obtenerConsultas() {
    fetch('./controller/obtener-consultas.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((c) => {
                var consulta = new Consulta(c.fecha, c.usuario, c.paciente, c.ta, c.oxigeno, c.pulso, c.peso, c.estatura, c.temperatura, c.motivoConsulta, c.exploracion, c.receta, c.consultorio);
                consulta.id = c.id;
                array.push(consulta);
            });
            tablaConsultas();
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}//END FUNCTION OBTENERCONSULTAS

function preguntaEliminar(idEliminar) {
    modalPregunta.style.display = 'block';
    botonAceptarEliminar.onclick = function (e) {
        e.preventDefault();
        eliminarConsulta(idEliminar);
    };
}
function eliminarConsulta(idEliminar) {
    var datos = { id: idEliminar };
    var json = JSON.stringify(datos);
    fetch('./controller/eliminar-consulta.php', {// Enviar los datos a PHP utilizando fetch
        method: 'POST',
        body: json// El JSON que contiene los datos 
    })
        .then(function (response) {
            return response.text();
        })
        .then(function (data) {
            cerrarPregunta();
            array = [];
            clearDiv(cuerpoTabla);
            obtenerConsultas();
            console.log("DATA : " + data)
            if (data == "1") {
                modalExito.style.display = 'block';
            } else {
                modalError.style.display = 'block';
            }
        })
        .catch(function (error) {
            console.error('Error:', error);
        });
}
function cerrarPregunta() {
    modalPregunta.style.display = 'none';
}
function cerrarExito() {
    modalExito.style.display = 'none';
}
function cerrarError() {
    modalError.style.display = 'none';
}
function tablaConsultas() {
    if (array.length > 0) {
        const thead=document.createElement('thead');
        const propiedades=document.createElement('tr');
        const fecha=document.createElement('th');
        const motivo=document.createElement('th');
        const editar=document.createElement('th');
        const eliminar=document.createElement('th');

        fecha.textContent="Fecha";
        motivo.textContent="Motivo de consulta";
        motivo.className="column-to-hide";
        editar.textContent="Editar";
        eliminar.textContent="Eliminar";

        propiedades.appendChild(fecha);
        propiedades.appendChild(motivo);
        propiedades.appendChild(editar);
        propiedades.appendChild(eliminar);
        thead.appendChild(propiedades);
        tabla.appendChild(thead);

        const tbody=document.createElement('tbody');

        array.forEach(co => {
            const celda = document.createElement('tr');
            const filaFecha = document.createElement('td');
            const filaMotivo = document.createElement('td');
            const filaEditar = document.createElement('td');
            const filaEliminar = document.createElement('td');
            const iconoEditar = document.createElement('i');
            const iconoEliminar = document.createElement('i');

            iconoEditar.className = "far fa-edit editar-consulta";
            iconoEliminar.className = "fas fa-trash eliminar-consulta";

            iconoEditar.dataset.id = co.id;
            iconoEliminar.dataset.id = co.id;

            filaFecha.textContent = co.fecha;
            filaMotivo.textContent = co.motivoConsulta;
            filaEditar.appendChild(iconoEditar);
            filaEliminar.appendChild(iconoEliminar);

            celda.appendChild(filaFecha);
            celda.appendChild(filaMotivo);
            celda.appendChild(filaEditar);
            celda.appendChild(filaEliminar);
            tbody.appendChild(celda);
        });
        tabla.appendChild(tbody);
    }else{
        const mensaje=document.createElement('p');
        mensaje.textContent="No existen registros";
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