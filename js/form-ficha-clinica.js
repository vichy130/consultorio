
// Añadir un nuevo hijo

let anadirHijo=document.getElementById("agregarHijo");
let tablaHijos= document.getElementById("tabla-hijos");
var arrayHijos=[];


class Hijo {

    constructor(sexo, edad){
        this._sexo= sexo;
        this._edad= edad;
    }
    get id(){
        return this._id;
    }
    set id(numero){
        this._id=numero;
    }
    get sexo(){
        return this._sexo;
    }
    get edad(){
        return this._edad;
    }
}

function ingresarHijos (){
    let edad=document.getElementById("hijoedad-paciente").value;
    let sexo=document.querySelector('input[name="sexo-hijo"]:checked').value;
    var hijo= new Hijo(sexo,edad);
    arrayHijos.push(hijo);
    hijo.id=new Date().getTime();
    actualizarTablaHijos();
}

function cleardiv(div){
    div.replaceChildren();
}
function actualizarTablaHijos(){
    cleardiv(tablaHijos);
    let contador=0;
    for(hijo of arrayHijos){
        contador++
        tablaHijos.innerHTML+= `<tr>
        <td class="column-to-hide">`+contador+`</td>
        <td name="hijo-sexo">`+hijo.sexo+`</td>
        <td name="hijo-edad">`+hijo.edad+`</td>
        <td><i class="fas fa-trash" onclick =eliminarHijo(`+hijo.id+`)></i></td>
        </tr>`;
    }
    console.log(arrayHijos);
}
 
function eliminarHijo(id){
    const filteredArray= arrayHijos.filter(hijo=> hijo.id != id);
    arrayHijos=filteredArray;
    /*const mappedArray= arrayHijos.map(hijo=>({...hijo,id: hijo.id+1}))*/
    actualizarTablaHijos();

}

anadirHijo.addEventListener("click", ingresarHijos);


// Añadir un nuevo hijo