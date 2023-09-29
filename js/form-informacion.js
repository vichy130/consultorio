







//MODAL//
// Obtener el valor del parámetro "exito" de la URL
const urlParams = new URLSearchParams(window.location.search);
const exitoParam = urlParams.get("exito");

// Obtener referencias a elementos del DOM
const modalExito = document.getElementById("modalExito");
const botonCerrarModal = document.getElementById("cerrarModal");

// Función para mostrar el modal de éxito
function mostrarModalExito() {
    modalExito.style.display = "block";
}

// Función para cerrar el modal
function cerrarModal() {
    modalExito.style.display = "none";
}

// Verificar si "exito" está presente en la URL y mostrar el modal
if (exitoParam === "1") {
    mostrarModalExito();
}

// Evento para cerrar el modal al hacer clic en el botón de cierre
botonCerrarModal.addEventListener("click", cerrarModal);
//MODAL//

