document.addEventListener('DOMContentLoaded', function() {
    
    const submitButton = document.getElementById('submit');
    submitButton.addEventListener('click', function(event) {
        event.preventDefault();

        const form = document.getElementById('autForm');
        const formData = new FormData(form);
        const apiUrl = "http://localhost:8081/authentification";

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
            return response;
        })
        .then(data => {
            console.log("Success:", data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});