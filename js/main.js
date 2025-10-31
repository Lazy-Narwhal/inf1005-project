document.addEventListener("DOMContentLoaded", function () {
    registerEventListeners();
});


function registerEventListeners() {
    var animals = document.getElementsByClassName("animal");
    if (animals != null && animals.length > 0) {
        for (var i = 0; i < animals.length; i++) {
            var animal = animals[i];
            animal.addEventListener("click", togglePopup);
        }
    }
    else {
        console.log("no images found.");
    }
}


function togglePopup(e) {
    console.log("e.target.title: " + e.target.title)
    console.log("e.target.src: " + e.target.src)

    var existingPopup = document.querySelector(".img-popup");
    if (existingPopup) {
        existingPopup.remove();
        return;
    }

    var currentImage = e.target.src;
    var largeImage = currentImage.replace("small", "large");

    var popupContainer = document.createElement("span");
    popupContainer.setAttribute("class", "img-popup")
    popupContainer.innerHTML = `<img src="${largeImage}">`

    document.body.insertAdjacentElement("beforeend", popupContainer);
    popupContainer.addEventListener("click", function () {
        popupContainer.remove();
    });
}

function activateMenu() {
    const navLinks = document.querySelectorAll('nav a');
    navLinks.forEach(link => {
        if (link.href === location.href) {
            link.classList.add('active');
        }
    })
}
