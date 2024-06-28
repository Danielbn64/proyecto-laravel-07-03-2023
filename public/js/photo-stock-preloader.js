"use strict";

var images = document.querySelectorAll(".image-sizes");
var loadedImagesCount = 0;
var cachedImagesCount = 0;
var restToLoad = 0;
var imagesNumber = 0;

//Este método se activa con el evento load, si las imagenes ya estan cargadas no se activa:
function imageLoaded() {
    loadedImagesCount++;
    imagesNumber = Number(images.length);
    restToLoad = imagesNumber - cachedImagesCount;
    // console.log(
    //     "imagenes restantes que no se han contado: " +
    //         restToLoad +
    //         " numero de imagenes contadas: " +
    //         (loadedImagesCount - 1)
    // );
    if (loadedImagesCount - 1 === restToLoad) {
        document.body.classList.add("loaded");
    }
}

function checkCachedImages() {
    images.forEach(function (image) {
        if (image.complete && image.naturalWidth !== 0) {
            cachedImagesCount++;
        }
    });
    issetLoadded();
}
//El método issetLoadded es nesesario cuando falla el método imageLoaded() que se activa 
//con el evento load ya que si el contador  loadedImagesCount falla es porque no se a 
//activado el método imageLoaded() y no se activa el método imageLoaded() porque todas
//las imágenes estan cargadas:
function issetLoadded() {
    if (cachedImagesCount === images.length) {
        document.body.classList.add("loaded");
    }
}

window.addEventListener("DOMContentLoaded", function () {
    checkCachedImages();
    imageLoaded();
    images.forEach(function (image) {
        image.addEventListener("load", imageLoaded);
    });
});

