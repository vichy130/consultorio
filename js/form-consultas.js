var tabla = document.getElementById('tabla-consultas');
const cuerpoTabla = tabla.createTBody();
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
            console.log(array);
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}//END FUNCTION OBTENERCONSULTAS

function tablaConsultas(){
    array.forEach(co=>{
        const celda=document.createElement('tr');
        const filaFecha=document.createElement('td');
        const filaMotivo=document.createElement('td');
        const filaEditar=document.createElement('td');
        const filaEliminar=document.createElement('td');
        const iconoEditar=document.createElement('i');
        const iconoEliminar=document.createElement('i');

        iconoEditar.className="far fa-edit editar-consulta";
        iconoEliminar.className="fas fa-trash eliminar-consulta";

        iconoEditar.dataset.id=co.id;
        iconoEliminar.dataset.id=co.id;

        filaFecha.textContent=co.fecha;
        filaMotivo.textContent=co.motivoConsulta;
        
        filaEditar.appendChild(iconoEditar);
        filaEliminar.appendChild(iconoEliminar);
        cuerpoTabla.appendChild(celda);
    });
}
//FUNCION BORRAR TABLA
function clearDiv(div) {
    div.replaceChildren();
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
    set fecha(fecha){
        this._fecha=fecha;
    }
    get fecha(){
        return this._fecha;
    }
    
}