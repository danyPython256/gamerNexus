
var carouselInner = document.querySelector('.carousel-inner');

setInterval(function () {
    var firstImage = carouselInner.firstElementChild;
    carouselInner.appendChild(firstImage);
}, 1000); 