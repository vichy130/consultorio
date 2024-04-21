class Modal {
    constructor() {
        var modal = document.getElementById("modal");
        var modalContent = document.getElementById("modal-contenido");
        const botonModalAceptarEliminar = document.createElement('button');
        botonModalAceptarEliminar.textContent = "Aceptar";
        botonModalAceptarEliminar.className = "boton rojo aceptar-eliminar";
        const botonModalCancelarEliminar = document.createElement('button');
        botonModalCancelarEliminar.textContent = "Cancelar";
        botonModalCancelarEliminar.className = "boton azul cancelar-eliminar";
        botonModalAceptarCerrar = document.createElement('button');
        botonModalAceptarCerrar.textContent = "Cerrar";
        botonModalAceptarCerrar.className = "boton azul modal-cerrar";
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    }
    exito(){
        
    }
    Block() {

    }
    error() {

    }
    clearDiv(div) {
        div.replaceChildren();
    }
}