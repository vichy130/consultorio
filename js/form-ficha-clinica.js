
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
    var hijo= new Hijo("Mujer", 22);
    arrayHijos.push(hijo);
    hijo.id=Object.keys(arrayHijos).length;
    console.log(Object.keys(arrayHijos).length);
    actualizarTablaHijos();
}

function cleardiv(div){
    div.replaceChildren();
}
function actualizarTablaHijos(){
    cleardiv(tablaHijos);
    for(hijo of arrayHijos){
        tablaHijos.innerHTML+= `<tr>
        <td class="column-to-hide">`+hijo.id+`</td>
        <td>`+hijo.sexo+`</td>
        <td>`+hijo.edad+`</td>
        <td><i class="fas fa-trash" onclick =eliminarHijo(`+hijo.id+`)></i></td>
        </tr>`;
        console.log(arrayHijos[0].id);
    }
    
}

function eliminarHijo(i){
    const filteredArray= arrayHijos.filter(function(hijo){ return hijo.id != i});
    arrayHijos=filteredArray;
    var j=0;
    do{/*
        arrayHijos[j].id=j+1;
        j++*/
        console.log(arrayHijos[j].id);
        j++
    }while (j<= Object.keys(arrayHijos).length);
    console.log(arrayHijos);
    actualizarTablaHijos();
}



anadirHijo.addEventListener("click", ingresarHijos);


// Añadir un nuevo hijo