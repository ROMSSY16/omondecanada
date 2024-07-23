document.addEventListener("DOMContentLoaded",function(){
    // Fonction pour définir un cookie avec une durée de validité
function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Fonction pour récupérer la valeur d'un cookie
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) === ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

// Fonction pour appliquer les paramètres de configuration
function applyConfig() {
    var navbarColor = getCookie("navbarColor");
    if (navbarColor) {
        document.querySelector(".navbar").style.backgroundColor = navbarColor;
    }
}

// Au chargement de la page
document.addEventListener("DOMContentLoaded", function () {
    applyConfig();
});

// Lorsque l'utilisateur change la configuration de la navbar
function changeNavbarColor(color) {
    document.querySelector(".navbar").style.backgroundColor = color;
    setCookie("navbarColor", color, 30); // Stocker la couleur dans un cookie pendant 30 jours
}

})