
// Añadir un nuevo hijo

let anadirHijo=document.getElementById("agregarHijo");
let tablaHijos= document.getElementById("tabla-hijos");
var arrayHijos=[];



class Hijo {
    
    constructor(id, sexo, edad){
        this._id=id;
        this._sexo= sexo;
        this._edad= edad;
    }
    get id(){
        return this._id;
    }
    get sexo(){
        return this._sexo;
    }
    get edad(){
        return this._edad;
    }
}

function ingresarHijos (){
    var i=0;
    let hijo= new Hijo(1, "Mujer", 22);
    arrayHijos.push(hijo);
    alert("Hijo agregado!");
    tablaHijos.innerHTML+= `<tr>
    <td class="column-to-hide">`+arrayHijos[i]._id+`</td>
    <td>`+arrayHijos[i]._sexo+`</td>
    <td>`+arrayHijos[i]._edad+`</td>
    <td><i class="fas fa-trash" onclick =eliminarHijo(`+arrayHijos[i]+`)></i></td>
    </tr>`;
}

function eliminarHijo(hijo){
    alert("hijo eliminado"+ hijo._id);
    arrayHijos= arrayHijos.filter(objeto => {return objeto._id =! i})
}

anadirHijo.addEventListener("click", ingresarHijos);


// Añadir un nuevo hijo