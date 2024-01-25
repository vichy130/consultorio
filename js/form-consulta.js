//VARIABLES
var fetchedData;
var id;
var arrayConsultorios = [];
var arrayCPrevias = [];
var arrayMedicamentos = [];
var arrayMedicamentoIndicaciones = [];
var arrayEstudiosSolicitados=[];
var arrayTerapiasAplicadas=[];
var receta=new Date().getTime();
var medicamentoDatalist = document.getElementById("consultanombremed-paciente");
var tablaCPrevias = document.getElementById("tbody-consultas-previas");//
var tablaMedicamentoIndicacion = document.getElementById("tbody-medicamento-indicacion");
var indicacionesMedicamento = document.getElementById("indicacionesmed-paciente"); //INPUT
//TABLA
var selectConsultorio = document.getElementById("select-consultorio"); //SELECT
var selectMedicamentoHora = document.getElementById("select-medicamento-hora");
var formConsulta = document.getElementById("form-consulta"); //FORM
var anadirCPrevia = document.getElementById('boton-consulta-previa');//BOTON
var anadirMedicamentoIndicacion = document.getElementById("boton-medicamento-indicacion");
var anadirEstudioSolicitado=document.getElementById("boton-estudios-solicitados");
var anadirTerapia=document.getElementById("boton-terapia");
//VARIABLES

//BOTONES -- EVENT LISTENERS
anadirCPrevia.addEventListener("click", ingresarCPrevia);
anadirMedicamentoIndicacion.addEventListener("click", ingresarMedicamentoIndicacion);
anadirEstudioSolicitado.addEventListener("click", ingresarEstudioSolicitado);
anadirTerapia.addEventListener("click", ingresarTerapia);
//BOTONES

window.onload = function () {// SE EJECUTA UNA VEZ QUE LOS RECURSOS HAN SIDO CARGADOS
    fetchedData = null;
    id = null;
    obtenerConsulta();
    obtenerConsultorios();
    obtenerMedicamentos();
};

document.addEventListener('DOMContentLoaded', function () {// SE EJECUTA AUNQUE LOS RECURSOS NO HAN SIDO CARGADOS POR COMPLETO

    var fecha = document.getElementById("consultafecha-paciente");
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
    }
});

