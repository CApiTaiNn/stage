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
            console.log("Connexion réussie !");
            window.location.href = data.redirect; // Rediriger si succès
        } else {
            console.log("Erreur de connexion");
            document.getElementById("error-message").textContent = data.message;
            document.getElementById("error-message").style.display = "block";
        }
    })
    .catch(error => {
        console.error("Erreur :", error);
        document.getElementById("error-message").textContent = "Erreur de connexion au serveur.";
        document.getElementById("error-message").style.display = "block";
    });
});
