"use strict";

function getImageWith() {
    let image = document.getElementById("imageFullScreen");
    let box = document.getElementById("ImagePublicOptions");

    // Obtén y muestra el ancho de la imagen
    let imageHeight = image.width;

    // Asigna el ancho de la imagen al contenedor
    box.style.width = imageHeight + "px";
}

// Evento que se ejecuta cuando la página se carga completamente
window.addEventListener("load", getImageWith);

// Evento que se ejecuta cuando la ventana cambia de tamaño
window.addEventListener("resize", getImageWith);
