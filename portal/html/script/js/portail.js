document.addEventListener('DOMContentLoaded', function() {

    /**
     * Fonction de traduction de la page
     * 2 langues disponibles : fr et en
     * La langue par défaut est le français
     */
    const langElements = document.querySelectorAll('[data-lang]');
    langElements.forEach(element => {
        element.addEventListener('click', function() {
            const lang = this.getAttribute('data-lang');
            changeLanguage(lang);
        });
    });

    function changeLanguage(lang) {
        const elements = document.querySelectorAll('[data-lang-fr], [data-lang-en]');
        elements.forEach(element => {
            const text = element.getAttribute(`data-lang-${lang}`);
            if (text) {
                element.textContent = text;
            }
        });
    }


    /**
     * Envoie des données du formulaire de connexion au proxy
     * Récupère la reponse API
     * Si valide, redirige vers la page d'authentification
    */
    const submitButton = document.getElementById('submit');
    submitButton.addEventListener('click', function(event) {
        event.preventDefault();

        const orga = document.getElementById('orga').value;
        const form = document.getElementById('loginForm');
        const formData = new FormData(form);
        const apiUrl = "script/php/proxy.php";

        
        const requestOption = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(Object.fromEntries(formData.entries())),
            credentials: 'include'
        };

        fetch(apiUrl, requestOption)
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response;
        })
        .then(data => {
            window.location.href = `authentication.php`;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});


