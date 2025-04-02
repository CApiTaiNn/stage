document.getElementById("autForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = new FormData(this);

    fetch("script/auth.php", { // Appel au script PHP
        method: "POST",
        body: formData
    })
    .then(response => response.json()) // Convertir la réponse en JSON
    .then(data => {
        if (data.status === "success") {
            window.location.href = data.redirect; // Rediriger si succès
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
