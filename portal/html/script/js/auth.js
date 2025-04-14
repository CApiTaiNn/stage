/**
 * 
 * Interseption du formulaire d'authentification et script PHP auth.php
 * 
 * Redirige l'utilisateur en fonction de la réponse de l'api ou affiche un message d'erreur
 * 
 * 3 cas possibles :
 * 1. Authentification réussie : redirection vers google
 * 2. Authentification échouée : message d'erreur avec nombre de tentatives restantes
 * 3. Tentative maximale atteinte : redirection vers la page d'accueil de l'organisation
 */

document.getElementById("autForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    fetch("script/js/auth.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            window.location.href = data.redirect;
        } else if (data.message === "tentativeMaxAtteinte") {
            window.location.href = `index.php?orga=${data.orga}`;
        }else {
            document.getElementById("error-message").textContent = data.message;
            document.getElementById("error-message").style.display = "block";
        }
    })
    .catch(error => {
        document.getElementById("error-message").textContent = "Erreur de connexion au serveur.";
        document.getElementById("error-message").style.display = "block";
    });
});
