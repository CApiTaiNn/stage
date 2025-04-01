document.addEventListener('DOMContentLoaded', function() {
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


    const submitButton = document.getElementById('submit');
    submitButton.addEventListener('click', function(event) {
        event.preventDefault();

        const orga = document.getElementById('orga').value;
        const email = document.getElementById('email').value;
        const form = document.getElementById('loginForm');
        const formData = new FormData(form);
        const apiUrl = "http://localhost:8081/login";


        const requestOption = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(Object.fromEntries(formData.entries()))
        };

        fetch(apiUrl, requestOption)
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response.json();
        })
        .then(data => {
            window.location.href = `authentication.php?orga=${orga}&email=${email}&id_session=${data.id_session}`;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

});


