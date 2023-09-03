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