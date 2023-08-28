
// Añadir un nuevo hijo

let anadirHijo=document.getElementById("agregarHijo");
let tablaHijos= document.getElementById("tabla-hijos");
tablaHijos.innerHTML= "testing";
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
        return this_edad;
    }
}

function ingresarHijos (){

   let hijo= new Hijo();
    alert("Hijo ingresado");
}
anadirHijo.addEventListener("click", ingresarHijos);


// Añadir un nuevo hijo