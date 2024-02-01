"use strict";

//Agregar el evento DOMContentLoaded para ajustar el tamaño al cargar la página
document.addEventListener("DOMContentLoaded", ajustSize);

// Agregar el evento resize para ajustar el tamaño cuando cambia el tamaño de la ventana
window.addEventListener("resize", ajustSize);

function ajustSize() {
    // Restaurar el diseño original antes de aplicar cambios

    var ventanaAncho = window.innerWidth;
    // Utilizar un switch para determinar el método de ajuste según las dimensiones de la ventana
    switch (true) {
        case ventanaAncho > 1200:
            desktopSize();
            break;
        case ventanaAncho <= 1200 && ventanaAncho > 600:
            tabletSize();
            break;
        case ventanaAncho <= 600:
            mobileSize();
            break;
        default:
            desktopSize(); // Ajuste predeterminado para otras situaciones
            break;
    }
}

function desktopSize() {
    ajustSizeImages(0.238);
}

function tabletSize() {
    ajustSizeImages(0.475);
}

function mobileSize() {
    ajustSizeImages(0.95);
}

function ajustSizeImages(multiplierFactor) {
    var windowheight = window.innerWidth;
    var images = document.getElementsByClassName("image-public-container");

    for (var i = 0; i < images.length; i++) {
        var image = images[i];
        var newHeight = windowheight * multiplierFactor;

        image.style.setProperty("width", newHeight + "px", "important");
    }
}

const desktopMediaQuery = window.matchMedia("(min-width: 1200px)");
const tabletMediaQuery = window.matchMedia(
    "(min-width: 600px) and (max-width: 1200px)"
);
const mobileMediaQuery = window.matchMedia(
    "(min-width: 200px) and (max-width: 600px)"
);

function handleMediaQueryChange() {
    const images = document.querySelectorAll(".image-public-container");

    if (desktopMediaQuery.matches) {
        moveImagesToColumns(images, 1, 2, 3, 4);
    } else if (tabletMediaQuery.matches) {
        moveImagesToColumns(images, 1, 2);
    } else if (mobileMediaQuery.matches) {
        moveImagesToColumns(images, 1);
    }
}

function moveImagesToColumns(images, ...columns) {
    const columnsContainers = columns.map((column) =>
        document.querySelector(`.column-${column}`)
    );

    images.forEach((image, index) => {
        const targetColumn = columns[index % columns.length];
        columnsContainers[targetColumn - 1].appendChild(image);
    });
}

// Asigna el controlador de eventos y evalúa las media queries inicialmente
desktopMediaQuery.addEventListener("change", (e) =>
    handleMediaQueryChange(e.target)
);
tabletMediaQuery.addEventListener("change", (e) =>
    handleMediaQueryChange(e.target)
);
mobileMediaQuery.addEventListener("change", (e) =>
    handleMediaQueryChange(e.target)
);
handleMediaQueryChange(); // Evaluar inicialmente
