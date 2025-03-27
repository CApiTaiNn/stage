document.addEventListener('DOMContentLoaded', function() {
    
    const submit = document.getElementById('submit');
    submit.addEventListener('click', function(event) {
        event.preventDefault();

        const form = document.getElementById('autForm');
        const formData = new FormData(form);
        const apiUrl = "http://localhost:8081/authentification";

        const requestOption = {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(
                Object.fromEntries(formData.entries())
            )
        };
        
        fetch(apiUrl, requestOption)
        .then(response => {
            if (!response.ok) {
                throw new Error("HTTP error " + response.status);
            }
            return response;
        })
    });
});