//FUNCIONES : OBTENER
//FUNCIONES : OBTENER
function obtenerConsulta() {
    fetch('./controller/obtener-consulta.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.id != null) {
                fetchedData = data;
                console.log(data);
                var consulta = new Consulta(data.fecha, data.usuario, data.paciente, data.ta, data.oxigeno, data.pulso, data.peso, data.estatura, data.temperatura, data.motivoConsulta, data.exploracion, data.receta, data.consultorio);

                document.getElementById('consultafecha-paciente').value = consulta.fecha;
                document.getElementById('vitalesta-paciente').value = consulta.ta;
                document.getElementById('vitalesoxigeno-paciente').value = consulta.oxigeno;
                document.getElementById('vitalespulso-paciente').value = consulta.pulso;
                document.getElementById('vitalespeso-paciente').value = consulta.peso;
                document.getElementById('vitalesestatura-paciente').value = consulta.estatura;
                document.getElementById('vitalestemperatura-paciente').value = consulta.temperatura;
                document.getElementById('consultamotivo-paciente').value = consulta.motivoConsulta;
                document.getElementById('consultaexploracion-paciente').value = consulta.exploracion;
                //pendiente
                data.consultasPrevias.forEach(cp=>{
                    var consultaPrevia = new ConsultaPrevia(cp.comentarios, cp.diagnostico, cp.estudios, cp.tratamiento);
                    consultaPrevia.id=cp.id;
                    consultaPrevia.consulta=cp.consulta;
                    arrayCPrevias.push(consultaPrevia);
                });
                actualizarTablaCPrevias();
                data.forEach(cp=>{
                    var consultaPrevia = new ConsultaPrevia(cp.comentarios, cp.diagnostico, cp.estudios, cp.tratamiento);
                    consultaPrevia.id=cp.id;
                    consultaPrevia.consulta=cp.consulta;
                    arrayCPrevias.push(consultaPrevia);
                });
            }
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
            console.log("catch");
        });
}
//FUNCIONES: OBTENER CONSULTORIO
function obtenerConsultorios() {
    fetch('./controller/obtener-consultorios.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((c) => {
                consultorio = new Consultorio(c.id, c.nombre, c.calle, c.colonia, c.ciudad, c.codigoPostal, c.telefono);
                arrayConsultorios.push(consultorio);
            });
            consultorioSelect();
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
//FUNCIONES: OBTENER MEDICAMENTOS
function obtenerMedicamentos() { //pendiente 
    fetch('./controller/obtener-medicamentos.php')
        .then(response => response.json())
        .then(data => {
            data.forEach((m) => {
                medicamento = new Medicamento(m.id, m.medicamento, m.tipo, m.descripcion);
                arrayMedicamentos.push(medicamento);
            });
            console.log(arrayMedicamentos);
            actualizarDatalistMedicamentos();
        })// FIN FETCH
        .catch(error => {
            console.error('Error:', error);
        });
}
// FUNCIONES : OBTENER CONSULTORIOS
function consultorioSelect() {
    console.log(arrayConsultorios);
    arrayConsultorios.forEach(consultorio => {
        const opcion = document.createElement('option');
        opcion.value = consultorio.id;
        opcion.text = consultorio.nombre;
        selectConsultorio.add(opcion);
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
    let inputMedicamento = document.getElementById("input-medicamento").value;
    const optionMedicamento = document.querySelector(`#consultanombremed-paciente option[value="${inputMedicamento}"]`);
    //++++ aqui va un validator +++++++ //
    const med = optionMedicamento.getAttribute('id-medicamento');
    let medicamentoHora = selectMedicamentoHora.value;
    let indicaciones = indicacionesMedicamento.value;
    let hora = document.getElementById("select-medicamento-hora").value;
    medicamentoIndicacion = new MedicamentoIndicacion(new Date().getTime(), med, hora, indicaciones, receta);
    arrayMedicamentoIndicaciones.push(medicamentoIndicacion);
    console.log(medicamentoIndicacion);
    actualizarTablaMedicamentoIndicacion();
}
//FUNCIONES INSERTAR ARRAY INGRESAR MEDICAMENTO
function ingresarEstudioSolicitado(){

}
function ingresarTerapia(){

}


//FETCH FORMULARIO Y ARRAYS
//FETCH FORMULARIO Y ARRAYS
formConsulta.addEventListener('submit', function (e) {
    e.preventDefault();
    var datosConsulta = new FormData(formConsulta);
    //pendiente
});
//FETCH FORMULARIO Y ARRAYS
//FETCH FORMULARIO Y ARRAYS


// TABLAS: CONSULTAS PREVIAS
function clearDiv(div) {
    div.replaceChildren();
}
function actualizarTablaCPrevias() {
    clearDiv(tablaCPrevias);
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
        tablaCPrevias.appendChild(celda);
        console.log(arrayCPrevias);
    });
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
    arrayMedicamentoIndicaciones.forEach(i => {
        const celda=document.createElement('tr');
        const medicamentoFila=document.createElement('td');
        const indicacionesFila=document.createElement('td');
        const eliminarFila = document.createElement('td');
        const iconoEliminar = document.createElement('i');
        iconoEliminar.dataset.id = i.id;
        iconoEliminar.className="fas fa-trash eliminar-medicamento-indicacion";
        medicamentoFila.textContent=i.medicamento;
        indicacionesFila.textContent=i.indicaciones;

        eliminarFila.appendChild(iconoEliminar);
        celda.appendChild(medicamentoFila);
        celda.appendChild(indicacionesFila);
        celda.appendChild(eliminarFila);
        tablaMedicamentoIndicacion.appendChild(celda);
    });
}

//CLASES
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
        this.temperatura = temperatura;
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
class Consultorio {
    constructor(id, nombre, calle, colonia, ciudad, codigoPostal, telefono) {
        this._id = id;
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
    get consulta(){
        return this._consulta;
    }
    set consulta(consulta){
        this._consulta=consulta;
    }
}
class Medicamento {
    constructor(id, medicamento, tipo, descripcion) {
        this._id = id;
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
    constructor(id, medicamento, hora, indicaciones, receta) {
        this._id = id;
        this._medicamento = medicamento;
        this._hora = hora;
        this._indicaciones = indicaciones;
        this._receta = receta;
    }
    set id(id) {
        this._id = id;
    }
    get id() {
        return this._id;
    }
    get medicamento(){
        return this._medicamento;
    }
    get hora(){
        return this._hora;
    }
    get indicaciones(){
        return this._indicaciones;
    }
    get receta(){
        return this._receta;
    }
}