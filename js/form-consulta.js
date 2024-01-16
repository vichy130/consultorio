//VARIABLES
var fetchedData;
var id;
var arrayConsultorios = [];
var arrayCPrevias = [];
var tablaCPrevias = document.getElementById("tbody-consultas-previas");
var selectConsultorio = document.getElementById("select-consultorio");

//VARIABLES
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
function obtenerConsulta() {
    fetch('./controller/obtener-consulta.php')
        .then(response => response.json())
        .then(data => {
            if (data && data.id != null) {
                fetchedData = data;
                console.log(data);
                var consulta = new Consulta(data.fecha, data.usuario, data.paciente, data.ta, data.oxigeno, data.pulso, data.peso, data.estatura, data.temperatura, data.motivoConsulta, data.exploracion, data.receta, data.consultorio,/* consultasPrevias, terapias, medicamentosIndicacion, estudiosSolicitados*/);

                document.getElementById('consultafecha-paciente').value = consulta.fecha;
                document.getElementById('vitalesta-paciente').value = consulta.ta;
                document.getElementById('vitalesoxigeno-paciente').value = consulta.oxigeno;
                document.getElementById('vitalespulso-paciente').value = consulta.pulso;
                document.getElementById('vitalespeso-paciente').value = consulta.peso;
                document.getElementById('vitalesestatura-paciente').value = consulta.estatura;
                document.getElementById('vitalestemperatura-paciente').value = consulta.temperatura;
                document.getElementById('consultamotivo-paciente').value = consulta.motivoConsulta;
                document.getElementById('consultaexploracion-paciente').value = consulta.exploracion;
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
function obtenerMedicamentos() {

}
function consultorioSelect(){
    console.log(arrayConsultorios);
    arrayConsultorios.forEach(consultorio =>{
        const opcion=document.createElement('option');
        opcion.value=consultorio.id;
        opcion.text=consultorio.nombre;
        selectConsultorio.add(opcion);
    });
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